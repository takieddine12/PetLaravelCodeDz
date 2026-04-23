<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;
use Illuminate\Support\Facades\Log;

class AddPetController extends Controller
{
    public function addNewPet(Request $request)
    {
        try {

            $request->validate([
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
                'isAdded' => 'required|string',
                'userID' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'latitude' => 'required|string',
                'longitude' => 'required|string'
            ]);

            $pet = PetInfo::create([
                'petID' => $request->petID,
                'petName' => $request->petName,
                'petCategory' => $request->petCategory,
                'petBreed' => $request->petBreed,
                'gender' => $request->gender,
                'age' => $request->age,
                'city' => $request->city,
                'status' => $request->status,
                'description' => $request->description,
                'image' => $request->image,
                'isAdded' => $request->isAdded,
                'userID' => $request->userID,
                'phoneNumber' => $request->phoneNumber,
                'email' => $request->email,
                'latitude' => $request -> latitude,
                'longitude' => $request -> longitude
            ]);

            return response()->json([
                'success' => true,
                'message' => "Pet has been successfully added"
            ], 201);

        } catch (\Throwable $e) {

            // 🔥 log full error for you (Railway logs)
            Log::error('AddPet error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            // 🔥 send clean error to Flutter
            return response()->json([
                'success' => false,
                'message' => 'Failed to add pet',
                'error' => $e->getMessage(), // optional (dev only)
            ], 500);
        }
    }
}