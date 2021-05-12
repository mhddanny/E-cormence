<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_produk',
        'atribute_id',
        'text_value',
        'boolean_valus',
        'integer_value',
        'float_value',
        'datetime_value',
        'date_value',
        'json_value',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }

    public static function getAttributeOptions($product, $attributeCode)
    {
        $productVariantIDs = $product->variants->pluck('kd_produk');
        
        $attribute = Atribute::where('code', $attributeCode)->first();

        $attributeOptions = ProdukAttributeValue::where('atribute_id', $attribute->id)
                            ->whereIn('kd_produk', $productVariantIDs)
                            ->get();
        // dd($attributeOptions);
        return $attributeOptions;
    }
}
