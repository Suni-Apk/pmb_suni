<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Matkuls;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun_ajaran = TahunAjaran::all();
        return view('admin.jurusan.create', compact('tahun_ajaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_tahun_ajarans' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);
        $jurusan = Jurusan::create($data);
        $semester = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8'];      
        // $tanggal = ['', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8'];      
        foreach($semester as $key => $item){
            Semester::create([
                'id_jurusans' => $jurusan->id,
                'name' => $item
                // 'start_date' =>  $tanggals
            ]);
        }
        return redirect()->route('admin.jurusan.index')->with('success', "Jurusan Berhasil Di Buat!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matkuls = Matkuls::all();
        $jurusan = Jurusan::findOrFail($id);
        $jurusanAll = Jurusan::all();
        $semester = Semester::where('id_jurusans', $id)->get();
        $semesterGrouped = Semester::with('jurusan')->get()->groupBy('id_jurusans');
        return view('admin.jurusan.detail',compact('semester', 'jurusan', 'matkuls', 'jurusanAll', 'semesterGrouped')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jurusan = Jurusan::find($id);
        $tahun_ajaran = TahunAjaran::all();
        return view('admin.jurusan.edit', compact('tahun_ajaran', 'jurusan'));
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
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index');
    }
}
