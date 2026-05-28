<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
// ✅ TAMBAHKAN BARIS INI (Controller Login yang akan kita bikin)
use App\Http\Controllers\LoginController;

// ==================================================
// ✅ BAGIAN 1: HALAMAN BEBAS ACCESS (TANPA LOGIN)
// ==================================================
Route::get('/', function () {
    return view('welcome');
});

// RUTE UNTUK FITUR LOGIN & LOGOUT
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/proses-login', [LoginController::class, 'masuk'])->name('proses.login');
Route::get('/logout', [LoginController::class, 'keluar'])->name('logout');


// ==================================================
// ✅ BAGIAN 2: HALAMAN TERKUNCI (WAJIB LOGIN DULU)
// SEMUA FITUR CRUD KAMU MASUK KE DALAM SINI BIAR AMAN!
// ==================================================
Route::middleware(['login'])->group(function () {

    // HALAMAN UTAMA SETELAH BERHASIL LOGIN
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // --------------------------
    // ✅ FITUR CRUD KAMU (SUDAH ADA, TETAP SAMA PERSIS)
    // --------------------------
    Route::resource('resto', RestoController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('galery', GaleryController::class);
    Route::resource('reservasi', ReservasiController::class);
    Route::post('/reservasi/proses', [ReservasiController::class, 'proses'])->name('reservasi.proses');
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('detail_transaksi', DetailTransaksiController::class);

});