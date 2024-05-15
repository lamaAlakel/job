<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\stringContains;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login','register']]);
    }

    public function register(Request $request){
        $validate = Validator::make($request->all() ,[
            'name'=>'required | string | max:255',
            'email'=>'required |string| email | max:255 | unique:admins',
            'password'=>'required | string | min:10 | max: 255 '
            ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
    }
        $admin=Admin::create([
        'name'=>$request['name'],
        'email'=>$request['email'],
        'password'=> Hash::make($request['password'])
        ]);
        $token= Auth::guard('admin')->login($admin);

        return response()->json([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'user' => $admin,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::guard('admin')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $admin = Auth::guard('admin')->user();
        return response()->json([
            'status' => 'success',
            'user' => $admin,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

}
