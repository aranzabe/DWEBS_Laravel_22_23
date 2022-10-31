<?php

use App\Http\Controllers\miControlador;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
;

Route::get('/', function () {
    return view('welcome');
});

Route::get('envia', [miControlador::class,'enviar']);
//https://medium.com/graymatrix/using-gmail-smtp-server-to-send-email-in-laravel-91c0800f9662
