<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mapels;
use Illuminate\Http\Request;

class MapelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapels::orderBy('id', 'DESC')->get();
        return view('admin.mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kursus = Course::all();
        return view('admin.mapel.create', compact('kursus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_courses' => 'required',
            'name' => 'required|min:3',
            'description' => 'required',
            'guru' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'hari' => 'required'
        ]);
        // dd($data);
        Mapels::create($data);
        return redirect()->route('admin.mapel.index')->with('success', "Mata Pelajaran Berhasil Di Buat!!");
    }

    public function active(Request $request, string $id)
    {
        $mapels = Mapels::find($id);

        $activeMapelCount = Mapels::where('status', 'Active')->count();
        

        $data['status'] = $mapels->status === 'Active' ? 'nonActive' : 'Active';

        $mapels->update($data);
        return redirect()->route('admin.mapel.index')->with('success', "Status Mata Pelajaran Berhasil Diubah");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mapel = Mapels::find($id);
        return view('admin.mapel.detail', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kursus = Course::all();
        $mapel = Mapels::find($id);
        return view('admin.mapel.edit', compact('kursus', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mapel = Mapels::findOrFail($id);

        $data = $request->validate([
            'id_courses' => 'required',
            'name' => 'required|min:3',
            'description' => 'required', // Tambahkan aturan validasi untuk description
            'guru' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'hari' => 'required'
        ]);
        // dd($data);
        $mapel->update($data);
        return redirect()->route('admin.mapel.index')->with('success', "Mata Pelajaran Berhasil Di Edit!!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = Mapels::findOrFail($id);
        $mapel->delete();
        return redirect()->route('admin.mapel.index')->with('success', "Mata Pelajaran Berhasil Di Hapus!!");
    }
}
