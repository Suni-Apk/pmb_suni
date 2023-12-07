<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Biodata;
use App\Models\Course;
use App\Models\Jurusan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\TahunAjaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biaya = Biaya::all();

        return view('admin.tagihan.index', compact('biaya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    public function next(Request $request)
    {
        $data = $request->validate([
            'jenis_tagihan' => 'required'
        ]);
        $jenis_tagihan = $request->jenis_tagihan;
        $tahunAjaran = TahunAjaran::all();
        $course = Course::all();
        $jurusanGrouped = Jurusan::with('tahunAjaran')->get()->groupBy('id_tahun_ajarans');
        $jurusans = Jurusan::with('tahunAjaran')->first();
        $biayaRoutine = Biaya::where('jenis_biaya', 'Routine')->pluck('id_angkatans');
        $biayaDaftarUlang = Biaya::where('jenis_biaya', 'DaftarUlang')->pluck('id_angkatans');

        $onlyTahunAjaran = $tahunAjaran->whereNotIn('id', $biayaRoutine);
        $onlyTahunAjaran2 = $tahunAjaran->whereNotIn('id', $biayaDaftarUlang);

        return view('admin.tagihan.create', compact('jenis_tagihan', 'tahunAjaran', 'jurusanGrouped', 'jurusans', 'course', 'onlyTahunAjaran', 'onlyTahunAjaran2'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->jenis_biaya == 'Routine') {
            $data = $request->validate([
                'id_angkatans' => 'required',
                'jenis_biaya' => 'required',
                'end_date.*' => 'required',
                'mounth.*' => 'nullable',
                'amount.*' => 'required|string|min:6',
                'status' => 'nullable',
            ]);
            $tahunAjaran = TahunAjaran::where('id', $data['id_angkatans'])->first();
            $biaya = Biaya::create([
                'id_angkatans' => $data['id_angkatans'],
                'jenis_biaya' => $data['jenis_biaya'],
                'nama_biaya' => 'Tagihan Spp tahun ' . $tahunAjaran->year,
                'program_belajar' => 'S1',
            ]);
            $dateEnd = request()->input('end_date');
            $mounth = request()->input('mounth');
            $replace_amount = str_replace('.', '', $data['amount']);

            foreach ($replace_amount as $key => $amount) {
                $tagihanCreate = Tagihan::create([
                    'id_biayas' => $biaya->id,
                    'mounth' => $mounth[$key],
                    'amount' => $amount,
                    'end_date' => $dateEnd[$key],
                ]);

                $mahasiswa = Biodata::where('angkatan_id', $biaya->id_angkatans)->where('program_belajar', $biaya->program_belajar)->get();

                foreach ($mahasiswa  as $index => $value) {
                    $transaction = Transaksi::where('user_id', $value->user_id)->where('program_belajar', 'S1')->where('jenis_tagihan', 'DaftarUlang')->where('status', 'berhasil')->get();
                    if ($transaction->count() >= 1) {
                        $end_date = strtotime('-10 days', strtotime($dateEnd[$key]));
                        $end_dates = date('Y-m-d', $end_date);
                        TagihanDetail::create([
                            'id_biayas' => $biaya->id,
                            'id_tagihans' => $tagihanCreate->id,
                            'id_users' => $value->user->id,
                            'end_date' => $dateEnd[$key],
                            'amount' => $amount,
                            'status' => 'BELUM',
                            'before_end' => $end_dates,
                        ]);
                    }
                }
            }
            return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Membuat tagihan ' . $biaya->nama_biaya);
        } else if ($request->jenis_biaya == 'Tidakroutine') {
            $data = $request->validate([
                'jenis_biaya' => 'required',
                'nama_biaya' => 'required',
                'program_belajar' => 'required',
                'end_date' => 'required',
                'mounth' => 'nullable',
                'amount' => 'required|string|min:6',
                'status' => 'nullable',
            ]);
            if ($request->program_belajar == 'S1') {
                $data = $request->validate([
                    'id_angkatans' => 'required',
                    'jenis_biaya' => 'required',
                    'nama_biaya' => 'required',
                    'program_belajar' => 'required',
                    'end_date' => 'required',
                    'mounth' => 'nullable',
                    'amount' => 'required|string|min:6',
                    'status' => 'nullable',
                ]);
                $biaya = Biaya::create([
                    'id_angkatans' => $data['id_angkatans'],
                    'jenis_biaya' => 'Tidakroutine',
                    'nama_biaya' => $data['nama_biaya'],
                    'program_belajar' => $data['program_belajar'],
                ]);
                $dateEnd = $data['end_date'];
                $mounth = $request->mounth;
                $replace_amount = str_replace('.', '', $data['amount']);

                $tagihanCreate = Tagihan::create([
                    'id_biayas' => $biaya->id,
                    'amount' => $replace_amount,
                    'end_date' => $dateEnd,
                ]);

                $mahasiswa = Biodata::where('angkatan_id', $biaya->id_angkatans)
                ->where('program_belajar', $biaya->program_belajar)
                ->get();


                foreach ($mahasiswa as $index => $value) {
                    $transaction = Transaksi::where('user_id', $value->user_id)->where('program_belajar', $value->program_belajar)->where('jenis_tagihan', 'DaftarUlang')->where('status', 'berhasil')->get();
                    if ($transaction->count() >= 1) {
                        $end_date = strtotime('-10 days', strtotime($dateEnd));
                        $end_dates = date('Y-m-d', $end_date);
                        TagihanDetail::create([
                            'id_biayas' => $biaya->id,
                            'id_tagihans' => $tagihanCreate->id,
                            'id_users' => $value->user->id,
                            'end_date' => $dateEnd,
                            'amount' => $replace_amount,
                            'status' => 'BELUM',
                            'before_end' => $end_dates
                        ]);
                    }
                }
                return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Membuat tagihan ' . $biaya->nama_biaya);
            } else if ($request->program_belajar == 'Kursus') {
                $data = $request->validate([
                    'id_angkatans' => 'required',
                    'id_jurusans' => 'nullable',
                    'jenis_biaya' => 'required',
                    'nama_biaya' => 'required',
                    'program_belajar' => 'required',
                    'end_date' => 'required',
                    'id_kursus' => 'required',
                    'mounth' => 'nullable',
                    'amount' => 'required|string|min:6',
                    'status' => 'nullable',
                ]);
                $biaya = Biaya::create([
                    'id_angkatans' => $data['id_angkatans'],
                    'id_kursus' => $data['id_kursus'],
                    'jenis_biaya' => 'Tidakroutine',
                    'nama_biaya' => $data['nama_biaya'],
                    'program_belajar' => $data['program_belajar'],
                ]);

                $dateEnd = $data['end_date'];
                $mounth = $request->mounth;
                $replace_amount = str_replace('.', '', $data['amount']);

                $tagihanCreate = Tagihan::create([
                    'id_biayas' => $biaya->id,
                    'amount' => $replace_amount,
                    'end_date' => $dateEnd,
                ]);

                $mahasiswa = Biodata::where('angkatan_id', $biaya->id_angkatans)->where('program_belajar', $biaya->program_belajar)->get();

                foreach ($mahasiswa as $index => $value) {
                    $end_date = strtotime('-10 days', strtotime($dateEnd));
                    $end_dates = date('Y-m-d', $end_date);
                    if ($value->user->status == 'on') {
                        TagihanDetail::create([
                            'id_biayas' => $biaya->id,
                            'id_tagihans' => $tagihanCreate->id,
                            'id_users' => $value->user->id,
                            'end_date' => $dateEnd,
                            'amount' => $replace_amount,
                            'status' => 'BELUM',
                        ]);
                    }
                }
                return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Membuat tagihan ' . $biaya->nama_biaya);
            }
        } else if ($request->jenis_biaya == 'DaftarUlang') {
            $data = $request->validate([
                'id_angkatans' => 'required',
                'end_date' => 'required',
                'mounth' => 'nullable',
                'amount' => 'required|string|min:6',
                'status' => 'nullable',
            ]);
            $tahunAjaran = TahunAjaran::where('id', $data['id_angkatans'])->first();
            $biodata = Biodata::where('angkatan_id', $data['id_angkatans'])->where('program_belajar', 'S1')->first();
            if (!$biodata) {
                $biaya = Biaya::create([
                    'id_angkatans' => $data['id_angkatans'],
                    'jenis_biaya' => 'DaftarUlang',
                    'nama_biaya' => 'Tagihan Daftar Ulang ' . $tahunAjaran->year,
                    'program_belajar' => 'S1',
                ]);
                $dateEnd = $data['end_date'];
                // $mounth = $tagihan['mounth'];
                $replace_amount = str_replace('.', '', $data['amount']);
                $tagihanCreate = Tagihan::create([
                    'id_biayas' => $biaya->id,
                    'amount' => $replace_amount,
                    'end_date' => $dateEnd,
                ]);
                $mahasiswa = Biodata::where('angkatan_id', $biaya->id_angkatans)->where('program_belajar', $biaya->program_belajar)->get();

                foreach ($mahasiswa as $index => $value) {
                    $end_date = strtotime('-10 days', strtotime($dateEnd));
                    $end_dates = date('Y-m-d', $end_date);
                    TagihanDetail::create([
                        'id_biayas' => $biaya->id,
                        'id_tagihans' => $tagihanCreate->id,
                        'id_users' => $value->user->id,
                        'end_date' => $dateEnd,
                        'amount' => $replace_amount,
                        'status' => 'BELUM',
                        'before_end' => $end_dates,
                    ]);
                }
                return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Membuat tagihan ' . $biaya->nama_biaya);
            } else {
                $angkatan = TahunAjaran::find($data['id_angkatans']);
                return redirect()->back()->with('error', 'Maaf sudah ada murid di angkatan ' . $angkatan->year);
            }

            // } else if ($request->jenis_biaya == 'Tingkatan') {
            //     $data = $request->validate([
            //         'id_angkatans' => 'required',
            //         'jenis_biaya' => 'required',
            //         'end_date' => 'required',
            //         'mounth' => 'nullable',
            //         'amount' => 'required|string|min:6',
            //         'status' => 'nullable',
            //     ]);
            //     $tahunAjaran = TahunAjaran::where('id', $data['id_angkatans'])->first();
            //     $biaya = Biaya::create([
            //         'id_angkatans' => $data['id_angkatans'],
            //         'jenis_biaya' => 'DaftarUlang',
            //         'nama_biaya' => 'Tagihan Daftar Ulang ' . $tahunAjaran->year,
            //         'program_belajar' => 'S1',
            //     ]);
            //     $dateEnd = $data['end_date'];
            //     // $mounth = $tagihan['mounth'];
            //     $replace_amount = str_replace('.', '', $data['amount']);
            //     $tagihanCreate = Tagihan::create([
            //         'id_biayas' => $biaya->id,
            //         'amount' => $replace_amount,
            //         'end_date' => $dateEnd,
            //     ]);
            //     $mahasiswa = Biodata::where('angkatan_id', $biaya->id_angkatans)->where('program_belajar', $biaya->program_belajar)->get();

            //     foreach ($mahasiswa as $index => $value) {
            //         TagihanDetail::create([
            //             'id_biayas' => $biaya->id,
            //             'id_tagihans' => $tagihanCreate->id,
            //             'id_users' => $value->user->id,
            //             'end_date' => $dateEnd,
            //             'amount' => $replace_amount,
            //             'status' => 'BELUM',
            //         ]);
            //     }
            //     return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Membuat tagihan ' . $biaya->nama_biaya);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $biaya = Biaya::find($id);
        $tagihan = Tagihan::where('id_biayas', $biaya->id)->get();
        $tagihans = Tagihan::where('id_biayas', $biaya->id)->first();
        $total = Tagihan::where('id_biayas', $biaya->id)->sum('amount');
        return view('admin.tagihan.detail', compact('id', 'biaya', 'tagihan', 'tagihans', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $biaya = Biaya::find($id);
        $tagihan = Tagihan::where('id_biayas', $biaya->id)->get();
        $tagihans = Tagihan::where('id_biayas', $biaya->id)->first();

        return view('admin.tagihan.edit', compact('biaya', 'tagihan', 'tagihans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $biaya = Biaya::find($id);
        if ($request->jenis_biaya == 'Routine') {
            $data  = $request->validate([
                'end_date.*' => 'required|date_format:Y-m-d',
                'amount.*' => 'required|string|min:5',
                'status.*' => 'nullable',
            ]);
            $dateEnd = request()->input('end_date');
            $replace_amount = str_replace('.', '', request()->input('amount'));
            $tagihan = Tagihan::where('id_biayas', '=', $biaya->id)->get();
            foreach ($tagihan as $key => $tagihans) {
                $tagihan = Tagihan::where('id', '=', $tagihans->id);
                $tagihanUpdate =  $tagihan->update([
                    'end_date' => $dateEnd[$key],
                    'amount' => $replace_amount[$key],
                ]);

                $tagihanGet = Tagihan::where('id', $tagihans->id)->get();
                foreach ($tagihanGet as $index => $value) {
                    $end_date = strtotime('-10 days', strtotime($dateEnd[$key]));
                    $end_dates = date('Y-m-d', $end_date);
                    TagihanDetail::where('id_tagihans', $value->id)->update([
                        'end_date' => $dateEnd[$key],
                        'amount' => $value->amount,
                        'status' => 'BELUM',
                        'before_end' => $end_dates,
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Berhasil mengupdate data ' . $biaya->nama_biaya);
        } else if ($request->jenis_biaya == 'Tidakroutine') {
            $data  = $request->validate([
                'end_date' => 'required|date_format:Y-m-d',
                'amount' => 'required|string|min:6',
                'status' => 'nullable',
                'nama_biaya' => 'required'
            ]);
            $biaya->update([
                'nama_biaya' => $data['nama_biaya'],
            ]);
            $dateEnd = request()->input('end_date');
            $replace_amount = str_replace('.', '', request()->input('amount'));
            $tagihan = Tagihan::where('id_biayas', '=', $biaya->id)->first();
            $tagihans = Tagihan::where('id', '=', $tagihan->id)->first();
            $tagihans->update([
                'end_date' => $dateEnd,
                'amount' => $replace_amount,
            ]);
            $tagihanGet = Tagihan::where('id', $tagihans->id)->get();
            foreach ($tagihanGet as $index => $value) {
                $end_date = strtotime('-10 days', strtotime($dateEnd));
                $end_dates = date('Y-m-d', $end_date);
                TagihanDetail::where('id_tagihans', $value->id)->update([
                    'end_date' => $dateEnd,
                    'amount' => $value->amount,
                    'status' => 'BELUM',
                    'before_end' => $end_dates,
                ]);
            }
            return redirect()->back()->with('success', 'Berhasil mengupdate data ' . $biaya->nama_biaya);
        } else if ($request->jenis_biaya == 'Tingkatan') {
            $data  = $request->validate([
                'end_date.*' => 'required|date_format:Y-m-d',
                'amount.*' => 'required|string|min:6',
                'status.*' => 'nullable',
            ]);
            $dateEnd = request()->input('end_date');
            $replace_amount = str_replace('.', '', request()->input('amount'));
            $tagihan = Tagihan::where('id_biayas', '=', $biaya->id)->get();
            foreach ($tagihan as $key => $tagihans) {
                $tagihan = Tagihan::where('id', '=', $tagihans->id);
                $tagihan->update([
                    'end_date' => $dateEnd[$key],
                    'amount' => $replace_amount[$key],
                ]);

                $tagihanGet = Tagihan::where('id', $tagihans->id)->get();
                foreach ($tagihanGet as $index => $value) {
                    TagihanDetail::where('id_tagihans', $value->id)->update([
                        'end_date' => $dateEnd[$key],
                        'amount' => $value->amount,
                        'status' => 'BELUM',
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Berhasil mengupdate data ' . $biaya->nama_biaya);
        } else if ($request->jenis_biaya == 'DaftarUlang') {
            $data  = $request->validate([
                'end_date' => 'required|date_format:Y-m-d',
                'amount' => 'required|string|min:6',
            ]);
            $dateEnd = request()->input('end_date');
            $replace_amount = str_replace('.', '', request()->input('amount'));
            $tagihan = Tagihan::where('id_biayas', '=', $biaya->id)->first();
            $tagihans = Tagihan::where('id', '=', $tagihan->id)->first();
            $tagihans->update([
                'end_date' => $dateEnd,
                'amount' => $replace_amount,
            ]);

            $tagihanGet = Tagihan::where('id', $tagihans->id)->get();
            foreach ($tagihanGet as $index => $value) {
                TagihanDetail::where('id_tagihans', $value->id)->update([
                    'end_date' => $dateEnd,
                    'amount' => $value->amount,
                    'status' => 'BELUM',
                ]);
            }
            return redirect()->back()->with('success', 'Berhasil mengupdate data ' . $biaya->nama_biaya);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function deleteAll(Request $request)
    {
        //
        $sid = $request->ids;
        $biaya = Biaya::whereIn('id', $sid);
        $tagihans = Tagihan::whereIn('id_biayas', $sid)->get();
        $tagihan = Tagihan::whereIn('id_biayas', $sid);

        foreach ($tagihans as $tagihanDelete) {
            $detail = TagihanDetail::where('id_tagihans', $tagihanDelete->id);
            $detail->delete();
        }
        $tagihan->delete();
        $biaya->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus biaya yang terpilih');
    }
    public function destroy($id)
    {
        //

        $biaya = Biaya::find($id);
        $tagihan = Tagihan::where('id_biayas', $id);
        $tagihanGet = Tagihan::where('id_biayas', $id)->get();

        foreach ($tagihanGet as $value) {
            TagihanDetail::where('id_tagihans', $value->id)->delete();
        }

        $tagihan->delete();
        $biaya->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Berhasil Menghapus tagihan ' . $biaya->nama_biaya);
    }
}
