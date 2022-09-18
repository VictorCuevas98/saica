<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WsRenapoController extends Controller
{
    public function getCurp(Request $request){
        //dd($request->curp);
        
        if($request->ajax()){
            $client = new Client();
 
            $response = $client->request('GET', 'https://www.curp.cdmx.gob.mx/curp/rest/curp/' . $request->curp,
                    ['auth' => ['finanzas', 'F1n4nz445!2020'],'verify' => false]);
 
 
            $data_repuve = $response->getBody();
            $data = json_decode($data_repuve,true);
            /* dd($data); */    
            $data = array(
                'nombre' => $data['nombres'],
                'apellido1' =>$data['apellido1'],
                'apellido2' =>$data['apellido2'],
                'rfc' => strtoupper(substr($request->curp, 0, 10)),
                'error' => $data['statusOper']
            );
         // dd($data);
            return $data;
        }
    }
}
