<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('states', [StateController::class, 'index']);
Route::post('states', [StateController::class, 'store']);
Route::get('states/{id}', [StateController::class, 'show']);
Route::put('states', [StateController::class, 'update']);

Route::get('cities', [CityController::class, 'index']);
Route::get('findCitiesWithStates', [CityController::class, 'findCitiesWithStates']);
Route::post('city', [CityController::class, 'store']);