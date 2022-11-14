<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parte;
use Illuminate\Support\Facades\Validator;

class ParteController extends Controller
{
    public function index()
    {
        $partes = Parte::all();

        return response()->json($partes,200);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $messages = [
            'required' => 'Campo obligatorio',
            'in' => 'El campo :gravedad debe estar entre las siguientes opciones: :Leve, Destierro, Grave',
           ];

        $validator = Validator::make($input, [
            'alumno' => 'required',
            'gravedad' => 'required|in:Leve,Destierro,Grave',
            'idprofesor'=> 'required',
            'observaciones' => 'required|string|max:255'
        ],$messages);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $parte = Parte::create($input);
        if ($parte){
            return response()->json(["success"=>true,"data"=>$parte, "message" => "Created"]);
        }
        else {
            return response()->json(["success" => false, "message" => "Error al insertar"],202);
        }
    }


    public function show($id)
    {
        $parte = Parte::find($id);
        if (is_null($parte)) {
            return response()->json(["success" => false, "message" => "Parte no encontrado"],202);
        }
        return response()->json(["success"=>true,"data"=>$parte, "message" => "Retrieved"]);
    }


    public function update($id, Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'alumno' => 'required',
            'gravedad' => 'required|in:Leve,Destierro,Grave',
            'idprofesor'=> 'required',
            'observaciones' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $parte = Parte::find($id);
        $parte->alumno = $input['alumno'];
        $parte->gravedad = $input['gravedad'];
        $parte->idprofesor = $input['idprofesor'];
        $parte->observaciones = $input['observaciones'];
        $parte->save();

        return response()->json(["success"=>true,"data"=>$parte, "message" => "Updated"]);
    }



    public function destroy($id)
    {
        $parte = Parte::find($id);
        if ($parte){
            $parte->delete();
            return response()->json(["success"=>true,"data"=>$parte, "message" => "Deleted"],200);
        }
        else {
            return response()->json(["success"=>true, "message" => "Parte no encontrado"],202);
        }
    }
}

/*
'email'    => 'required|email|unique:clients',

quiere decir que el email es requerido y sera único dentro de la tabla clients

'type' => 'required|in:empresa,particular',

indica que solo admite los valores empresa y particular, por lo cual cuando seleccionamos la opcion “otros” en el formulario nos mostrara un error de validación.

'register' => 'required_if:type,empresa'

en este caso el campo register solo es requerido cuando se haya seleccionado ‘empresa’ en el campo anterior.


--------------------------------------------------------------------------
    $validator = Validator::make($request->all(), [
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    if ($validator->fails()) {
        // or, for APIs:
        $validator->errors()->toJson();
    }

--------------------------------------------------------------------------
$this->validate($request, [
        'nombre' => 'required|max:255',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
        'publish_at' => 'nullable|date'
    ]);
--------------------------------------------------------------------------
$validator = Validator::make($request->all(), [
'name' => 'required|string|max:255',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:6|confirmed',
'edad' => 'numeric|between:9,12'
]);
if($validator->fails()){
return response()->json($validator->errors()->toJson(), 400);
}

--------------------------------------------------------------------------
MENSAJES DE ERROR PERSONALIZADOS
Tanto el método validate como el método make, pueden recibir un parámetro con un arreglo que
contiene los errores personalizados.
$messages = [
'required' => 'El campo :attribute es obligatorio.',
];
$validator = Validator::make($input, $rules, $messages);

$messages = [
 'same' => 'Los campos :attribute y :other deben coincidir.',
 'size' => 'El campo :attribute debe tener exactamente :size.',
 'between' => 'El valor del campo :attribute :input no está entre :min - :max.',
 'in' => 'El campo :attribute debe estar entre las siguientes opciones: :values',
];

*/
