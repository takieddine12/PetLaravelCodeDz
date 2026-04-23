<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutUserController extends Controller
{
    public function logoutUser(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User successfully logged out'
        ]);
    }
}