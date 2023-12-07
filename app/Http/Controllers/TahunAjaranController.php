<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Link;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

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
        return redirect()->route('admin.tahun-ajaran.index')->with('success', "Tahun Ajaran Berhasil Di Buat!!");
    }


    public function active(Request $request, string $id)
    {
        $tahun_ajaran = TahunAjaran::find($id);

        $activeTahunAjaranCount = TahunAjaran::where('status', 'Active')->count();


        // if ($tahun_ajaran->status == 'Active' && $activeTahunAjaranCount <= 1) {
        //     return redirect()->route('admin.tahun_ajaran.index')->with('pesan', "Tidak dapat menonaktifkan satu-satunya tahun ajaran yang aktif");
        // }


        if ($tahun_ajaran->status == 'nonActive' && $activeTahunAjaranCount > 0) {
            return redirect()->route('admin.tahun-ajaran.index')->with('pesan', "Tidak dapat mengaktifkan tahun ajaran lain ketika sudah ada yang aktif");
        }

        $data['status'] = $tahun_ajaran->status === 'Active' ? 'nonActive' : 'Active';

        $tahun_ajaran->update($data);
        return redirect()->route('admin.tahun-ajaran.index')->with('success', "Status Tahun Ajaran Berhasil Diubah");
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $angkatan = TahunAjaran::findOrFail($id);
        $jurusan = Jurusan::all();
        $jurusans = $angkatan->jurusans;
        $links = Link::get();

        return view('admin.tahun_ajaran.detail', compact('angkatan', 'links', 'jurusan', 'jurusans'));
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
        $data = TahunAjaran::findOrFail($id);

        if ($data->users) {
            $data->users->delete();
        }
        if ($data->biodatas) {
            $data->biodatas->delete();
        }
        if ($data->links) {
            $data->links->delete();
        }

        $data->delete();
        return redirect()->route('admin.tahun-ajaran.index');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $data = TahunAjaran::whereIn('id', $ids);
        $data->delete();
        return redirect()->route('admin.tahun_ajaran.index')->with('success', 'Kamu telah berhasil menghapus tahun ajaran');
    }
}
