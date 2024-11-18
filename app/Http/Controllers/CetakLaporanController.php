<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\IndikatorProgram;
use App\Models\Program;
use App\Models\Realisasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class CetakLaporanController extends Controller
{
    public function index()
    {
        // --> Get all bidang
        $allBidang = Bidang::all();
        $allProgram = Program::all();
        return view('cetakLaporan.index', compact('allBidang', 'allProgram'));
    }

    public function tahunBidang($id)
    {
        try {
            // --> Get semua tahun berdasarkan bidang pada data program
            $allPrograms = Program::where('bidang_id', '=', $id)->orderBy('year', 'DESC')->get();

            return response()->json([
                'tahunBidang' => $allPrograms,
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 400);
        }
    }

    // public function cetakRequest(Request $request)
    // {

    //     $laporanType = $request->query('tipe-laporan');
    //     $this->cetakLaporanEvaluasi(, , );
    //     switch ($laporanType) {
    //         case 'evaluasi':
    //             break;

    //         default:
    //             # code...
    //             break;
    //     }
    // }

    public function cetakRequest(Request $request)
    {
        // --> Validate request
        $validator = Validator::make(
            $request->all(),
            [
                'bidang_laporan' => 'required',
                'tahun_anggaran' => 'required',
                'triwulan_laporan' => 'required'
            ],
            [
                "bidang_laporan.required" => 'Bidang wajib di isi',
                "tahun_anggaran.required" => 'Tahun wajib di isi',
                "triwulan_laporan.required" => 'Triwulan wajib di isi',
            ]
        );
        if ($validator->fails()) {
            flash()->addError('Gagal membuat laporan');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validator->validated();
        $bidangId = $request->bidang_laporan;
        $year = $request->tahun_anggaran;
        $maxTriwulan = (int)$request->triwulan_laporan;
        $maxTriwulanRoman = 'I';
        switch ($maxTriwulan) {
            case 1:
                $maxTriwulanRoman = 'I';
                break;
            case 2:
                $maxTriwulanRoman = 'I';
                break;
            case 3:
                $maxTriwulanRoman = 'III';
                break;
            default:
                $maxTriwulanRoman = 'IV';
                break;
        }

        // --> data contoh sebagai template pdf
        // $data = [
        //     [
        //         "programName" => "Program Menyusui kambing",
        //         "dataChild" => [
        //             [
        //                 "indicatorName" => 'Indikator 1',
        //                 "targetIndicator" => 50,
        //                 "targetTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.816],
        //                     ["tw" => 2.2],
        //                     ["tw" => 5.6],
        //                 ],
        //                 "realisasiTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                 ],
        //                 'totalRealisasi' => 100
        //             ],
        //             [
        //                 "indicatorName" => 'Indikator 2',
        //                 "targetIndicator" => 50,
        //                 "targetTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                 ],
        //                 "realisasiTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                 ],
        //                 'totalRealisasi' => 100
        //             ],
        //             [
        //                 "indicatorName" => 'Indikator 3',
        //                 "targetIndicator" => 50,
        //                 "targetTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                 ],
        //                 "realisasiTriwulan" => [
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                     ["tw" => 2.86],
        //                 ],
        //                 'totalRealisasi' => 100
        //             ],
        //         ]
        //     ],
        // ];

        $data = $this->generateDataPDF($bidangId, $year, $maxTriwulan);

        if (count($data) === 0) {
            return flash()->addError('Gagal membuat laporan');
        }

        $pdf = PDF::loadView('cetakLaporan.pdf-template.index', [
            'data' => $data,
            "tahun" => $year,
            'maxTw' => $maxTriwulanRoman,
        ]);
        // $customPaper = array(0, 0, 2000, 800);
        // $pdf->setPaper($customPaper);

        $pdf->setPaper('A1', 'landscape');
        $pdf->set_option('dpi', 250);

        return $pdf->stream('rekapitulasi-data-kepegawaian-golongan.pdf');
    }

    public function generateDataPDF($bidangId, $year, $maxTriwulan)
    {
        // --> Get programData berdasarkan bidang dan tahun yang dipilih
        $programData = Program::where([['bidang_id', '=', $bidangId], ['year', '=', $year]])->get();

        // --> filter only program data id
        $programDataID = $programData->pluck('id');

        // --> get indicator berdasarkan program yg didapatkan
        $indicatorProgram = IndikatorProgram::whereIn('program_id', $programDataID)->get();

        // --> filter only indicator program id
        $indicatorProgramID = $indicatorProgram->pluck('id');

        // --> Get realisasi program
        $realisasiProgram = Realisasi::whereIn('indikator_id', $indicatorProgramID)->get();

        $dataPdf = [];
        foreach ($programData as $program) {
            $indicatorProgramByProgramID = $indicatorProgram->where('program_id', '=', $program->id);
            $tempData = [
                "programName" => $program->name,
                "dataChild" => $this->generateDataChildPDF($indicatorProgramByProgramID, $realisasiProgram, $maxTriwulan)
            ];
            array_push($dataPdf, $tempData);
        }
        return $dataPdf;
    }

    public function generateDataChildPDF($indicatorCollection, $realisasiCollection, $maxTriwulan)
    {
        $indicatorCollectionArr = $indicatorCollection->toArray();
        $dataChild = [];

        foreach ($indicatorCollectionArr as $value) {
            // --> get realisasi data berdasarkan indikator
            $desiredElementArray =
                $realisasiCollection->first(function ($element) use ($value) {
                    return $element['indikator_id'] == $value['id'];
                });
            $realisasiByIndicator = $desiredElementArray ? json_decode(json_encode($desiredElementArray), true) : [];

            // --> set object for data child array
            $tempDataChild = [
                "indicatorName" => $value['indikator'],
                "targetIndicator" => $value['target'],
                "targetTriwulan" => $this->generateTargetTriwulan($value, $maxTriwulan),
                "realisasiTriwulan" => $this->generateTargetTriwulan($realisasiByIndicator, $maxTriwulan),
                "totalRealisasi" => $realisasiByIndicator['target']
            ];
            array_push($dataChild, $tempDataChild);
        }
        return $dataChild;
    }

    public function generateTargetTriwulan($selectedRow, $maxTriwulan)
    {
        $triwulanData = [];

        // --> get triwulan data
        for ($i = 1; $i <= $maxTriwulan; $i++) {
            $nameFieldTW = 'tw_' . $i;
            $tempTriwulan = [
                "tw" => $selectedRow[$nameFieldTW]
            ];
            array_push($triwulanData, $tempTriwulan);
        }
        return $triwulanData;
    }
}
