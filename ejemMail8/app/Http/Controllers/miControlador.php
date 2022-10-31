<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class miControlador extends Controller
{
    public function enviar()
    {
        $datos = [
            'nombreUsuario' => 'Fernando',
            'email' => 'faranzabe@gmail.com'
        ];

        $email = 'faranzabe@gmail.com';
        $nombre = 'Fernando';

        //Le mando la vista 'welcome' como cuerpo del correo.
        Mail::send('correo', $datos, function($message) use ($email)
        {
            $message->to($email)->subject('Ejemplo de envío');
            $message->from('AuxiliarDAW2@gmail.com', 'Esto es un ejemplo de envío de correo electronico desde Laravel');
        });

        return response()->json(["enviado" => true, "mensaje"=>"Enviado"],200);
    }
}
