<?php

namespace App\Http\Controllers;

use App\Models\IndikatorSubKegiatan;
use App\Models\Program;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakLaporanSpmController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->jenis_spm) {
            case 'laporan_tw':
                $data = Program::with([
                    'kegiatan.subKegiatan.indikatorSubKegiatan'
                ])
                    ->findOrFail($request->tahun_anggaran);

                $data = $data->kegiatan->flatMap(function ($kegiatan) {
                    return $kegiatan->subKegiatan->flatMap(function ($subKegiatan) {
                        return $subKegiatan->indikatorSubKegiatan;
                    });
                });
                $pdf = Pdf::loadView('pdf.triwulan', ['data' => $data])->setPaper('A2', 'landscape');

                return $pdf->stream('triwulan.pdf');

            case 'rekap_spm':
                $data = Program::with([
                    'kegiatan.subKegiatan.indikatorSubKegiatan'
                ])
                    ->findOrFail($request->tahun_anggaran);

                $data = $data->kegiatan->flatMap(function ($kegiatan) {
                    return $kegiatan->subKegiatan->flatMap(function ($subKegiatan) {
                        return $subKegiatan->indikatorSubKegiatan;
                    });
                });
                $pdf = Pdf::loadView('pdf.rekap', ['data' => $data])->setPaper('A3', 'landscape');

                return $pdf->stream('rekap.pdf');

                break;

            default:
                # code...
                break;
        }
    }
}
