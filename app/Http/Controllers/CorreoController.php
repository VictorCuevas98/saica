<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class CorreoController extends Controller
{
    public static function send_mail($data, $informacion){
        $response ['correo']= $data->toArray();
        $response ['titulo'] = $informacion->nombre;
        $response ['descripcion'] = $informacion->descripcion;
        Mail::send('mail.body_mail',$response, function($msj) use($response, $informacion){
            foreach($response['correo'] as $clave => $valor){
                $correo = $valor->email;
                $msj->subject('Aviso de nuevo Registro');
                $msj->to($correo);
            }
        });
        return response()->json(['message'=>'Se envio el correo correctamente!'],200);  
    }
}
