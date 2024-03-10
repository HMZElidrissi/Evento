<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public static function sendPasswordResetLink($user, $token)
    {
        $subject = "Your password reset link";
        $view = "password-reset";
        $data = ['token' => $token];

        Mail::send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email);
            $message->subject($subject);
        });
    }
}
