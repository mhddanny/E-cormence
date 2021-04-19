<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{Produk,Category,ProdukImage};
use Illuminate\Http\Request;
use Storage;
use SweetAlert;
use Validator;


class ProdukController extends Controller
{
     public function __construct()
     {
        $this->data['statuses'] = Produk::statuses();
     }

    public function index()
    {
        $produk = Produk::orderBy('name', 'ASC')->paginate(10);
        return view('Backend.Produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('kategori', 'ASC')->get();
        $produk = Produk::orderBy('name', 'ASC')->get();
        $produkimages = 0;
        return view('Backend.Produk.create', compact('category', 'produk', 'produkimages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['slug' => $request->name]);
         //dd($request->all());
        $input = $request->all();
        $validator = Validator::make($input,[
          'kode' => 'required|min:3|unique:produks',
          'kd_kategori' => 'required',
          'name' => 'required|min:3',
          'price' => 'required|min:4',
          'weight' => 'required|min:3',
          'description' => 'sometimes|nullable|max:255',
          'status' => 'required',
          'image' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        // dd($input);

        if ($validator->fails()) {
          alert()->warning('Warning ', 'Data is Not Valid');
          return redirect()->route('produk.create')->withErrors($validator)->withInput();
        }

        $image = $request->file('image');
        $extention = $image->getClientOriginalExtension();

        if ($request->file('image')->isValid()) {
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path = 'uploads/produk';
            $request->file('image')->move($upload_path,$namaFoto);
            $input['image'] = $namaFoto;
        }

        $produk = Produk::create($input);
        alert()->success('Success', 'Product entered Successfully');
        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Backend.Produk.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $produk = Produk::findOrFail($id);

          $category = Category::orderBy('kategori', 'ASC')->get();
          return view('Backend.Produk.edit', compact('produk','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $produk = Produk::findOrFail($id);

      $request->request->add(['user_id' => auth()->user()->id ]);
      $request->request->add(['slug' => $request->name]);
      //dd($request);
      $input = $request->all();

      $validator = Validator::make($input,[
        'kode' => 'required|min:3',
        'kd_kategori' => 'required',
        'name' => 'required|min:3',
        'price' => 'required|min:4',
        'weight' => 'required|min:3',
        'description' => 'sometimes|nullable|max:255',
        'status' => 'required',
        'image' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
      ]);

      if ($validator->fails()) {
        alert()->warning('Warning ', 'Data is Not Valid');
        return redirect()->route('produk.edit',[$id])->withErrors($validator);
      }

      if ($request->hasfile('image'))
      {
        if ($request->file('image')->isValid())
        {
          Storage::disk('upload')->delete($category->image);

          $image = $request->file('image');
          $extention = $image->getClientOriginalExtension();
          $namaFoto = "produk/".date('YmdHis').".".$extention;
          $upload_path = 'uploads/produk';
          $request->file('image')->move($upload_path,$namaFoto);
          $input['image'] = $namaFoto;
        }
      }

      $produk->update($input);
      // $produk->category()->attach($input['kd_kategori']);
      alert()->success('Success', 'Product entered Successfully');
      return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        alert()->success('Success', 'Product entered Successfully');
        return redirect()->route('produk.index');
    }
}
