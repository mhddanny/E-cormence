<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'kd_produk';
    protected $fillable = [
      'kd_kategori',
      'kode',
      'name',
      'price',
      'weight',
      'description',
      'status',
      'slug',
      'image'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function category()
    {
      return $this->belongsTo(Category::class, 'kd_kategori');
    }

    public function produkImages()
    {
      return $this->hasMany(ProdukImage::class,'kd_produk');
    }

    public static function statuses()
    {
       return [
         0 => 'draft',
         1 => 'active',
       ];
    }
}
