<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddPetController;
use App\Http\Controllers\GetPetInfoController;
use App\Http\Controllers\SingleItemController;
use App\Http\Controllers\AddFavPetsController;
use App\Http\Controllers\GetFavPetsController;
use App\Http\Controllers\LogoutUserController;
use App\Http\Controllers\MyPetsController;
use App\Http\Controllers\UpdatePetInfoController;
use App\Http\Controllers\DeleteFavPetController;
use App\Http\Controllers\DeletePetController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\TokenGenerateController;
use App\Http\Controllers\RecoverPasswordController;
use App\Http\Controllers\VerifyTokenController;


/*
|--------------------------------------------------------------------------
| Public Routes (NO TOKEN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::post('/registerUser', [RegisterController::class, 'registerUser']);
Route::post('/loginUser', [LoginController::class, 'loginUser']);
Route::post('/recoverPassword',[TokenGenerateController::class,'recoverPassword']);
Route::post('/resetPassword',[RecoverPasswordController::class,'resetPassword']);
Route::post('/verifyToken',[VerifyTokenController::class,'verifyToken']);

/*
|--------------------------------------------------------------------------
| Protected Routes (TOKEN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/getUserProfile', [ProfileController::class, 'getUserProfile']);

    Route::post('/addNewPet', [AddPetController::class, 'addNewPet']);

    Route::get('/getPetInfo', [GetPetInfoController::class, 'getPetInfo']);

    Route::get('/getSinglePet', [SingleItemController::class, 'getSinglePet']);

    Route::post('/addFavPet', [AddFavPetsController::class, 'addFavPet']);

    Route::get('/getFavPets',[GetFavPetsController::class,'getFavPets']);

    Route::post('/logoutUser',[LogoutUserController::class,'logoutUser']);

    Route::post('/getMyPets',[MyPetsController::class,'getMyPets']);
    
    Route::post('/updatePetInfo',[UpdatePetInfoController::class,'updatePetInfo']);

    Route::post('/deleteFavPet',[DeleteFavPetController::class,'deleteFavPet']);

    Route::post('/deletePet',[DeletePetController::class,'deletePet']);

    Route::post('/updateUser',[UpdateUserController::class,'updateUser']);

  
    
});