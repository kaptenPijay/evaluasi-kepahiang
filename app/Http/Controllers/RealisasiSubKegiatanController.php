<?php

namespace App\Http\Controllers;

use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RealisasiSubKegiatan;
use App\Models\Triwulan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RealisasiSubKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $data = SubKegiatan::latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = SubKegiatan::where('bidang_id', Auth::user()->bidang_id)->latest();
        }
        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('indikator', function ($query, $keyword) {
                    $query->whereHas('realisasiSubKegiatan', function ($query) use ($keyword) {
                        $query->where('indikator', 'like', "%$keyword%");
                    });
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('indikator', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->indikator . '</div>';
                    })->implode('');
                })
                ->addColumn('anggaran', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' .  number_format($item->anggaran, 0, ',', '.') . '</div>';
                    })->implode('');
                })
                ->addColumn('target', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->target . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_1_fisik', function ($data) {
                    $tw1Data = $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_1_fisik . '</div>';
                    })->implode('');
                    return $tw1Data;
                })
                ->addColumn('satuan', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->satuan->name . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_1_anggaran', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . number_format($item->tw_1_anggaran, 0, ',', '.') . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_2_fisik', function ($data) {
                    $tw1Data = $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_2_fisik . '</div>';
                    })->implode('');
                    return $tw1Data;
                })
                ->addColumn('tw_2_anggaran', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . number_format($item->tw_2_anggaran, 0, ',', '.') . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_3_fisik', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_3_fisik . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_3_anggaran', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . number_format($item->tw_3_anggaran, 0, ',', '.') . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_4_fisik', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_4_fisik . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_4_anggaran', function ($data) {
                    return $data->realisasiSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . number_format($item->tw_4_anggaran, 0, ',', '.') . '</div>';
                    })->implode('');
                })
                ->rawColumns(['indikator', 'anggaran', 'target', 'tw_1_fisik', 'tw_1_anggaran', 'tw_2_fisik', 'tw_2_anggaran', 'tw_3_fisik', 'tw_3_anggaran', 'tw_4_fisik', 'tw_4_anggaran', 'satuan'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Realisasi Sub Kegiatan' : '';
        $updateUrl = 'realisasiSubKegiatan.update';
        $deleteUrl = 'realisasiSubKegiatan.destroy';
        $dataSubKegiatan = SubKegiatan::latest()->get();
        if (Auth::user()->role != 'Super Admin') {
            $dataPrograms = SubKegiatan::where('bidang_id', Auth::user()->bidang_id)->latest()->get();
        }
        return view('realisasiSubKegiatan.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataSubKegiatan'));
    }
    public function update(Request $request)
    {
        $dataRealisasi = collect(DB::select('SELECT * from realisasi_sub_kegiatans where sub_kegiatan_id = ' . json_encode($request->sub_kegiatan_id) . ' AND indikator_id = ' . json_encode($request->indikator_id)))->first();
        $dataRealisasi = RealisasiSubKegiatan::findOrFail($dataRealisasi->id);
        $validator = Validator::make($request->all(), [
            'tw_1' => 'nullable',
            'tw_2' => 'nullable',
            'tw_3' => 'nullable',
            'tw_4' => 'nullable',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $tw1_fisik = $request->tw == 'tw_1' ? $request->tw_value_fisik : $dataRealisasi->tw_1_fisik;
        $tw2_fisik = $request->tw == 'tw_2' ? $request->tw_value_fisik : $dataRealisasi->tw_2_fisik;
        $tw3_fisik = $request->tw == 'tw_3' ? $request->tw_value_fisik : $dataRealisasi->tw_3_fisik;
        $tw4_fisik = $request->tw == 'tw_4' ? $request->tw_value_fisik : $dataRealisasi->tw_4_fisik;

        $tw1_anggaran = $request->tw == 'tw_1' ? str_replace('.', '', $request->tw_value_anggaran) : $dataRealisasi->tw_1_anggaran;
        $tw2_anggaran = $request->tw == 'tw_2' ? str_replace('.', '', $request->tw_value_anggaran) : $dataRealisasi->tw_2_anggaran;
        $tw3_anggaran = $request->tw == 'tw_3' ? str_replace('.', '', $request->tw_value_anggaran) : $dataRealisasi->tw_3_anggaran;
        $tw4_anggaran = $request->tw == 'tw_4' ? str_replace('.', '', $request->tw_value_anggaran) : $dataRealisasi->tw_4_anggaran;

        $checkMaksValueAnggaran = maxTriWulan([$tw1_anggaran, $tw2_anggaran, $tw3_anggaran, $tw4_anggaran], $dataRealisasi->anggaran);
        $checkMaksValue = maxTriWulan([$tw1_fisik, $tw2_fisik, $tw3_fisik, $tw4_fisik], $dataRealisasi->target);

        if ($checkMaksValue && $checkMaksValueAnggaran) {
            flash()->addError('Kumulatif Triwulan Harus Sama Dengan Realisasi Fisik Maupun Anggaran');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        switch ($request->tw) {
            case 'tw_1':
                $dataRealisasi->tw_1_anggaran = str_replace('.', '', $request->tw_value_anggaran);
                $dataRealisasi->tw_1_fisik = $request->tw_value_fisik;
                $dataRealisasi->save();
                break;

            case 'tw_2':
                $dataRealisasi->tw_2_anggaran = str_replace('.', '', $request->tw_value_anggaran);
                $dataRealisasi->tw_2_fisik = $request->tw_value_fisik;
                $dataRealisasi->save();
                break;

            case 'tw_3':
                $dataRealisasi->tw_3_anggaran = str_replace('.', '', $request->tw_value_anggaran);
                $dataRealisasi->tw_3_fisik = $request->tw_value_fisik;
                $dataRealisasi->save();
                break;

            case 'tw_4':
                $dataRealisasi->tw_4_anggaran = str_replace('.', '', $request->tw_value_anggaran);
                $dataRealisasi->tw_4_fisik = $request->tw_value_fisik;
                $dataRealisasi->save();
                break;

            default:
                break;
        }

        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataRealisasi = RealisasiSubKegiatan::findOrFail($id);
        $dataRealisasi->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
    public function dataProgram($id)
    {
        try {
            $subKegiatanData = SubKegiatan::with('indikatorSubKegiatan.realisasiSubKegiatan')->findOrFail($id);
            $indikatorData = $subKegiatanData->indikatorSubKegiatan;
            $dataTriwulan = Triwulan::all();
            return response()->json([
                'indikatorData' => $indikatorData,
                'dataTriwulan' => $dataTriwulan,
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Data Not Found',
            ], 400);
        }
    }
}
