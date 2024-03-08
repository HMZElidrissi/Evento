<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\JWTService;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials.'], 422);
        }

        $user = Auth::user();
        $token = JWTService::createJwtToken($user);
        return response()->json(['token' => $token], 200);
    }

    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = Hash::make($attributes['password']);
        $user = User::create($attributes);

        $token = JWTService::createJwtToken($user);

        return response()->json(['token' => $token], 201);
    }

    public function me(Request $request)
    {
        $user = JWTService::getUser();
        return response()->json(['user' => $user], 200);
    }
}
