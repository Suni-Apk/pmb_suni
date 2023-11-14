<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\General;
use Illuminate\Http\Request;
use App\Models\DescProgramBelajar;

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

    public function desc_edit(Request $request, $id)
    {
        $descPro = DescProgramBelajar::find($id);
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
}
