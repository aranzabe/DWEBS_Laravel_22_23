<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ParteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('partes', [ParteController::class,'index']);
    Route::post('parte', [ParteController::class,'store']);
    Route::get('parte/{id}', [ParteController::class,'show'])->middleware('midGet');
    Route::put('parte/{id}', [ParteController::class,'update']);
    Route::delete('parte/{id}', [ParteController::class,'destroy'])->middleware('midDelete');
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);
