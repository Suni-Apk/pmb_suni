<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Jurusan;
use App\Models\Link;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function whatsapp()
    {
        $link = Link::where('type', 'Whatsapp')->orderBy('id', 'desc')->get();
        // dd($link);
        return view('admin.link.whatsapp', compact('link'));
    }


    //Zoom Section

    public function zoom()
    {
        $link = Link::where('type', 'Zoom')->orderBy('id', 'desc')->get();
        return view('admin.link.zoom', compact('link'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::get();
        $tahun_ajarans = TahunAjaran::get();
        $kursus = Course::get();
        return view('admin.link.create', compact('jurusans', 'tahun_ajarans', 'kursus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'url' => 'required',
            'type' => 'required',
            'id_tahun_ajarans' => 'required',
            'id_jurusans' => 'nullable',
            'gender' => 'required',
            'id_courses' => 'nullable'
        ]);

        if ($request->id_courses) {
            $data['program'] = 'KURSUS';
        } else {
            $data['program'] = 'S1';
        }

        // dd($data);
        Link::create($data);
        if ($request->type == 'whatsapp') {
            return redirect()->route('admin.link.whatsapp')->with('success', "Link Berhasil Di Buat!!");
        } elseif ($request->type == 'zoom') {
            return redirect()->route('admin.link.zoom')->with('success', "Link Berhasil Di Buat!!");
        } else {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = Link::find($id);
        return view("admin.link.detail", compact("link"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type, string $id)
    {
        $link = Link::find($id);
        $jurusans = Jurusan::get();
        $kursus = Course::get();
        $tahun_ajarans = TahunAjaran::get();
        return view("admin.link.edit", compact("link", "jurusans", "tahun_ajarans", "kursus"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $link = Link::find($id);
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'url' => 'required',
            'type' => 'required',
            'id_tahun_ajarans' => 'string',
            'id_jurusans' => 'nullable',
            'id_courses' => 'nullable',
            'gender' => 'required',
        ]);

        if ($request->id_courses) {
            $data['program'] = 'KURSUS';
        } else {
            $data['program'] = 'S1';
        }

        // dd($data);
        $link->update($data);
        if ($request->type == 'whatsapp') {
            return redirect()->route('admin.link.whatsapp')->with('success', "Link Berhasil Di Ubah!!");
        } elseif ($request->type == 'zoom') {
            return redirect()->route('admin.link.zoom')->with('success', "Link Berhasil Di Ubah!!");
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::find($id);

        if ($link->type == 'Whatsapp' || $link->type == 'whatsapp') {
            $link->delete();
            return redirect()->route('admin.link.whatsapp')->with('success', "Link Berhasil Di Ubah!!");
        } elseif ($link->type == 'Zoom' || $link->type == 'zoom') {
            $link->delete();
            return redirect()->route('admin.link.zoom')->with('success', "Link Berhasil Di Ubah!!");
        } else {
            return false;
        }
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $link = Link::where('id', $ids)->first();
        $links = Link::whereIn('id', $ids);

        if ($link->type == 'Whatsapp' || $link->type == 'whatsapp') {
            $links->delete();
            return redirect()->route('admin.link.whatsapp')->with('success', "Link Berhasil Di Ubah!!");
        } elseif ($link->type == 'Zoom' || $link->type == 'zoom') {
            $links->delete();
            return redirect()->route('admin.link.zoom')->with('success', "Link Berhasil Di Ubah!!");
        } else {
            return false;
        }
    }
}
