<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        $data = Bidang::latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = Bidang::where('id', Auth::user()->bidang_id)->latest();
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
                ->addColumn('action', function ($data) {
                    $editButton = "
                        <button onclick='editData(" . json_encode($data) . ")' aria-expanded='false' class='btn btn_action_dt icon_edit'>
                            <i class='ri-pencil-line'></i>
                        </button>";

                    $deleteButton = Auth::user()->role != 'Super Admin' ?
                        '' : "<button onclick='deleteData(" . json_encode($data->id) . ")' aria-expanded='false' class='btn btn_action_dt icon_delete'>
                            <i class='ri-delete-bin-line'></i>
                        </button>";

                    return "
                        <div class='wrapper_action_dt'>
                            $editButton
                            $deleteButton
                        </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Data Bidang' : '';
        $updateUrl = 'bidang.update';
        $deleteUrl = 'bidang.destroy';
        return view('bidang.index', compact('request', 'title', 'updateUrl', 'deleteUrl'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama Bidang wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        Bidang::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataBidang = Bidang::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Nama Bidang wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $dataBidang->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataBidang = Bidang::findOrFail($id);
        $dataBidang->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
