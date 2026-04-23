<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getUserProfile(Request $request){


       $user = $request -> user();

       return response() -> json([
         'user' => $user,
         'message' => 'Profile retreived successfully...'
       ]);

    }
}
