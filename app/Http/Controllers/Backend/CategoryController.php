<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Storage;
use SweetAlert;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $category = Category::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);

       //QUERY INI MENGAMBIL SEMUA LIST CATEGORY DARI TABLE CATEGORIES, PERHATIKAN AKHIRANNYA ADALAH GET() TANPA ADA LIMIT
       //LALU getParent() DARI MANA? METHOD TERSEBUT ADALAH SEBUAH LOCAL SCOPE
      $parent = Category::getParent()->orderBy('kategori', 'ASC')->get();

       //LOAD VIEW DARI FOLDER CATEGORIES, DAN DIDALAMNYA ADA FILE INDEX.BLADE.PHP
       //KEMUDIAN PASSING DATA DARI VARIABLE $category & $parent KE VIEW AGAR DAPAT DIGUNAKAN PADA VIEW TERKAIT
      return view('Backend.Category.index', compact('category', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = Category::getParent()->orderBy('kategori', 'ASC')->get();
        return view('Backend.Category.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request);
      $request->request->add(['slug' => $request->kategori]);
      $input = $request->all();
      $validator = Validator::make($input,[
        'kategori' => 'required|max:50|unique:categories',
        'gambar_kategori' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        // 'slug' => 'required'
      ]);

      if ($validator->fails()) {
        alert()->warning('Warning Message', 'Data is Not Valid');
        return redirect()->route('category.create')->withErrors($validator)->withInput();
      }


      // dd($input);
      $gambar_kategori = $request->file('gambar_kategori');
      $extention = $gambar_kategori->getClientOriginalExtension();

      if ($request->file('gambar_kategori')->isValid()) {
          $namaFoto = "category/".date('YmdHis').".".$extention;
          $upload_path = 'uploads/category';
          $request->file('gambar_kategori')->move($upload_path,$namaFoto);
          $input['gambar_kategori'] = $namaFoto;
      }


      Category::create($input);
      alert()->success('Success Message', 'Category entered Successfully');
      return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Category::findOrFail($id);
      $parent = Category::getParent()->orderBy('kategori', 'ASC')->get();

      return view('Backend.Category.edit', compact('category','parent'));
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
      $category = Category::findOrFail($id);

      $input = $request->all();

      $validator = Validator::make($input,[
        'kategori' => 'required|max:255',
        'gambar_kategori' => 'sometimes|nullable|image|mimes:jpeg,jpg.png|max:2048'
      ]);

      if ($validator->fails())
      {
        alert()->warning('Warning Message', 'Data is Not Valid');
        return redirect()->route('category.edit',[$id])->withErrors($validator)->withInput();
      }

      if ($request->hasfile('gambar_kategori'))
      {
        if ($request->file('gambar_kategori')->isValid())
        {
          Storage::disk('upload')->delete($category->gambar_kategori);

          $gambar_kategori = $request->file('gambar_kategori');
          $extention = $gambar_kategori->getClientOriginalExtension();
          $namaFoto = "category/".date('YmdHis').".".$extention;
          $upload_path = 'uploads/category';
          $request->file('gambar_kategori')->move($upload_path,$namaFoto);
          $input['gambar_kategori'] = $namaFoto;
        }
      }
      $category->update($input);
      alert()->success('Success', 'Category Update Successfully');
      return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::withCount(['child'])->findOrFail($id);
      if ($category->child_count == 0) {
        // code...
        Storage::disk('upload')->delete($category->gambar_kategori);
        $category->delete();
        alert()->success('Success', 'Category Delete Successfully');
        return redirect()->route('category.index');
      }
      alert()->error('Error', 'This category has sub categories');
      return redirect()->route('category.index');
    }
}
