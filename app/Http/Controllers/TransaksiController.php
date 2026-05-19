<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil transaksi + relasi menus + reservasi
        $transaksi = Transaksi::with(['menus', 'reservasi'])->get();
        
        return view('Transaksi.index', compact('transaksi'));
    }
}