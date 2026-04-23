<?php

namespace App\Http\Controllers;

use App\Models\FavPetInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddFavPetsController extends Controller
{
    public function addFavPet(Request $request)
    {
        try {

            $validated = $request->validate([
                'petID' => 'required|string|max:255',
                'petName' => 'required|string|max:255',
                'petCategory' => 'required|string|max:255',
                'petBreed' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'age' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image' => 'required|string|max:255',
                'isAdded' => 'required|string'
            ]);

            $pet = FavPetInfo::create($validated);

            return response()->json([
                'success' => true,
                'favInfo' => $pet,
                'message' => "Pet has been successfully added to fav"
            ], 201);

        } catch (\Throwable $e) {

            // 🔥 log full error in Railway logs
            Log::error('AddFavPet Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            // 🔥 send full error to Flutter (DEBUG ONLY)
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
}