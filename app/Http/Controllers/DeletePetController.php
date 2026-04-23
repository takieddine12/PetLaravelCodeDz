<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;

class DeletePetController extends Controller
{
    public function deletePet(Request $request)
    {
        $request->validate([
            'petID' => 'required|string'
        ]);

        $pet = PetInfo::where('petID', $request->petID)->first();

        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found'
            ], 404);
        }

        $pet->delete();

        return response()->json([
            'message' => 'Pet successfully deleted'
        ]);
    }
}