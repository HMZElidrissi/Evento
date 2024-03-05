<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        $token = $this->createJwtToken($user);

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = Hash::make($attributes['password']);
        $user = User::create($attributes);

        $token = $this->createJwtToken($user);

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    protected function createJwtToken(User $user)
    {
        $key = env('JWT_SECRET');

        $payload = [
            'iss' => "Evento",
            'sub' => $user->id,
            'name' => $user->name,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
}
