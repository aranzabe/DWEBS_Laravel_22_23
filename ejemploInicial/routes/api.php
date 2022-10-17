<?php

use App\Http\Controllers\miControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('ejemplo/{otro}/{id?}', function ($otro, $id = 0) {
    return response()->json(["Hola" => $otro, "otro" => "Bienvenido: ".$id],200);
})->whereNumber('id')->whereNumber('otro');

Route::post('ejemplopost', [miControlador::class,'recuperaDatos']);

Route::get('faker',[miControlador::class,'pruebaFaker']);

