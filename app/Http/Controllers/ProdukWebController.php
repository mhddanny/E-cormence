<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Produk;

class ProdukWebController extends Controller
{
    /**S
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       $kategories = Category::with(['child'])->withCount(['child'])->getParent()->orderBy('kategori', 'ASC')->get();
       $produk = Produk::orderBy('created_at', 'DESC')->paginate(8);

       return view('Website.produk_web', compact('produk','kategories'));
     }

     public function categoryProduk($slug)
     {
       $produk = Produk::with('category')->whereHas('category', function ($query){
         $query->where('slug',request('slug') );
       })->paginate(8);

       return view('Website.produk_web', compact('produk'));
     }

     public function produkDetail($slug)
     {
         $produk = Produk::where('slug',$slug)->firstOrfail();

         return view('Website.produk_detail', compact('produk'));
     }

}
