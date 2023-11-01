<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function document()
    {
        return view('mahasiswa.document.document-s1');
    }

    public function document_process(Request $request)
    {

        $request->validate([
            'ktp' => 'required|mimes:pdf|max:8192', // Kartu Keluarga
            'kk' => 'required|mimes:pdf|max:8192', // Ijazah
            'ijazah' => 'required|mimes:pdf|max:8192', // Akta
            'transkrip_nilai' => 'nullable|mimes:pdf|max:8192|required_without:ktp,kk,ijazah', // Opsional tetapi tidak boleh kosong
        ]);
    
        if ($request->hasFile('ktp') && $request->hasFile('kk') && $request->hasFile('ijazah') && $request->hasFile('transkrip_nilai')) {
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');
            $ijazahFile = $request->file('ijazah');
            $transkripFile = $request->file('transkrip_nilai');
    
            $ktpFileName = time() . '_ktp_' . $ktpFile->getClientOriginalName();
            $kkFileName = time() . '_kk_' . $kkFile->getClientOriginalName();
            $ijazahFileName = time() . '_ijazah_' . $ijazahFile->getClientOriginalName();
            $transkripFileName = time() . '_transkrip_nilai_' . $transkripFile->getClientOriginalName();
    
            $ktpFile->storeAs('public/pdf', $ktpFileName);
            $kkFile->storeAs('public/pdf', $kkFileName);
            $ijazahFile->storeAs('public/pdf', $ijazahFileName);
            $transkripFile->storeAs('public/pdf', $transkripFileName);
    
            // Proses penyimpanan informasi ke database
            $data = [
                'ktp' => 'pdf/' . $ktpFileName,
                'kk' => 'pdf/' . $kkFileName,
                'ijazah' => 'pdf/' . $ijazahFileName,
                'transkrip_nilai' => 'pdf/' . $transkripFileName,
            ];
            
            $data['user_id'] = Auth::user()->id;
            
            Document::create($data);

            return redirect()->route('mahasiswa.dashboard')->with('success','Berhasil Melengkapi Dokument Ynag di Pelukan');
        }
    }

        public function download_pdf_ktp(Request $request ,$id)
        {
            $data = Document::where('user_id',$id)->first();
            $path = public_path('/storage/'.$data->ktp);
            if(file_exists($path)){
                return response()->download($path);
            }
        }

        public function download_pdf_kk(Request $request ,$id)
        {
            $data = Document::where('user_id',$id)->first();
            $path = public_path('/storage/'.$data->kk);
            if(file_exists($path)){
                return response()->download($path);
            }
        }

        public function download_pdf_ijazah(Request $request ,$id)
        {
            $data = Document::where('user_id',$id)->first();
            $path = public_path('/storage/'.$data->ijazah);
            if(file_exists($path)){
                return response()->download($path);
            }
        }

        public function download_pdf_transkrip_nilai(Request $request ,$id)
        {
            $data = Document::where('user_id',$id)->first();
            $path = public_path('/storage/'.$data->transkrip_nilai);
            if(file_exists($path)){
                return response()->download($path);
            }
        }
}

