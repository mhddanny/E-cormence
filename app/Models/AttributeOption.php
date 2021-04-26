<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    protected $table = 'attribute_options';
    protected $fillable = [
        'atribute_id',
        'name'
    ];

    public function atribute()
    {
        return $this->belongsTo(Atribute::class);
    }
}
