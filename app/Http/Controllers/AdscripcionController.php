<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //para transacciones

use App\User;
use App\Personas;
use App\UnidadesAdmin;
use App\PuestosNoEstructuraAdscripcion;
use App\PuestosPersona;

use Carbon\Carbon;

class AdscripcionController extends Controller
{
    //BEGIN::cambio de adscripcion para usuarios no estructura
    public function camAdsNoEs(Request $request,$id){
            
            $usuario = User::find($id);
            $persona = $usuario->persona;
            $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
            //$fechaAdscripcion = Carbon::now()->toDateString();
           // dd($puestoPersona);

            //$selectEnteLlenado = $request->input('entes_llenados');
            $selectEnteLlenado = $request->idEnte;
            //$fechaAdscripcion = $request->input('dateAdscripcion');
            $fecha_Adscripcion = $request->fecha_Adscripcion;
            //dd($fecha_Adscripcion);
            $datosUnidadAmin = UnidadesAdmin::getUnidades($selectEnteLlenado); 

            DB::beginTransaction();

            try {

                $idPuestoNoEstructura = $puestoPersona->puesto_funcional->puestoNoEstructura->id;

                $puestoAdscripcion = PuestosNoEstructuraAdscripcion::getPuestoAdscripcion($idPuestoNoEstructura);
                $bajaPuesto = PuestosNoEstructuraAdscripcion::find($puestoAdscripcion[0]->id);
                $bajaPuesto->activo = false;
                $bajaPuesto->save();

                $cambioAdscripcion = PuestosNoEstructuraAdscripcion::create([
                'id_puesto_no_estructura' => $idPuestoNoEstructura,
                'id_unidad_admin' => $datosUnidadAmin[0]->id,
                'fecha_adscripcion' => $fecha_Adscripcion,
                'activo' => true,
                ]);



                 DB::commit();
                 //return back()->with('flash','El cambio de adscripcion se ha realizado exitosamente :)');
                 return response()->json([
                     'message'=> '¡Cambio de adscripción realizado!', 'tipoerror'=>''],200);

                 
             } catch (Exception $e) {

                DB::rollBack();
                Log::error(__METHOD__." -> ".$e->getMessage());
                //return back()->with('flash','¡Error! El cambio no se logro realizar...');

                return response()->json([
                     'error'=> '!No se ha podido realizar el cambio de adscripción !', 'tipoerror'=>''],200);
                 
             }

    }//END::cambio de adscripcion para usuarios no estructura

    //BEGIN::cambio de adscripcion para usuarios tipo estructura
    public function camAdsEs(Request $request,$id){

        //obtener informacion de usuario
        $usuario = User::find($id);
        $persona = $usuario->persona;
        $puestoPersona = $persona->puesto_persona()->activo()->get()->first();

        $fechaTermino = Carbon::now()->subDays(1)->toDateString();

        //dd($puestoPersona->activo);

        //cambio de adscripcion de un puesto estructura
        DB::beginTransaction();
        try {

            //baja del puestos actual
            $bajaPuesto = PuestosPersona::find($puestoPersona->id);
            $bajaPuesto->activo = false;
            $bajaPuesto->fecha_termino = $fechaTermino;
            $bajaPuesto->update();

            //se inserta nuevo puesto
            $cambioAdscripcion = PuestosPersona::create([
                'id_persona' => $usuario->persona->id,
                'id_puesto_funcional' => $request->idPuesto,
                'fecha_inicial' => $request->fecha_Adscripcion,
                'telefono_oficina' => $request->telOficina,
                'extension_oficina' => $request->extOficina,
                'id_tipo_desempeno' => 'T',
                'activo' => true

            ]);

            DB::commit();
            //return back()->with('flash','El cambio de adscripcion ha realizado exitosamente :)');
            return response()->json([
                     'message'=> '¡Cambio de adscripción realizado!', 'tipoerror'=>''],200);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__." -> ".$e->getMessage());
            //return back()->with('flash','¡Error! El cambio no se logro realizar...');
            return response()->json([
                     'error'=> '!No se ha podido realizar el cambio de adscripción !', 'tipoerror'=>''],200);
        }


    }//END::cambio de adscripcion para usuarios tipo estructura
}
