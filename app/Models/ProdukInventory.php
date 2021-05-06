<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_produk',
        'qty'
    ];


    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
