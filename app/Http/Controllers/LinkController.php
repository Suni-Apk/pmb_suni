<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function whatsapp()
    {
        $links = Link::where('type', 'Whatsapp')->orderBy('id', 'desc')->get();
        return view('admin.link_whatsapp.index', compact('links'));
    }

    public function zoom()
    {
        $links = Link::where('type', 'Zoom')->orderBy('id', 'desc')->get();
        return view('admin.link_whatsapp.index', compact('links'));
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
        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'url' => 'required',
            'type' => 'required',
            'id_tahun_ajarans' => 'string',
            'id_jurusans' => 'string',
            'gender' => 'required'
        ]);

        // dd($data);
        Link::create($data);
        return redirect()->route('admin.link_whatsapp.index')->with('success', "Link Berhasil Di Buat!!");
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
