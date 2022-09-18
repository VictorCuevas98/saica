<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

use App\User;
use App\Personas;
use App\Correo;
use App\ProfesionalesPersona;
use App\Colonias;
use App\Contacto;
use App\PuestosFuncionales;
use App\PuestosPersona;
use App\EntesPulicos;
use App\UnidadesAdmin;
use App\CatTipoContratacion;
use App\PuestosEstructura;
use App\PuestosNoEstructura;
use App\PuestosNoEstructuraAdscripcion;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\RegistroRevision;
use App\Mail\MailConfirmacionServidor;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    public function crear(Request $request){
       /* dd($request->all()); */
        $rfc=$request->rfc;
        $email=$request->email;
        $puesto = $request->puesto;
        $usuarioExiste = User::existeUsuario(mb_strtoupper($rfc));
        $emailExiste = Personas::existePersonaEmail(mb_strtoupper($email));
        $existePreReg = Personas::existePreReg(mb_strtoupper($request->txtrfc));
        //dd($existePreReg);
        if(count($emailExiste)>0){
            return response()->json([
                'message'=> 'El correo electrónico ya existe en el sistema, favor de ingresar otro!',
                'tipoerror'=>'existe'],200);
        }
        if(count($usuarioExiste)>0){
            return response()->json([
                'message'=> 'Ya existe un usuario registrado con este rfc!',
                'tipoerror'=>'existe'],200);
        }else{
            try{
                DB::beginTransaction();
                    /**agregar condicionante para usuario con pre-registro */
                    if(!is_null($existePreReg)){
                        $concluyeRegistro = Personas::updatePersona($request,$existePreReg->id);
                        $idPersona = $existePreReg->id;
                    }else{
                        $idPersona = Personas::crearPersona($request);
                    }
                    $idUsuario = User::crearUsuario($request,$idPersona);
                    $datosUsuario = Personas::getPersonaId($idPersona);
                    /* $contacto = Contacto::guardaContacto($request,$idPersona); */
                    if($puesto=="other"){
                        $idPuestoFuncioal = PuestosFuncionales::guardaPuesto($request);
                    }else{
                        $idPuestoFuncioal=$request->puesto;
                    }
                    $puestoPersona =  PuestosPersona::insertPuesto($idPersona,$request,$idPuestoFuncioal);

                    $idUser = Hashids::encode($idUsuario);

                $envioMail = Correo::sendEmailActivateUser(['email' => $datosUsuario->email, 'id_usuario' => $idUser]);
                if(!is_null($existePreReg)){
                    $idInvitadoPor = User::getInvitadoReg($idPersona);
                    $datosPersonaSolicitante = Personas::getPersonaId($idInvitadoPor->invitado_por);
                    $datosPersonaInvitada = Personas::getPersonaId($idPersona);
                    $nombreInvitado = $datosPersonaInvitada->nombre;
                    $apellidoPInvitado = $datosPersonaInvitada->primer_ap;
                    $apellidoMInvitado = $datosPersonaInvitada->segundo_ap;
                    $enviaMailSolicitante = Correo::sendEmailSolicitante(['email' => $datosPersonaSolicitante->email,'nombre' => $nombreInvitado, 'apellidop' => $apellidoPInvitado, 'apellidom' => $apellidoMInvitado]);
                }

                DB::commit();
                return response()->json([
                    'message'=> 'Ha sido registrado en la agenda MAAP, se le ha enviado un correo electrónico con una liga de activación.',
                    'email'=> $datosUsuario->email,
                    'tipoerror'=>''],200);
            }catch(Exception $e){
                DB::rollBack();
                Log::error(__METHOD__." -> ".$e->getMessage());
                return response()->json(['message'=> 'El usuario no pudo ser creado!'.$e,'email'=> "",'tipoerror'=>''],400);
            }
        }
    }

    public function crearManual(Request $request){

        //dd($request->all());
        //dd($request);
         $rfc = mb_strtoupper($request->txtrfcManual);
         $curp = mb_strtoupper($request->txtCurpManual);

         if(substr($rfc,0,10) != substr($curp,0,10)){
            return [
                'message'=> 'El RFC y el CURP no coinciden.',
                'tipoerror'=>'diferente',
                'codigo'=>200
            ];
         }

        $email=$request->emailManual;
        $puesto = $request->puesto_manual;
        $persona = Personas::where('curp',mb_strtoupper($curp))->get();
         if($persona->count()>0){
            return [
                'message' => 'Ya existe un usuario con ese CURP',
                'tipoerror' => 'existe',
                'codigo' => 200
                ];
         }

         /* dd($puesto ); */
         $usuarioExiste = User::where('rfc',mb_strtoupper($rfc))->get();
         $emailExiste = Personas::where('email', $email)->get();
         $existePreReg = Personas::where('rfc','=',$rfc)->where('id_status_persona','=','R')->get();
         //dd($existePreReg);
         
         if($emailExiste->count()>0){
             return [
                 'message'=> 'El correo electrónico ya existe en el sistema, favor de ingresar otro!',
                 'tipoerror'=>'existe',
                 'codigo'=>200];
         }
         
         if($usuarioExiste->count()>0){
             return [
                 'message'=> 'Ya existe un usuario registrado con este rfc!',
                 'tipoerror'=>'existe',
                 'codigo'=>200];
         }else{
             try{
                 DB::beginTransaction();
                    $catTipoContratacion = CatTipoContratacion::where('clave_tipo_contratacion',$request->tipo_contratacion_manual)->get();
                     /**agregar condicionante para usuario con pre-registro */
                     if($existePreReg->count()>0){
                         $concluyeRegistro = Personas::updatePersona($request,$existePreReg->first()->id);
                         $idPersona = $existePreReg->first()->id;
                     }else{
                         /* $idPersona = Personas::crearPersonaManual($request); */
                        //se agrega
                        $idPersona = Personas::crearPersonaManual($request);
                        $registrosRevision = new RegistroRevision();
                        $registrosRevision->status_persona_id = 'R';
                        $registrosRevision->activo = true;
                        $registrosRevision->persona_id = $idPersona;

                        $registrosRevision->save();
                     }
                     $idUsuario = User::crearUsuarioManual($request,$idPersona);
                     $datosUsuario = Personas::getPersonaId($idPersona);
                     /* $contacto = Contacto::guardaContacto($request,$idPersona); */
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
                     $puestoPersona =  PuestosPersona::insertPuestoManual($idPersona,$request,$idPuestoFuncioal,$fechaInicio);
                     $idUser = Hashids::encode($idUsuario);
                     
                 /* $envioMail = Correo::sendEmailActivateUser(['email' => $datosUsuario->email, 'id_usuario' => $idUser]); */

                $cuerpoEmail = new MailConfirmacionServidor();

                Mail::to($datosUsuario->email)->send($cuerpoEmail);
                Log::info('Se envío el Correo de validación de credencial al Usuario (Trabajador)');

                 /*                  if(!is_null($existePreReg)){
                     $idInvitadoPor = User::getInvitadoReg($idPersona);
                     $datosPersonaSolicitante = Personas::getPersonaId($idInvitadoPor->invitado_por);
                     $datosPersonaInvitada = Personas::getPersonaId($idPersona);
                     $nombreInvitado = $datosPersonaInvitada->nombre;
                     $apellidoPInvitado = $datosPersonaInvitada->primer_ap;
                     $apellidoMInvitado = $datosPersonaInvitada->segundo_ap;
                     $enviaMailSolicitante = Correo::sendEmailSolicitante(['email' => $datosPersonaSolicitante->email,'nombre' => $nombreInvitado, 'apellidop' => $apellidoPInvitado, 'apellidom' => $apellidoMInvitado]);
                 } */

                 DB::commit();
                 return response()->json([
                    'message' => 'Su registro fue enviado al área correspondiente para validación, se le enviará al correo electrónico proporcionado un link de activación una vez que el área haya aceptado su solicitud.',
                     'email'=> $datosUsuario->email,
                     'tipoerror'=>''],200);
             }catch(Exception $e){
                 /* dd($e); */
                 DB::rollBack();
                 Log::error(__METHOD__." -> ".$e->getMessage());
                 return response()->json(['message'=> '¡El usuario no puede ser creado!'.$e,'email'=> "",'tipoerror'=>''],400);
             }
         }
     }

    public function activarUsuario(Request $request){
        
        
            $rules = [
                'password' => ['required',
                                'min:8',
                                'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.&]).*$/',
                                'confirmed',
                                ],
                ];

            $messages = [
                'password.required' => 'Ingrese su contraseña.',
                'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'password.regex'=>'la contraseña no cumple con los requisitos, el formato es invalido'
                ];

            
            $this->validate($request, $rules, $messages);
            //$activo = User::activarUsuario($request);
            try {
            DB::beginTransaction();
            //se activa al usuario
            $status_persona_id = 'A';
            $idUser = Hashids::decode($request->hashid);
            $usuario = User::find($idUser[0]);
            $usuario->password = Hash::make($request->password);
            $usuario->activo = true;
            $usuario->save();
            //se cambia el esttus de la persona
            $persona = Personas::find($usuario->persona->id);
            $persona->id_status_persona = $status_persona_id;
            $persona->save();

            //se inserta un nuevo registro revision
            RegistroRevision::where('persona_id', $persona->id)->activos()->update(['activo' => false, 'updated_by' => null]);
            $nuevoRegistroRevision = RegistroRevision::create([
                    'status_persona_id' => $status_persona_id,
                    'persona_id' => $usuario->persona->id,
                    'activo' => true,
                    'created_by' => null
                ]);
            DB::commit();
            return redirect('login')->with('success', 'El usuario ha sido activado, puede ingresar sus credenciales en el portal!');
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
            return redirect('login')->with('error', 'El usuario no se pudo activar!');
        }
        
    }

    public function activar($id_usuario){
        $idUser = Hashids::decode($id_usuario);
        if(empty($idUser)){
            return redirect('login');
        }
        $datosUsuario = User::existUserInactivo($idUser);
        if(count($datosUsuario)>0){
            return view('auth.activar',compact('datosUsuario','id_usuario'));
        }else{
            return redirect('login');
        }

    }

    protected function validatePassword(Request $request)
    {
        $messages = [
            'password.required' => 'Ingrese su contraseña',
            'passwordconfirma.required' => 'Confirme su contraseña',
        ];
        $request->validate([
            'password' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.&]).*$/'
                            ],
            'passwordconfirma' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.&]).*$/'
                            ]
        ], $messages);
    }

    public function view(){
        return view('auth.cambiarPwd');
    }

    public function save(Request $request){
        $id_usuario = Auth::user()->id;
        $this->validateNewPassword($request);
        if(!Hash::check($request->passwordcurrent, Auth::user()->password)){
            return redirect()->back()->with('errorPass', '¡La contraseña actual no es correcta!');
        }
        if($request->passwordnew != $request->passwordconfirm){
            return redirect()->back()->with('errorPass', '¡Las contraseñas no coinciden!');
        }
        $updated = User::updatePassword($request, $id_usuario);
        if($updated==1){
            return redirect()->back()->with('message', '¡La contraseña ha sido actualizada!');
        }else{
            return redirect()->back()->with('error', '¡La contraseña no se pudo actualizar, favor de intentarlo nuevamente!');
        }
    }

    protected function validateNewPassword(Request $request)
    {
        $messages = [
            'passwordcurrent.required' => 'Ingrese su contraseña actual',
            'passwordnew.required' => 'Ingrese su nueva contraseña',
            'passwordconfirm.required' => 'Confirme su nueva contraseña',
        ];
        $request->validate([
            'passwordnew' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.]).*$/'
                            ],
            'passwordconfirm' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.]).*$/'
                            ],
            'passwordcurrent' => ['required'
                        ]

        ], $messages);
    }

    public function sendPass(Request $request){

        $rfc=mb_strtoupper($request->rfcforgot);

        $datosUsuario = Personas::getPersonaRfc($rfc);
        if(count($datosUsuario)>0){
            try{
                DB::beginTransaction();
                $user = User::getUserRfc($rfc);

                if(!$user->first()->activo){
                    //NO ESTA ACTIVO
                    DB::rollBack();
                    return response()->json([
                        'error'=> '¡No es posible recuperar la contraseña, el usuario aún no ha sido activado!',
                        'tipoerror'=>'inactivo'],200);
                }
                
                $updateUser = User::updateRememberPwd($rfc);
                $datosUser = array("email" => $datosUsuario[0]->email, "id_usuario" =>  $user[0]->id );
                $envioMail = Correo::sendEmailPassRemember($datosUser);

                if($envioMail=='fail'){
                    DB::rollBack();
                    return response()->json([
                        'error'=> '¡No se ha podido enviar el correo de recuperación, favor de volver a intentar!',
                        'tipoerror'=>'falloenvio'],200);

                }else{
                    DB::commit();
                    return response()->json([
                        'message'=> '!Se ha enviado un mensaje al correo electrónico asociado a este RFC, para recuperar la contraseña!',
                        'tipoerror'=>''],200);
                }
            }
            catch(Exception $e){
                /* dd($e); */
                    DB::rollBack();
                    return response()->json(['error'=> '¡Ocurrio un error favor de volver a intentar!','tipoerror'=>'400'],200);
                    
            }
        }else{
           return response()->json([
                'error'=> 'No se encontró información relacionada con este RFC',
                'tipoerror'=>'noexiste'],200);
        }
    }

    //begin::función de recuperación de contraseña desde administrador
    public function sendPassAdmin(Request $request){

        $rfc=mb_strtoupper($request->rfc);

        $datosUsuario = Personas::getPersonaRfc($rfc);
        if($datosUsuario->count()>0){
            DB::beginTransaction();
            try{

                $user = User::whereRaw("upper(rfc) = '".mb_strtoupper($rfc)."'")->get();
                $user->first()->remember_password = true;
                $user->first()->save();
                $datosUser = array("email" => $datosUsuario->first()->email, "id_usuario" =>  $user->first()->id );
                $envioMail = Correo::sendEmailPassRemember($datosUser);

                if($envioMail=='fail'){
                    DB::rollBack();

                    Log::info('!No se ha podido enviar el correo de recuperación, favor de volver a intentar');

                    return response()->json([
                     'message'=> '!No se ha podido enviar el correo de recuperación, favor de volver a intentar!', 'tipoerror'=>''],200);

                    //return back()->with('flash','No se ha podido enviar el correo de recuperación, favor de volver a intentar');

                }else{
                    DB::commit();
                   // return back()->with('flash','Se ha enviado un mensaje al correo electrónico para recuperar la contraseña');
                Log::info('Enviando correo....');

                 return response()->json([
                     'message'=> '!Se ha enviado un mensaje al correo electrónico para recuperar su contraseña!', 'tipoerror'=>''],200);

                }
            }
            catch(Exception $e){
                /* dd($e); */
                    Log::error(__METHOD__." -> ".$e->getMessage());
                    DB::rollBack();

                    return response()->json([
                     'message'=> '!Error inesperado con el servicio de correo, favor de volver a intentar!', 'tipoerror'=>''],200);


                    //return back()->with('error','Error inesperado con el servicio de correo, favor de volver a intentar');
            }
        }else{
           
           Log::info('No se encontró información relacionada con el usuario');
           return response()->json([
                     'message'=> '!No se encontró información relacionada con el usuario!', 'tipoerror'=>''],200);
           //return back()->with('flash','No se encontró información relacionada con el usuario');
        }
    }//end::función de recuperación de contraseña desde administrador

    //begin::función para reactivar usuario
    public function sendReactivarUsuario(Request $request){
        $rfc=mb_strtoupper($request->rfc);

        $datosUsuario = Personas::getPersonaRfc($rfc);
        if($datosUsuario->count()>0){
            DB::beginTransaction();
            try{

                $user = User::whereRaw("upper(rfc) = '".mb_strtoupper($rfc)."'")->get();
                $user->first()->remember_password = true;
                $user->first()->activo = true;
                $user->first()->save();

                $datosUser = array("email" => $datosUsuario->first()->email, "id_usuario" =>  $user->first()->id );
                $envioMail = Correo::sendEmailReactivarUsuario($datosUser);

                if($envioMail=='fail'){
                    DB::rollBack();

                    Log::info('¡No se ha podido enviar el correo de recuperación! Favor de volver a intentar');

                   //return back()->with('flash','¡No se ha podido enviar el correo de recuperación! Favor de volver a intentar');

                    return response()->json([
                     'message'=> '!No se ha podido enviar el correo de recuperación, favor de volver a intentar!', 'tipoerror'=>''],200);


                }else{
                    DB::commit();
                    Log::info('Enviando correo....');
                    
                  // return back()->with('flash','¡Se ha enviado un mensaje al correo electrónico para reactivar usuario!');

                return response()->json([
                     'message'=> '¡Se ha enviado un mensaje al correo electrónico para reactivar usuario!', 'tipoerror'=>''],200);

                }
            }
            catch(Exception $e){
                /* dd($e); */
                    Log::error(__METHOD__." -> ".$e->getMessage());
                    DB::rollBack();

                   return response()->json([
                     'message'=> '¡Error inesperado con el servicio de correo! Favor de volver a intentar', 'tipoerror'=>''],200);

                   // return back()->with('flash','¡Error inesperado con el servicio de correo! Favor de volver a intentar');
            }
        }else{
           
           Log::info('No se encontró información relacionada con el usuario');
           return response()->json([
                     'message'=> '¡No se encontró información relacionada con el usuario!', 'tipoerror'=>''],200);
           //return back()->with('flash','¡No se encontró información relacionada con el usuario!');
        }


    }//end::función para reactivar usuario


    public function actualizaPwd($id){
        $idUser = Hashids::decode($id)[0];
        $userRemember = User::existPwdRemember($idUser);
        if(count($userRemember)>0){
            return view('auth.actualizaPwd',compact('userRemember'));
        }else{
            return redirect('login');
        }
    }

    public function saveRememberPwd(Request $request){
        $this->validateRememberPassword($request);
        if($request->password != $request->passwordconfirma){
            return redirect()->back()->with('errorPass', 'Las contraseñas no coinciden!');
        }
        $updated = User::updateRememberPassword($request);
        if($updated==1){
            return redirect('login')->with('message', 'La contraseña ha sido actualizada, puede ingresar al sistema con su nueva contraseña!');
        }else{
            return redirect()->back()->with('error', 'La contraseña no se pudo actualizar, favor de intentarlo nuevamente!');
        }
    }

    protected function validateRememberPassword(Request $request)
    {
        $messages = [
            'password.required' => 'Ingrese su nueva contraseña',
            'passwordconfirma.required' => 'Confirme su nueva contraseña',
        ];
        $request->validate([
            'password' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.]).*$/'
                            ],
            'passwordconfirma' => ['required',
                            'min:8',
                            'regex:/^.*(?=.{1,})(?=.*[a-z])(?=.{1,})(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%.]).*$/'
                            ]

        ], $messages);
    }

    public function buscar_cp(Request $request)
    {
      // obtiene informacion de cp
      $cp=Colonias::getColoniaCp($request->cp);
      return response()->json($cp);
    }

    public function buscar_puestos(Request $request)
    {
        $puestos = PuestosFuncionales::getPuestos($request->area,$request->tipo_contratacion);
        return response()->json($puestos);
    }

    public function buscarEntidades(Request $request){

        //$EntePub = EntesPulicos::all();

       //$EntePub = EntesPulicos::whereNotIn('clave_entpub',['REPSS','US'])->get();
        //,'REPSS','US'
        $EntePub = EntesPulicos::whereIn('clave_entpub',array('SAF','SEDESA','SSPDF'))->get();


        //$EntePub = EntesPulicos::whereNotIn('ente_publico',['DESCONOCIDO'])->get();
        //$EntePub = EntesPulicos::find(22);
        //$EntePub = EntesPulicos::where('id',22)->orWhere('id',26)->get();
        /* $datosUniAdm = UnidadesAdmin::getUnidades($idEntePub->id); */
        /* dd($EntePub[0]); */
        return compact('EntePub');
    }


    public function buscarUnidadAdministrativa(Request $request){

        /* $idEntePub = EntesPulicos::all(); */
        $datosUniAdm = UnidadesAdmin::getUnidades($request->idEntes);
        return compact('datosUniAdm');
    }
}