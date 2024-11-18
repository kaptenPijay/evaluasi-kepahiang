<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dataDashboard = [
            [
                "cardName" => "Program",
                "id" => "program",
                "totalData" => 10,
                'assetName' => 'images/graph-program.png'
            ],
            [
                "cardName" => "Kegiatan",
                "id" => "kegiatan",
                "totalData" => 10,
                'assetName' => 'images/graph-kegiatan.png'
            ],
            [
                "cardName" => "Sub Kegiatan",
                "id" => "subkegiatan",
                "totalData" => 10,
                'assetName' => 'images/graph-subkegiatan.png'
            ],
        ];
        return view('dashboard.index', compact('dataDashboard'));
    }
}
