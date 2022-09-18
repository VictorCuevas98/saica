<?php

namespace App\Http\Controllers;

use App\FiscalesPersona;
use Illuminate\Http\Request;
use App\Personas;
use App\ProfesionalesPersona;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use App\Roles;
use App\CatTipoProf;
use App\PersonalProyecto;
use App\DocumentosPersona;
use App\User;

class PersonasController extends Controller
{
    use HasRoles;
    //EL SIGUIENTE METODO BUSCA COINCIDENCIAS EN LA TABLA PERSONAS

    public function searchPersona(Request $request){
        //recibimos un cadena
        //debo separarla y meterla en un arreglo
        //crear un query dinamico que repita ese mismo nuero de palabras dentro de los
        //tres campos principales de 
    }


    //ESTE METODO AUN NO ESTA COMPLETO PUE SNO SE QUE CAMPOS DEBO DEVOLVER
    //METODO QUE BUSCA POR RFC LOS DATOS DE UNA PERSONA
    //SE USA EN LA BUSQUEDA DE PERSONAL EN EL FORMULARIO DEL PROYECTO
    public function searchPersonaByRfc(Request $request){
        //si viene vacio no buscamos
        if(empty($request->rfc)){
            $personas =  [];
        }else{
            //'num_registro','formacion_prof','num_cedula','vigencia_registro','id_tipo_prof'
            $personas = Personas::select('rfc', 'nombre','primer_ap','segundo_ap','email','id','es_empleado')
            ->where('rfc', 'like', '%'.$request->rfc.'%')
            ->with(['Datosprofesionales' => function($query) {
                $query->with('tipoProf');
            }])
            ->get();
        }
        return $personas;
    }


    public function getRfc(Request $request){
        $datosPersona= Personas::existePersonaRfc(strtoupper($request->rfc));
        if(count($datosPersona)>0){
            return response()->json([
                'email'=> $datosPersona[0]->email,
                'tipoerror'=>''],200);
        }else{
            return response()->json([
                'email'=> "",
                'tipoerror'=>''],200);
        }
        
    }

    public function viewDatosProf(){
            return view('personas.datos_profesionales');
    }

    public function saveDatosProf(Request $request){
        $datos_persona = Auth::user()->persona;
        $idPersona = $datos_persona->id;
        $role= User::getRolUsuarioPersona($idPersona);
        $tipoPersona = Auth::user()->persona->tipo_persona;
        $rfc = $datos_persona->rfc;
        $guardaDatos = ProfesionalesPersona::guardaDatosProf($request,$idPersona);
        $docsPersona = DocumentosPersona::subirDocumentos($request,$role,$tipoPersona,$idPersona,$rfc);
        if($guardaDatos){
            return redirect('firmante')->with('success', 'Los datos Profesionales han sido actualizados!');   
        }else{
            return redirect()->back()->with('error', 'No se guardaron los datos favor de volver a intentar!');   
        }
    }

    public function getDetalleFirma($id){
        $detalle = PersonalProyecto::getDetalleFirma($id);
        if(count($detalle)>0){
            return view("detalle_firma.detalle",compact("detalle"));
        }else{
            return redirect("login");
        }
    }

    public function getDetalleFirmaEntidad($id){
        $detalle = PersonalProyecto::getDetalleFirmaEnte($id);
        if(count($detalle)>0){
            return view("detalle_firma.detalle",compact("detalle"));
        }else{
            return redirect("login");
        }
    }
    
    public function consultaCurpPersona(Request $request){
        $existePersonaCurp = Personas::getCurpPersona(strtoupper($request->curp));
        $existePersonaRFC = Personas::getPersonaRfc(strtoupper($request->rfc));
        $existePersonaCorreo = Personas::existePersonaEmail(strtolower($request->correo));
        if(count($existePersonaCurp)>0){
            return response()->json([
                'existeCurp'=> "true",
                'tipoerror'=>''],200);
        }else if(count($existePersonaRFC)>0){
            return response()->json([
                'existeRfc'=> "true",
                'tipoerror'=>''],200);
        }else if(count($existePersonaCorreo)>0){
            return response()->json([
                'existeCorreo'=> "true",
                'tipoerror'=>''],200);
        }
    }

}
