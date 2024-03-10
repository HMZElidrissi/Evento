<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\EmailService;
use App\Services\JWTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

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

    public function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'We can\'t find a user with that email address.'], 421);
        } else {
            $token = Password::createToken($user);
            EmailService::sendPasswordResetLink($user, $token);
            return response()->json(['message' => 'We have emailed your password reset link!']);
        }
    }

    public function reset(Request $request)
    {
        Log::info('Reset password attempt for email: '.$request->email);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        Log::error('Invalid token.');

        $user = User::where('email', $request->email)->first();

        if (!Password::tokenExists($user, $request->token)) {
            return response()->json(['message' => 'Invalid token.'], 422);
            Log::error('Invalid token.');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        Password::deleteToken($user);

        return response()->json(['message' => 'Password reset successfully.']);
    }
}
