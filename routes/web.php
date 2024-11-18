<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SubKegiatanController;
use App\Http\Controllers\CetakLaporanController;
use App\Http\Controllers\CetakLaporanSpmController;
use App\Http\Controllers\IndikatorProgramController;
use App\Http\Controllers\IndikatorKegiatanController;
use App\Http\Controllers\KegiatanRealisasiController;
use App\Http\Controllers\IndikatorSubKegiatanController;
use App\Http\Controllers\RealisasiSubKegiatanController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\TriwulanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/login');
});
Route::middleware('guest')->get('/login', function () {
    return view('login');
});
Route::middleware('auth')->prefix('back-office')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('bidang', [BidangController::class, 'index'])->name('bidang.index');
    Route::post('bidang/store', [BidangController::class, 'store'])->name('bidang.store');
    Route::put('bidang/update/{id}', [BidangController::class, 'update'])->name('bidang.update');
    Route::delete('bidang/destroy/{id}', [BidangController::class, 'destroy'])->name('bidang.destroy');

    Route::get('satuan', [SatuanController::class, 'index'])->name('satuan.index');
    Route::post('satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
    Route::put('satuan/update/{id}', [SatuanController::class, 'update'])->name('satuan.update');
    Route::delete('satuan/destroy/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');

    Route::get('triwulan', [TriwulanController::class, 'index'])->name('triwulan.index');
    Route::put('triwulan/update/{id}', [TriwulanController::class, 'update'])->name('triwulan.update');

    Route::get('puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas.index');
    Route::post('puskesmas/store', [PuskesmasController::class, 'store'])->name('puskesmas.store');
    Route::put('puskesmas/update/{id}', [PuskesmasController::class, 'update'])->name('puskesmas.update');
    Route::delete('puskesmas/destroy/{id}', [PuskesmasController::class, 'destroy'])->name('puskesmas.destroy');

    Route::get('program', [ProgramController::class, 'index'])->name('program.index');
    Route::post('program/store', [ProgramController::class, 'store'])->name('program.store');
    Route::put('program/update/{id}', [ProgramController::class, 'update'])->name('program.update');
    Route::delete('program/destroy/{id}', [ProgramController::class, 'destroy'])->name('program.destroy');

    Route::get('indikator', [IndikatorProgramController::class, 'index'])->name('indikator.index');
    Route::post('indikator/store', [IndikatorProgramController::class, 'store'])->name('indikator.store');
    Route::put('indikator/update/{id}', [IndikatorProgramController::class, 'update'])->name('indikator.update');
    Route::delete('indikator/destroy/{id}', [IndikatorProgramController::class, 'destroy'])->name('indikator.destroy');

    Route::get('indikator-kegiatan', [IndikatorKegiatanController::class, 'index'])->name('indikatorKegiatan.index');
    Route::post('indikator-kegiatan/store', [IndikatorKegiatanController::class, 'store'])->name('indikatorKegiatan.store');
    Route::put('indikator-kegiatan/update/{id}', [IndikatorKegiatanController::class, 'update'])->name('indikatorKegiatan.update');
    Route::delete('indikator-kegiatan/destroy/{id}', [IndikatorKegiatanController::class, 'destroy'])->name('indikatorKegiatan.destroy');

    Route::get('indikator-sub-kegiatan', [IndikatorSubKegiatanController::class, 'index'])->name('indikatorSubKegiatan.index');
    Route::post('indikator-sub-kegiatan/store', [IndikatorSubKegiatanController::class, 'store'])->name('indikatorSubKegiatan.store');
    Route::put('indikator-sub-kegiatan/update/{id}', [IndikatorSubKegiatanController::class, 'update'])->name('indikatorSubKegiatan.update');
    Route::delete('indikator-sub-kegiatan/destroy/{id}', [IndikatorSubKegiatanController::class, 'destroy'])->name('indikatorSubKegiatan.destroy');

    Route::get('realisasi', [RealisasiController::class, 'index'])->name('realisasi.index');
    Route::get('realisasi/{id}', [RealisasiController::class, 'dataProgram'])->name('realisasi.dataProgram');
    Route::post('realisasi/store', [RealisasiController::class, 'store'])->name('realisasi.store'); //ini sementara
    Route::post('realisasi/update', [RealisasiController::class, 'update'])->name('realisasi.update');
    Route::delete('realisasi/destroy/{id}', [RealisasiController::class, 'destroy'])->name('realisasi.destroy');

    Route::get('sub-kegiatan-realisasi', [RealisasiSubKegiatanController::class, 'index'])->name('realisasiSubKegiatan.index');
    Route::get('sub-kegiatan-realisasi/{id}', [RealisasiSubKegiatanController::class, 'dataProgram'])->name('realisasiSubKegiatan.dataProgram');
    Route::post('sub-kegiatan-realisasi/store', [RealisasiSubKegiatanController::class, 'store'])->name('realisasiSubKegiatan.store'); //ini sementara
    Route::post('sub-kegiatan-realisasi/update', [RealisasiSubKegiatanController::class, 'update'])->name('realisasiSubKegiatan.update');
    Route::delete('sub-kegiatan-realisasi/destroy/{id}', [RealisasiSubKegiatanController::class, 'destroy'])->name('realisasiSubKegiatan.destroy');

    Route::get('kegiatan-realisasi', [KegiatanRealisasiController::class, 'index'])->name('kegiatanRealisasi.index');
    Route::get('kegiatan-realisasi/{id}', [KegiatanRealisasiController::class, 'dataProgram'])->name('kegiatanRealisasi.dataProgram');
    Route::post('kegiatan-realisasi/store', [KegiatanRealisasiController::class, 'store'])->name('kegiatanRealisasi.store'); //ini sementara
    Route::post('kegiatan-realisasi/update', [KegiatanRealisasiController::class, 'update'])->name('kegiatanRealisasi.update');
    Route::delete('kegiatan-realisasi/destroy/{id}', [KegiatanRealisasiController::class, 'destroy'])->name('kegiatanRealisasi.destroy');

    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('kegiatan/destroy/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    Route::get('sub-kegiatan', [SubKegiatanController::class, 'index'])->name('subKegiatan.index');
    Route::post('sub-kegiatan/store', [SubKegiatanController::class, 'store'])->name('subKegiatan.store');
    Route::put('sub-kegiatan/update/{id}', [SubKegiatanController::class, 'update'])->name('subKegiatan.update');
    Route::delete('sub-kegiatan/destroy/{id}', [SubKegiatanController::class, 'destroy'])->name('subKegiatan.destroy');

    Route::get('cetak-laporan', [CetakLaporanController::class, 'index'])->name('cetakLaporan.index');
    Route::get('cetak-laporan/{id}', [CetakLaporanController::class, 'tahunBidang'])->name('cetakLaporan.tahunBidang');
    Route::post('cetak-laporan', [CetakLaporanController::class, 'cetakRequest'])->name('cetakLaporan.cetak');

    Route::get('export', [ExportController::class, 'index'])->name('export.index');
    Route::get('cetak-laporan-spm', [CetakLaporanSpmController::class, 'index'])->name('cetakLaporanPdfSpm.index');
});
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
