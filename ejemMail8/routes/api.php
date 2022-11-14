<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\miControlador;

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
Route::get("/",function (Request $request) {
    return response()->json(["mesn" => "sdkljfkls"],200);
});
Route::get("loquesea",function (Request $request) {
    return response()->json(["mesn" => "sdkljfkls"],201);
});

Route::get('envia', [miControlador::class,'enviar']);

