<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'resto_id', 'nama_menu', 'deskripsi', 'harga', 'gambar'
    ];

    public function resto()
    {
        return $this->belongsTo(Resto::class);
    }

    public function transaksis()
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi')
                    ->withPivot('jumlah');
    }
}