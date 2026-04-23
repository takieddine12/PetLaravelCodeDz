<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;

class UpdatePetInfoController extends Controller
{
    public function updatePetInfo(Request $request)
    {
        // validate
        $request->validate([
            'petID' => 'required|string',
            'isAdded' => 'required|string',
        ]);

        // find pet
        $pet = PetInfo::where('petID', $request->petID)->first();

        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found'
            ], 404);
        }

        // update
        $pet->isAdded = $request->isAdded;
        $pet->save();

        return response()->json([
            'message' => 'Pet updated successfully',
        ]);
    }
}