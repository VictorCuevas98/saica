<?php

namespace App\Http\Controllers;

use App\CatOrigenRecurso;
use App\Licitacion;
use Illuminate\Http\Request;
use App\Adquisicion;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class AdquisicionController extends Controller
{
    //CONSULTA SI EXISTE EN ADQUISICIONES YA SE TIENE UN NUMERO DE REQUISICION
    public function AdquisicionesHaveAny(Request $request, $num_requisicion = null){
        if(isset($request->numero_de_requisicion))
            $num_requisicion=$request->numero_de_requisicion;

        $valor = false;

        if ($num_requisicion!==null){
            $adquisicion = Adquisicion::whereRaw("LOWER(num_requisicion) = ? ",strtolower($num_requisicion));
            if(isset($request->adquisicion)){
                 $adquisicion = $adquisicion->whereNotIn('id',[Hashids::decode($request->adquisicion)[0]]);
            }
            $valor = ($adquisicion->get()->count()>0) ? true : false;
        }else{
            $valor = false;
        }

        if(isset($request->form_validation_format)){ //si se consulta desde un formvalidation
            return json_encode(array(
                'valid' => !$valor,
            ));
        }else{
            if ($num_requisicion!==null) {
                //  AQUI ENTRA EN EL CODIGO DE VIC
                if ($adquisicion->count() <= 0) {
                    return false;
                } else {
                    return
                        [
                            'status' => true,
                            'adquisicion' => $adquisicion->first()
                        ];
                }
            }
        }
    }

    //CONSULTA SI EXISTE EN ADQUISICIONES YA SE TIENE UN oficio de adjudicacion
    public function AdjudicacionesHaveAny(Request $request, $oficio_adjudicacion=null){

        if(isset($request->oficio_de_adjudicacion))
            $oficio_adjudicacion=$request->oficio_de_adjudicacion;

        $valor= false;
        if ($oficio_adjudicacion!==null){
            $adquisicion = Adquisicion::whereRaw("LOWER(num_oficio_adjudicacion) = ? ",strtolower($request->oficio_de_adjudicacion));
            if(isset($request->adquisicion)){
                 $adquisicion = $adquisicion->whereNotIn('id',[Hashids::decode($request->adquisicion)[0]]);
            }


            $valor = ($adquisicion->get()->count()>0) ? true : false;
        }else{
            $valor = false;
        }

        if(isset($request->form_validation_format)){ //si se consulta desde un formvalidation

            return json_encode(array(
                'valid' => !$valor,
            ));
        }else{
            if ($oficio_adjudicacion!==null) {
                //  AQUI ENTRA EN EL CODIGO DE VIC
                if ($adquisicion->count() <= 0) {
                    return false;
                } else {
                    return
                        [
                            'status' => true,
                            'adquisicion' => $adquisicion->first()
                        ];
                }
            }
        }
    }
}
