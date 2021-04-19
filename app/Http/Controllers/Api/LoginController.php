<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResources;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
    public function login_user(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
          'username' => 'required',
          'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
              'status'=>FALSE,
              'msg'=>$validator->errors()
            ],400);
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where([
                ['username',$username]
              ])->first();

        if (is_null($user)) {
          //jika user tidak ditemukan
            return response()->json([
              'status'=>FALSE,
              'msg' =>'Username Not Fount'
            ],200);
        }
        else {
          //jika user ditemukan
          if (password_verify($password,$user->password)) {
            //jika password sesuia
              return response()->json([
                'status'=>TRUE,
                'msg'=>'Username Seccesfuly',
                'user'=>new UserResources($user)
              ],200);
          }
          else {
            // password tidak sesuai
            return response()->json([
              'status'=>FALSE,
              'msg'=>'Username & Password Not Fount'
            ],200);
          }
        }
    }

    public function get_user()
    {
        return UserResources::collection(User::all());
    }
}
