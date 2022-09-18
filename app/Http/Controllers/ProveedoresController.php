<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Exception;
use GuzzleHttp\Client;
use App\Proveedor;

class ProveedoresController extends Controller
{
    //

    public function ws_getDataGeneral(Request $request){
        
        $proveedor = new Proveedor();
        $resJson = $proveedor->ws_getDataGeneral($request->rfc);
        $res = json_decode($resJson,true);
        
        if($res["error"]["code"] <= 0 ){
            //No hay error al consumir el ws de provedores
            if(isset($res["data"])){ 
                //DEVOLVIO DATOS EL SERVICIO
                Proveedor::updateOrCreate(
                    [
                        'rfc' => $request->rfc,
                    ],[
                        'tipo_persona'=> substr($res["data"]["tipo_persona"], 0, 1) ,
                        'fisica_nombre'=> $res["data"]["nombre"],
                        'fisica_primer_ap'=> $res["data"]["paterno"],
                        'fisica_segundo_ap'=> $res["data"]["materno"],
                        'razon_social'=> $res["data"]["razon_social"],
                        'representante_legal'=> null, //TODO::FALTA LOS DATOS LEGALES
                        'activo'=> true,
                    ]
                );
            }else{ 
                //NO DEVUELVE DATOS EL SERVICIO
                //TODO::EL RFC EXISTE? 
                //TODO::NO DEVUELVE DATOS POR QUE ESTÁ INACTIVO EL PROVEEDOR?
            }//FIN::SI ISSET DATA
        }//FIN::IF NO HAY ERROR
        return $res;
    }

    public function catalogoProveedoresLista(){

        return view('catalogos.proveedores.proveedores');
    }
    
    public function catalogoProveedores(){

        $proveedores = Proveedor::select('id', 'rfc', 'tipo_persona', 'fisica_nombre', 'fisica_primer_ap', 'fisica_segundo_ap', 'razon_social', 'representante_legal', 'activo')->get();
        return Datatables::of($proveedores)->toJson();
    }

    public function crearProveedor(){

        return view('catalogos.proveedores.modals.nuevoProveedor');
    }

    public function guardarProveedor(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'rfc' => ["required" , "max:14"],
                'tipo_persona' => ["required"],
                'fisica_nombre' => ["required" , "max:15"],
                'fisica_primer_ap' => ["required" , "max:15"],
                'fisica_segundo_ap' => ["required" , "max:15"],
                'razon_social' => ["required" , "max:150"],
                'representante_legal' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $rfc = $request->rfc;
        $id_rfc = Proveedor::where('rfc',$rfc)->count();

        if($id_rfc>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con ese RFC','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo proveedor');
            DB::beginTransaction();
            try{
                //Creamos un nuevo artículo    
                $proveedor = new Proveedor();       
                $proveedor->rfc = $request->rfc;
                $proveedor->tipo_persona = $request->tipo_persona; 
                $proveedor->fisica_nombre = $request->fisica_nombre; 
                $proveedor->fisica_primer_ap = $request->fisica_primer_ap;
                $proveedor->fisica_segundo_ap = $request->fisica_segundo_ap; 
                $proveedor->razon_social = $request->razon_social; 
                $proveedor->representante_legal = $request->representante_legal;             
                $proveedor->activo = true;//Activo en creación 
                $proveedor->created_at = date('Y-m-d H:i:s');             
                $proveedor->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }        
    }

    public function editarProveedor(Request $request){

        $proveedor = Proveedor::findOrFail($request->id);
        return view('catalogos.proveedores.modals.editarProveedor', compact('proveedor'));

    }

    public function guardarEdicionProveedor(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'rfc' => ["required" , "max:14"],
                'tipo_persona' => ["required"],
                'fisica_nombre' => ["required" , "max:15"],
                'fisica_primer_ap' => ["required" , "max:15"],
                'fisica_segundo_ap' => ["required" , "max:15"],
                'razon_social' => ["required" , "max:150"],
                'representante_legal' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar proveedor');
        DB::beginTransaction();
        try{
            $idProveedor = $request->id_proveedor;
            
            $proveedor = Proveedor::find($idProveedor);
            $estatus = ($request->estatusProveedor == "on" ) ? 1 : 0;
            $proveedor->rfc = $request->rfc;
            $proveedor->tipo_persona = $request->tipo_persona; 
            $proveedor->fisica_nombre = $request->fisica_nombre; 
            $proveedor->fisica_primer_ap = $request->fisica_primer_ap;
            $proveedor->fisica_segundo_ap = $request->fisica_segundo_ap; 
            $proveedor->razon_social = $request->razon_social; 
            $proveedor->representante_legal = $request->representante_legal; 
            $proveedor->activo = $estatus;
            $proveedor->updated_at = date('Y-m-d H:i:s');
            $proveedor->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se creo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }

    }

        
}
