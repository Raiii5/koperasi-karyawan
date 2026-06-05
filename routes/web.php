<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController as AdminKaryawanController;
use App\Http\Controllers\Admin\PinjamanController as AdminPinjamanController;
use App\Http\Controllers\Admin\AngsuranController as AdminAngsuranController;
use App\Http\Controllers\Admin\CutiController as AdminCutiController;
use App\Http\Controllers\Admin\IzinKerjaController as AdminIzinKerjaController;

use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\PinjamanController as KaryawanPinjamanController;
use App\Http\Controllers\Karyawan\CutiController as KaryawanCutiController;
use App\Http\Controllers\Karyawan\IzinKerjaController as KaryawanIzinKerjaController;

use App\Http\Controllers\Karyawan\PasswordController as KaryawanPasswordController;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/ubah-password', [PasswordResetController::class, 'showForm']);
Route::post('/ubah-password', [PasswordResetController::class, 'resetPassword']);

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Data Karyawan
    Route::get('/karyawan', [AdminKaryawanController::class, 'index']);
    Route::get('/karyawan/create', [AdminKaryawanController::class, 'create']);
    Route::post('/karyawan', [AdminKaryawanController::class, 'store']);

    Route::get('/karyawan/{id}/edit', [AdminKaryawanController::class, 'edit']);
    Route::post('/karyawan/{id}/update', [AdminKaryawanController::class, 'update']);
    Route::post('/karyawan/{id}/toggle-status', [AdminKaryawanController::class, 'toggleStatus']);
    Route::post('/karyawan/{id}/reset-password', [AdminKaryawanController::class, 'resetPassword']);
    Route::get('/karyawan/{id}', [AdminKaryawanController::class, 'show']);

    // Pinjaman
    Route::get('/pinjaman', [AdminPinjamanController::class, 'index']);
    Route::get('/pinjaman/{id}/approve', [AdminPinjamanController::class, 'approve']);
    Route::get('/pinjaman/{id}/reject', [AdminPinjamanController::class, 'reject']);

    // Angsuran
    Route::get('/angsuran', [AdminAngsuranController::class, 'index']);
    Route::get('/angsuran/create', [AdminAngsuranController::class, 'create']);
    Route::post('/angsuran', [AdminAngsuranController::class, 'store']);

    // Cuti
    Route::get('/cuti', [AdminCutiController::class, 'index']);
    Route::get('/cuti/{id}/approve', [AdminCutiController::class, 'approve']);
    Route::get('/cuti/{id}/reject', [AdminCutiController::class, 'reject']);

    // Izin Kerja
    Route::get('/izin', [AdminIzinKerjaController::class, 'index']);
    Route::get('/izin/{id}/approve', [AdminIzinKerjaController::class, 'approve']);
    Route::get('/izin/{id}/reject', [AdminIzinKerjaController::class, 'reject']);
});

Route::middleware(['karyawan.auth'])->prefix('karyawan')->group(function () {

    Route::get('/dashboard', [KaryawanDashboardController::class, 'index']);

    Route::get('/pinjaman', [KaryawanPinjamanController::class, 'index']);
    Route::get('/pinjaman/create', [KaryawanPinjamanController::class, 'create']);
    Route::post('/pinjaman', [KaryawanPinjamanController::class, 'store']);

    Route::get('/cuti', [KaryawanCutiController::class, 'index']);
    Route::get('/cuti/create', [KaryawanCutiController::class, 'create']);
    Route::post('/cuti', [KaryawanCutiController::class, 'store']);

    Route::get('/izin', [KaryawanIzinKerjaController::class, 'index']);
    Route::get('/izin/create', [KaryawanIzinKerjaController::class, 'create']);
    Route::post('/izin', [KaryawanIzinKerjaController::class, 'store']);

    Route::get('/password', [KaryawanPasswordController::class, 'edit']);
    Route::post('/password', [KaryawanPasswordController::class, 'update']);
});