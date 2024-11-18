<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Realisasi;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $data = Program::latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = Program::where('bidang_id', Auth::user()->bidang_id)->latest();
        }
        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('indikator', function ($query, $keyword) {
                    $query->whereHas('realisasi', function ($query) use ($keyword) {
                        $query->where('indikator', 'like', "%$keyword%");
                    });
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('program', function ($data) {
                    return $data->name;
                })
                ->addColumn('indikator', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->indikator . '</div>';
                    })->implode('');
                })
                ->addColumn('target', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->target . '</div>';
                    })->implode('');
                })
                ->addColumn('satuan', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->satuan->name . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_1', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_1 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_2', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_2 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_3', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_3 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_4', function ($data) {
                    return $data->realisasi->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_4 . '</div>';
                    })->implode('');
                })
                ->rawColumns(['indikator', 'target', 'tw_1', 'tw_2', 'tw_3', 'tw_4', 'satuan'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Realisasi Program' : '';
        $updateUrl = 'realisasi.update';
        $deleteUrl = 'realisasi.destroy';
        $dataPrograms = Program::latest()->get();
        if (Auth::user()->role != 'Super Admin') {
            $dataPrograms = Program::where('bidang_id', Auth::user()->bidang_id)->latest()->get();
        }
        return view('realisasi.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataPrograms'));
    }
    public function update(Request $request)
    {
        $dataRealisasi = collect(DB::select('SELECT * from realisasis where program_id = ' . json_encode($request->program_id) . ' AND indikator_id = ' . json_encode($request->indikator_id)))->first();
        $dataRealisasi = Realisasi::findOrFail($dataRealisasi->id);
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
        $checkMaksValue = maxTriWulan([$request->tw_1, $request->tw_2, $request->tw_3, $request->tw_4], $request->target);
        if ($checkMaksValue) {
            flash()->addError('Kumulatif Triwulan Tidak Boleh Lebih Besar Dari Target');
            return back();
        }
        $dataRealisasi->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataRealisasi = Realisasi::findOrFail($id);
        $dataRealisasi->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
    public function dataProgram($id)
    {
        try {
            $programData = Program::with('indikatorProgram.realisasi.satuan')->findOrFail($id);
            $indikatorData = $programData->indikatorProgram;
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
