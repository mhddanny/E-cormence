<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Produk;
use App\Models\ProdukAttributeValue;

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
      //  $produk = Produk::orderBy('created_at', 'DESC')->paginate(8);
      $produk = Produk::Active()->paginate(8);

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

        if (!$produk) {
          return redirect('web.produk');
        }

        if ($produk->type == 'configurable') {
            $produk['colors'] = ProdukAttributeValue::getAttributeOptions($produk, 'color')->pluck('text_value', 'text_value');
            $produk['sizes'] = ProdukAttributeValue::getAttributeOptions($produk, 'size')->pluck('text_value', 'text_value');
        }
         return view('Website.produk_detail', compact('produk'));
     }

}
