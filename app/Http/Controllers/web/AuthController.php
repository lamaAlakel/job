<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255 ',
            'commercial_number' => 'required|string',
            'bio' => 'string',
            'profile_image' => 'nullable|image',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
        $path = null ;
        if ($request->hasFile('profile_image'))
        {
            $path = $request->file('profile_image')->store('CompanyProfileImage') ;
        }
        $user=User::create([
            'name'=>$request['name'],
            'commercial_number'=>$request['commercial_number'],
            'bio'=>$request['bio'],
            'profile_image' => $path,
            'email' =>  $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);

    }
}
