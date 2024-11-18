<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $data = Kegiatan::latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = Kegiatan::where('bidang_id', Auth::user()->bidang_id)->latest();
        }
        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('subKegiatan', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    });
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('kegiatan', function ($data) {
                    return $data->name;
                })
                ->addColumn('name', function ($data) {
                    return $data->subKegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->name . '</div>';
                    })->implode('');
                })
                ->addColumn('action', function ($data) {
                    return $data->subKegiatan->map(function ($item) {
                        return "
                            <div class='d-flex mb-2'>
                                <button onclick='editData(" . json_encode($item) . ")' aria-expanded='false' class='btn btn_action_dt icon_edit me-2'><i class='ri-pencil-line'></i></button>
                                <button onclick='deleteData(" . json_encode($item->id) . ")' aria-expanded='false' class='btn btn_action_dt icon_delete'><i class='ri-delete-bin-line'></i></button>
                            </div>
                        ";
                    })->implode('');
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Data Sub Kegiatan' : '';
        $updateUrl = 'subKegiatan.update';
        $deleteUrl = 'subKegiatan.destroy';
        $dataKegiatan = Kegiatan::latest()->get();
        if (Auth::user()->role != 'Super Admin') {
            $dataKegiatan = Kegiatan::where('bidang_id', Auth::user()->bidang_id)->latest()->get();
        }
        return view('subKegiatan.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataKegiatan'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'name' => 'required',
        ], [
            'kegiatan_id.required' => 'Kegiatan wajib diisi.',
            'name.required' => 'Nama Kegiatan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $kegiatan = Kegiatan::findOrFail($validatedData['kegiatan_id']);
        $validatedData['program_id'] = $kegiatan->program_id;
        $validatedData['bidang_id'] = $kegiatan->bidang_id;
        SubKegiatan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $subKegiatanData = SubKegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'name' => 'required',
        ], [
            'kegiatan_id.required' => 'Kegiatan wajib diisi.',
            'name.required' => 'Nama Kegiatan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $kegiatan = Kegiatan::findOrFail($validatedData['kegiatan_id']);
        $validatedData['program_id'] = $kegiatan->program_id;
        $validatedData['bidang_id'] = $kegiatan->bidang_id;
        $subKegiatanData->update($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataIndikator = SubKegiatan::findOrFail($id);
        $dataIndikator->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
