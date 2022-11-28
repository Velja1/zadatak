<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategorijeController;
use App\Http\Controllers\ArtikliController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('IsAdmin')->group(function(){
    Route::post('artikli/create', [ArtikliController::class,'store']);
    Route::post('artikli/update', [ArtikliController::class,'update']);
    Route::post('artikli/delete', [ArtikliController::class,'delete']);
});

Route::middleware('IsSeller')->group(function(){
    Route::post('artikli/updateSeller', [ArtikliController::class,'updateSeller']);
});

Route::middleware('IsCustomer')->group(function(){
    Route::get('artikli', [ArtikliController::class,'index']);
    Route::post('artikli/kupovina', [ArtikliController::class,'kupovina']);
});













