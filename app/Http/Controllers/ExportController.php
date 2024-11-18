<?php

namespace App\Http\Controllers;

use App\Exports\SPMEexport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return Excel::download(new SPMEexport, 'spme.xlsx');
    }
}
