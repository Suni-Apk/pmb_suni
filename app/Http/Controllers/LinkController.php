<?php

namespace App\Http\Controllers;

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
        $link = Link::all();
        return view('admin.link_whatsapp.index', compact('link'));
    }

    public function whatsapp_create()
    {
        $tahunAjaran = TahunAjaran::all();
        $jurusanGrouped = Jurusan::with('tahunAjaran')->get()->groupBy('id_tahun_ajarans');
        return view('admin.link_whatsapp.create', compact('tahunAjaran', 'jurusanGrouped'));
    }

    public function whatsapp_create_process(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'url' => 'required',
            'id_tahun_ajarans' => 'required',
            'id_jurusans' => 'required',
            'gender' => 'required'
        ]);

        $data['type'] = 'whatsapp';
        // dd($data);
        Link::create($data);
        return redirect()->route('admin.link_whatsapp.index')->with('success', "Link Berhasil Di Buat!!");
    }

    public function whatsapp_edit($id)
    {
        $link = Link::findOrFail($id);
        $tahunAjaran = TahunAjaran::all();
        $jurusans = Jurusan::all();
        $jurusanGrouped = Jurusan::with('tahunAjaran')->get()->groupBy('id_tahun_ajarans');
        return view('admin.link_whatsapp.edit', compact('tahunAjaran', 'jurusanGrouped', 'link', 'jurusans'));
    }

    public function whatsapp_edit_process(Request $request, string $Id)
    {
        $link = Link::findOrFail($Id);

        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'url' => 'required',
            'id_tahun_ajarans' => 'required',
            'id_jurusans' => 'required',
            'gender' => 'required'
        ]);

        $link->update($data);
        return redirect()->route('admin.link_whatsapp.index')->with('success', "Link Berhasil Di Edit!!");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
