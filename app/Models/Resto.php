<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{

    protected $table = 'resto';
    // ➡️ Ini kasih tau: "Tabel di database namanya `resto`, bukan `restos` (biar sama tulisannya)"

    protected $fillable = [
        'nama_resto', 'deskripsi', 'alamat', 'no'
    ];
    // ➡️ Daftar kolom yang BOLEH diisi atau diubah lewat sistem
    // Isinya: Nama Resto, Penjelasan, Alamat, Nomor Telepon

    // ------------------------------
    // RELASI SATU KE BANYAK
    // Artinya: 1 Resto punya BANYAK Menu & BANYAK Galeri
    // ------------------------------
    public function menus()
    {
        // ➡️ Hubungin ke Model Menu.
        // Artinya: Satu Resto ini bisa punya banyak sekali daftar makanan/minuman
        return $this->hasMany(Menu::class);
    }

    public function galeries()
    {
        // ➡️ Hubungin ke Model Galeri.
        // Artinya: Satu Resto ini bisa punya banyak sekali foto-foto penampakan
        return $this->hasMany(Galery::class);
    }
}