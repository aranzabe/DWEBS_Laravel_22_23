<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parte;

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
