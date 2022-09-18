<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Proyectos;

class eFirma extends Controller
{
    public function eFirmaLogin($data){

          $keyq = base64_encode($data['key']);
    	    $cerq = base64_encode($data['cer']);
    	    $pasword = $data['password'];

          $tokenId = env('TOKEN_VALIDAR_CERTIFICADO');
          $cadena = base64_encode('|Valida e.Firma|');

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_PORT => env('PORT_VALIDAR_CERTIFICADO_EFIRMA'),
		        CURLOPT_URL => env('URL_VALIDAR_CERTIFICADO_EFIRMA'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{ \n  \"security\": \n  { \n  \n    \"tokenId\":\"$tokenId\" \n  }, \n  \"data\": \n  { \n    \"password\":\"$pasword\", \n    \"cadena\":\".$cadena.\", \n    \"byteKey\":\"$keyq\", \n    \"bytecer\":\"$cerq\" \n  } \n}",
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json; charset=utf-8",
       		    "Accept:application/json, text/javascript, */*; q=0.01"
            ),
          ));

          $response = curl_exec($curl);
		  curl_close($curl);
          return json_decode($response);

	}

	public function eFirmaAvanzada($datosFirma){

         $key = base64_encode($datosFirma['key']);
         $cer = base64_encode($datosFirma['cer']);
         $password = $datosFirma['password'];
		     $tokenId = env('TOKE_FIRMA_CADENA_EFIRMA');
    	   $cadena = base64_encode('|Valida e.Firma|');
         $data = "{\r\n  \"security\":\r\n  {\r\n    \"tokenId\":\"" . $tokenId . "\"\r\n  },\r\n  \"data\":\r\n  {\r\n    \"password\":\"" . $password . "\",\r\n    \"cadena\":\"" . $cadena . "\",\r\n    \"byteKey\":\"" . $key . "\",\r\n    \"bytecer\":\"" . $cer . "\"\r\n  }\r\n}";

    	   $curl = curl_init();

    		 #Los campos editables solo son: CURLOPT_PORT, CURLOPT_URL y CURLOPT_CUSTOMREQUEST.
    		 curl_setopt_array($curl, array(
    		  CURLOPT_PORT => env('PORT_FIRMA_CADENA_EFIRMA'),
    		  CURLOPT_URL => env('URL_FIRMA_CADENA_EFIRMA'),
    		  CURLOPT_RETURNTRANSFER => true,
    		  CURLOPT_MAXREDIRS => 10,
    		  CURLOPT_TIMEOUT => 30,
    		  CURLOPT_CUSTOMREQUEST => "POST",
    		  CURLOPT_POSTFIELDS => $data,
    		  CURLOPT_HTTPHEADER => array(
    		   "Content-Type: application/json; charset=utf-8",
    		   "Accept:application/json, text/javascript, */*; q=0.01" )
    		 ));

		     #Se cacha la respuesta y el error si es que existiera en cuestiones de conectividad

         $response = curl_exec($curl);
		     $err = curl_error($curl);

		     #Se cierra el recurso cURL y se liberan recursos del sistema.
		     curl_close($curl);

		     #Validación de errores
		     if ($err) {
		  	      return false;
		     }else {
			        return json_decode($response);
	       }
	  }

    public function seguimiento_firmas(Request $request){
        $id_proyecto=$request->id_proyecto;
		$busca_personal_proyecto=Proyectos::get_personal_proyecto($id_proyecto);
        return view('pages.seguimiento_firmas',compact('id_proyecto','busca_personal_proyecto'));
    }

}
