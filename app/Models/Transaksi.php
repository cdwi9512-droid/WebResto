<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'reservasi_id',
        'tanggal_pesan',
        'total',
        'metode_pembayaran',
        'status'
    ];

    // ✅ RELASI ONE TO ONE
    // Artinya: Transaksi ini milik ONE data Reservasi saja
   public function reservasi()
{
    return $this->belongsTo(Reservasi::class, 'reservasi_id');
}

public function menus()
{
    return $this->belongsToMany(
        Menu::class,
        'detail_transaksi',
        'transaksi_id',
        'menu_id'
    )
    ->withPivot('jumlah', 'sub_total'); 
    // ⬆️ BAGIAN PIVOT ITU HANYA BOLEH ADA DI SINI, DI FUNGSI menus() SAJA
}

// ✅ FUNGSI BARU INI YANG DIPERBAIKI, JANGAN ADA TULISAN PIVOT DI SINI
public function detail_transaksi()
{
    return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    // ✅ UDAH CUMA SEGINI AJA, GAK USAH ADA TAMBAHAN APA-APA LAGI DI BAWAHNYA
}}