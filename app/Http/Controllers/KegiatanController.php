<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
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
                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereHas('kegiatan', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%");
                    });
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('program', function ($data) {
                    return $data->name;
                })
                ->addColumn('name', function ($data) {
                    return $data->kegiatan->map(function ($item) {
                        return '<div class="mb-2">' . $item->name . '</div>';
                    })->implode('');
                })
                ->addColumn('action', function ($data) {
                    return $data->kegiatan->map(function ($item) {
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
        $title = auth()->user()->role == 'Super Admin' ? 'Data Kegiatan' : '';
        $updateUrl = 'kegiatan.update';
        $deleteUrl = 'kegiatan.destroy';
        $dataPrograms = Program::latest()->get();
        if (Auth::user()->role != 'Super Admin') {
            $dataPrograms = Program::where('bidang_id', Auth::user()->bidang_id)->latest()->get();
        }
        return view('kegiatan.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataPrograms'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program_id' => 'required',
            'name' => 'required',
        ], [
            'program_id.required' => 'Program wajib diisi.',
            'name.required' => 'Nama Kegiatan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $validatedData['bidang_id'] = Program::findOrFail($validatedData['program_id'])->bidang_id;
        Kegiatan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $kegiatanData = Kegiatan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'program_id' => 'required',
            'name' => 'required',
        ], [
            'program_id.required' => 'Program wajib diisi.',
            'name.required' => 'Nama Kegiatan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $validatedData['bidang_id'] = Program::findOrFail($validatedData['program_id'])->bidang_id;
        $kegiatanData->update($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataIndikator = Kegiatan::findOrFail($id);
        $dataIndikator->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
