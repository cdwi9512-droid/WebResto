<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{

protected $table = 'resto';

    protected $fillable = [
        'nama_resto', 'deskripsi', 'alamat', 'no'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function galeries()
    {
        return $this->hasMany(Galery::class);
    }
}