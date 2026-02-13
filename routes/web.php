<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PelayananDukcapilController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/geojson/jawa_barat.geojson', function () {
    $path = resource_path('geojson/jawa_barat.geojson');
    return response()->file($path, ['Content-Type' => 'application/json']);
});

Route::get('/api/wilayah/regencies/{province}', [WilayahController::class, 'regencies']);
Route::get('/api/wilayah/districts/{regency}', [WilayahController::class, 'districts']);
Route::get('/api/wilayah/villages/{district}', [WilayahController::class, 'villages']);

Route::middleware(['auth:pegawai'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // API: search penduduk for autocompletes
    Route::get('/api/penduduk/search', [PendudukController::class, 'search']);

    Route::resource('pegawai', PegawaiController::class);
    Route::resource('penduduk', PendudukController::class);
    Route::resource('surat', SuratController::class);
    Route::resource('pelayanan', PelayananDukcapilController::class);
});
