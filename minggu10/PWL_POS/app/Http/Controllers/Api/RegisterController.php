<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required|min:5|confirmed',
            'level_id' => 'required'
        ]);

        // if validations fails
        if ($validator->fails()) {
            return reponse()->json($validator->errors(), 422);
        }

        // create user 
        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'passowrd' => $bcrypt($request->passowrd),
            'level_id' => $request->level_id,
        ]);

        // return reponse JSON user is created
        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        // return JSON process insert failed
        return response()->json([
            'success' => false,
        ], 409);
    }
}