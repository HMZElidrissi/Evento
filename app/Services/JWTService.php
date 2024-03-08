<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;

class JWTService
{
    public static function createJwtToken($user)
    {
        $key = env('JWT_SECRET');

        $payload = [
            'iss' => "Evento",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    public static function getUser()
    {
        $token = request()->bearerToken();
        if($token){
            $key = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $userId = $decoded->sub;
            return User::find($userId);
        }
        return null;
    }

    public static function validateToken($token)
    {
        $key = env('JWT_SECRET');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        if ($decoded->exp < time() || $decoded->iat > time() || $decoded->iss !== 'Evento' || !$decoded->sub) {
            throw new \Exception('Token expired');
        }
    }
}