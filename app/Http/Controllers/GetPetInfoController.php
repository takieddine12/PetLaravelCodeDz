<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;

class GetPetInfoController extends Controller
{
    public function getPetInfo()
    {
        try {
            // 🐾 Get all pets
            $pets = PetInfo::all();

            // 🧠 Transform data (VERY IMPORTANT)
            $data = $pets->map(function ($pet) {
                return [
                    'petID' => $pet->petID,
                    'petCategory' => $pet->petCategory,
                    'petBreed' => $pet->petBreed,
                    'gender' => $pet->gender,
                    'age' => $pet->age,
                    'city' => $pet->city,
                    'status' => $pet->status,
                    'description' => $pet->description,
                    'petName' => $pet->petName,
                    'image' => $pet ->image,
                    'isAdded' => $pet ->isAdded,
                    'phoneNumber' => $pet ->phoneNumber,
                    'email' => $pet ->email,
                    'latitude' => $pet ->latitude,
                    'longitude' => $pet ->longitude,
                ];
            });

            // ✅ Return safe JSON
            return response()->json([
                'petInfo' => $data,
                'message' => 'Pets fetched successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching pets',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}