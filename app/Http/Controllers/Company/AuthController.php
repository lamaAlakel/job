<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Traits\FileStorageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use FileStorageTrait ;

    public function __construct()
    {
        $this->middleware('auth:company', ['except' => ['login','register']]);
    }

    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255 ',
            'commercial_number' => 'required|string',
            'bio' => 'nullable |string',
            'profile_image' => 'nullable|image',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'location'=>'nullable | string'
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
            $path = $this->storefile($request->file('profile_image') , 'Company/Profile/images') ;
        }

        $user=User::create([
            'name'=>$request['name'],
            'commercial_number'=>$request['commercial_number'],
            'bio'=>$request['bio'],
            'profile_image' => $path,
            'email' =>  $request['email'],
            'password' => Hash::make($request['password']),
            'location'=> $request['location'],
        ]);

        $token = Auth::guard('company')->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('company')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('company')->user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);

    }


    public function logout()
    {
        Auth::guard('company')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('company')->user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }




}
