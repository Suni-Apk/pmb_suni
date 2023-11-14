<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function document()
    {
        $biodata = Biodata::where('program_belajar','S1')->where('user_id',Auth::user()->id)->first();
        return view('mahasiswa.document.document-s1',compact('biodata'));
    }

    public function document_process(Request $request)
    {

        $request->validate([
            'ktp' => 'required|mimes:pdf|max:8192',
            'kk' => 'required|mimes:pdf|max:8192',
            'ijazah' => 'required|mimes:pdf|max:8192',
            'transkrip_nilai' => 'nullable|mimes:pdf|max:8192',
        ]);
        
        if ($request->hasFile('ktp') && $request->hasFile('kk') && $request->hasFile('ijazah')) {
            $ktpFile = $request->file('ktp');
            $kkFile = $request->file('kk');
            $ijazahFile = $request->file('ijazah');
            
            $transkripFile = $request->file('transkrip_nilai');
        
            // Check if 'transkrip_nilai' is present before attempting to handle it
            if ($transkripFile) {
                $transkripFileName = time() . '_transkrip_nilai_' . $transkripFile->getClientOriginalName();
                $transkripFile->storeAs('public/pdf', $transkripFileName);
            } else {
                // Handle the case when 'transkrip_nilai' is not present
                $transkripFileName = null;
            }
        
            $ktpFileName = time() . '_ktp_' . $ktpFile->getClientOriginalName();
            $kkFileName = time() . '_kk_' . $kkFile->getClientOriginalName();
            $ijazahFileName = time() . '_ijazah_' . $ijazahFile->getClientOriginalName();
        
            $ktpFile->storeAs('public/pdf', $ktpFileName);
            $kkFile->storeAs('public/pdf', $kkFileName);
            $ijazahFile->storeAs('public/pdf', $ijazahFileName);
        
            // Proses penyimpanan informasi ke database
            $data = [
                'ktp' => 'pdf/' . $ktpFileName,
                'kk' => 'pdf/' . $kkFileName,
                'ijazah' => 'pdf/' . $ijazahFileName,
                'transkrip_nilai' => $transkripFileName,
            ];
        
            $data['user_id'] = Auth::user()->id;
        
            Document::create($data);
        
            return redirect()->route('mahasiswa.tagihan.index')->with('success', 'Berhasil Melengkapi Dokumen Yang Diinginkan Silahkan Membayar Uang Daftar Ulang');
        }
        
        // Handle the case where one or more files are missing
        return redirect()->route('mahasiswa.dashboard')->with('error', 'Gagal mengunggah file. Pastikan semua file diunggah.');
        
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

