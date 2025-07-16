<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanAsetController;

// Halaman awal
Route::get('/', function () {
    return view('auth.login');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (bisa diakses semua yang login)
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');

// ===================== PEMBATASAN ROLE ===================== //

// ========== ADMIN SAJA ========== //
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Approval
    Route::get('/admin/approval', [PeminjamanController::class, 'adminIndex'])->name('admin.pemesanan');
    Route::put('/admin/approval/{id}', [PeminjamanController::class, 'prosesApproval'])->name('admin.approval.update');

    Route::get('/admin/approval_aset', [PeminjamanAsetController::class, 'adminIndexAset'])->name('admin.pemesanan_aset');
    Route::put('/admin/approval_aset/{id}', [PeminjamanAsetController::class, 'prosesApproval'])->name('admin.approval.update-aset');
});

// ========== ADMIN, PEGAWAI, GS (pengembalian kendaraan) ========== //
Route::middleware(['auth', 'role:admin,pegawai,gs'])->group(function () {
    Route::get('/admin/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('admin.pengembalian.index');
    Route::get('/admin/pengembalian/{id}', [PeminjamanController::class, 'formPengembalian'])->name('admin.form-pengembalian');
    Route::put('/admin/pengembalian/{id}', [PeminjamanController::class, 'prosesPengembalian'])->name('admin.pengembalian.update');
});

// ========== ADMIN, USER, GS (pengembalian aset) ========== //
Route::middleware(['auth', 'role:admin,pegawai,gs'])->group(function () {
    Route::get('/admin/pengembalian_aset', [PeminjamanAsetController::class, 'pengembalian_aset'])->name('admin.pengembalian_aset.index');
    Route::get('/admin/pengembalian_aset/{id}', [PeminjamanAsetController::class, 'formPengembalian'])->name('admin.form-pengembalian_aset');
    Route::put('/admin/pengembalian_aset/{id}', [PeminjamanAsetController::class, 'prosesPengembalian'])->name('admin.pengembalian.update-aset');
});

// ========== ADMIN, GS (kelola data dan laporan) ========== //
Route::middleware(['auth', 'role:admin,gs'])->group(function () {
    // User
    Route::resource('/admin', AdminController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
    Route::put('/admin/user/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.update-password');

    // Kendaraan & Aset
    Route::resource('/kendaraan', KendaraanController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/aset', AsetController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);

    // Laporan
    Route::get('/laporan/peminjaman', [PeminjamanController::class, 'laporan'])->name('laporan.peminjaman');
    Route::get('/laporan/peminjaman_aset', [PeminjamanAsetController::class, 'laporan'])->name('laporan.peminjaman_aset');
});

// ========== SEMUA USER (peminjaman dan riwayat) ========== //
Route::middleware('auth')->group(function () {
    Route::resource('/peminjaman', PeminjamanController::class);
    Route::resource('/peminjaman_aset', PeminjamanAsetController::class);

    Route::get('/riwayat-peminjaman-kendaraan', [PeminjamanController::class, 'riwayatUser'])->name('user.riwayat');
    Route::get('/riwayat-peminjaman-aset', [PeminjamanAsetController::class, 'riwayatUser'])->name('user.riwayat_aset');
});
