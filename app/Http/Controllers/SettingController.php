<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\General;
use Illuminate\Http\Request;
use App\Models\DescProgramBelajar;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    //

    public function index()
    {
        $general = General::first();
        $descPro = DescProgramBelajar::first();

        return view('admin.settings.index', compact('general', 'descPro'));
    }

    public function general_edit(Request $request, $id)
    {
        $general = General::find($id);
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
                $location = 'uploads';

                // upload file
                $file->move($location, $filename);

                // file path
                $filepath = url('uploads/'.$filename);

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
            'notif_otp' => 'required|string'
        ]);

        $notif->update($data);

        return redirect()->route('admin.settings.notifications')->with('success','Berhasil Mengedit Notifikasi');
    }
}
