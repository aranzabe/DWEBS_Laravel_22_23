<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona; //--> Añadimos el espacio de direcciones de la clase Persona.
use App\Models\Propiedad;
use App\Models\Coche;

class miControlador extends Controller
{
    public function verPersonas() {
        $pers = Persona::all();

        return response()->json($pers,200);
    }

    //------------------------------------------------------------------------
    public function probarFind() {
        $pers = Persona::find('4D');
        return response()->json($pers,200);
    }

    //------------------------------------------------------------------------
    public function buscarPersona($dni) {
        //Opción A.
        //$pers = Persona::where('edad', '>', 18)->all();
        //Opción B.
        $pers = Persona::find($dni);

        return response()->json($pers,200);
    }

    //------------------------------------------------------------------------
    public function insertarPersonas(Request $req) {


        $pe = new Persona;

        $pe->DNI = $req->get('DNI');
        $pe->Nombre = $req->get('Nombre');
        $pe->Tfno = $req->get('Tfno');
        $pe->edad = $req->get('edad');
        //return response()->json($pe,200);
        $mensaje = 'Inserción ok';
        try {
            $pe->save();
        } catch (\Exception $e) {
            $mensaje = 'Clave duplicada';
        }
        return response()->json(['mens' => $mensaje],200);
    }

    //------------------------------------------------------------------------
    public function vermayores() {
        $pers = Persona::where('edad', '>', 18)
                ->orderBy('Nombre', 'asc')
                ->get();

        return response()->json($pers,200);
    }

    //------------------------------------------------------------------------
    public function verPersonasCoche() {
        $p = Propiedad::all();
        $vectorDatos = [];
        foreach ($p as $pe) {
            $pers = Persona::where('DNI', $pe->DNI)->first();
            if ($pers) {
                $vectorDatos[] = ['DNI' => $pe->DNI,
                    'Matricula' => $pe->Matricula,
                    'Nombre' => $pers->Nombre,
                    'Tfno' => $pers->Tfno,
                    'edad' => $pers->edad];
            }
        }
        return response()->json($vectorDatos,200);
    }


    //------------------------------------------------------------------------

    /**
     * Busca personas con coche usando la propiedad hasMany que tenemos definida en el modelo.
     * @return type
     */
    public function probarMany() {
        //        //Opción A.
        //        $coches = Propiedad::with('usuarios')->get();
        ////        dd($coches);
        //        $conalquiler = [];
        //        foreach ($coches as $co) {
        //            foreach ($co->usuarios as $usu) {
        //                $datocoche = Coche::find($co->Matricula);
        //                $conalquiler[] = ['DNI' => $usu->DNI,
        //                    'Nombre' => $usu->Nombre,
        //                    'Matricula' => $co->Matricula,
        //                    'Marca' => $datocoche->Marca,
        //                    'Modelo' => $datocoche->Modelo];
        //            }
        //        }
                //Opción B.
        //        $pers = Persona::with(['cochesAlquilados'])->get();
        //        $conalquiler = [];
        //        foreach ($pers as $pe) {
        //            //dd($pe->DNI);
        //            //dd($pe->cochesAlquilados);
        //            foreach ($pe->cochesAlquilados as $co) {
        ////                dd($co);
        //                $conalquiler[] = ['DNI' => $pe->DNI,
        //                    'Nombre' => $pe->Nombre,
        //                    'Matricula' => $co->Matricula];
        //            }
        //        }


                //Opción C.
                $coches = Propiedad::with(['usuarios', 'coches'])->get();  //Le pasamos las llamadas a los métodos de los modelos (usuarios y coches).
        //        dd($coches);
                $conalquiler = [];
                foreach ($coches as $co) {
                    $conalquiler[] = [
                        'DNI' => $co->DNI,
                        'Nombre' => $co->usuarios[0]->Nombre,
                        'Matricula' => $co->Matricula,
                        'Marca' => $co->coches[0]->Marca,
                        'Modelo' => $co->coches[0]->Modelo
                    ];
                }


                $datos = [
                    'pers' => $conalquiler
                ];
                return response()->json($datos,200);
            }

//------------------------------------------------------------------------
public function probarManyUnaPersona($dni) {

    //Opción A.
//        $coches = Propiedad::with(['usuarios'])->where('DNI', $dni)->get();
//        //dd($coches);
//        $conalquiler = [];
//        foreach ($coches as $co) {
//            foreach ($co->usuarios as $usu) {
//                $datocoche = Coche::find($co->Matricula);
//                $conalquiler[] = ['DNI' => $usu->DNI,
//                    'Nombre' => $usu->Nombre,
//                    'Matricula' => $co->Matricula,
//                    'Marca' => $datocoche->Marca,
//                    'Modelo' => $datocoche->Modelo];
//            }
//        }
        //Opción B.
        $coches = Propiedad::with(['usuarios'])->where('DNI', $dni)->get();

        $conalquiler = [];
        foreach ($coches as $co) {
            //dd($co->usuarios[0]->Nombre);
            //dd($co->usuarios[0]);
            $conalquiler[] = [
                'DNI' => $co->DNI,
                'Nombre' => $co->usuarios[0]->Nombre,
                'Matricula' => $co->Matricula,
                'Marca' => $co->coches[0]->Marca,
                'Modelo' => $co->coches[0]->Modelo
            ];
        }


        $datos = [
            'pers' => $conalquiler
        ];
        return response()->json($datos,200);
    }


    //-------------------------------------------------------------------
    public function probarBelong() {
        $coches = Propiedad::with(['usuariosBelong','cochesBelong'])->get();
        return response()->json($coches,200);
    }

     //-------------------------------------------------------------------
     public function verComentarios(){
        $comentarios = Persona::with(['comentarios'])->get();
        return response()->json($comentarios,200);
        //dd($comentarios);
        $coments = [];
        $i=0;
        foreach ($comentarios as $co) {
            //$valor = $co->DNI . ', '. $co->Nombre . ', '.$co->comentarios[0]->texto;
            //dd($valor);
            //dd($co->comentarios[0]->texto);
            //dd($co->DNI);
            //dd($co->Nombre);
            $vecComentarios = [];
            foreach($co->comentarios as $comentariosPersonales) {
                //dd($comentariosPersonales);
                $vecComentarios[] = $comentariosPersonales->texto;
            }
            $coments[] = [
                'DNI' => $co->DNI,
                'Nombre' => $co->Nombre,
                'Comentario' => $vecComentarios
            ];
        }
        //dd($coments);
        $datos = [
            'coms' => $coments
        ];
        return response()->json($datos,200);
    }

}
