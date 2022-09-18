<?php

namespace App;

use App\Mail\FirmasRechazadas;
use App\Mail\InvitacionUsuario;
use App\Mail\MensajeParticipantes;
use App\Mail\NotificacionEntidad;
use App\Mail\ReporteDeFallas;
use Illuminate\Database\Eloquent\Model;
use App\Mail\ActivacionMail;
use App\Mail\PassRememberMail;
use App\Mail\MensajeEntidad;
use App\Mail\NuevoProyecto;
use App\Mail\MensajeDocumento;
use App\Mail\RespuestaDocumento;
use App\Mail\ProcesosMail;
use App\Mail\MensajeDocumentoEnte;
use App\Mail\MensajeSolicitante;
use App\Mail\RecibeActaInvitacionEnviar;
use App\Mail\TestigoActaInvitacionEnviar;
use App\Mail\NotificacionEresTestigoEntrega;
use App\Mail\NotificacionEresQuienRecibeEntrega;
use App\Mail\SolicitudDeInformacionMail;
use App\Mail\inhabilitarUsuario;
use App\Mail\MailReactivarUsuario;
use App\Mail\activarCuentaAdmin;
use Illuminate\Support\Facades\DB;
use Mail;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use App\Mail\SolicitudAperturaEvento;
use App\Mail\EncuestaGeneralMail;

class Correo extends Model
{
    
    public static function sendEmailActivateUser($data){
        try{
            $response ['email'] = $data['email'];
            $response ['id_usuario'] = $data['id_usuario'];
            $urlActivacion = route('activar',$data['id_usuario']);
            Mail::to($response['email'])
            ->send(new ActivacionMail($response,$urlActivacion));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendEmailPassRemember($data){
        try{
            
            $rfchash=Hashids::encode($data['id_usuario']);
            //dd( $rfchash);
            $response ['id']= $rfchash;
            $urlRecordar = route('actualizaPwd',$response ['id']);
            Mail::to($data['email'])
            ->send(new PassRememberMail($response,$urlRecordar));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendEmailReactivarUsuario($data){
        try{
            
            $rfchash=Hashids::encode($data['id_usuario']);
            //dd( $rfchash);
            $response ['id']= $rfchash;
            $urlRecordar = route('actualizaPwd',$response ['id']);
            Mail::to($data['email'])
            ->send(new MailReactivarUsuario($response,$urlRecordar));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendEmailActivarUser($data){
        try{
            $rfchash=Hashids::encode($data['id_usuario']);
            //dd( $rfchash);
            $response ['id']= $rfchash;
            $urlRecordar = route('actualizaPwd',$response ['id']);
            Mail::to($data['email'])
            ->send(new activarCuentaAdmin($response,$urlRecordar));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
        }catch(Exception $e){
            $respuesta = $e;
        }
         return $respuesta;
    }

    public static function firmasRechazadas($proyecto, $comentarios){
        try{

            $persona = Personas::find($proyecto->id_persona);
            $response = [
                'persona' => $persona,
                'proyecto' => $proyecto,
                'comentario' => $comentarios
            ];

            Mail::to($persona->email)
                ->send(new FirmasRechazadas($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function invitarUsuario($persona, $url, $rol){
        try{

            $response = [
                'rol' => $rol,
                'url' => $url,
                'rfc' => $persona->rfc
            ];
            //dd($persona);
            Mail::to($persona->email)
                ->send(new InvitacionUsuario($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function notificacion_entidad($proyecto){
        try{

            $rolesHasModel = DB::table('model_has_roles')->whereIn('role_id', array(4,6,9,11))->get();
            //recorreremos los rolesInModel
            foreach ($rolesHasModel as $row){
                $persona = User::find($row->model_id)->persona;
                $rol = Roles::find($row->role_id);
                $response = [
                    'persona' => $persona,
                    'proyecto' => $proyecto,
                    'rol' => $rol
                ];

                Mail::to($persona->email)
                    ->send(new NotificacionEntidad($response));
            }

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function sendEmailMensajeEnte($data){
        
        try{
            $response ['mensaje'] = $data['mensaje'];
            $response ['emailPersona'] = $data['emailPersona'];
            $response ['nombre'] = $data['nombre'];
            $response ['emailDependencia'] = $data['emailDependencia'];
            //$response ['mailprueba'] = "pjimenez@finanzas.cdmx.gob.mx";
            //dd( $response ['mailprueba']);
            Mail::to( $response ['emailDependencia'])
            ->send(new MensajeEntidad($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendReporteFalla($data){
        try{
            $response ['mensaje'] = $data['mensaje'];
            $response ['emailPersona'] = $data['emailPersona'];
            $response ['nombre'] = $data['nombre'];
            //$response ['mailprueba'] = "pjimenez@finanzas.cdmx.gob.mx";
            //dd( $response ['mailprueba']);
            Mail::to(  env('ERROR_REPORT_MAIL','tzamnhc@gmail.com'))
            ->send(new ReporteDeFallas($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendSolicitudes($data){
        try{
            $response ['titulo'] = $data['titulo'];
            $response ['mensaje'] = $data['mensaje'];
            $response ['emailPersona'] = $data['emailPersona'];
            $response ['nombre'] = $data['nombre'];
            $response ['ponentes'] = $data['ponentes'];
            //$response ['ponentesByComa'] = $data['ponentesByComa'];
            Mail::to( $response ['ponentes'])
            ->send(new SolicitudDeInformacionMail($data['titulo'],$response));
            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendConstanciaMasiva($data){
        try{
            $response['emailPersona'] = $data['emailPersona'];
            $response['usuario'] = $data['usuario'];
            $response['url'] = $data['url'];
            
            
            Mail::to($response['emailPersona'])
            ->send(new EncuestaGeneralMail($response));
            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
        }
         return $respuesta;
    }

    public static function sendSolicitudApertura($data){
        try{
            $response ['titulo'] = $data['titulo'];
            $response ['mensaje'] = $data['mensaje'];
            $response ['emailPersona'] = $data['emailPersona'];
            $response ['nombre'] = $data['nombre'];
            Mail::to(  env('ERROR_REPORT_MAIL','tzamnhc@gmail.com') )
            ->send(new SolicitudAperturaEvento($data['titulo'],$response));
            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function sendEmailRegitroProy($data){
        
        try{
            $response ['proyecto'] = $data['proyecto'];
            $response ['email'] = $data['email'];
            Mail::to( $response ['email'])
            ->send(new NuevoProyecto($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }

    public static function enviarMensajeAParticipantes($mensaje){

        try{

            Mail::to( $mensaje['email'])
                ->send(new MensajeParticipantes($mensaje));

            if(count(Mail::failures())>0){
                $respuesta = 206 ;
            }else{
                $respuesta = 200;
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function enviarMensajeDocumento($data){
        try{
            $response ['nombre'] = $data['nombre'];
            $response ['documento'] = $data['documento'];
            $response ['mensaje'] = $data['mensaje'];
            $response ['email'] = $data['email'];
            Mail::to( $response['email'])
                ->send(new MensajeDocumento($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function enviarRespuestaDocumento($data){
        try{
            $response ['nombre'] = $data['nombre'];
            $response ['documento'] = $data['documento'];
            $response ['unidad'] = $data['unidad'];
            $response ['mensaje'] = $data['mensaje'];
            $response ['email'] = $data['email'];
            Mail::to( $response['email'])
                ->send(new RespuestaDocumento($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public static function mailProcesos ($persona, $proyecto){
        try{
            $response['nombre'] = $persona->nombre.' '.$persona->primer_ap.' '.$persona->segundo_ap;
            $response['email'] = $persona->email;
            $response['proyecto'] = $proyecto;
            //$response['email_test'] = 'jorge.medgal@gmail.com';
            Mail::to($response['email'])->send(new ProcesosMail($response));
            if (count(Mail::failures())>0) {
                $respuesta = 'fail';
            }else{
                $respuesta = 'ok';
            } 
        }catch(Exception $e){
            $respuesta = $e;
        }
        return $respuesta;
    }

    public static function enviarMensajeDocumentoEnte($data){
        try{
            $response ['entidad'] = $data['entidad'];
            $response ['documento'] = $data['documento'];
            $response ['proyecto'] = $data['proyecto'];
            $response ['email'] = $data['email'];
            Mail::to( $response['email'])
                ->send(new MensajeDocumentoEnte($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }

        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
        return $respuesta;
    }

    public function recibeActaInvitacionEnviar(Actas $acta,$destinatario){
        try {
            Mail::to($destinatario)->send(new RecibeActaInvitacionEnviar($acta));
            $resultado = ['success'=>true, 'mensaje'=>'mensaje enviado corretamente','data'=>null];
        } catch (Exception $e) {
            \Log::debug($e->getMessage());
            $resultado = ['success'=>false, 'mensaje'=>$e->getMessage(),'data'=>null];
        }
        return $resultado ;
    }
    /*SE ENVIA POR CORREO INVIACION PARA REGISTRARSE CUANDO SE LE SELECCIONA COMO TESTIGO DEL ACTA*/
    public function testigoActaInvitacionEnviar(Actas $acta,$destinatario){
        try {
            Mail::to($destinatario)->send(new TestigoActaInvitacionEnviar($acta));
            $resultado = ['success'=>true, 'mensaje'=>'mensaje enviado corretamente','data'=>null];
        } catch (Exception $e) {
            \Log::debug($e->getMessage());
            $resultado = ['success'=>false, 'mensaje'=>$e->getMessage(),'data'=>null];
        }
        return $resultado ;
    }

    public function notificacionEresTestigoEntrega(Actas $acta,$destinatario){
        try {
            Mail::to($destinatario)->send(new NotificacionEresTestigoEntrega($acta));
            $resultado = ['success'=>true, 'mensaje'=>'mensaje enviado corretamente','data'=>null];
        } catch (Exception $e) {
            \Log::debug($e->getMessage());
            $resultado = ['success'=>false, 'mensaje'=>$e->getMessage(),'data'=>null];
        }
        return $resultado ;
    }

    public function notificacionEresQuienRecibeEntrega(Actas $acta,$destinatario){
        try {
            Mail::to($destinatario)->send(new NotificacionEresQuienRecibeEntrega($acta));
            $resultado = ['success'=>true, 'mensaje'=>'mensaje enviado corretamente','data'=>null];
        } catch (Exception $e) {
            \Log::debug($e->getMessage());
            $resultado = ['success'=>false, 'mensaje'=>$e->getMessage(),'data'=>null];
        }
        return $resultado ;
    }

    public static function sendEmailSolicitante($data){
        try{
            $response ['email'] = $data['email'];
            $response ['nombre'] = $data['nombre'];
            $response ['apellidop'] = $data['apellidop'];
            $response ['apellidom'] = $data['apellidom'];
            Mail::to($response['email'])
            ->send(new MensajeSolicitante($response));

            if(count(Mail::failures())>0){
                $respuesta = "fail" ;
            }else{
                $respuesta = "ok";
            }
            
        }catch(Exception $e){
            $respuesta = $e;
            //dd($e);
        }
         return $respuesta;
    }
}
