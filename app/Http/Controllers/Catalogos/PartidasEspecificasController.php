<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatPartidaEspecifica;
use App\CatElementoCog;

class PartidasEspecificasController extends Controller
{
    public function catalogoPartidasLista(){

        return view('catalogos.partidas.partidasEspecificas');
    }

    public function catalogoPartidas(){

        $partidasLista = CatPartidaEspecifica::select('cat_partidas_especificas.id', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida','cat_partidas_especificas.id_elemento_cog', 'cat_elementos_cog.clave_elemento_cog', 'cat_elementos_cog.elemento_cog', 'cat_partidas_especificas.activo')->join('cat_elementos_cog', 'cat_partidas_especificas.id_elemento_cog', '=', 'cat_elementos_cog.id')->orderBy('partida', 'ASC')->get();
        return Datatables::of($partidasLista)->toJson();
    }

    public function crearPartida(){

        $elementos = CatElementoCog::select('id', 'clave_elemento_cog', 'elemento_cog')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.partidas.modals.nuevoPartida', compact('elementos'));
    }

    public function guardarPartida(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_partida' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'elemento' => ["required" , "max:150"],
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_partida = $request->clave_partida;
        $clave = CatPartidaEspecifica::where('clave_partida',$clave_partida)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva partida');
            DB::beginTransaction();
            try{
                //Creamos un nueva partida especifica    
                $partidasLista = new CatPartidaEspecifica();       
                $partidasLista->clave_partida = $request->clave_partida;
                $partidasLista->partida = $request->partida; 
                $partidasLista->id_elemento_cog = $request->elemento;       
                $partidasLista->activo = true;//Activo en creación 
                $partidasLista->created_at = date('Y-m-d H:i:s');             
                $partidasLista->save();
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

    public function editarPartida(Request $request){

        $elementos = CatElementoCog::select('id', 'clave_elemento_cog', 'elemento_cog')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        $partida = CatPartidaEspecifica::findOrFail($request->id);
        
        return view('catalogos.partidas.modals.editarPartida', compact('elementos', 'partida'));
    }


    public function guardarEdicionPartida(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_partida' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'elemento' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar partida');
        DB::beginTransaction();
        try{
            $idPartida = $request->id_partida;
            
            $partidasLista = CatPartidaEspecifica::find($idPartida);
            $estatus = ($request->estatusPartida == "on" ) ? 1 : 0;
            $partidasLista->clave_partida = $request->clave_partida;
            $partidasLista->partida = $request->partida; 
            $partidasLista->id_elemento_cog = $request->elemento;  
            $partidasLista->activo = $estatus;
            $partidasLista->updated_at = date('Y-m-d H:i:s');
            $partidasLista->save();
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
