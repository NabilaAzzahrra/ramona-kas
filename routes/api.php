<?php

use App\Http\Controllers\API\JenispengeluaranAPIController;
use App\Http\Controllers\API\KlasifikasiAPIController;
use App\Http\Controllers\API\PendapatanAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/klasifikasi', [KlasifikasiAPIController::class, 'get_all'])->name('klasifikasi.get');
Route::get('/jenis_pengeluaran', [JenispengeluaranAPIController::class, 'get_all'])->name('jenis_pengeluaran.get');
Route::get('/pendapatan', [PendapatanAPIController::class, 'get_all'])->name('pendapatan.get');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
