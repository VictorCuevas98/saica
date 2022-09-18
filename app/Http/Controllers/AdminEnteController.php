<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\CatEtapasProyecto;
use App\HistorialEtapasProyectos;
use App\LaboralesPersona;
use App\Proceso;
use App\Proyectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Roles;
use App\Personas;
use App\Correo;
use App\CatTipoSeccion;
use App\ActasTemplate;
use Exception;
use Spatie\Permission\Contracts\Role;
use Vinkla\Hashids\Facades\Hashids;

use Yajra\Datatables\Datatables;
use App\Ponente;
class AdminEnteController extends Controller
{
    public function index(){
        $datosLaborales = DB::table('laborales_persona')->where('id_persona', Auth::user()->persona->id)->first();
        if(!$datosLaborales) {
            $uniAdmn = DB::table('cat_uniadm')->get();
            return view('entidad/datos_laborales', compact('uniAdmn'));
        }
        $id_usuario = Auth::user()->id;
        $roleFull=Auth::user()->getRoleNames();
        $arrayRole = explode("ADMIN", $roleFull);
        $role = $arrayRole[0];
        $busca  = array('"', ']','[','``');
        $role = str_replace($busca,'',$role);
        $datosUser = User::getPersonaRole(trim($role),$id_usuario);
        $total = count($datosUser);
        return view('admin.entes.index',compact("datosUser","role","total"));
    }

    public function nuevo_usuario(){
        $roleFull=Auth::user()->getRoleNames();
        $arrayRole = explode("ADMIN", $roleFull);
        $role = $arrayRole[0];
        $busca  = array('"', ']','[','``');
        $role = str_replace($busca,'',$role);
        $cat_roles = Roles::getRolesEnte($role);
        return view('admin.entes.agregar_usuario',compact("cat_roles","role"));
    }

    public function catalogo_acta(){
        //$tipoSeccion = CatTipoSeccion::all();
        $versiones = ActasTemplate::join("personas","personas.id", "=", "actas_template.id_persona")->select('version','fecha_publicacion','actas_template.activo','nombre','primer_ap','segundo_ap')->orderBy('actas_template.id', 'desc')->get();
        $version_actual = ActasTemplate::where('activo','t')->get();
        /*$contenido_seccion = array();
        foreach ($tipoSeccion as $seccion){
        $contenido = DB::table('secciones_template')->select('contenido')->where('id_tipo_seccion', $seccion->id)->get();
          $contenido_seccion[$seccion->id]=$contenido->contenido;
          foreach($contenido as $cont){
            $contenido_seccion[$seccion->id]=$cont->contenido;
          }
          //dd($contenido_seccion);
        }*/
        $contenido = DB::table('secciones_template')->select('id','contenido','titulo','clave_seccion')->whereNull('updated_at')->orderBy('id')->get();
        return view('actas.catalogo_acta',compact('contenido','versiones','version_actual'));
        //return view('actas.catalogo_acta',compact('tipoSeccion','contenido_seccion','versiones','version_actual'));
    }

    public function guarda_usuario(Request $request){
        $roleFull=Auth::user()->getRoleNames();
        $arrayRole = explode("ADMIN", $roleFull);
        $role = $arrayRole[0];
        $busca  = array('"', ']','[','``');
        $role = str_replace($busca,'',$role);
        try{
            DB::beginTransaction();
                //primero la personsa
            $nuevaPersona =  new Personas();
            $nuevaPersona->tipo_persona = 'F';
            $nuevaPersona->rfc = strtoupper($request->get('rfc')).strtoupper($request->get('homoclave'));
            $nuevaPersona->curp = strtoupper($request->get('curp'));
            $nuevaPersona->nombre = $request->get('nombre');
            $nuevaPersona->primer_ap = $request->get('paterno');
            $nuevaPersona->segundo_ap = $request->get('materno');
            $nuevaPersona->telefono = $request->get('telefono');
            $nuevaPersona->email = $request->get('correo');
            $nuevaPersona->es_empleado = 't';
            $nuevaPersona->save();

            $nuevoUsuario = User::crearUsuarioEnte($request,$nuevaPersona->id);
            $uniadm = DB::table('cat_uniadm')->where('clave_uniadm', $role)->first();
            $idCargo = DB::table('laborales_persona')->insertGetId([
                'area' =>$request->area,
                'cargo' => $request->cargo,
                'id_persona' => $nuevaPersona->id,
                'id_uniadm' => $uniadm->id,
                'created_at' => date('Y-m-d H:m:s')
            ]);

            $rol = Roles::getRolesId($request->perfil);
            //dd($rol);
            $idPersona= Hashids::encode($nuevoUsuario);
            $url = url('activar/'.$idPersona);

            Correo::invitarUsuario($nuevaPersona, $url, $rol);
            DB::commit();
            //return redirect()->back()->with('success', 'El usuario ha sido creado, se ha enviado un correo al usuario para su activación!');
            return redirect('/admin/ente')->with('success', 'El usuario ha sido creado, se ha enviado un correo al usuario para su activación!');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrio un error al guardar el usuario, favor de volver a intentarlo!..');
        }
    }

    public function ver_editar($id_persona){
        $roleFull=Auth::user()->getRoleNames();
        $arrayRole = explode("ADMIN", $roleFull);
        $role = $arrayRole[0];
        $busca  = array('"', ']','[','``');
        $role = str_replace($busca,'',$role);
        $cat_roles = Roles::getRolesEnte($role);
        $idPersona= Hashids::decode($id_persona);
        //dd($idPersona);
        if (empty($idPersona)) {
            return redirect('/admin/ente')->with('error', 'Acción no permitida!');
        }
        $datosPersona = Personas::getPersonaId($idPersona);
        $datosLaborales = Personas::getLaboralesPersona($idPersona);
        $rol = User::getRolUsuarioPersona($idPersona);
        $idPersona = $id_persona;
        return view('admin.entes.editar_usuario',compact("cat_roles","role","rol","datosPersona","datosLaborales","idPersona"));
    }

    public function editar_ente(Request $request){
        $idPersona= Hashids::decode($request->hashid);
        $rfc = $request->rfc.$request->homoclave;
        $id_role = $request->perfil;
        $area = $request->area;
        $cargo = $request->cargo;
        $datosUsuario = User::getRolUsuarioPersona($idPersona);
        $id_usuario = $datosUsuario->id_usuario;
        try{
            DB::beginTransaction();
            $updateEnte = Personas::updatePersonaEnte($request);
            $updateUserRole = User::updateUserRole($rfc,$id_usuario,$id_role);
            $updateDatosLaborales = Personas::updateLabPersonaEnte($idPersona,$area,$cargo);
            DB::commit();
            return redirect('/admin/ente')->with('success', 'Los datos del usuario han sido actualizados!');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrio un error al editar el usuario, favor de volver a intentarlo!..');
        }
    }

    public function borrar_ente(Request $request){
        $idPersona= Hashids::decode($request->hashid);
        $datosUsuario = User::getRolUsuarioPersona($idPersona);
        $id_usuario = $datosUsuario->id_usuario;
        try{
            $updateUsuarioEnte = User::updateUserDelete($id_usuario);
            return $respuesta = ['mensaje' => [
                'success' => "true",
                'aviso' => "El usuario ha sido eliminado!"
            ],
                'codigo' => 200];
        }catch(Exception $e){
            return $respuesta = ['mensaje' => [
                'success' => "false",
                'aviso' => "Ocurrio un error al eliminar el usuario, favor de volver a intentarlo!"],
                'codigo' => 206];
        }
    }

    public function estadisticas(){

        $proyectos = Proyectos::all();
        return view('admin.entes.estadisticas', compact('proyectos'));
    }

    public function proyectosXEtapa(Request $request){

        //$proyectos = HistorialEtapasProyectos::where('activo', true)->get();
        $proyectos = DB::table('etapas_proyecto')
            ->join('proyectos', 'etapas_proyecto.id_proyecto', '=', 'proyectos.id')
            ->join('cat_etapas', 'etapas_proyecto.id_etapa', '=', 'cat_etapas.id')
            ->where('etapas_proyecto.activo', true)
            ->get();

        $etapas = CatEtapasProyecto::all();

        $estadisticas = [];
        $estadisticas['etapas'] = [];
        foreach ($etapas as $etapa) {
            $digits = 6;
            $valorColor = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $color = '#'.$valorColor;
            $existe = $proyectos->where('id_etapa', $etapa->id)->count();
            array_push($estadisticas['etapas'], [
                'etapa' => $etapa->etapa,
                'cuantos' => $existe,
                'color' => $color,
            ]);
        }
        $sinFirma = $proyectos->where('firmafiel', false)->count();
        $conFirmaFiel = $proyectos->where('firmafiel', true)->count();

        $estadisticas['cuantasFirmas'] = [
            'sinfirma' => $sinFirma,
            'confirma' => $conFirmaFiel
        ];

        //para todos los procesos de la entidad se deben obtener todos las personas de la entidad
        $laboralesPersona = LaboralesPersona::where('id_uniadm', Auth::user()->persona->laboralPersona->unidadAdmin->id)->get();
        $cuantosProcesosSuma = 0;
        $procesosActivos = 0;
        $procesosInactivos = 0;
        foreach ($laboralesPersona as $laboral){
            //aqui encontramos cada persona y sumaremos
            $cuantosProcesos = Proceso::where('owner', $laboral->id_persona)->count();
            $cuantosProcesosSuma = $cuantosProcesosSuma + $cuantosProcesos;
            $procesosActivos = $procesosActivos = Proceso::where('activo', true)->count();
            $procesosInactivos = $procesosInactivos = Proceso::where('activo', false)->count();
        }

        $estadisticas['procesos'] = [
            'total' => $cuantosProcesosSuma,
            'activos' => $procesosActivos,
            'inactivos' => $procesosInactivos
        ];

        $estatus = DB::table('cat_status')->get();
        $arraryActividades = array();
        foreach ($estatus as $estatu){
            $actividades = DB::table('actividades')
                ->join('procesos', 'actividades.id_proceso', '=', 'procesos.id')
                ->join('personas', 'procesos.owner', '=', 'personas.id')
                ->join('laborales_persona', 'personas.id', '=', 'laborales_persona.id_persona')
                ->join('cat_uniadm', 'laborales_persona.id_uniadm', '=', 'cat_uniadm.id')
                ->where('cat_uniadm.id', Auth::user()->persona->laboralPersona->unidadAdmin->id)
                ->where('actividades.id_status', $estatu->id)
                ->count();
            array_push($arraryActividades, [
                'estatus' => $estatu->status,
                'cuantasActividades' => $actividades
            ]);
        }
        $estadisticas['actividades'] = $arraryActividades;

       return ['mensaje' => [
           'datos' => $estadisticas,
           'mensaje' => 'datos generados'], 'codigo' => 200];

    }

    public function obtenerProcesosPorProyecto($proyectoId){
        $laboralesPersona = LaboralesPersona::where('id_uniadm', Auth::user()->persona->laboralPersona->unidadAdmin->id)->get();
        $arrayProcesos = array();
        foreach ($laboralesPersona as $laboral){
            $cuantosProcesos = Proceso::where('owner', $laboral->id_persona)->where('id_proyecto', $proyectoId)->get();
            foreach ($cuantosProcesos as $procesos){
                array_push($arrayProcesos, $procesos);
            }
        }

        return ['mensaje' => [
            'datos' => $arrayProcesos,
            'mensaje' => 'datos generados'], 'codigo' => 200];
    }

    public function obtenerActividadesPorProyecto($proyectoId){
        $estatus = DB::table('cat_status')->get();
        $arraryActividades = array();
        foreach ($estatus as $estatu){
            $actividades = DB::table('actividades')
                ->join('procesos', 'actividades.id_proceso', '=', 'procesos.id')
                ->join('personas', 'procesos.owner', '=', 'personas.id')
                ->join('laborales_persona', 'personas.id', '=', 'laborales_persona.id_persona')
                ->join('cat_uniadm', 'laborales_persona.id_uniadm', '=', 'cat_uniadm.id')
                ->where('cat_uniadm.id', Auth::user()->persona->laboralPersona->unidadAdmin->id)
                ->where('actividades.id_status', $estatu->id)
                ->where('procesos.id_proyecto', $proyectoId)
                ->count();
            array_push($arraryActividades, [
                'estatus' => $estatu->status,
                'cuantasActividades' => $actividades
            ]);
        }

        return ['mensaje' => [
            'datos' => $arraryActividades,
            'mensaje' => 'datos generados'], 'codigo' => 200];
    }

    public function oci_inicio(Request $request){
        //entidad
        //$entidad = Auth::user()->persona->puesto_persona()->first()->puesto_funcional()->first()->unidad_admin()->first()->ente_publico()->first();
        //$entidad = Auth::user()->persona->puesto_persona->first()->puesto_funcional->unidad_admin->ente_publico;
        //dd($entidad);
        $datosUser = DB::table('users as u')
            ->join('personas as p','u.id_persona','=','p.id')
            ->join('model_has_roles as mh','u.id','=','mh.model_id')
            ->join('roles as r','r.id','=','mh.role_id')
            ->join('puestos_persona as pp', 'p.id', '=', 'pp.id_persona')
            ->join('puestos_funcionales as pf', 'pp.id_puesto_funcional', '=', 'pf.id')
            ->join('unidades_admin as ua', 'pf.id_unidad_admin', '=', 'ua.id')
            ->join('entes_publicos as ep', 'ua.id_ente_publico', '=', 'ep.id')
            /* ->whereNull('u.deleted_at')
            ->whereNull('pp.fecha_termino') */
            //->where('ua.id_ente_publico', $entidad->id)
            ->whereIn('r.id', [6])
            ->get();
/*             $datosPonentesTotal = DB::table('ponentes as pon')
            ->select('pon.*','p.*','pf.*','ua.unidad_admin','ep.ente_publico','us.activo as estatus_perfil')
            ->leftJoin('personas as p','pon.persona_id','=','p.id')
            ->leftJoin('users as us','us.id_persona','=','p.id')
            ->leftJoin('puestos_persona as pp', 'p.id', '=', 'pp.id_persona')
            ->leftJoin('puestos_funcionales as pf', 'pp.id_puesto_funcional', '=', 'pf.id')
            ->leftJoin('unidades_admin as ua', 'pf.id_unidad_admin', '=', 'ua.id')
            ->leftJoin('entes_publicos as ep', 'ua.id_ente_publico', '=', 'ep.id')
            ->leftJoin('model_has_roles as mr','mr.model_id','=','us.id')
            ->where('mr.role_id',6)
            ->orderBy('us.created_at')
            ->get(); */
            $datosPonentesTotal = Ponente::where('estatus_ponente_perfil',true)->count();
            $datosPonentes = Ponente::where('estatus_ponente_perfil',true)->paginate(4)/* ->toJson() *//* ->withQueryString */;
/*             foreach ($datosPonentes as $key => $value) {
                # code...
                dump(count($value->persona->puesto_persona)>0?$value->persona->puesto_persona[0]->puesto_funcional->unidad_admin->unidad_admin:'');

            }
            dd('llegas'); */
            $rol = DB::table('roles')->where('name', '=','PONENTE')->first();
           /*  dd(json_decode($datosPonentes)); */
/*             $datosPonentes = DB::table('ponentes as pon')
            ->select('pon.*','p.*','pf.*','ua.unidad_admin','ep.ente_publico','us.activo as estatus_perfil')
            ->leftJoin('personas as p','pon.persona_id','=','p.id')
            ->leftJoin('users as us','us.id_persona','=','p.id')
            ->leftJoin('puestos_persona as pp', 'p.id', '=', 'pp.id_persona')
            ->leftJoin('puestos_funcionales as pf', 'pp.id_puesto_funcional', '=', 'pf.id')
            ->leftJoin('unidades_admin as ua', 'pf.id_unidad_admin', '=', 'ua.id')
            ->leftJoin('entes_publicos as ep', 'ua.id_ente_publico', '=', 'ep.id')
            ->leftJoin('model_has_roles as mr','mr.model_id','=','us.id')
            ->where('mr.role_id',$rol->id )
            ->orderBy('us.created_at')
            ->paginate(4); */
            /* dd($datosPonentes); */
            $cat_roles = Roles::all();
            $totalPonentes = $datosPonentesTotal;
            if ($request->ajax()) {
                # code...

                $datosPonentes = Ponente::where('estatus_ponente_perfil',true)->paginate(4);
                return view('oci.tabla_ponentes', ['datosPonentes'=>$datosPonentes])->render();    
            }
        
        
        /* dd($datosPonentesTotal); */
        
       // dd($datosUser);
       /* dd($datosPonentes); */
/*        dd(asset($datosPonentes[0]->url_foto));
       dd(\Storage::download('public/keB1PCuQZdAHIDRTXdy4LUx2IObSoyJT4nxu1O2y.jpg')); */
       /* return response()->json($datosPonentes); */
        return view('oci.inicio', ["datosUser"=>$datosUser, 'cat_roles' => $cat_roles,'datosPonentes'=>$datosPonentes,'totalPonentes' => $totalPonentes]);
    }


    public function oci_inicio_ponentes_inactivos(Request $request){
        //entidad
        //$entidad = Auth::user()->persona->puesto_persona()->first()->puesto_funcional()->first()->unidad_admin()->first()->ente_publico()->first();
        //$entidad = Auth::user()->persona->puesto_persona->first()->puesto_funcional->unidad_admin->ente_publico;
        //dd($entidad);
        $datosUser = DB::table('users as u')
            ->join('personas as p','u.id_persona','=','p.id')
            ->join('model_has_roles as mh','u.id','=','mh.model_id')
            ->join('roles as r','r.id','=','mh.role_id')
            ->join('puestos_persona as pp', 'p.id', '=', 'pp.id_persona')
            ->join('puestos_funcionales as pf', 'pp.id_puesto_funcional', '=', 'pf.id')
            ->join('unidades_admin as ua', 'pf.id_unidad_admin', '=', 'ua.id')
            ->join('entes_publicos as ep', 'ua.id_ente_publico', '=', 'ep.id')
            /* ->whereNull('u.deleted_at')
            ->whereNull('pp.fecha_termino') */
            //->where('ua.id_ente_publico', $entidad->id)
            ->whereIn('r.id', [6])
            ->get();
            if ($request->ajax()) {
                    # code...
                    $rol = DB::table('roles')->where('name', '=', 'PONENTE')->first();
                    $datosPonentesInactivos = DB::table('ponentes as pon')
                ->select('pon.*','p.*','pf.*','ua.unidad_admin','ep.ente_publico','us.activo as estatus_perfil','us.id as id_us')
                ->leftJoin('personas as p','pon.persona_id','=','p.id')
                ->leftJoin('users as us','us.id_persona','=','p.id')
                ->leftJoin('puestos_persona as pp', 'p.id', '=', 'pp.id_persona')
                ->leftJoin('puestos_funcionales as pf', 'pp.id_puesto_funcional', '=', 'pf.id')
                ->leftJoin('unidades_admin as ua', 'pf.id_unidad_admin', '=', 'ua.id')
                ->leftJoin('entes_publicos as ep', 'ua.id_ente_publico', '=', 'ep.id')
                ->leftJoin('model_has_roles as mr','mr.model_id','=','us.id')
                ->where('estatus_ponente_perfil',false)
                /* ->whereNotIn('mr.role_id', [$rol->id]) */
                ->orderBy('us.created_at')
                ->get();
                /* dd($datosPonentesInactivos); */
                return Datatables::of($datosPonentesInactivos)->toJson();
            }
            
            /* dd($datosPonentes); */
        $cat_roles = Roles::all();
        
       // dd($datosUser);
       /* dd($datosPonentes); */
/*        dd(asset($datosPonentes[0]->url_foto));
       dd(\Storage::download('public/keB1PCuQZdAHIDRTXdy4LUx2IObSoyJT4nxu1O2y.jpg')); */
        return view('ponentes.listar_ponentes_desactivados', ["datosUser"=>$datosUser, 'cat_roles' => $cat_roles]);
    }

}
