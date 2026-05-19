<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{
   public function menus()
{
    return $this->hasMany(Menu::class);
}

public function galeries()
{
    return $this->hasMany(Galery::class);
}
}
