<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    
    // ✅ DI SINI DITAMBAH: Masukkan 'sub_total' ke dalam $fillable
    protected $fillable = [
        'transaksi_id',
        'menu_id',
        'jumlah',
        'sub_total' // <--- ✅ TAMBAHKAN BARIS INI
    ];

    // === RELASI (Sudah benar, pastikan ada ini) ===
    // Terhubung ke Tabel Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Terhubung ke Tabel Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}