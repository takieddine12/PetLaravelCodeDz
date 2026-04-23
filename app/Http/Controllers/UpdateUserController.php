<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateUserController extends Controller
{
    public function updateUser(Request $request)
    {
        // ✅ Validate
        $request->validate([
            'id' => 'required|integer',
            'fullName' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255'
        ]);

        // ✅ Find user
        $user = User::where('id', $request->id)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User was not found...'
            ], 404); // ✅ correct status
        }

        // ✅ Update fields properly
        $user->fullName = $request->fullName;
        $user->address = $request->address;
        $user->phoneNumber = $request->phoneNumber;

        $user->save();

        // ✅ Success response
        return response()->json([
            'message' => 'User credentials have been successfully updated'
        ], 200);
    }
}