<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends ApiController
{
    function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return $this->errorResponse('Username atau password yang anda masukan salah!.',401);
        }
        
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(['user'=>$user,'token'=>$token],"Success Login");
    }
}
