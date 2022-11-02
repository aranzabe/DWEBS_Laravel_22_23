<?php

use App\Http\Controllers\MiControlador;
use App\Http\Controllers\OtroControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\mid1;
use App\Http\Middleware\mid2;

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

Route::get('prueba', function (Request $request) {
    return response()->json('ok',200);
})->middleware(['mid1','mid2']);

Route::get('controladorunaaccion',[MiControlador::class, 'unaAccion']);
Route::get('controladorotraaccion',[MiControlador::class, 'otraAccion']);
Route::get('controladorotramas',[MiControlador::class, 'otroMas']);

Route::prefix('administradores')->middleware(['mid2', 'mid1', 'mid3'])->group(function () {
    Route::get('controladorunaaccion',[OtroControlador::class, 'unaAccion']);
    Route::get('controladorotraaccion',[OtroControlador::class, 'otraAccion']);
    Route::get('controladorotramas',[OtroControlador::class, 'otroMas']);
});

Route::prefix('usuarios')->middleware('mid1')->group(function () {
    Route::get('controladorunaaccion',[OtroControlador::class, 'unaAccion']);
    Route::get('controladorotraaccion',[OtroControlador::class, 'otraAccion']);
    Route::get('controladorotramas',[OtroControlador::class, 'otroMas']);
});
