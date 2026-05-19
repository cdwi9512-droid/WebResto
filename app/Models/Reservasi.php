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

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}