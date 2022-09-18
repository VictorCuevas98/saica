<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatPreguntaRevisionEntrada;
use App\CatTipoRevision;

class PreguntasRevisionController extends Controller
{
    public function catalogoPreguntasLista(){

        return view('catalogos.preguntasRevision.preguntasRevision');
    }

    public function catalogoPreguntasRevision(){

        $preguntasRevision = CatPreguntaRevisionEntrada::select('cat_preguntas_revision_entrada.id', 'cat_preguntas_revision_entrada.clave_pregunta', 'cat_preguntas_revision_entrada.pregunta', 'cat_tipo_revision.tipo_revision', 'cat_preguntas_revision_entrada.activo')->join('cat_tipo_revision', 'cat_preguntas_revision_entrada.id_tipo_revision', '=', 'cat_tipo_revision.id')->orderBy('pregunta', 'ASC')->get();
        return Datatables::of($preguntasRevision)->toJson();
    }

    public function crearPreguntasRevision(){

        $tipoRevision = CatTipoRevision::select('id', 'clave_tipo_revision', 'tipo_revision')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.preguntasRevision.modals.nuevoPreguntasRevision', compact('tipoRevision'));
    }

    public function guardarPreguntasRevision(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_pregunta' => ["required" , "max:150"],
                'pregunta' => ["required" , "max:150"],
                'tipo_revision' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_pregunta = $request->clave_pregunta;
        $clave = CatPreguntaRevisionEntrada::where('clave_pregunta',$clave_pregunta)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva pregunta revisión entrada');
            DB::beginTransaction();
            try{
                //Creamos un nueva pregunta revision    
                $preguntasRevision = new CatPreguntaRevisionEntrada();       
                $preguntasRevision->clave_pregunta = $request->clave_pregunta;
                $preguntasRevision->pregunta = $request->pregunta; 
                $preguntasRevision->id_tipo_revision = $request->tipo_revision; 
                $preguntasRevision->activo = true;//Activo en creación 
                $preguntasRevision->created_at = date('Y-m-d H:i:s');             
                $preguntasRevision->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 

    }

    public function editarPreguntasRevision(Request $request){

        $preguntasRevision = CatPreguntaRevisionEntrada::findOrFail($request->id);
        $tipoRevision = CatTipoRevision::select('id', 'clave_tipo_revision', 'tipo_revision')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.preguntasRevision.modals.editarPreguntasRevision', compact('preguntasRevision', 'tipoRevision'));

    }

    public function guardarEdicionPreguntasRevision(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_pregunta' => ["required" , "max:150"],
                'pregunta' => ["required" , "max:150"],
                'tipo_revision' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        \Log::info(__METHOD__.' Editar pregunta revisión entrada');
        DB::beginTransaction();
        try{
            $idPregunta = $request->id_pregunta;
            
            $preguntasRevision = CatPreguntaRevisionEntrada::find($idPregunta);
            $estatus = ($request->estatusPregunta == "on" ) ? 1 : 0;
            $preguntasRevision->clave_pregunta = $request->clave_pregunta;
            $preguntasRevision->pregunta = $request->pregunta; 
            $preguntasRevision->id_tipo_revision = $request->tipo_revision; 
            $preguntasRevision->activo = $estatus;
            $preguntasRevision->updated_at = date('Y-m-d H:i:s');
            $preguntasRevision->save();
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
