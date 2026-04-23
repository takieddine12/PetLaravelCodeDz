<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginUser(Request $request)
    {
        $request->validate([
            'emailAddress' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('emailAddress', $request->emailAddress)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid password'
            ], 401);
        }

        // 🔐 Create Sanctum token
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}