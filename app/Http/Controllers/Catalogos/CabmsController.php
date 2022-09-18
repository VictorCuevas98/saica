<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Cabms;
use App\CatPartidaEspecifica;

class CabmsController extends Controller
{
    public function catalogoCabmsLista(){

        return view('catalogos.cabms.cabms');
    }

    public function catalogoCabms(){

        $cabmsLista = Cabms::select('cabms.id', 'cabms.clave_cabms', 'cabms.cabms', 'cabms.id_partida', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida', 'cabms.unidad_medida', 'cabms.activo', DB::raw("(CASE WHEN cabms.unidad_medida is null THEN 'No se especifica unidad de medida' WHEN cabms.unidad_medida=' ' THEN 'No se especifica unidad de medida' ELSE 'No se especifica unidad de medida' END) AS unidad_medida"))->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->orderBy('cabms', 'ASC')->get();
        return Datatables::of($cabmsLista)->toJson();

    }

    public function crearCabms(){

        $partidas = CatPartidaEspecifica::select('id', 'clave_partida', 'partida')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.cabms.modals.nuevoCabms', compact('partidas'));
    }

    public function guardarCabms(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_cabms' => ["required" , "max:150"],
                'cabms' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                //'unidad_medida' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_cabms = $request->clave_cabms;
        $clave = Cabms::where('clave_cabms',$clave_cabms)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo cabms');
            DB::beginTransaction();
            try{
                //Creamos un nuevo cabms    
                $cabmsLista = new Cabms();       
                $cabmsLista->clave_cabms = $request->clave_cabms;
                $cabmsLista->cabms = $request->cabms; 
                $cabmsLista->id_partida = $request->partida; 
                $cabmsLista->unidad_medida = $request->unidad_medida;             
                $cabmsLista->activo = true;//Activo en creación 
                $cabmsLista->created_at = date('Y-m-d H:i:s');             
                $cabmsLista->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                \Log::warning(__METHOD__."--->Line:".$e->getLine()."----->".$e->getMessage());
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }    
    }

    public function editarCabms(Request $request){

        $partidas = CatPartidaEspecifica::select('id', 'clave_partida', 'partida')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        $cabms = Cabms::findOrFail($request->id);
        return view('catalogos.cabms.modals.editarCabms', compact('partidas', 'cabms'));

    }

    public function guardarEdicionCabms(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_cabms' => ["required" , "max:150"],
                'cabms' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                //'unidad_medida' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar cabms');
        DB::beginTransaction();
        try{
            $idCabms = $request->id_cabms;
            
            $cabmsLista = Cabms::find($idCabms);
            $estatus = ($request->estatusCabms == "on" ) ? 1 : 0;
            $cabmsLista->clave_cabms = $request->clave_cabms;
            $cabmsLista->cabms = $request->cabms; 
            $cabmsLista->id_partida = $request->partida; 
            $cabmsLista->unidad_medida = $request->unidad_medida;   
            $cabmsLista->activo = $estatus;
            $cabmsLista->updated_at = date('Y-m-d H:i:s');
            $cabmsLista->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            \Log::warning(__METHOD__."--->Line:".$e->getLine()."----->".$e->getMessage());
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }
}
