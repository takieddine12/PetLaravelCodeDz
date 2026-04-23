<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetInfo;

class MyPetsController extends Controller
{
   public function getMyPets(Request $request)
{
    $myPets = PetInfo::where('userID', $request->userID)->get();

    if ($myPets->isEmpty()) {
        return response()->json([
            'message' => 'No pets found'
        ], 404);
    }


    return response()->json([
        'myPets' => $myPets,
        'message' => 'My pets retrieved successfully'
    ]);
 }
}