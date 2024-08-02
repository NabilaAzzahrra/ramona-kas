<?php

use App\Http\Controllers\JenispengeluaranController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoController;
use App\Models\Jenispengeluaran;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('klasifikasi',KlasifikasiController::class)->middleware(['auth']);
Route::resource('jenis_pengeluaran',JenispengeluaranController::class)->middleware(['auth']);
Route::resource('pendapatan',PendapatanController::class)->middleware(['auth']);
Route::resource('saldo',SaldoController::class)->middleware(['auth']);
Route::resource('pengeluaran',PengeluaranController::class)->middleware(['auth']);
Route::resource('laporan',LaporanController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
