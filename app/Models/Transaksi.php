<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // 🔴 WAJIB: Nama tabel di DB kamu 'transaksi' (tanpa s)
    protected $table = 'transaksi';

    protected $fillable = [
        'reservasi_id',
        'tanggal_pesan',
        'total',
        'metode_pembayaran',
        'status'
    ];

    // Relasi ke Reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    // Relasi Banyak-ke-Banyak ke Menu, lewat tabel detail_transaksi
    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'detail_transaksi', // Nama tabel perantara
            'transaksi_id',     // Foreign key di tabel perantara untuk Transaksi
            'menu_id'           // Foreign key di tabel perantara untuk Menu
        )->withPivot('jumlah'); // 🔴 WAJIB: Ambil kolom 'jumlah' dari tabel perantara
    }
}
