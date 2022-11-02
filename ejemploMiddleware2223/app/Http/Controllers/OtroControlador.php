<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class OtroControlador extends Controller
{
    public function unaAccion(){
        return response()->json('Una acción',200);
    }

    public function otraAccion(){
        return response()->json('Otra acción',200);
    }


    public function otroMas(){
        return response()->json('Otra más',200);
    }
}
