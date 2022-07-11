<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BezetingController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\DiklatKuController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    // Beranda
    Route::get('/', BerandaController::class);
    Route::get('/home', BerandaController::class)->name('home');

    Route::group(['middleware' => 'isAdmin'], function () {
        // User
        Route::resource('/user', UserController::class);
        // Pangkat
        Route::resource('/pangkat', PangkatController::class);
        // Golongan
        Route::resource('/golongan', GolonganController::class);
        // Jabatan
        Route::resource('/jabatan', JabatanController::class);
        // Diklat
        Route::resource('/diklat', DiklatController::class);
    });

    Route::group(['middleware' => 'isOperator'], function () {
        // Pegawai
        Route::post('/pegawai/export', [PegawaiController::class, 'export'])->name('pegawai.export');
        Route::resource('/pegawai', PegawaiController::class);
        // Peserta
        Route::get('/peserta/{id}/detail', [PesertaController::class, 'show'])->name('peserta.detail');
        Route::post('/peserta/{id}/verifikasi', [PesertaController::class, 'verifikasi'])->name('peserta.verifikasi');
        Route::post('/peserta/{id}/sertifikat', [PesertaController::class, 'sertifikat'])->name('peserta.sertifikat');
        Route::resource('/peserta', PesertaController::class)->except(['show']);
        // Rekap
        Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
        Route::get('/rekap/{id}/detail', [RekapController::class, 'show'])->name('rekap.detail');
        Route::post('/rekap/export', [RekapController::class, 'export'])->name('rekap.export');
        // Bezeting
        Route::get('/bezeting', [BezetingController::class, 'index'])->name('bezeting.index');
        Route::get('/bezeting/create', [BezetingController::class, 'create'])->name('bezeting.create');
        Route::post('/bezeting/store', [BezetingController::class, 'store'])->name('bezeting.store');
        Route::get('/bezeting/{id}/edit', [BezetingController::class, 'edit'])->name('bezeting.edit');
        Route::put('/bezeting/{id}/update', [BezetingController::class, 'update'])->name('bezeting.update');
        Route::post('/bezeting/export', [BezetingController::class, 'export'])->name('bezeting.export');
    });

    Route::group(['middleware' => 'isUser'], function () {
        // Diklat-Ku
        Route::get('/diklatku', [DiklatKuController::class, 'index'])->name('diklatku.index');
        Route::get('/diklatku/create', [DiklatKuController::class, 'create'])->name('diklatku.create');
        Route::post('/diklatku/store', [DiklatKuController::class, 'store'])->name('diklatku.store');
        Route::get('/diklatku/edit/{id}', [DiklatKuController::class, 'edit'])->name('diklatku.edit');
        Route::put('/diklatku/update/{id}', [DiklatKuController::class, 'update'])->name('diklatku.update');
        Route::get('/diklatku/detail/{id}', [DiklatKuController::class, 'show'])->name('diklatku.detail');
        Route::post('/diklatku/sertifikat/{id}', [DiklatKuController::class, 'sertifikat'])->name('diklatku.sertifikat');
    });
    // Pengaturan Akun
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::post('/akun/update', [AkunController::class, 'update'])->name('akun.update');
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});
