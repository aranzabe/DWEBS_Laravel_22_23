<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class miControlador extends Controller
{
    public function listar() {
        //************* Sin QueryBuilder ******************
        // a) Select sencilla con un valor.
        //$personas = DB::select('select * from personas where DNI = ?', ['3C']);
        //b) Usando un parámetro con nombre.
        //$personas = DB::select('select * from personas where DNI = :dn', ['dn' => '4D']);
        //c) Consulta de varias tablas.
        // $quer = 'select * from personas, propiedades, coches'
        //   . ' where propiedades.DNI = personas.DNI '
        //   . 'AND propiedades.Matricula = coches.Matricula And personas.DNI = ?';
        // //dd($quer);
        // $personas = DB::select($quer,['1A']);
        /*
         * Otros ejemplos sin QB:
         */
        // try {
        //     DB::insert('insert into personas (DNI, Nombre, Tfno, edad) values (?, ?, ?, ?)', ['007', 'Naiden', '1234', 36]);
        //     /* $afectadas = \DB::update('update personas set Tfno = '100' where DNI = ?', ['3C'])
        //      * $borradas = \DB::delete('delete from personas');
        //      */
        //     return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
        // }
        // catch (\Illuminate\Database\QueryException $e) {
        //     //return redirect()->back()->withErrors(($e->getCode() === '23000') ? 'E-mail ya existe.' : 'teste');
        //     return response()->json(['mensaje'=>'Clave duplicada'],202);
        // }





        //************* Con Query Builder ****************
        //Dirección de interés para Query Builder: https://laravel.com/docs/5.5/queries
        //a) El equivalente de una select *.
        $personas = DB::table('personas')->get();
        //b) Select con condiciones
        // $personas = DB::table('personas')
        // ->select('DNI', 'Nombre', 'Tfno', 'edad')
        // ->where('DNI', '=', '5E')
        // ->orderBy('edad', 'desc')
        // ->get();
        //c) Selección con opciones AND y OR
        // $personas = DB::table('personas')
        //  ->select('DNI','Nombre','Tfno','edad')
        //  ->whereBetween('edad', [35, 40])
        //  ->orwhere('nombre','Alicia')
        //  ->orderBy('edad','desc')
        //  ->get();
        //d) Selección haciendo join de varias tablas.
        // $personas = DB::table('personas')
        //         ->join('propiedades', 'propiedades.DNI', '=', 'personas.DNI')
        //         ->join('coches', 'coches.Matricula', '=', 'propiedades.Matricula')
        //         ->select('personas.DNI', 'Nombre', 'edad', 'Marca', 'Modelo')
        //         ->where('nombre','Obiguan')
        //         ->get();

        ///Otras opciones con QB:
        // try {
        //     DB::table('personas')->insert(
        //         ['DNI' => '2034T', 'Nombre' => 'Yoda', 'Tfno' => '435', 'edad' => 10]
        //         );
        //     return response()->json(['mensaje'=>'Registro insertado correctamente'],200);
        // }
        // catch(\Illuminate\Database\QueryException $e){
        //     return response()->json(['mensaje'=>'Clave duplicada'],202);
        // }

        // $personas = DB::table('personas')
        //  ->where('DNI', '1A')
        //  ->update(['Tfno' => '123556']);
        // $personas = DB::table('personas')->where('DNI', '=', '007')->delete();
        // $personas = \DB::table('personas')->truncate();



        $datos = [
            'pers' => $personas
        ];

        //return view('listado', $datos);
        return response()->json($datos,200);
    }

    public function pruebaFaker() {
        $fak = \Faker\Factory::create('fr_FR');
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
        //return response()->json($datos,200,['Content-Type'=>'application/json'],JSON_UNESCAPED_UNICODE);
        return response()->json($datos,200,[],JSON_UNESCAPED_UNICODE);
    }
}
