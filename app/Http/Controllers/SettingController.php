<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function index()
    {
        $notif = Notify::where('id',1)->first();
        return view('admin.settings.index',compact('notif'));
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
