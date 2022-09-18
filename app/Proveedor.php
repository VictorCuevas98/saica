<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rfc',
        'tipo_persona',
        'fisica_nombre',
        'fisica_primer_ap',
        'fisica_segundo_ap',
        'razon_social',
        'representante_legal',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function adquisiciones(){
        return $this->hasMany('App\Adquisicion','id_proveedor');
    }
    /*END::RELATIONSHIPS*/

    /*
    *ws_getDataGeneral
    * metodo que consulta el ws de finanzas sobre los datos personales del proveedor
    * params : rfc del proveedor
    */
    public function ws_getDataGeneral($rfc){
        try {
            $client = new Client();
            $response = $client->request('POST', 'http://10.1.181.9:9001/Proveedores'.'/getDataGeneral',
                [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'     => 'application/json',
                    ],
                    'body' => json_encode([
                        'token'=>env('TOKEN_WS_PROVEEDORES'),
                        'data'=>["RFC"=>mb_strtoupper($rfc)],
                    ]),
                ]
            );
            $responseBody = $response->getBody();
            //$data = $responseBody;
            $data = json_decode($responseBody,true);
            $data['dataLegal'] = json_decode($this->w_getDataLegal($rfc));
            //$data['dataContacto'] = json_decode($this->w_getDataContacto($rfc));

            //throw new Exception('excepcion controlada');
            return json_encode($data);
        } catch (Exception $e) {
            Log::error("Error al consumir servicio y buscar proveedor -> ".$e->getMessage());
            $response = ["data"=> null , 'error'=>['code'=>99,'msg'=>'falla en el servicio de proveedores']];
            return json_encode($response,true);
        }
        
    }

    public function w_getDataLegal($rfc){
        $data = null;
        try {
            $client = new Client();
            $response = $client->request('POST', 'http://10.1.181.9:9001/Proveedores'.'/getDataLegal',
                [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'     => 'application/json',
                    ],
                    'body' => json_encode([
                        'token'=>env('TOKEN_WS_PROVEEDORES'),
                        'data'=>["RFC"=>mb_strtoupper($rfc)],
                    ]),
                ]
            );
            $responseBody = $response->getBody();
            //$data = json_decode($responseBody,true);
            $data = $responseBody;

            //throw new Exception('excepcion controlada');
        } catch (Exception $e) {
            Log::error("Error al consumir servicio  y buscar proveedor -> w_getDataLegal -> ".$e->getMessage());
            $response = ["data"=> null , 'error'=>['code'=>99,'msg'=>'falla en el servicio de proveedores de datos legales']];
            return json_encode($response,true);
        }
        return $data;
    }
    public function w_getDataContacto($rfc){
        $data = null;
        try {
            $client = new Client();
            $response = $client->request('POST', 'http://10.1.181.9:9001/Proveedores'.'/getDataContacto',
                [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'     => 'application/json',
                    ],
                    'body' => json_encode([
                        'token'=>env('TOKEN_WS_PROVEEDORES'),
                        'data'=>["RFC"=>mb_strtoupper($rfc)],
                    ]),
                ]
            );
            $responseBody = $response->getBody();
            //$data = json_decode($responseBody,true);
            $data = $responseBody;

            //throw new Exception('excepcion controlada');
        } catch (Exception $e) {
            Log::error("Error al consumir servicio  y buscar proveedor -> w_getDataContacto -> ".$e->getMessage());
            $response = ["data"=> null , 'error'=>['code'=>99,'msg'=>'falla en el servicio de proveedores de datos de contacto']];
            return json_encode($response,true);
        }
        return $data;
    }

    public function w_getDataFiscal($rfc){
        $data = null;
        try {
            $client = new Client();
            $response = $client->request('POST', 'http://10.1.181.9:9001/Proveedores'.'/getDataFiscal',
                [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'     => 'application/json',
                    ],
                    'body' => json_encode([
                        'token'=>env('TOKEN_WS_PROVEEDORES'),
                        'data'=>["RFC"=>mb_strtoupper($rfc)],
                    ]),
                ]
            );
            $responseBody = $response->getBody();
            //$data = json_decode($responseBody,true);
            $data = $responseBody;

            //throw new Exception('excepcion controlada');
        } catch (Exception $e) {
            Log::error("Error al consumir servicio  y buscar proveedor -> w_getDataFiscal -> ".$e->getMessage());
            $response = ["data"=> null , 'error'=>['code'=>99,'msg'=>'falla en el servicio de proveedores de datos fiscales']];
            return json_encode($response,true);
        }
        return $data;
    }

}
