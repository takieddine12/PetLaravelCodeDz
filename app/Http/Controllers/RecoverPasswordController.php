<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RecoverPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6'
        ]);

        // ✅ FIXED: use correct column name
        $record = DB::table('password_reset_tokens')
            ->where('emailAddress', $request->emailAddress)
            ->first();

        if (!$record) {
            return response()->json([
                'message' => 'Invalid request'
            ], 400);
        }

        // ⚠️ TOKEN CHECK (plain text version - recommended for OTP)
        if ($record->token !== $request->token) {
            return response()->json([
                'message' => 'Invalid token'
            ], 400);
        }

        // ⏱ Expiration check (15 min)
        if (Carbon::parse($record->created_at)
            ->addMinutes(15)
            ->isPast()) {

            return response()->json([
                'message' => 'Token expired'
            ], 400);
        }

        // 🔐 Update password
        DB::table('users')
            ->where('emailAddress', $request->emailAddress)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        // 🧹 Delete token
        DB::table('password_reset_tokens')
            ->where('emailAddress', $request->emailAddress)
            ->delete();

        return response()->json([
            'message' => 'Password updated successfully'
        ]);
    }
}