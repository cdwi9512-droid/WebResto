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

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'detail_transaksi',
            'transaksi_id',
            'menu_id'
        )->withPivot('jumlah');
    }
}