<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::orderBy('id', 'DESC')->get();
        return view('admin.tahun_ajaran.index', compact('tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tahun_ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ]);
        TahunAjaran::create($data);
        return redirect()->route('admin.tahun_ajaran.index')->with('success', "Tahun Ajaran Berhasil Di Buat!!");
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
        $tahun_ajaran = TahunAjaran::findOrFail($id);
        $tahun_ajaran->delete();
        return redirect()->route('admin.tahun_ajaran.index');
    }
}
