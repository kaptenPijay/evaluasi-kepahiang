<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bidang;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $data = Program::with('bidang')->latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = Program::where('bidang_id', Auth::user()->bidang_id)->latest();
        }
        $counter = 1;
        if ($request->ajax()) {
            return DataTables::eloquent($data)
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%$keyword%");
                })
                ->addColumn('id', function ($data) use (&$counter) {
                    return $counter++;
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('year', function ($data) {
                    return $data->year;
                })
                ->addColumn('bidang', function ($data) {
                    return $data->bidang->name;
                })
                ->addColumn('action', function ($data) {
                    return "
                    <div class='wrapper_action_dt'>
                        <button onclick='editData(" . json_encode($data) . ")' aria-expanded='false' class='btn btn_action_dt icon_edit'><i class='ri-pencil-line'></i></button>
                        <button onclick='deleteData(" . json_encode($data->id) . ")' aria-expanded='false' class='btn btn_action_dt icon_delete'><i class='ri-delete-bin-line'></i></button>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Data Program' : '';
        $updateUrl = 'program.update';
        $deleteUrl = 'program.destroy';
        $dataBidangs = Bidang::all();
        return view('program.index', compact('request', 'title', 'updateUrl', 'deleteUrl', 'dataBidangs'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'bidang_id' => 'required',
            'year' => 'required',
        ], [
            'name.required' => 'Nama Program wajib diisi.',
            'bidang.required' => 'Nama Bidang wajib diisi.',
            'year.required' => 'Tahun wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Program::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataProgram = Program::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'bidang_id' => 'required',
            'year' => 'required',
        ], [
            'name.required' => 'Nama Program wajib diisi.',
            'bidang.required' => 'Nama Bidang wajib diisi.',
            'year.required' => 'Tahun wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $dataProgram->update($validatedData);
        foreach ($dataProgram->kegiatan as $key => $item) {
            $item->bidang_id = $dataProgram->bidang_id;
            $item->save();
        }
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataProgram = Program::findOrFail($id);
        $dataProgram->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
