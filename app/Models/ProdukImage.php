<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
    use HasFactory;

    protected $date = ['created_at'];
    protected $table = "produk_images";
    protected $fillable = [
      'kd_produk',
      'path'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
