<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;

class SingleItemController extends Controller
{
    public function getSinglePet(Request $request)
    {
        // 🔍 Validate request
        $request->validate([
            'petID' => 'required|string'
        ]);

        // 🔎 Find pet
        $pet = PetInfo::where('petID', $request->petID)->first();

        // ❌ Not found
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found'
            ], 404);
        }

        // ✅ Return FULL DATA
        return response()->json([
            'pet' => [
                'petID' => $pet->petID,
                'petCategory' => $pet->petCategory,
                'petBreed' => $pet->petBreed,
                'gender' => $pet->gender,
                'age' => $pet->age,
                'city' => $pet->city,
                'status' => $pet->status,
                'description' => $pet->description,
                'petName' => $pet->petName,
                'image' => $pet->image,
                'isAdded' => $pet->isAdded,
                'userID' => $pet->userID,
                'phoneNumber' => $pet->phoneNumber,
                'email' => $pet->email,
                'latitude' => $pet->latitude,
                'longitude' => $pet->longitude,
            ],
            'message' => 'Pet successfully retrieved'
        ], 200);
    }
}