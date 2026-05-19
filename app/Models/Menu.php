<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu'; // Tambahin ini biar aman

    public function resto()
    {
        return $this->belongsTo(Resto::class);
    }

    public function transaksis()
    {
        return $this->belongsToMany(
            Transaksi::class,
            'detail_transaksi'
        )->withPivot('jumlah');
    }
}

