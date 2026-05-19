<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TransaksiController;

// HALAMAN UTAMA
Route::get('/', function () {
    return view('welcome');
});
route::get('/resto', function (){
    return view('resto/index');
});
// MENU
Route::get('/menu', [MenuController::class, 'index']);

//galery
Route::get('/galery', [GaleryController::class, 'index']);

// RESERVASI (INI YANG KURANG DULU)
Route::get('/reservasi', [ReservasiController::class, 'index']);
Route::post('/reservasi/proses', [ReservasiController::class, 'proses']); // <-- INI YANG DICARI SISTEM

// TRANSAKSI
Route::get('/transaksi', [TransaksiController::class, 'index']);