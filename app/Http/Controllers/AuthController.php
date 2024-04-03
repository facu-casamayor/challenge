<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        return response()->json([
            'message'=>'User registered',
            'data'=>$user,
        ], 201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(30))->plainTextToken;

        return response()->json([
            'message'=>'User logged',
            'token'=>$token,
            'token_type'=>'bearer',
            'token_duration' =>'30 minutes'
        ], 201);
    }
}