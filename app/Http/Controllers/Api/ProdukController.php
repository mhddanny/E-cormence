<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Validator;
use Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return ProdukResource::collection(Produk::all());
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

        if ($validator->fails()) {
          // code...
          return response()->json([
            'status'=>FALSE,
            'msg'=>$validator->errors()
          ],400);
        }

        $image = $request->file('image');
        $extention = $image->getClientOriginalExtension();

        if ($request->file('image')->isValid()) {
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path = 'uploads/produk';
            $request->file('image')->move($upload_path,$namaFoto);
            $input['image'] = $namaFoto;
        }

        if (Produk::create($input)) {
          // code...
          return response()->json([
            'status'=>TRUE,
            'msg'=>'Data Entered Successfully'
          ],201);
        }
        else {
          return response()->json([
            'status'=>FALSE,
            'msg'=>'Data Entered Failed'
          ],200);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json([
          'status'=>TRUE,
          'msg'=>'Data Seccesfuly',
          'data'=> $produk
        ],200);
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
        $request->request->add(['slug' => $request->name]);
        $input = $request->all();

        $produk = Produk::find($id);
        if (is_null($produk)) {
            return response()->json([
              'status'=>FALSE,
              'msg'=>'Record Not Found'
            ],404);
        }

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
          return response()->json([
            'status'=>FALSE,
            'msg'=>$validator->errors()
          ],400);
        }

        if ($request->hasfile('image'))
        {
          if ($request->file('image')->isValid())
          {
            Storage::disk('upload')->delete($produk->image);

            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path = 'uploads/produk';
            $request->file('image')->move($upload_path,$namaFoto);
            $input['image'] = $namaFoto;
          }
        }


        $produk->update($input);
            return response()->json([
              'status'=>TRUE,
              'msg'=>'Data Seccesfuly Update'
            ],201);

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
        return response()->json([
          'status'=>TRUE,
          'msg'=>'Data Delete Seccesfuly'
        ],200);

    }
}
