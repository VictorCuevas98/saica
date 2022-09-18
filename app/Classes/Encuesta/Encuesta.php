<?php

namespace App\Classes\Encuesta;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Bloque;

class Encuesta
{   
    public static function ws_encripta($bloque){
        try {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $bloque->fecha_inicio.' '.$bloque->hora_inicio);
            $epochDate = strtotime($date->format('d-m-Y H:i:s'));
            /*if(is_null($epochDate)){
                return null ;
            }*/

            $usuario = Auth::user();
            if($usuario->persona->es_empleado){
                //es empleado
                if($usuario->persona->laboralPersona()->count()>0){
                    //revisar la unidad 
                    $unidadAdmin = $usuario->persona->laboralPersona->unidadAdmin;
                    if($unidadAdmin->clave_uniadm =='SAF' ){
                        $idTipoUusuario = '01';
                    }else{
                        $idTipoUusuario = '02';
                    }
                }else{
                    $idTipoUusuario = '02';
                }
            }else{
                $idTipoUusuario = '03';
            }

            $client = new Client();
            try {
                $response = $client->request('POST', env('URL_WS_ENCRIPTA'),
                    [
                        //'auth' => ['finanzas', 'F1n4nz445!2020'],
                        'verify' => false,
                        'query' => [
                            'sistema' => env('SISTEMA_ID_ENCRIPTADO'),
                            'cadena' => $usuario->persona->rfc.'|'.$idTipoUusuario.'|'.$epochDate,
                            'api_key'=>env('API_KEY_ENCUESTAS'),
                        ]
                    ] 
                );
                $response = $response->getBody();
                $data = json_decode($response,true);
                return $data;

            } catch (ClientException $e) {
                Log::error("Error al consultar WS de encriptacion para obtener referencia Encuesta->ws_encripta()");
                Log::error( Psr7\Message::toString($e->getRequest()) );
                Log::error( Psr7\Message::toString($e->getResponse()) );
                Log::error( $e->getMessage() );
                return null;
            }
            
        }catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
        
    }
    
    public static function ws_consulta($bloque){
        try {
            $cadena_encriptada = self::ws_encripta($bloque);
            $sistema_id_encriptado = env('SISTEMA_ID_ENCRIPTADO');
            $encuestaEncriptada =env('ENCUENTA_ENCRIPTADA');
            $url_ws_consulta = env('URL_WS_CONSULTA');
            $api_key = env('API_KEY_ENCUESTAS');
            if(is_array($cadena_encriptada) && isset($cadena_encriptada["cadena_encriptada"])){
                $client = new Client();
                $response = $client->request('POST', $url_ws_consulta.'/'.$encuestaEncriptada,
                        [
                            //'auth' => ['finanzas', 'F1n4nz445!2020'],
                            'verify' => false,
                            'query' => [
                                'ref' => $cadena_encriptada["cadena_encriptada"],
                                'sistema'=>$sistema_id_encriptado,
                                'api_key'=>$api_key
                            ]
                        ] 
                    );
                $response = $response->getBody();
                $data = json_decode($response,true);
               return $data;

            }else{
                return null;
            }

        } catch (Exception $e) {
            Log::error("Error al consultar WS de encuestas Encuesta->WS_consulta()");
            Log::error($e->getMessage());
            return null;
        } catch (ClientException $e) {
            //Log::error( Psr7\Message::toString($e->getRequest()) );
            //Log::error( Psr7\Message::toString($e->getResponse()) );
            Log::error( $e->getMessage() );
            return null;
        }

    }

    
    public static function get_url_encuesta($bloque){
        try {
            $cadena_encriptada = self::ws_encripta($bloque);
            $sistema_id_encriptado = env('SISTEMA_ID_ENCRIPTADO');
            $encuestaEncriptada =env('ENCUENTA_ENCRIPTADA');
            $url_env_encuesta = env('URL_ENCUESTA');

            if(is_array($cadena_encriptada)){
                //$consultaEncuesta = self::ws_consulta();
                
                $urlEncuesta = $url_env_encuesta.'/'.$sistema_id_encriptado.'/'.$encuestaEncriptada.'/'.$cadena_encriptada["cadena_encriptada"] ;
                return $urlEncuesta;
            }else{
                 Log::error("no se puede acceder a la variable cadena encriptada Trying to access array offset on value of type null");
                Log::error($cadena_encriptada);
                return null ;
            }
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public static function isEncuestaContestadaEvento($bloque){
        try {
            $consultaEncuesta = self::ws_consulta($bloque);
            if(is_null($consultaEncuesta)){
                return true; //para no mostrar
            }else{
                return $consultaEncuesta['estatus'];
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }



    //FALTA UN METODO PARA SABER SI mostramos el boton de la encueta del evento

//    private static function getDatePeriod($date){
//        $time = strtotime($date->format('d-m-Y')) ;
//        $epochDate = null;
       //
//
//        //evaluacion periodo 1
//        $period1_init =strtotime($date->format('Y').'-03-01');
//        $period1_end = strtotime($date->format('Y').'-03-15');
//        if( $time >= $period1_init && $time <= $period1_end){
//            $epochDate = strtotime('01-03-'.$date->format('Y'));
//        }
//
//        //evaluacion periodo 2
//        $period2_init =strtotime($date->format('Y').'-06-01');
//        $period2_end = strtotime($date->format('Y').'-06-15');
//        if( $time >= $period2_init && $time <= $period2_end){
//            $epochDate = strtotime('01-06-'.$date->format('Y'));
//        }
//        //evaluacion periodo 3
//        $period3_init =strtotime($date->format('Y').'-09-01');
//        $period3_end = strtotime($date->format('Y').'-09-15');
//        if( $time >= $period3_init && $time <= $period3_end){
//            $epochDate = strtotime('01-09-'.$date->format('Y'));
//        }
//        //evaluacion periodo 4
//        $period4_init =strtotime($date->format('Y').'-12-01');
//        $period4_end = strtotime($date->format('Y').'-12-15');
//        if( $time >= $period4_init && $time <= $period4_end){
//            $epochDate = strtotime('01-12-'.$date->format('Y'));
//        }
//
        //
//        $epochDate = strtotime($date->format('d-m-Y'));
//        return $epochDate;
//    }

    private static function getEventoEpochDate(){

    }
}
