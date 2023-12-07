<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\General;
use App\Models\Jurusan;
use App\Models\Link;
use App\Models\Matkuls;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    public function index()
    {
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();

        if ($biodata) {
            if ($biodata->jurusan_id) {
                $jurusan = Jurusan::find($biodata->jurusan_id);

                $links = Link::where('id_jurusans', $jurusan->id)->where('gender', Auth::user()->gender)->first();

                $semester = Semester::where('id_jurusans', $jurusan->id)->get();

                $matkuls = Matkuls::where('id_jurusans', $jurusan->id)->get();

                return view('mahasiswa.matkul.index', compact('jurusan', 'semester', 'matkuls', 'links'));
            } else {
                return redirect()->route('mahasiswa.index')->with('error', 'Anda belum memilih jurusan.');
            }
        } else {
            return redirect()->route('mahasiswa.index')->with('error', 'Anda belum mengisi biodata.');
        }
    }

    public function downloadMatkuls($semester_id)
    {
        $instansi = General::first();
        $biodata = Biodata::where('program_belajar', 'S1')->where('user_id', Auth::user()->id)->first();
        $jurusan = Jurusan::find($biodata->jurusan_id);
        $matkuls = Matkuls::where('id_semesters', $semester_id)->get();
        $html = "<body>
            <div class='container'>
                <div style='display:flex; align-items:center; justify-content:between; '>
                    <div>
                        <div class='d-flex'>
                            <img src='" . $instansi->image . "' alt='' class='' width='200'>
                        </div>
                    </div>
                    <div>
                        <h5 class='' style='margin-top: 10px; width:350px; text-align: end; '>Jadwal Mata Kuliah Jurusan " . $jurusan->name . "</h5>
                    </div>        
                </div>

                <table style='width: 100%; border-collapse: collapse;'>
                    <thead>
                            <tr>
                                <th style='padding: 8px; border: 1px solid #ddd;'>Mata Kuliah</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>Semester</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>Hari</th>
                                <th style='padding: 8px; border: 1px solid #ddd;'>Waktu</th>
                            </tr>
                    </thead>
                    <tbody>";

                foreach ($matkuls as $matkul) {
                    $html .= "<tr>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $matkul->nama_matkuls . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $matkul->semesters->name . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $matkul->hari . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $matkul->mulai . " WIB - " . $matkul->selesai . " WIB</td>
                    </tr>";
                }

                $html .= "</tbody>
                </table>
            </div>
        </body>";

                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $dompdf = new Dompdf($options);
                $pdf = Pdf::loadView('mahasiswa.pdf.matkuls', compact('instansi', 'matkuls', 'jurusan'));
                $pdf->loadHtml($html)->setPaper('A4', 'portrait');
                return $pdf->download('jadwal.pdf');
            }
}
