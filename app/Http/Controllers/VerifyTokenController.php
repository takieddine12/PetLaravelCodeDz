<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifyTokenController extends Controller
{
    public function verifyToken(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
            'token' => 'required'
        ]);

        // 1. Get record
        $record = DB::table('password_reset_tokens')
            ->where('emailAddress', $request->emailAddress)
            ->first();

        if (!$record) {
            return response()->json([
                'message' => 'Invalid request'
            ], 400);
        }

        // 2. Check token
        if ($record->token !== $request->token) {
            return response()->json([
                'message' => 'Invalid code'
            ], 400);
        }

        // 3. Check expiration (15 min)
        if (Carbon::parse($record->created_at)
            ->addMinutes(15)
            ->isPast()) {

            return response()->json([
                'message' => 'Token expired'
            ], 400);
        }

        return response()->json([
            'message' => 'Code valid'
        ], 200);
    }
}