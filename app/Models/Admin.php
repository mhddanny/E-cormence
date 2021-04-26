<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $fillable = [
      'username',
      'level',
      'name',
      'mobile',
      'email',
      'password',
      'kd_district',
      'image',
      'status'
    ];
}
