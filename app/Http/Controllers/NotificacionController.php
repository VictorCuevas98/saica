<?php

namespace App\Http\Controllers;

use App\Events\Notificaciones;
use App\Participante;
use App\Personas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{

    public function enviarNotificacionSimple($mensaje, $destinatarios, $url){
        try {
            foreach ($destinatarios as $destinatario) {
                $persona = Personas::find($destinatario->id);
                DB::table('notificaciones')->insert([
                    'id_persona' => $persona->id,
                    'mensaje' => $mensaje,
                   'url' => $url,
                    'visto' => false,
                    'created_at' => date('Y-m-d H:m:s')
                ]);
                event(new Notificaciones($mensaje, $persona, $url));
            }
        } catch (\Exception $exception){

        }
    }

    public function enviarNotificacionSimpleAParticipantes($mensaje, $destinatarios, $url){
        try {
        foreach ($destinatarios as $destinatario)
        {
            $persona = Personas::find($destinatario->id_persona);
            DB::table('notificaciones')->insert([
                'id_persona' => $persona->id,
                'mensaje' => $mensaje,
                'url' => $url,
                'visto' => false,
                'created_at' => date('Y-m-d H:m:s')
            ]);
            event(new Notificaciones($mensaje, $persona, $url));
        }
        } catch (\Exception $exception){

        }
    }


    public function obtener(){
        //todas las notificaciones del usuario
        $notificaciones = DB::table('notificaciones')->where('id_persona', Auth::user()->persona->id)->get();
        return ['mensaje' => $notificaciones, 'codigo' => 200];
    }
}
