<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Province;
// use DB;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SweetAlert;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
      //VALIDASI DATA YANG DIKIRIM
      $this->validate($request, [
          'kd_produk' => 'required|exists:produks', //PASTIKAN PRODUCT_IDNYA ADA DI DB
          'qty' => 'required|integer' //PASTIKAN QTY YANG DIKIRIM INTEGER
      ]);
      // dd($request);
      //AMBIL DATA CART DARI COOKIE, KARENA BENTUKNYA JSON MAKA KITA GUNAKAN JSON_DECODE UNTUK MENGUBAHNYA MENJADI ARRAY
      $carts = json_decode($request->cookie('e-carts'), true);

      //CEK JIKA CARTS TIDAK NULL DAN PRODUCT_ID ADA DIDALAM ARRAY CARTS
      if ($carts && array_key_exists($request->kd_produk, $carts)) {
          //MAKA UPDATE QTY-NYA BERDASARKAN PRODUCT_ID YANG DIJADIKAN KEY ARRAY
          $carts[$request->kd_produk]['qty'] += $request->qty;
      } else {
          //SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUCT_ID
          $produk = Produk::find($request->kd_produk);
          //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUCT_ID SEBAGAI KEY DARI ARRAY CARTS
          $carts[$request->kd_produk] = [
              'qty' => $request->qty,
              'kd_produk' => $produk->kd_produk,
              'kode' => $produk->kode,
              'name' => $produk->name,
              'price' => $produk->price,
              'image' => $produk->image,
              'weight' => $produk->weight
          ];
      }

      //BUAT COOKIE-NYA DENGAN NAME WF-CARTS
      //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 1400 MENIT ATAU 48 JAM
      $cookie = cookie('e-carts', json_encode($carts), 1440);
      //STORE KE BROWSER UNTUK DISIMPAN
      alert()->success('Success', 'Product eddeds To Cart');
      return redirect()->back()->cookie($cookie)->with('status', 'Produk Berhasil di Masukan ke dalam Keranjang');

    }

    public function listCart()
    {
      //MENGAMBIL DATA DARI COOKIE
      $carts = json_decode(request()->cookie('e-carts'), true);
      //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL

       // dd($carts);
      $subtotal = collect($carts)->sum(function($q) {
          return $q['qty'] * $q['price']; //SUBTOTAL TERDIRI DARI QTY * harga
      });

      //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
      return view('Website.card', compact('carts', 'subtotal'));

    }

    public function updateCart(Request $request)
    {
      //AMBIL DATA DARI COOKIE
      $carts = json_decode(request()->cookie('e-carts'), true);
      //KEMUDIAN LOOPING DATA PRODUCT_ID, KARENA NAMENYA ARRAY PADA VIEW SEBELUMNYA
      //MAKA DATA YANG DITERIMA ADALAH ARRAY SEHINGGA BISA DI-LOOPING
      // dd($carts);
      foreach ($request->kd_produk as $key => $row) {
          //DI CHECK, JIKA QTY DENGAN KEY YANG SAMA DENGAN PRODUCT_ID = 0
          if ($request->qty[$key] == 0) {
              //MAKA DATA TERSEBUT DIHAPUS DARI ARRAY
              unset($carts[$row]);
          } else {
              //SELAIN ITU MAKA AKAN DIPERBAHARUI
              $carts[$row]['qty'] = $request->qty[$key];
          }
      }

      //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
      $cookie = cookie('e-carts', json_encode($carts), 1440);
      //DAN STORE KE BROWSER.
     // dd($cookie);
      return redirect()->back()->cookie($cookie);
    }

    public function remove(Request $request)
    {
      //AMBIL DATA DARI COOKIE
      $carts = json_decode(request()->cookie('e-carts'), true);
      // dd($carts);
      //DI CEK CARTS SESUAI ID
      if ($request->id) {
        //TANGAKAP CART SESUAI ID PRODUK YANG INGIN DI HAPUS
        //
        if(isset($carts[$request->id])) {
            unset($carts[$request->id]);
            session()->put('carts', $carts);
        }

        //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
        $cookie = cookie('e-carts', json_encode($carts), 1440);
        //DAN STORE KE BROWSER.
        return redirect()->back()->cookie($cookie);
      }
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('e-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function checkout()
    {
      // return 'ok';
        //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
        $provinces = Province::orderBy('created_at', 'DESC')->get();
        $carts = $this->getCarts(); //MENGAMBIL DATA CART
        //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['price'];
        });
        $weight = collect($carts)->sum(function($q) {
        return $q['qty'] * $q['weight'];
        });
        //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINCES, CARTS DAN SUBTOTAL
        return view('Website.checkout', compact('provinces', 'carts', 'subtotal', 'weight'));
    }

    public function getCity()
    {
        //QUERY UNTUK MENGAMBIL DATA KOTA / KABUPATEN BERDASARKAN PROVINCE_ID
        $cities = City::where('province_id', request()->province_id)->get();
        //KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        //QUERY UNTUK MENGAMBIL DATA KECAMATAN BERDASARKAN CITY_ID
        $districts = District::where('city_id', request()->city_id)->get();
        //KEMUDIAN KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $districts]);
    }




}
