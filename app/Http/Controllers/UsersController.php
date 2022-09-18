<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Personas;
use App\CatTipoContratacion;
use App\EntesPulicos;
use APP\CatUniAdm;
use App\Correo;
use App\PuestosPersona;
use App\PuestosFuncionales;
use App\UnidadesAdmin;
use App\PuestosNoEstructuraAdscripcion;
use App\PuestosEstructura;
use App\PuestosNoEstructura;
use Session;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
//use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\CatStatusPersona;
use Illuminate\Support\Facades\DB; //para transacciones

use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;

use Mail;
use App\Mail\MailConfirmacionServidor;
use App\Mail\PassRememberMail;
use App\Mail\ActivacionMail;
use App\Mail\inhabilitarUsuario;

use Illuminate\Support\Facades\Log;
class UsersController extends Controller
{
    function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        
        $entesPublicos = EntesPulicos::where('activo',true)->get();
        $catTipoContratacion = CatTipoContratacion::all();
        //$catUniAdm = CatUniAdm::all();
                //dd($entesPublicos);

        $busquedaRfc = $request->get('busquedaRfc');
        $busquedaNombre = $request->get('busquedaNombre');
        $busquedaPrimer_ap = $request->get('busquedaPrimer_ap');
        $busquedaSegundo_ap = $request->get('busquedaSegundo_ap');
        $busquedaEmail = $request->get('busquedaEmail');
        $busquedaLoginOne= $request->get('busquedaLoginOne');
        $selectLastLogin = $request->input('selectLastLogin'); 
        $selectEstadoUsuarios = $request->input('selectEstadoUsuarios'); 
        
       $usuarios = User::select('users.*','personas.nombre','personas.primer_ap','personas.segundo_ap','personas.email')
                            ->join('personas','users.id_persona','personas.id','personas.id_status_persona')
                            //->activosUsuarios()
                            ->ordenUsuarios()
                            ->rfc($busquedaRfc)
                            ->nombre($busquedaNombre)
                            ->primerApellido($busquedaPrimer_ap)
                            ->segundoApellido($busquedaSegundo_ap)
                            ->email($busquedaEmail)
                            ->lastLogin($selectLastLogin)
                            ->estadoUsuarios($selectEstadoUsuarios)
                            ->paginate(10);


        return view('users.index',compact('usuarios','busquedaRfc','busquedaNombre','busquedaPrimer_ap','busquedaSegundo_ap','busquedaEmail','entesPublicos','catTipoContratacion'));
    }
    
    public function edit($id){
        if(Auth::user()->hasPermissionTo('users.edit') ){
            //tiene el permiso
            $usuario = User::find($id);
            $roles = Role::all();
            $persona = $usuario->persona;

            if($persona->puesto_persona()->activo()->get()->count()>0)
            {
                $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
                //dd($puestoPersona);
            }else{
            $puestoPersona  = new PuestosPersona();
        }


            return view('users.detallesUsuario.detallesUsuario',compact('usuario','roles','persona','puestoPersona'));
        }else{
            //colocar la pagina 403
            //echo "no tiene permiso para editar";
            abort(403, 'No tienen permisos para realizar esta acción');
        }
    }

    public function showInformacionPersona($id)
    {
        if(Auth::user()->hasPermissionTo('users.edit') ){
            
            //tiene el permiso
            $usuario = User::find($id);

            $persona = $usuario->persona;

            if($persona->puesto_persona()->activo()->get()->count()>0)
            {
                $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
                //dd($puestoPersona);
            }else
                {
                    $puestoPersona  = new PuestosPersona();
                }

            return view('users.detallesUsuario.informacionPersona',compact('usuario','persona','puestoPersona'));
        }else{
            //colocar la pagina 403
            //echo "no tiene permiso para editar";
            abort(403, 'No tienen permisos para realizar esta acción');
        }

    }

    public function showNoEstructura($id)
    {
        if(Auth::user()->hasPermissionTo('users.edit') ){
            
            //tiene el permiso
            $usuario = User::find($id);
            $persona = $usuario->persona;


            //cargar entes publicos
            $entesPublicos = EntesPulicos::where('activo',true)->get();
            $catTipoContratacion = CatTipoContratacion::all();

            if($persona->puesto_persona()->activo()->get()->count()>0)
            {
                $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
                //dd($puestoPersona);
            }else
                {
                    $puestoPersona  = new PuestosPersona();
                }
                

            return view('users.detallesUsuario.informacionNoEstructura',compact('usuario','persona','puestoPersona','entesPublicos','catTipoContratacion'));
        }else{
            //colocar la pagina 403
            //echo "no tiene permiso para editar";
            abort(403, 'No tienen permisos para realizar esta acción');
        }

    }

    public function showEstructura($id)
    {
        if(Auth::user()->hasPermissionTo('users.edit') ){
            
            //tiene el permiso
            $usuario = User::find($id);
            $persona = $usuario->persona;


            //cargar entes publicos
            $entesPublicos = EntesPulicos::where('activo',true)->get();
            $catTipoContratacion = CatTipoContratacion::all();

            if($persona->puesto_persona()->activo()->get()->count()>0)
            {
                $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
                //dd($puestoPersona);
            }else
                {
                    $puestoPersona  = new PuestosPersona();
                }
                

            return view('users.detallesUsuario.informacionEstructura',compact('usuario','persona','puestoPersona','entesPublicos','catTipoContratacion'));
        }else{
            //colocar la pagina 403
            //echo "no tiene permiso para editar";
            abort(403, 'No tienen permisos para realizar esta acción');
        }

    }

    public function update(UserUpdateRequest $request, $id ){
        
            $usuario = User::find($id);
            $usuario->persona->email=$request->input('email');
            $usuario->persona->save();
            return redirect()->route('users.edit', ['user' => $id])->with('flash','Usuario actualizado.');
        
    }
    
    public function info($id){
        
            //tiene el permiso
            $dependencias = Dependencia::orderBy('nombre')->active()->get();
            $usuario = User::find($id);
           
            return view('users.configUser',compact('usuario','dependencias'));
        
    }
    
    public function editUs($id){
        
            //tiene el permiso
            $usuarioId = Auth::user()->id;
            
            $usuario = User::find($usuarioId);
           //var_dump($usuario->id);
           //exit();
            return view('users.changeInfo',compact('usuario'));
        
    }

    //BEGIN::Funcion para editar campo email del usuario
    public function updateUs(UserUpdateRequest $request, $id ){
           // $usuarioId = Auth::user()->id;
            
            $usuario = User::find($id);
            //$usuario->name=$request->input('name');
            $usuario->persona->email=$request->input('email');
            $usuario->persona->save();

            //Log::info($usuario);
            
            //return redirect()->route('users.config', ['user' => $id])->with('flash','Usuario actualizado.');
            return back()->with('flash','El campo correo electrónico ha sido actualizado');

    }//END::Funcion para editar campo email del usuario

    public function inhabilitarUsuario(Request $request, $id){

           // DB::beginTransaction();
            $usuario = User::find($id);
            $usuario->activo=false;
            $usuario->save();

            Mail::to($usuario->persona->email)->send(new inhabilitarUsuario);
                if (count(Mail::failures()) > 0) {
                   // DB::rollBack();
                    $respuesta = "fail";

                    Log::info('¡Error! no se logro enviar el correo');

                    return response()->json([
                     'error'=> '!Ocurrio un error inesperado!', 'tipoerror'=>''],200);

                } else {
                    $respuesta = "ok";
                    //DB::commit();

                    Log::info('Enviando correo de desactivación de usuario enviado');

                    return response()->json([
                     'message'=> '!El usuario ha sido desactivado! Se ha enviado un correo electrónico con la notificación', 'tipoerror'=>''],200);
                    //return back()->with('flash','El usuarios ha sido inhabilitado');
                }  
    }
    
    public function password($id){
        $usuarioId = Auth::user()->id;
        $usuario = User::find($usuarioId);
        //var_dump($usuario->change_password);
        //exit();
        //Si no tiene dependencia_id
        //Si tiene dependencia_id
        if ($usuario->change_password !== true) {
            if (is_null( Auth::user()->dependencia_id)){
                return view('users.changePassword',compact('usuario'));
            }else{
            Session::flash('message','Debe cambiar la contraseña para poder continuar con el registro de ingresos.');
            return view('users.changePassword',compact('usuario'));
            }
        }else{
            return view('users.changePassword',compact('usuario'));
        }
    }
    
    public function updatePassword(PasswordUpdateRequest $request, $id){
        $usuarioId = Auth::user()->id;
        $usuario = User::find($usuarioId);

                
        if( Hash::check($request->input('old_password'),$usuario->password)){
                $usuario->password=Hash::make ($request->input('new_password'));
                $usuario->change_password=$request->input('change_password');
                $usuario->save();
                //return redirect()->route('users.password', ['user' => $id])->with('flash','Usuario actualizado.');
            if (is_null(Auth::user()->dependencia_id)) {
                    return redirect()->route('users.password', ['user' => $id])->with('message','Contraseña actualizada.');
                }else{
                    return redirect('/dependencias/'.$usuario->dependencia_id.'/ingresos')->with('message','Contraseña actualizada.');
                }
            }else{
                return redirect()->route('users.password', ['user' => $id])->withErrors(['La contraseña actual es incorrecta.']);
            }
    }
    
    public function show($id)
    {
        if(Auth::user()->hasPermissionTo('users.edit') ){
            return redirect()->route('users.edit', ['user' => $id]);
        }else{
            //solo ver
            $usuario = User::find($id);
            $roles = Role::all();
            return view('users.view',compact('usuario','roles'));
        }
    }
    
    public function delete($user){
        echo $user;
        //eliminar o desactivar un usuario
    }

    public function destroy($user_id){
        $usuario = User::find($user_id);
        $usuario->delete();
        //return redirect('users')->with('flash','usuario ELIMINADO Exitosamente ');

        return response()->json([
                'message'=> '¡Se ha eliminado al usuario exitosamente!', 'tipoerror'=>''],200);


    }



    public function create(){

        $tipos = CatTipoContratacion::all();
         return view('users.new', compact('tipos'));
    }


    public function store(UserCreateRequest $request){
    
        DB::beginTransaction();
        try {
            $catStatusPersona = CatStatusPersona::find('A');
            $nuevaPersona = Personas::create([
                'rfc'=>mb_strtoupper($request->input('txtrfcManual')),
                'id_status_persona'=>$catStatusPersona->id,
                'nombre'=>mb_strtoupper($request->input('txtnombre_manual')),
                'primer_ap'=>mb_strtoupper($request->input('txtapaterno_manual')),
                'segundo_ap'=>mb_strtoupper($request->input('txtamaterno_manual')),
                'email'=>$request->input('emailManual'),
                'curp'=>mb_strtoupper($request->input('txtCurpManual')),
                'telefono'=>$request->input('telefono'),
                'num_empleado'=>$request->input('num_empleado')

            ]);
            $nuevoUsuario = User::create([
                'rfc' => mb_strtoupper($request->input('txtrfcManual')),
                'id_persona'=>$nuevaPersona->id,
                'activo' => false,
                'remember_password'=> true,
            ]);
            
            //------------------------- inicia el puesto de la persona 

             $puesto = $request->puesto_manual;
             $catTipoContratacion = CatTipoContratacion::where('clave_tipo_contratacion',$request->tipo_contratacion_manual)->get();
             if($puesto=="other"){
                         
                        $nuevoPuestoFuncional = PuestosFuncionales::create([
                            'activo' => true,
                            'created_at' => date('Y-m-d H:i:s'),
                            'id_tipo_contratacion' => $catTipoContratacion->first()->id
                         ]);
                        
                       
                        if($catTipoContratacion->first()->clave_tipo_contratacion =='E'){
                            //EL PUESTO ES DE ESTTRUCTURA
                            
                        }else{
                            //EL PUESTO NO ES DE ESTRUCTURA
                            //INSERTAR EL PUESTO DE NO ESTRUCTURA ADSCRIPCION , 
                            $nuevoPuestoNoEstructura = PuestosNoEstructura::create([
                                'id'=> $nuevoPuestoFuncional->id,
                                'puesto_funcional'=> mb_strtoupper($request->txtpuestomanual),
                                'id_puesto_superior'=>null,
                                'nivel'=>null,
                             ]);
                             $nuevoPuestoNoEstructuraAdscripcion = PuestosNoEstructuraAdscripcion::create([
                                'id_puesto_no_estructura'=>$nuevoPuestoNoEstructura->id,
                                'id_unidad_admin'=>$request->areas_llenados,
                                'fecha_adscripcion'=>date('Y-m-d H:i:s'),
                                'activo'=> true,
                             ]);
                             
                        }
                        $idPuestoFuncioal = $nuevoPuestoFuncional->id;
                     }else{
                         $idPuestoFuncioal=$request->puesto_manual;
                     }
                     //

                     $fechaInicio = Carbon::parse($request->fecha_de_contratacion_inicial)->format('Y-m-d');
                     $puestoPersona =  PuestosPersona::insertPuestoManual($nuevaPersona->id,$request,$idPuestoFuncioal,$fechaInicio);
                     
            //------------------------- termina el puesto de la persona
            //$updateUser = User::updateRememberPwd($rfc);
            $datosMail = array("email" => $nuevaPersona->email, "id_usuario" =>  $nuevoUsuario->id );
            $envioMail = Correo::sendEmailActivarUser($datosMail);
            //ENVIAR POR EMAIL LA CONTRASEÑA
            /*$cuerpoEmail = new MailConfirmacionServidor();
            Mail::to($nuevaPersona->email)->send($cuerpoEmail);
            Log::info('Se envío el Correo de validación de credencial al Usuario (Trabajador)');*/
            if($envioMail=='fail'){
                DB::rollBack();
                Log::error(__METHOD__." -> ".'No se pudo guardar el usuario: el correo de activación de cuenta no se ha podido enviar, favor de volver a intentar');
                return  [ 'data'=> null , "success"=> false, 'msg'=> 'No se pudo guardar el usuario: el correo de activación de cuenta no se ha podido enviar, favor de volver a intentar'];
            }
        
            DB::commit();
            Log::info('Usuario creado con datos: rfc:'.$nuevaPersona->rfc.' nombre:'.$nuevaPersona->nombre." ".$nuevaPersona->primer_ap." ".$nuevaPersona->segundo_ap);
            return  [ "success"=> true, 'msg'=> 'El usuario ha sido agregado exitosamente, se ha enviado enlace a la cuenta de correo para ingreso de contraseña', 'data'=> [
                    'nombre'=>$nuevaPersona->nombre,
                    'primer_ap'=>$nuevaPersona->primer_ap,
                    'segundo_ap'=>$nuevaPersona->segundo_ap,
                ] 
            ];

        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__." -> ".$e->getMessage());
            return  [ 'data'=> null, "success"=> false, 'msg'=> 'No se pudo guardar el usuario error: ERR-M-USR-01'];
        }

    }

    public function assignRole(Request $request , $user_id){
        $user = User::find($user_id);
        $user->assignRole($request->input('roles'));
        return back();
    }
    
    public function removeFromRole(Request $request, $user_id){
        $user = User::find($user_id);
        $user->removeRole($request->input('roles'));
        return back();
    }

    public function getEntePublico($id){
        return EntesPulicos::where('tipo_id',$id)->get();

    }

    public function getUnidades(Request $request){
        
        if($request->ajax()){

            $unidades = UnidadesAdmin::getUnidades($request->idEnte);
            log::info($unidades);
            return response()->json($unidades);
        }

    }

    public function getPuestos(Request $request){
        
        if($request->ajax()){

            $puestos = PuestosEstructura::getPuestos($request->idUnidad);
            log::info($puestos);
            return response()->json($puestos);
        }

    }


}