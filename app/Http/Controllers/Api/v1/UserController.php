<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['data'=> $validator->errors()->all(), 'status'=>400], 400);
        }

        if(!auth()->validate(['email'=> $request->email,'password'=>$request->password])) {
            return response(['data'=> 'Unaunthenticate', 'status'=>401], 401);
        };

        return response(['data'=> User::whereEmail($request->input('email'))->first()->api_token, 'status'=>200], 200);


    }
}
