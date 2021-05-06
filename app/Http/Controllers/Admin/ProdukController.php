<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Atribute, AttributeOption, Produk,Category, ProdukAttributeValue, ProdukImage, ProdukInventory};
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use Storage;
use SweetAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class ProdukController extends Controller
{

     public function __construct()
     {
        $this->data['statuses'] = Produk::statuses();
        $this->data['types'] = Produk::types();
        
     }

    public function index()
    {
        $produk = Produk::orderBy('name', 'ASC')->paginate(10);
        return view('Admin.Produk.index', compact('produk'));
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
        $configurableAttributes  = $this->getConfigurableAttribute();
        // $types = Produk::types();
        $produkimages = 0;
        return view('Admin.Produk.create', compact('category', 'produk', 'produkimages', 'configurableAttributes'));
    }


    private function getConfigurableAttribute()
    {
        return Atribute::where('is_configureble', true)->get();
    }

    private function generateAttributeCombinations($arrays)
    {
      $result = array(array());
        foreach ($arrays as $property => $property_values) {
          $tmp = array();
          foreach ($result as $result_item) {
            foreach ($property_values as $property_value) {
              $tmp[] = array_merge($result_item, array($property => $property_value));
            }
          }
          $result = $tmp;
        }
        return $result;
    }

    private function convertVariantAsName($variant)
    {
      $variantsName = '';

      foreach (array_keys($variant) as $key => $kode) {
        $attributeOptionId = $variant[$kode];
        $attributeOption = AttributeOption::find($attributeOptionId);

        if ($attributeOption) {
           $variantsName .= '-' . $attributeOption->name;
        }
      }

      return $variantsName;
    }

    private function generateAttributevariants($produk, $input)
    {
      $configurableAttributes = $this->getConfigurableAttribute();

      $variantAttributes = [];
      foreach ($configurableAttributes as $attribute) {
        $variantAttributes[$attribute->code] = $input[$attribute->code];
      }
      $variants = $this->generateAttributeCombinations($variantAttributes);
      // print_r($variants);exit;
            if ($variants) {
              foreach ($variants as $variant) {
                $inputVariant = [
                    'parent_id' => $produk->kd_produk,
                    'user_id' => Auth::user()->id,
                    'kd_kategori' => $produk->kd_kategori,
                    'kode' => $produk->kode . '-' .implode('-', array_values($variant)),
                    'type' => "simple",
                    'name' => $produk->name . $this->convertVariantAsName($variant),
                  ];
                  // print_r($inputVariant);exit;
                  $inputVariant['slug'] = Str::slug($inputVariant['name']);

                  $newProdukVariant = Produk::create($inputVariant);

                  $this->saveProdukAttributeValues($newProdukVariant, $variant, $produk->kd_produk);
              }
            }
    }

    private function saveProdukAttributeValues($produk, $variant, $parentProdukID)
    {
      foreach (array_values($variant) as $attributeOptionID) {
        $attributeOption = AttributeOption::find($attributeOptionID);
        
        $inputAttributeValue = [
          'kd_produk' => $produk->kd_produk,
          'atribute_id' => $attributeOption->atribute_id,
          'text_value' => $attributeOption->name,
        ];

        ProdukAttributeValue::create($inputAttributeValue);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::user()->id]);
        $request->request->add(['slug' => Str::slug($request->name)]);

        $input = $request->all();
        $validator = Validator::make($input,[
          'type' => 'required',
          'kode' => 'required|min:3|unique:produks',
          'kd_kategori' => 'required',
          'name' => 'required|min:3',
          'image' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);
        // dd($input);

        if ($validator->fails()) {
          alert()->warning('Warning ', 'Data is Not Valid');
          return redirect()->route('produk.create')->withErrors($validator)->withInput();
        }

        $produk = DB::transaction(
          function () use ($input) {
            $produk =  Produk::create($input);

            if ($input['type'] == 'configurable') {
              $this->generateAttributevariants($produk, $input);
              }
              return $produk;
          }
        );

        alert()->success('Success', 'Product entered Successfully');
        return redirect('admin/produk/' . $produk->kd_produk . '/edit/');
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
        $category = Category::orderBy('kategori', 'ASC')->get();

        return view('Admin.Produk.show', compact('produk', 'category'));
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
          // $produk->qty = isset($produk->produkIventory) ? $produk->produkInventory->qty : null; 

          $category = Category::orderBy('kategori', 'ASC')->get();
          return view('Admin.Produk.edit', compact('produk','category'));
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
      $request->request->add(['user_id' => Auth::user()->id]);
      $request->request->add(['slug' => Str::slug($request->name)]);

      $input = $request->all();
      
      $produk = Produk::findOrFail($id);
      $validator = Validator::make($input,[
        'kode' => 'required|min:3',
        'kd_kategori' => 'required',
        'name' => 'required|min:3',
        // 'price' => 'required|min:4',
        // 'weight' => 'required|min:3',
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
          Storage::disk('upload')->delete($produk->image);

          $image = $request->file('image');
          $extention = $image->getClientOriginalExtension();
          $namaFoto = "produk/".date('YmdHis').".".$extention;
          $upload_path = 'uploads/produk';
          $request->file('image')->move($upload_path,$namaFoto);
          $input['image'] = $namaFoto;
        }
      }

      $saved = false;
      $saved = DB::transaction(function() use ($produk, $input){
          $produk->update($input);
          
          if ($produk->type == 'configurable') {
              $this->updateProdukVariants($input);
          }
          else {
            ProdukInventory::updateOrCreate(['kd_produk' => $produk->kd_produk], ['qty' => $input['qty']]);
          }
          return true;
      });

      // $produk->category()->attach($input['kd_kategori']);
      alert()->success('Success', 'Product entered Successfully');
      return redirect()->route('produk.index');
    }

    private function updateProdukVariants($input)
    {
      $variants = $input['variants'];
      if ($variants) {
        foreach ($variants as $produkInput) {
            $produk = Produk::find($produkInput['kd_produk']);
            $produk->update($produkInput);
            // dd($variants);
            $produk->status = $input['status'];
            $produk->save();
            
            ProdukInventory::updateOrCreate(['kd_produk' => $produk->kd_produk], ['qty' => $produkInput['qty']]);
        }
      }
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

    public function images($id)
    {
      if (empty($id)) {
         return redirect()->route('produk.create');
      }
      $produk = Produk::find($id);
      $images = $produk->produkImages;

      return view('Admin.Produk.image', compact('produk', 'images'));
    }

    public function store_image(Request $request, $id)
    {
      // dd($request);
      $produk = Produk::find($id);
      $input = $request->all();
      $validator = Validator::make($input,[
        'path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
      ]);

      if ($validator->fails()) {
          alert('warning', 'Record is Not Found');
          return redirect()->route('imageproduk', [$produk->kd_produk])->withErrors($validator)->withInput();
      }

      if ($request->file('path')->isValid()) {

        // $name = $request->file('path')->getClientOriginalName();
        //
        // $path = $request->file('path')->store('public/images');
        $gambar_produk = $request->file('path');
        $extention = $gambar_produk->getClientOriginalExtension();
        $namaFoto = "produk/".date('YmdHis').".".$extention;
        $upload_path = 'uploads/produk/';
        $request->file('path')->move($upload_path,$namaFoto);
        $input['path'] = $namaFoto;

        $save = new ProdukImage;

        $save->kd_produk = $produk->kd_produk;
        $save->path = $namaFoto;

        $save->save();
      }

      alert()->success('Success', 'Images Product entered Successfully');

      return redirect()->route('imageproduk', [$produk->kd_produk]);
    }

    public function imagedelete($id)
    {
        $image = ProdukImage::findOrFail($id);
        Storage::disk('upload')->delete($image->path);
        $image->delete();
        alert()->success('Success', 'Image Delete Successfully');
        return redirect()->route('imageproduk', [$image->produk->kd_produk]);
    }
}
