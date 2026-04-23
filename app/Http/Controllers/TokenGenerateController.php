<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class TokenGenerateController extends Controller
{
    public function recoverPassword(Request $request)
{
    $request->validate([
        'emailAddress' => 'required|email|exists:users,emailAddress'
    ]);

    $token = Str::random(6); // shorter = better for Flutter OTP UX

    DB::table('password_reset_tokens')->updateOrInsert(
        ['emailAddress' => $request->emailAddress],
        [
            'token' => $token,
            'created_at' => Carbon::now()
        ]
    );

  Mail::raw("Your password reset code is: $token", function ($message) use ($request) {
    $message->to($request->emailAddress)
        ->subject('Password Reset Code');
});
    return response()->json([
        'message' => 'Reset code sent'
    ]);
}
}