<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use App\Models\IndikatorSubKegiatan;
use App\Models\RealisasiSubKegiatan;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class IndikatorSubKegiatanController extends Controller
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
                    $query->whereHas('indikatorSubKegiatan', function ($query) use ($keyword) {
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
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->indikator . '</div>';
                    })->implode('');
                })
                ->addColumn('anggaran', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        $formattedAnggaran = number_format($item->anggaran, 0, ',', '.');
                        return '<div class="mb-2">' . $formattedAnggaran . '</div>';
                    })->implode('');
                })
                ->addColumn('target', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->target . '</div>';
                    })->implode('');
                })
                ->addColumn('satuan', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->satuan->name . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_1', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_1 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_2', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_2 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_3', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_3 . '</div>';
                    })->implode('');
                })
                ->addColumn('tw_4', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->tw_4 . '</div>';
                    })->implode('');
                })
                ->addColumn('action', function ($data) {
                    return $data->indikatorSubKegiatan->map(function ($item) {
                        return "
                            <div class='d-flex mb-2'>
                                <button onclick='editData(" . json_encode($item) . ")' aria-expanded='false' class='btn btn_action_dt icon_edit me-2'><i class='ri-pencil-line'></i></button>
                                <button onclick='deleteData(" . json_encode($item->id) . ")' aria-expanded='false' class='btn btn_action_dt icon_delete'><i class='ri-delete-bin-line'></i></button>
                            </div>
                        ";
                    })->implode('');
                })
                ->rawColumns(['action', 'indikator', 'anggaran', 'target', 'tw_1', 'tw_2', 'tw_3', 'tw_4', 'satuan'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Indikator Sub Kegiatan' : '';
        $updateUrl = 'indikatorSubKegiatan.update';
        $deleteUrl = 'indikatorSubKegiatan.destroy';
        $dataKegiatan = SubKegiatan::latest()->get();
        $dataSatuans = Satuan::latest()->get();
        if (Auth::user()->role != 'Super Admin') {
            $dataKegiatan = SubKegiatan::where('bidang_id', Auth::user()->bidang_id)->latest()->get();
        }
        return view('indikatorSubKegiatan.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataKegiatan', 'dataSatuans'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_kegiatan_id' => 'required',
            'indikator' => 'required',
            'anggaran' => 'required',
            'satuan_id' => 'required',
            'target' => 'nullable',
            'tw_1' => 'nullable',
            'tw_2' => 'nullable',
            'tw_3' => 'nullable',
            'tw_4' => 'nullable',
        ], [
            'sub_kegiatan_id.required' => 'Kegiatan wajib diisi.',
            'indikator.required' => 'Indikator wajib diisi.',
            'anggaran.required' => 'Anggaran wajib diisi.',
            'satuan_id.required' => 'Satuan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $checkMaksValue = maxTriWulan([$request->tw_1, $request->tw_2, $request->tw_3, $request->tw_4], $request->target);
        if ($checkMaksValue) {
            flash()->addError('Kumulatif Triwulan Tidak Boleh Lebih Besar Dari Target');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $sumTriwulan = sumTriWulan([$request->tw_1, $request->tw_2, $request->tw_3, $request->tw_4], $request->target);
        if ($sumTriwulan) {
            flash()->addError('Kumulatif Triwulan Harus Sama Dengan Target');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData['anggaran'] = str_replace(['Rp', '.', ' '], '', $request->anggaran);
        $indikatorData = IndikatorSubKegiatan::create($validatedData);
        $realisasi = new RealisasiSubKegiatan([
            'indikator' => $request->indikator,
            'sub_kegiatan_id' => $request->sub_kegiatan_id,
            'anggaran' => str_replace(['Rp', '.', ' '], '', $request->anggaran),
            'indikator_id' => $indikatorData->id,
            'target' => $request->target,
            'satuan_id' => $request->satuan_id
        ]);
        $realisasi->save();
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataIndikator = IndikatorSubKegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'sub_kegiatan_id' => 'required',
            'indikator' => 'required',
            'anggaran' => 'required',
            'satuan_id' => 'required',
            'target' => 'nullable',
            'tw_1' => 'nullable',
            'tw_2' => 'nullable',
            'tw_3' => 'nullable',
            'tw_4' => 'nullable',
        ], [
            'sub_kegiatan_id.required' => 'Kegiatan wajib diisi.',
            'indikator.required' => 'Indikator wajib diisi.',
            'anggaran.required' => 'Anggaran wajib diisi.',
            'satuan_id.required' => 'Satuan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $checkMaksValue = maxTriWulan([$request->tw_1, $request->tw_2, $request->tw_3, $request->tw_4], $request->target);
        if ($checkMaksValue) {
            flash()->addError('Kumulatif Triwulan Tidak Boleh Lebih Besar Dari Target');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $sumTriwulan = sumTriWulan([$request->tw_1, $request->tw_2, $request->tw_3, $request->tw_4], $request->target);
        if ($sumTriwulan) {
            flash()->addError('Kumulatif Triwulan Harus Sama Dengan Target');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData['anggaran'] = str_replace(['Rp', '.', ' '], '', $request->anggaran);
        $dataIndikator->update($validatedData);
        $realisasi = new RealisasiSubKegiatan([
            'indikator' => $request->indikator,
            'sub_kegiatan_id' => $request->sub_kegiatan_id,
            'anggaran' => str_replace(['Rp', '.', ' '], '', $request->anggaran),
            'indikator_id' => $dataIndikator->id,
            'target' => $request->target,
            'satuan_id' => $request->satuan_id
        ]);
        $realisasi->save();
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataIndikator = IndikatorSubKegiatan::findOrFail($id);
        $dataIndikator->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
