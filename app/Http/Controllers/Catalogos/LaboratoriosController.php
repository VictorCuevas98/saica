<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatLaboratorio;

class LaboratoriosController extends Controller
{
    public function catalogoLaboratoriosLista(){

        return view('catalogos.laboratorios.laboratorios');
    }

    public function catalogoLaboratorios(){

        $laboratoriosLista = CatLaboratorio::select('id', 'clave_laboratorio', 'laboratorio', 'activo')->orderBy('laboratorio', 'ASC')->get();
        return Datatables::of($laboratoriosLista)->toJson();
    }

    public function crearLaboratorio(){

        return view('catalogos.laboratorios.modals.nuevoLaboratorio');
    }

    public function guardarLaboratorio(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_laboratorio' => ["required" , "max:150"],
                'laboratorio' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_laboratorio = $request->clave_laboratorio;
        $clave = CatLaboratorio::where('clave_laboratorio',$clave_laboratorio)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo laboratorio');
            DB::beginTransaction();
            try{
                //Creamos un nuevo laboratorio    
                $laboratorio = new CatLaboratorio();       
                $laboratorio->clave_laboratorio = $request->clave_laboratorio;
                $laboratorio->laboratorio = $request->laboratorio;     
                $laboratorio->activo = true;//Activo en creación 
                $laboratorio->created_at = date('Y-m-d H:i:s');             
                $laboratorio->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 
    }

    public function editarLaboratorio(Request $request){

        $laboratorio = CatLaboratorio::findOrFail($request->id);
        return view('catalogos.laboratorios.modals.editarLaboratorio', compact('laboratorio'));
    }


    public function guardarEdicionLaboratorio(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_laboratorio' => ["required" , "max:150"],
                'laboratorio' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar laboratorio');
        DB::beginTransaction();
        try{
            $idLaboratorio = $request->id_laboratorio;
            
            $laboratorio = CatLaboratorio::find($idLaboratorio);
            $estatus = ($request->estatusLaboratorio == "on" ) ? 1 : 0;
            $laboratorio->clave_laboratorio = $request->clave_laboratorio;
            $laboratorio->laboratorio = $request->laboratorio; 
            $laboratorio->activo = $estatus;
            $laboratorio->updated_at = date('Y-m-d H:i:s');
            $laboratorio->save();
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
