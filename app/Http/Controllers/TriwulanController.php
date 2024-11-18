<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TriwulanController extends Controller
{
    public function index(Request $request)
    {
        $data = Triwulan::latest();
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
                ->addColumn('start_date', function ($data) {
                    return Carbon::parse($data->start_date)->translatedFormat('d F Y');
                })
                ->addColumn('end_date', function ($data) {
                    return Carbon::parse($data->end_date)->translatedFormat('d F Y');
                })
                ->addColumn('action', function ($data) {
                    return "
                    <div class='wrapper_action_dt'>
                        <button onclick='editData(" . json_encode($data) . ")' aria-expanded='false' class='btn btn_action_dt icon_edit'><i class='ri-pencil-line'></i></button>
                    </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = auth()->user()->role == 'Super Admin' ? 'Data Triwulan' : '';
        $updateUrl = 'triwulan.update';
        return view('triwulan.index', compact('request', 'title', 'updateUrl'));
    }
    public function update(Request $request, $id)
    {
        $dataTriwulan = Triwulan::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'start_date.required' => 'Tanggal Mulai wajib diisi.',
            'end_date.required' => 'Tanggal Berakhir wajib diisi.',
        ]);

        if ($validator->fails()) {
            flash()->addError('Gagal Menyimpan Data');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();
        $dataTriwulan->update($validatedData);
        flash('Berhasil Mengubah Data');
        return back();
    }
}
