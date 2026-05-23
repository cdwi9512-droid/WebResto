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
        // Tambahkan 'reservasi_id' biar jelas kuncinya, walau tanpa ini juga biasanya jalan
        return $this->belongsTo(Reservasi::class, 'reservasi_id');
    }

    // ✅ RELASI MANY TO MANY (LEWAT TABEL detail_transaksi)
    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'detail_transaksi', // Nama tabel penghubung
            'transaksi_id',      // Kunci dari tabel ini
            'menu_id'            // Kunci dari tabel Menu
        )
        // ✅ TAMBAHKAN 'sub_total' DI SINI!
        // Dulu cuma 'jumlah', tapi kan kita nambah kolom 'sub_total' di database
        ->withPivot('jumlah', 'sub_total'); 
    }
}