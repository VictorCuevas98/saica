<?php

namespace App\Http\Controllers;

use App\CatUniAdm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use App\UnidadesAdmin;
use App\EntesPulicos;
use Exception;
class WsCapitalHController extends Controller
{
    public function buscaRfc(Request $request){
        
        try{
            $rfc = $request->rfc;
            $rfcC = str_replace('""','',$rfc);
            $existeUsuario = User::existeUsuario(strtoupper($rfcC));
            if(count($existeUsuario)>0){
                $data = array(
                    'error'=> '3',
                    'mensaje' => "Ya existe un registro para el RFC " . mb_strtoupper($rfc) . ". <br><br> Favor de darle seguimiento comunicándose al teléfono: XXXXXXXXXX y extensión: XXX");
                return compact("data");
            }else{
                /*$data = $this->consume_servicio($rfc);
                if($data["error"]=="1" || $data["error"]=="2"){
                    $data = array(
                        'error'=>"3",
                        'mensaje' => $data["mensaje"]);
                    return compact("data");
                }else{*/
                    $datosUA = '';
                    $usuarioNoTieneSectPres = false;
                    //if ($data["sectPres"] != '') {
                        # code...
                        $data = ['error' => false];
                        //$idCH = explode(".",$data["sectPres"]);
                        /*$idCH = 22;
                        $idEntePub = EntesPulicos::getEnte($idCH);*/
                        $datosUniAdm = UnidadesAdmin::where('id_ente_publico', 22)->get();
                        $datosUA = $datosUniAdm;
                    //}
                    
                    //dd(compact("data","datosUA"));
                    return compact("datosUA","data");
                //}
            }
        }catch(Exception $e){
            Log::error(__METHOD__." -> ".$e->getMessage());
            return $e;
        }
        
    }

    public function buscaRfcPonentes(Request $request){
        
        $rfc = $request->rfc;
        $rfcC = str_replace('""','',$rfc);
        $existeUsuario = User::existeUsuarioPonentes(strtoupper($rfcC));
        /* dd(User::role(['PONENTE'])->get()); */
        /* dd($existePonenteRegistrados); */
        /* dd($existeUsuario); */
        if($existeUsuario != null){
            $existePonenteRegistrados = User::existeUsuarioPonentesRegistrados(strtoupper($rfcC));
            if ($existePonenteRegistrados) {
                # code...
                $existeRolPonentes = $existeUsuario->hasRole('PONENTE');
                if (!$existeRolPonentes) {
                    # code...
                    $data = array(
                        'error'=>"5",
                        'mensaje' => "Ya existe un usuario registrado con este rfc, con el perfil de 'Ponente, pero se encuentra inactivo, por favor dirijase a la seccion de 'Ponentes Inactivos'.");    
                }else {
                    # code...
                    $data = array(
                        'error'=>"6",
                        'mensaje' => "Ya existe un usuario registrado con el perfil de 'Ponente'!, No puede volver a registrarlo");
                }
            }else{
                $data = array(
                    'error'=>"4",
                    'mensaje' => "Ya existe un usuario registrado con este rfc como servidor público, pero no cuenta con el perfil de 'Ponente'!, desea registrarlo con este perfil?");
            }
            
            
            return compact("data");
        }else{
            /* dd('elses'); */
            $data = $this->consume_servicio($rfc);
            /* dd($data); */
            if($data["error"]=="1" || $data["error"]=="2"){
                $data = array(
                    'error'=>"3",
                    'mensaje' => $data["mensaje"]);
                return compact("data");
            }else{
                $datosUA = '';
                $usuarioNoTieneSectPres = false;
                if ($data["sectPres"] != '') {
                    # code...
                    $usuarioNoTieneSectPres = true;
                    $idCH = explode(".",$data["sectPres"]);
                    $idEntePub = EntesPulicos::getEnte($idCH);
                    $datosUniAdm = UnidadesAdmin::getUnidades($idEntePub->id);
                    $datosUA = $datosUniAdm;
                }

                //dd(compact("data","datosUA"));
                return compact("data","datosUA","usuarioNoTieneSectPres");
            }
        }
        
    }

    public function consume_servicio($rfc){
        $rfcC = str_replace('""','',$rfc);
        $tokenId = env('TOKEN_CAPITAL_HUMANO');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "10.1.181.9:9003/usuarios/consultaRfcUSerAE",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\r\n\"security\":\r\n    {\r\n    \"tokenId\":\"".$tokenId."\"\r\n    },\r\n\"data\":\r\n    {\r\n    \"RFC\":\"".mb_strtoupper(trim($rfcC))."\"\r\n    }\r\n}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain"
            ),
            ));
            
            $response = curl_exec($curl);
	    \Log::debug($response);
            curl_close($curl);
	    $respuesta = json_decode($response);
	    //dd($respuesta);
            if($respuesta->error->code===1){
                $data = array('error'=>"1",'mensaje' => "No se encontraron servidores públicos que coincidan con tu búsqueda");
            }else if($respuesta->error->code == 0){
                switch($respuesta->Status){
                    case $respuesta->Status == "Activo" || $respuesta->Status == "Pendiente":
                        $data = array(
                            'error'=>"0",
                            'nombre' => $respuesta->data->nombre_s,
                            'apellidoP' => $respuesta->data->apPaterno,
                            'apellidoM' => $respuesta->data->apMaterno,
                            'rfc' => $respuesta->data->RFC,
                            'entidad' => $respuesta->data->Entidad,
                            'mensaje' => $respuesta->error->msg,
                            'curp' => $respuesta->data->CURP,
                            'sectPres' => $respuesta->data->SECT_PRES,
                            'numEmpleado' => $respuesta->data->NumEmpleado,
                            'genero' => $respuesta->data->Genero,
                            'mail'=> $respuesta->data->MAIL,
                            'status'=>$respuesta->data->Status
                        );
                        break;
                    case "Inactivo":
                        $data = array('error'=>"2",'mensaje' => "Actualmente no te enuentras activo como empleado en el Gobierno de la CDMX.");
                        break;
                    case "Baja":
                        $data = array('error'=>"2",'mensaje' => "Tu estatus es: baja, como trabajador de la Ciudad de México.");
                        break;
                    default:
                        $data = array('error'=>"2",'mensaje' => "Algo salió mal, intenta de nuevo más tarde.");
                        break;
                }
            }else{
                $data = array('error'=>"2",'mensaje' => "Algo salió mal, intenta de nuevo más tarde.");
            }
            return $data;
        
    }
}
