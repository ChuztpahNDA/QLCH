<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshToken;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $tokenResult = $user->createToken('userToken');
        $accessToken = $tokenResult->accessToken;

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at,
        ]);
    } else {
        return response()->json(['error' => 'UNAUTHORIZED'], 401);
    }
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return ["message" => "Success!", 'data' => $user->id];
    }

    // Phương thức refresh token
    public function refreshToken(Request $request)
    {
        $user = auth('api')->user();
        // remove old token
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        // create new token
        $token = $request->user()->createToken('userToken')->accessToken;


        return ['access_token' => $token, 'code' => 200];
    }
}
