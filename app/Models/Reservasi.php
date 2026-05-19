<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    // ✅ DAFTARKAN SEMUA KOLOM YANG KITA PAKAI
    protected $fillable = [
        'nama',
        'jumlah_orang',
        'tanggal',
        'no_telp' // 👉 DIMASUKIN BIAR BOLEH DISIMPAN
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}