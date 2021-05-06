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
      'parent_id',
      'user_id',
      'kd_kategori',
      'kode',
      'type',
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

    public function produkInventory()
    {
      return $this->hasOne(ProdukInventory::class,'kd_produk');
    }

    public function variants()
    {
      return $this->hasMany(Produk::class, 'parent_id')->orderBy('price', 'ASC');
    }

    public function parent()
    {
      return $this->belongsTo(Produk::class, 'parent_id');
    }

    public function category()
    {
      return $this->belongsTo(Category::class, 'kd_kategori');
    }

    public function produkImages()
    {
      return $this->hasMany(ProdukImage::class,'kd_produk');
    }

    public function produkAtrributeValues()
    {
      return $this->hasMany(ProdukAttributeValue::class);
    }

    public static function statuses()
    {
       return [
         0 => 'Draft',
         1 => 'Active',
       ];
    }

    public static function types()
    {
      return [
          'simple' => 'Simple',
          'configurable' => 'Configurable'
      ];
    }

    public function statusesLabel()
    {
      $statuses = $this->statuses();
      return isset($this->status) ? $statuses[$this->status] : null ;
    }
}
