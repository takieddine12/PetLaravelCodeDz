<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// This is registration page
//php artisan serve --host=0.0.0.0 --port=8000

class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        // Validate data
        $request->validate([
            'id' => 'required|integer',
            'fullName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'emailAddress' => 'required|email|max:255|unique:users,emailAddress',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        // Create user
        $user = User::create([
            'id' => $request -> id,
            'fullName' => $request->fullName,
            'phoneNumber' => $request->phoneNumber,
            'emailAddress' => $request->emailAddress,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);

        // Generate token
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}