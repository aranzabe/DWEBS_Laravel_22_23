<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class miControlador extends Controller
{
    //
    function recuperaDatos(Request $req){
        // $nom = $req->get('nombre');
        // $cur = $req->get('curso');
        // $cad = "Bienvenido ".$nom." de ".$cur;
        // return response()->json(["dev" => $cad],200);

        $p = new Persona($req->get('nombre'),$req->get('curso'));
        return response()->json(["dev" => $p],200);
    }

    public function pruebaFaker() {
        $fak = \Faker\Factory::create('es_ES');
        //$fak = \Faker\Factory::create();
         $datos = [
            'nombreCompleto: ' => $fak->name,
            'nombre' => $fak->firstName,
            'apellidos' => $fak->lastName,
            'dirección' => $fak->address,
            'texto' => $fak->text,
            'email' => $fak->email,
            'ciudad' => $fak->city,
            'comp: ' => $fak->company,
            'claveAleatoria' => $fak->password
            //'DNI' => $fak->dni
        ];
        //Dirección de interés para faker: https://code.tutsplus.com/es/tutorials/using-faker-to-generate-filler-data-for-automated-testing--cms-26824
        return response()->json($datos,200,['Content-Type'=>'application/json'],JSON_UNESCAPED_UNICODE);
        //return response()->json($datos,200,[],JSON_UNESCAPED_UNICODE);
    }

}
