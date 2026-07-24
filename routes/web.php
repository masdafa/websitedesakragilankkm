<?php

use App\Http\Controllers\AdminController;
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

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/pengajuan', [AdminController::class, 'submissions'])->name('admin.submissions');
Route::post('/admin/pengajuan/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.pengajuan.status');
Route::get('/admin/pengajuan/{id}/chat', [App\Http\Controllers\ChatController::class, 'showConversation'])->name('admin.chat.show');
Route::post('/admin/pengajuan/{id}/chat', [App\Http\Controllers\ChatController::class, 'storeMessage'])->name('admin.chat.store');
Route::get('/admin/testimoni', [AdminController::class, 'testimonials'])->name('admin.testimonials');
Route::post('/admin/testimoni/{id}/toggle', [AdminController::class, 'toggleTestimoni'])->name('admin.testimoni.toggle');
Route::get('/admin/site-settings', [AdminController::class, 'siteSettings'])->name('admin.site.settings');
Route::post('/admin/site-settings', [AdminController::class, 'updateSiteSettings'])->name('admin.site.settings.update');
Route::post('/admin/org-members', [AdminController::class, 'storeOrgMember'])->name('admin.org.store');
Route::post('/admin/org-members/{id}', [AdminController::class, 'updateOrgMember'])->name('admin.org.update');
Route::post('/admin/org-members/{id}/delete', [AdminController::class, 'deleteOrgMember'])->name('admin.org.delete');
