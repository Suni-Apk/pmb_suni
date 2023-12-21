<?php

namespace App\Http\Controllers\Kursus;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use App\Models\Course;
use App\Models\General;
use App\Models\Mapels;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{

    public function index()
    {
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->with('course')->get();

        if ($biodata) {
            return view('kursus.pelajaran.index', compact('biodata',));
        } else {
            return view('kursus.pelajaran.index')->with(['error' => 'Kamu Belum Memilih Kursus!.']);
        }
    }

    public function downloadMapels($id_kursus)
    {
        $instansi = General::first();
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        $mapel = Mapels::where('id_courses', $id_kursus)->get();
        $kursus = Course::find($id_kursus);
        $html = "<body>
    <div class='container'>
        <div style='display:flex; align-items:center; justify-content:between; '>
            <div>
                <div class='d-flex'>
                    <img src='" . $instansi->image . "' alt='' class='' width='200'>
                </div>
            </div>
            <div>
                <h5 class='' style='margin-top: 10px; width:350px; text-align: end; '>Jadwal Mata Pelajaran Kursus " . $kursus->name . "</h5>
            </div>        
        </div>

        <table style='width: 100%; border-collapse: collapse;'>
            <thead>
                    <tr>
                        <th style='padding: 8px; border: 1px solid #ddd;'>Mata Pelajaran</th>
                        <th style='padding: 8px; border: 1px solid #ddd;'>Hari</th>
                        <th style='padding: 8px; border: 1px solid #ddd;'>Waktu</th>
                    </tr>
            </thead>
            <tbody>";

            foreach ($mapel as $mapels) {
                if ($mapels->status == 'Active') {
                    $html .= "<tr>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $mapels->name . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $mapels->hari . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd; text-align:center; '>" . $mapels->mulai . " WIB - " . $mapels->selesai . " WIB</td>
                    </tr>";
                }
            }            

        $html .= "</tbody>
        </table>
    </div>
</body>";
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);
    $pdf = PDF::loadView('kursus.pdf.mapels', compact('instansi', 'mapel', 'biodata', 'kursus', 'id_kursus'));
    $pdf->loadHtml($html)->setPaper('A4', 'portrait');
    return $pdf->download('jadwal.pdf');
    }

    public function mapelsPreview($id_kursus)
    {
        $instansi = General::first();
        $biodata = Biodata::where('program_belajar', 'KURSUS')->where('user_id', Auth::user()->id)->first();
        $mapel = Mapels::where('id_courses', $id_kursus)->get();
        $kursus = Course::find($id_kursus);
        return view('kursus.pdf.mapels', compact('instansi', 'mapel', 'biodata', 'kursus', 'id_kursus'));
    }
}
