<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Matkuls;
use App\Models\Semester;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkuls = Matkuls::all();
        return view('admin.matkul.index', compact('matkuls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $semesterGrouped = Semester::with('jurusan')->get()->groupBy('id_jurusans');
        return view('admin.matkul.create', compact('jurusan', 'semesterGrouped'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_jurusans' => 'required',
            'id_semesters' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'hari' => 'required',
            'nama_matkuls' => 'required',
            'nama_dosen' => 'required'
        ]);
        Matkuls::create($data);
        return redirect()->route('admin.matkul.index')->with('success', "Mata Kuliah Berhasil Di Buat!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matkuls = Matkuls::findOrFail($id);
        return view('admin.matkul.detail', compact('matkuls'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matkuls = Matkuls::findOrFail($id);
        $jurusan = Jurusan::all();
        $semesterGrouped = Semester::with('jurusan')->get()->groupBy('id_jurusans');
        return view('admin.matkul.edit', compact('matkuls', 'jurusan', 'semesterGrouped'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $matkuls = Matkuls::findOrFail($id);
        $data = $request->validate([
            'id_jurusans' => 'required',
            'id_semesters' => 'required',
            'nama_matkuls' => 'required|min:3',
            'nama_dosen' => 'required|min:3',
            'mulai' => 'required',
            'selesai' => 'required',
            'hari' => 'required'
        ]);
        // dd($data);
        $matkuls->update($data);
        return redirect()->route('admin.matkul.index')->with('success', "Mata Kuliah Berhasil Di Edit!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matkuls = Matkuls::findOrFail($id);
        $matkuls->delete();
        return redirect()->route('admin.matkul.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $matkuls = Matkuls::whereIn('id', $ids);
        $matkuls->delete();
        return redirect()->route('admin.matkul.index');
    }
}
