<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function get_token()
    {
        return response("token");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()
            ]);
        }

        if(Auth::attempt($request->all())){
            $user = Auth::user();

            return response()->json([
                'status' => 1,
                'token' => $user->createToken(env('APP_NAME'))
            ]);
        }else{
            return response()->json([
                'status' => -1,
                'errors' => [
                    'credentials' => 'Wrong credentials'
                ]
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
    }
}
