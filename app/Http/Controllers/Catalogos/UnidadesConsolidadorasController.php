<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatUnidadConsolidadora;
use App\CatOrdenGobierno;

class UnidadesConsolidadorasController extends Controller
{
    public function catalogoUnidadesLista(){

        return view('catalogos.unidadesConsolidadoras.unidadesConsolidadoras');
    }

    public function catalogoUnidadConsolidadora(){

        $unidadConsolidadora = CatUnidadConsolidadora::select('cat_unidades_consolidadoras.id', 'cat_unidades_consolidadoras.clave_unidad_consolidadora', 'cat_unidades_consolidadoras.unidad_consolidadora', 'cat_orden_gobierno.orden_gobierno', 'cat_unidades_consolidadoras.activo')->join('cat_orden_gobierno', 'cat_unidades_consolidadoras.id_orden_gobierno', '=', 'cat_orden_gobierno.id')->orderBy('unidad_consolidadora', 'ASC')->get();
        return Datatables::of($unidadConsolidadora)->toJson();
    }

    public function crearUnidadConsolidadora(){

        $ordenGobierno = CatOrdenGobierno::select('id', 'clave_orden_gobierno', 'orden_gobierno')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.unidadesConsolidadoras.modals.nuevoUnidadConsolidadora', compact('ordenGobierno'));
    }

    public function guardarUnidadConsolidadora(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_unidad_consolidadora' => ["required" , "max:150"],
                'unidad_consolidadora' => ["required" , "max:150"],
                'orden_gobierno' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
        $clave = CatUnidadConsolidadora::where('clave_unidad_consolidadora',$clave_unidad_consolidadora)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva unidad consolidadora');
            DB::beginTransaction();
            try{
                //Creamos un nueva unidad consolidadora    
                $unidadConsolidadora = new CatUnidadConsolidadora();       
                $unidadConsolidadora->clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
                $unidadConsolidadora->unidad_consolidadora = $request->unidad_consolidadora; 
                $unidadConsolidadora->id_orden_gobierno = $request->orden_gobierno; 
                $unidadConsolidadora->activo = true;//Activo en creación 
                $unidadConsolidadora->created_at = date('Y-m-d H:i:s');             
                $unidadConsolidadora->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }

    }

    public function editarUnidadConsolidadora(Request $request){

        $unidadConsolidadora = CatUnidadConsolidadora::findOrFail($request->id);
        $ordenGobierno = CatOrdenGobierno::select('id', 'clave_orden_gobierno', 'orden_gobierno')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.unidadesConsolidadoras.modals.editarUnidadConsolidadora', compact('unidadConsolidadora', 'ordenGobierno'));
    }

    public function guardarEdicionUnidadConsolidadora(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_unidad_consolidadora' => ["required" , "max:150"],
                'unidad_consolidadora' => ["required" , "max:150"],
                'orden_gobierno' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        \Log::info(__METHOD__.' Editar unidad consolidadora');
        DB::beginTransaction();
        try{
            $idUnidad = $request->id_unidad;
            
            $unidadConsolidadora = CatUnidadConsolidadora::find($idUnidad);
            $estatus = ($request->estatusUnidad == "on" ) ? 1 : 0;
            $unidadConsolidadora->clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
            $unidadConsolidadora->unidad_consolidadora = $request->unidad_consolidadora; 
            $unidadConsolidadora->id_orden_gobierno = $request->orden_gobierno; 
            $unidadConsolidadora->activo = $estatus;
            $unidadConsolidadora->updated_at = date('Y-m-d H:i:s');
            $unidadConsolidadora->save();
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
