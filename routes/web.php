<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UmkmController;

Route::get('/', [PengajuanController::class, 'index'])->name('home');
Route::get('/pelayanan', [PengajuanController::class, 'pelayanan'])->name('pelayanan');
Route::get('/profil', [PengajuanController::class, 'profil'])->name('profil');
Route::get('/persyaratan', [PengajuanController::class, 'persyaratan'])->name('persyaratan');
Route::get('/pengajuan', [PengajuanController::class, 'pengajuan'])->name('pengajuan');
Route::get('/cek-status', [PengajuanController::class, 'cekStatus'])->name('cek-status');
Route::post('/submit-pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/cek-status/search', [PengajuanController::class, 'searchStatus'])->name('cek-status.search');
Route::post('/testimoni', [App\Http\Controllers\TestimoniController::class, 'store'])->name('testimoni.store');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');

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

// UMKM Admin Routes
Route::get('/admin/umkm', [UmkmController::class, 'adminIndex'])->name('admin.umkm.index');
Route::get('/admin/umkm/create', [UmkmController::class, 'adminCreate'])->name('admin.umkm.create');
Route::post('/admin/umkm', [UmkmController::class, 'adminStore'])->name('admin.umkm.store');
Route::get('/admin/umkm/{id}/edit', [UmkmController::class, 'adminEdit'])->name('admin.umkm.edit');
Route::post('/admin/umkm/{id}', [UmkmController::class, 'adminUpdate'])->name('admin.umkm.update');
Route::post('/admin/umkm/{id}/delete', [UmkmController::class, 'adminDestroy'])->name('admin.umkm.destroy');
Route::post('/admin/umkm/{id}/toggle', [UmkmController::class, 'adminToggle'])->name('admin.umkm.toggle');
