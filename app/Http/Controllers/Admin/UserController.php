<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use SweetAlert;
use Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('Admin.User.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();

        $validasi = Validator::make($data,[
          'username' => 'required|unique:users',
          'name' => 'required|max:100',
          'email' => 'required|email|max:100|unique:users',
          'password' => 'required|min:6',
          'level' => 'required',
        ]);

        if ($validasi->fails())
        {
          alert()->warning('Warning Message', 'Data is Not Valid');
          return redirect()->back()->withErrors($validasi)->withInput();
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        alert()->success('Success', 'User Entered Successfully');
        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        return view('Admin.User.edit', compact('user'));
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
        $user = User::find($id);
        $data = $request->all();
        // dd($data);

        $validasi = Validator::make($data,[
          'username' => 'required|unique:users,username,'.$id,
          'name' => 'required|max:100',
          'email' => 'required|email|max:100|unique:users,email,'.$id,
          'password' => 'sometimes|nullable|min:6',
          'level' => 'required',
        ]);

        if ($validasi->fails()) {
            alert()->warning('Warning Message', 'Data In Not Valid');
            return redirect()->route('user.edit',[$id])->withErrors($validasi)->withInput();
        }

        if ($request->input('password')) {
              $data['password'] = bcrypt($data['password']);
        }else {
            $data = Arr::except($data,['password']);
        }
        $user->update($data);
        alert()->success('Success', 'User Edit Successfully');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = User::findOrFail($id);
         $data->delete();
         alert()->success('Success', 'User Delete Successfully');
         return redirect()->route('user.index');
    }
}
