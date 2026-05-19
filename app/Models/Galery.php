<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $fillable = [
        'resto_id', 'keterangan', 'gambar'
    ];

    public function resto()
    {
        return $this->belongsTo(Resto::class);
    }
}