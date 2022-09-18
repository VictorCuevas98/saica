<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatFundamentoLegal;

class FudamentoLegalController extends Controller
{
    public function catalogoFundamentoLegal(){

        return view('catalogos.fundamentoLegal.fundamentoLegal');
    }
    public function catalogofundamento(){

        $fundamentoLegalLista = CatFundamentoLegal::select('id', 'clave_fundamento_legal', 'fundamento_legal', 'activo')->orderBy('fundamento_legal', 'ASC')->get();
        return Datatables::of($fundamentoLegalLista)->toJson();
    }
    public function crearFundamentoLegal(){

        return view('catalogos.fundamentoLegal.modals.nuevoFundamentoLegal');
    }
    public function guardarFundamentoLegal(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_fundamento_legal' => ["required" , "max:150"],
                'fundamento_legal' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_fundamento_legal = $request->clave_fundamento_legal;
        $clave = CatFundamentoLegal::where('clave_fundamento_legal',$clave_fundamento_legal)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo fundamento_legal');
            DB::beginTransaction();
            try{
                //Creamos un nuevo fundamento_legal  
                $fundamento_legal = new CatFundamentoLegal();       
                $fundamento_legal->clave_fundamento_legal = $request->clave_fundamento_legal;
                $fundamento_legal->fundamento_legal = $request->fundamento_legal;     
                $fundamento_legal->activo = true;//Activo en creación 
                $fundamento_legal->created_at = date('Y-m-d H:i:s');             
                $fundamento_legal->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 
    }
     public function editarFundamentoLegal(Request $request){

        $fundamento_legal = CatFundamentoLegal::findOrFail($request->id);
        return view('catalogos.fundamentoLegal.modals.editarFundamentoLegal',compact('fundamento_legal'));
    }
    public function guardarEdicionFundamentoLegal(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_fundamento_legal' => ["required" , "max:150"],
                'fundamento_legal' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar fundamento');
        DB::beginTransaction();
        try{
            $idfundamento= $request->id_fundamento;
            
            $fundamento_legal = CatFundamentoLegal::find($idfundamento);
            $estatus = ($request->estatusfundamento== "on" ) ? 1 : 0;
            $fundamento_legal->clave_fundamento_legal = $request->clave_fundamento_legal;
            $fundamento_legal->fundamento_legal = $request->fundamento_legal; 
            $fundamento_legal->activo = $estatus;
            $fundamento_legal->updated_at = date('Y-m-d H:i:s');
            $fundamento_legal->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }
}






