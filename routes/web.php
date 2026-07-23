<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;

Route::get('/', [PengajuanController::class, 'index'])->name('home');
Route::get('/pelayanan', [PengajuanController::class, 'pelayanan'])->name('pelayanan');
Route::get('/persyaratan', [PengajuanController::class, 'persyaratan'])->name('persyaratan');
Route::get('/pengajuan', [PengajuanController::class, 'pengajuan'])->name('pengajuan');
Route::get('/cek-status', [PengajuanController::class, 'cekStatus'])->name('cek-status');
Route::post('/submit-pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/cek-status/search', [PengajuanController::class, 'searchStatus'])->name('cek-status.search');
Route::post('/testimoni', [App\Http\Controllers\TestimoniController::class, 'store'])->name('testimoni.store');
