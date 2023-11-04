<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
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
                Jurusan::create($data);
                return redirect()->route('admin.jurusan.index')->with('success', "Jurusan Berhasil Di Buat!!");
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
                return view('admin.jurusan.detail');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
                $tahun_ajaran = TahunAjaran::all();
                return view('admin.jurusan.edit', compact('tahun_ajaran'));
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
