<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        $data = Satuan::latest();
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
        $title = auth()->user()->role == 'Super Admin' ? 'Data Satuan' : '';
        $updateUrl = 'satuan.update';
        $deleteUrl = 'satuan.destroy';
        return view('satuan.index', compact('request', 'title', 'updateUrl', 'deleteUrl'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama Satuan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Satuan::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataSatuan = Satuan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama Satuan wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $dataSatuan->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataSatuan = Satuan::findOrFail($id);
        $dataSatuan->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
