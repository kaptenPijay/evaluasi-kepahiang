<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::latest();
        if (Auth::user()->role != 'Super Admin') {
            $data = User::where('bidang_id', Auth::user()->bidang_id)->latest();
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
                ->addColumn('role', function ($data) {
                    return $data->role;
                })
                ->addColumn('bidang', function ($data) {
                    return $data->bidang->name ?? '-';
                })
                ->addColumn('nohp', function ($data) {
                    return $data->nohp;
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
        $title = auth()->user()->role == 'Super Admin' ? 'Data User' : '';
        $dataBidangs = Bidang::all();
        $updateUrl = 'user.update';
        $deleteUrl = 'user.destroy';
        return view('user.index', compact('request', 'title', 'dataBidangs', 'updateUrl', 'deleteUrl'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'role' => 'required',
            'bidang_id' => 'nullable',
            'nohp' => 'required|unique:users|numeric',
            'password' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah ada',
            'role.required' => 'Role wajib dipilih.',
            'nohp.required' => 'No HP wajib diisi.',
            'nohp.unique' => 'No HP Sudah Ada',
            'nohp.numeric' => 'No HP Harus Berupa Angka',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->role == 'Super Admin') {
            $validatedData['bidang_id'] = null;
        }
        User::create($validatedData);
        flash('Berhasil Menambah Data');
        return back();
    }
    public function update(Request $request, $id)
    {
        $dataUser = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required',
            'bidang_id' => 'nullable',
            'nohp' => 'required|unique:users,nohp,' . $id . '|numeric',
            'password' => 'nullable',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah ada',
            'role.required' => 'Role wajib dipilih.',
            'nohp.required' => 'No HP wajib diisi.',
            'nohp.unique' => 'No HP Sudah Ada',
            'nohp.numeric' => 'No HP Harus Berupa Angka',
        ]);
        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        if ($request->role == 'Super Admin') {
            $validatedData['bidang_id'] = null;
        }
        if ($request->password == null) {
            unset($validatedData['password']);
        }
        $dataUser->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
    public function destroy($id)
    {
        $dataUser = User::findOrFail($id);
        if ($dataUser->id == auth()->user()->id) {
            flash()->addError('Tidak Bisa Menghapus Diri Sendiri');
            return back();
        }
        $dataUser->delete();
        flash('Berhasil Menghapus Data');
        return back();
    }
}
