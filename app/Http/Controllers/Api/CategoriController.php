<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoriResource;

class CategoriController extends Controller
{
     public function get_all()
     {
         return CategoriResource::collection(Category::all());
     }
}
