<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Notify;
use App\Models\General;
use Illuminate\Http\Request;
use App\Models\DescProgramBelajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $general = General::first();
        $descPro = DescProgramBelajar::first();

        return view('admin.settings.index', compact('general', 'descPro'));
    }

    public function general_edit(Request $request, $id)
    {
        $general = General::find($id);

        $data = $request->validate([
            'name'        => 'required|string|max:200',
            'phone'       => 'required',
            'email'       => 'required|email',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,svg,ico|max:4096',
            'image_link'  => 'nullable|url|string',
            'title'       => 'required|string|max:100',
            'url'         => 'required',
        ]);

        if ($request->hasFile('image') && $request->input('image_link')) {
            return redirect()->back()->withInput()->withErrors(['image' => 'Hanya boleh memilih satu metode untuk upload gambar.']);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/' . $file->store('settings', 'public');

            $data['image'] = url($filepath);
        } elseif ($request->has('image_link')) {
            $data['image'] = $request->image_link;
        } else {
            $data['image'] = $general->image;
        }

        $general->update($data);

        return redirect()->route('admin.settings.general')->with('success', 'Data Sekolah berhasil di ubah!');
    }

    public function upload_file(Request $request)
    {
        $data = array();

        $validator = Validator::make($request->all(), [
            'upload' => 'required|mimes:png,jpg,jpeg,gif,webp|max:8192'
        ]);

        if ($validator->fails()) {
            $data['uploaded'] = 0;
            $data['error']['message'] = $validator->errors()->first('upload'); // error response
        } else {
            if ($request->file('upload')) {
                $file = $request->file('upload');
                $filename = time().'_'.$file->getClientOriginalName();

                // file upload location
                $location = 'storage/uploads';

                // upload file
                $file->move($location, $filename);

                // file path
                $filepath = url('storage/uploads/'.$filename);

                // response
                $data['fileName'] = $filename;
                $data['uploaded'] = 1;
                $data['url'] = $filepath;
            } else {
                // response
                $data['uploaded'] = 0;
                $data['error']['message'] = 'File not uploaded.'; // error response
            }
        }

        return response()->json($data);
    }

    public function desc_edit(Request $request, $id)
    {
        $descPro = DescProgramBelajar::find($id);

        $validator = Validator::make($request->all(), [
            's1' => 'required',
            'kursus' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            // Gunakan $request->all() alih-alih $data
            $descPro->update($request->all());
            return redirect()->route('admin.settings.general')->with('success', 'Berhasil mengubah deskripsi program belajar.');
        }
    }

    public function notify_index()
    {
        $notif = Notify::first();
        return view('admin.settings.notify',compact('notif'));
    }

    public function notify_edit(Request $request,$id)
    {
        $notif = Notify::find($id);

        $data = $request->validate([
            'notif_otp' => 'required|string',
            'notif_isi_biodata_formal' => 'required',
            'notif_isi_biodata_nonformal' => 'required',
            'notif_isi_document' => 'required',
            'notif_administrasi_formal' => 'required',
            'notif_administrasi_nonformal' => 'required'
        ]);

        $notif->update($data);

        return redirect()->route('admin.settings.notifications')->with('success','Berhasil Mengedit Notifikasi');
    }

    public function komponen()
    {
        $banner = Banner::latest()->get();
        return view('admin.settings.component', compact('banner'));
    }

    public function create_banner()
    {
        return view('admin.settings.component.create-banner');
    }

    public function store_banner(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:png,jpg,svg,jpeg,gif,webp|max:6144',
            'image_link'  => 'nullable|url|string',
            'author'      => 'nullable',
            'type'        => 'required',
        ]);

        if ($request->type == 'DASHBOARD') {
            $dataDB = $request->validate([
                'target'      => 'required',
                'desc'        => 'nullable'
            ]);

            $data = array_merge($data, $dataDB);
        }

        if ($request->type == 'WELCOME') {
            $data['target'] = NULL;
        }

        // type : welcome atau dashboard
        // target : admin, mahasiswa, kursus

        $data['author'] = Auth::user()->id;

        if ($request->hasFile('image') && $request->input('image_link')) {
            return redirect()->back()->withInput()->withErrors(['image' => 'Hanya boleh memilih satu metode untuk upload gambar.']);
        } elseif ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/' . $file->store('component', 'public');

            $data['image'] = url($filepath);
        } elseif ($request->has('image_link')) {
            $data['image'] = $request->image_link;
        }

        Banner::create($data);

        return redirect()->route('admin.settings.component')->with('success', 'Anda berhasil menambahkan data');
    }

    public function edit_banner($id)
    {
        $banner = Banner::find($id);
        return view('admin.settings.component.edit-banner', compact('banner'));
    }

    public function update_banner(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:png,jpg,svg,jpeg,gif,webp|max:6144',
            'image_link'  => 'nullable|url|string',
            'author'      => 'nullable',
            'type'        => 'required',
        ]);

        if ($request->type == 'DASHBOARD') {
            $dataDB = $request->validate([
                'target'      => 'required',
                'desc'        => 'nullable'
            ]);

            $data = array_merge($data, $dataDB);
        }

        if ($request->type == 'WELCOME') {
            $data['target'] = NULL;
        }

        // type : welcome atau dashboard
        // target : admin, mahasiswa, kursus

        $data['author'] = Auth::user()->id;

        if ($request->hasFile('image') && $request->input('image_link')) {
            return redirect()->back()->withInput()->withErrors(['image' => 'Hanya boleh memilih satu metode untuk upload gambar.']);
        } elseif ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/' . $file->store('component', 'public');

            $data['image'] = url($filepath);
        } elseif ($request->has('image_link')) {
            $data['image'] = $request->image_link;
        } else {
            $data['image'] = $banner->image;
        }

        $banner->update($data);

        return redirect()->route('admin.settings.component')->with('edit', 'Anda berhasil mengubah data');
    }

    public function delete_banner($id)
    {
        $banner = Banner::findOrFail($id);

        $banner->delete();
        return redirect()->route('admin.settings.component')->with('delete', 'Anda berhasil menghapus data');
    }
}
