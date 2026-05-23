<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    protected $fillable = [
        'nama',
        'jumlah_orang',
        'tanggal',
        'jam',
        'no_telp'
    ];
    // ✅ RELASI ONE TO ONE: Satu Reservasi punya Satu Transaksi
    public function transaksi()
    {
    return $this->hasOne(Transaksi::class, 'reservasi_id');
    }
}