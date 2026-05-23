<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;

// HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});

// FITUR CRUD RESTO
Route::resource('resto', RestoController::class);

// FITUR CRUD MENU
Route::resource('menu', MenuController::class);

// FITUR CRUD GALERY
Route::resource('galery', GaleryController::class);

// FITUR CRUD RESERVASI + RUTE KHUSUS PROSES PESAN
Route::resource('reservasi', ReservasiController::class);
Route::post('/reservasi/proses', [ReservasiController::class, 'proses'])->name('reservasi.proses');

// FITUR CRUD TRANSAKSI
Route::resource('transaksi', TransaksiController::class);

// Taruh di antara route transaksi dan yang lain
Route::resource('detail_transaksi', DetailTransaksiController::class);