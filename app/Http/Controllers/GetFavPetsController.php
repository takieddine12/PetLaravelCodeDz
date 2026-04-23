<?php

namespace App\Http\Controllers;

use App\Models\FavPetInfo;
use Illuminate\Http\Request;

class GetFavPetsController extends Controller
{
    public function getFavPets(Request $request)
    {
        $favPets = FavPetInfo::all();

        if ($favPets->isEmpty()) {
            return response()->json([
                'message' => 'No favorite pets found',
            ], 404);
        }

        // ✅ Convert file path → full URL (NO base64)
        $data = $favPets->map(function ($pet) {

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
                'image' => $pet->image ? asset($pet->image) : null,
                'isAdded' => $pet->isAdded,
            ];
        });

        return response()->json([
            'favPets' => $data,
            'message' => 'Fav pets successfully retrieved'
        ]);
    }
}