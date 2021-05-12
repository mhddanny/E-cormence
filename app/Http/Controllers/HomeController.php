<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Produk::Active()->paginate(8);
        return view('Website.home_web', compact('produk'));
    }

    public function produk()
    {
      $kategories = Category::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
      $produk = Produk::Active()->paginate(8);
     
      return view('Website.produk_web', compact('produk','kategories'));
    }

    public function produkDetail($id)
    {
        $kategories = Category::all();
        $produk = Produk::find($id);
        return view('Website.produk_detail', compact('kategories', 'produk'));
    }

}
