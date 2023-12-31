<?php

namespace App\Http\Controllers;

use App\Exports\JurusanExport;
use App\Models\Course;
use App\Models\Jurusan;
use App\Models\Link;
use App\Models\Matkuls;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'name' => 'required',
            'code' => 'required'
        ]);
        $jurusan = Jurusan::create($data);

        $semester = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8'];

        foreach ($semester as $key => $item) {
            Semester::create([
                'id_jurusans' => $jurusan->id,
                'name' => $item
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
        $tahun_ajaran = TahunAjaran::get();
        $links = Link::get();
        $kursus = Course::all();
        return view('admin.jurusan.detail', compact('semester', 'jurusan', 'matkuls', 'jurusanAll', 'semesterGrouped', 'links', 'tahun_ajaran','kursus'));
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
        $jurusan = Jurusan::find($id);
        $data  = $request->validate([
            'id_tahun_ajarans' => 'required',
            'name' => 'required',
            'code' => 'required'
        ]);
        $jurusan->update($data);
        return redirect()->route('admin.jurusan.index')->with('success', "Jurusan Berhasil Di Edit!!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        if ($jurusan->matkuls) {
            $jurusan->matkuls->delete();
        }
        if ($jurusan->semesters) {
            $jurusan->semesters->delete();
        }
        if ($jurusan->links) {
            $jurusan->links->delete();
        }

        $jurusan->delete();
        return redirect()->route('admin.jurusan.index');
    }

    public function exportJurusan(Request $request)
    {
        return Excel::download(new JurusanExport($request), 'dataJurusan.xlsx');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $jurusan = Jurusan::whereIn('id', $ids);
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index');
    }
}
