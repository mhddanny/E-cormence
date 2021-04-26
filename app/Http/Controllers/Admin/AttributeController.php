<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Atribute;
use App\Models\AttributeOption;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute = Atribute::orderBy('name', 'ASC')->get();

        return view('Admin.Attribute.index', compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute = null;

        return view('Admin.Attribute.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //  dd($request->all());
            $input = $request->all();
            $validator = Validator::make($input,[
                'code' => 'required|min:3|max:225|unique:atributes',
                'name' => 'required|min:3|max:225|unique:atributes',
                'type' => 'required'             
            ]);
            
            if ($validator->fails()) {
                alert()->warning('Warning Message', 'Data is Not Valid');
                return redirect()->route('attribute.create')->withErrors($validator)->withInput();
            }

            Atribute::create($input);
            alert()->success('Success Message', 'Attribute Entered Succesfuly');
            return redirect()->route('attribute.index');

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
        $attribute = Atribute::findOrFail($id);
        return view('Admin.Attribute.edit', compact('attribute'));
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
        
        $attribute = Atribute::findOrFail($id);
        $data = $request->all();
        // dd($data);
        $validator = Validator::make($data,[
            'code' => 'required|min:3|max:225|unique:atributes,code,'.$id,
            'name' => 'required|min:3|max:225|unique:atributes,name,'.$id,
            'type' => 'required'             
        ]);
        
        if ($validator->fails()) {
            alert()->warning('Warning Message', 'Data is Not Valid');
            return redirect()->route('attribute.edit',[$id])->withErrors($validator)->withInput();
        }

        $attribute->update($data);
        alert()->success('Success Message', 'Attribute Entered Succesfuly');
        return redirect()->route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Atribute::findOrFail($id);
        $data->delete($data);
        alert()->success('Success', 'User Delete Successfully');
        return redirect()->route('attribute.index');
    }

    public function option($id)
    {
        if (empty($id)) {
            return redirect('attribute.index');
        }

        $data = Atribute::findOrFail($id);
        // dd($option->all());
        return view('Admin.Attribute.option', compact('data'));
    }

    public function add_option(Request $request,$id)
    {
        if (empty($id)) {
            return redirect('attribute.index');
        }
        $data = Atribute::find($id);
        // dd($request->all());
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|max:255|unique:attribute_options'
        ]);

        if ($validator->fails()) {
            alert()->warning('Warning Message', 'Data is Not Valid');
            return redirect()->route('attributeoption',[$id])->withErrors($validator)->withInput();
        }

        $save = new AttributeOption;
        $save->atribute_id = $data->id;
        $save->name = $request->name;
        $save->save(); 

        alert()->success('Success', 'Attribute entered Successfully');

        return redirect()->route('attributeoption', [$id]);
    }

    public function edit_option($id)
    {
        if (empty($id)) {
            return redirect('attribute.index');
        }
        
        $attributeoption = AttributeOption::find($id);
        $data = $attributeoption->atribute;
        // dd($attributeoption->all());
        return view('Admin.Attribute.option', [$id], compact('attributeoption', 'data'));

    }

    public function update_option(Request $request, $id)
    {
        if (empty($id)) {
            return redirect('attribute.index');
        }

        // dd($request->all());
        $attributeoption = AttributeOption::find($id);
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|max:255|unique:attribute_options,name,'.$id
        ]);

        if ($validator->fails()) {
            alert()->warning('Warning Message', 'Data is Not Valid');
            return redirect()->route('attribute_update',[$id])->withErrors($validator)->withInput();
        }

        $attributeoption->update($input);
        alert()->success('Success', 'Attribute entered Successfully');

        return redirect()->route('attribute_edit', [$id]);

    }

    public function delete_option($id)
    {
        if (empty($id)) {
            return redirect('attribute.index');
        }
        $data = AttributeOption::find($id);
        $data->delete();
        return redirect()->route('attributeoption', [$id]);
    }
}
