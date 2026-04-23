<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavPetInfo;

class DeleteFavPetController extends Controller
{
    public function deleteFavPet(Request $request)
    {
        // validate
        $request->validate([
            'petID' => 'required|string',
        ]);

        // find pet
        $pet = FavPetInfo::where('petID', $request->petID)->first();

        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found'
            ], 404);
        }

        // delete
        $pet->delete();

        return response()->json([
            'message' => 'Pet deleted successfully'
        ]);
    }
}