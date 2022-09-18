<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
use App\Personas;
use App\Roles;
use App\RegistroRevision;
use App\PuestosPersona;
use Yajra\DataTables\DataTables;

use Mail;
use App\Mail\ActivacionMail;
use App\Mail\DesactivarUsuarioMail;
use Carbon\Carbon;

class UsuarioSolicitudController extends Controller
{
    
    public function index(){
        //$RegistrosRevision = RegistroRevision::activos()->pendientes()->orderBy('created_at')->get();
        return view('admin.solicitudes.index_list');
    }

    //funcion para generar el datatable
    public function usuariosSolicitudes(Request $request){
        $busqueda =  $request->input('search')['value'];
        $registrosRevision = RegistroRevision::where('activo',true);
        if(!is_null($busqueda)){
            $registrosRevision =  $registrosRevision->whereHas('persona', function ($query) use ($busqueda){
                $query->orWhere('nombre', 'ilike', '%'.$busqueda.'%');
                $query->orWhere('primer_ap', 'ilike', '%'.$busqueda.'%');
                $query->orWhere('segundo_ap', 'ilike', '%'.$busqueda.'%');
            });
        }
        $arrIds = array();
        foreach ($registrosRevision->get() as $solicitud) {
            array_push($arrIds, [
                'id' => $this->hashIdSol($solicitud->id),
                'nombre' => $solicitud->persona->nombre . ' ' . $solicitud->persona->primer_ap . ' ' . $solicitud->persona->segundo_ap,
                'status_persona_id' => $solicitud->status_persona_id,
                'created_at' => $solicitud->created_at->format('Y-m-d')
            ]) ;
        }
        return DataTables::of($arrIds)->toJson();
    }

    public function hashIdSol($idSol){
        return Hashids::encode($idSol);
    }

    public function show($solicitudId){
        //RECIBIMIOS EL ID DE LA SOLICITUD
        $registroRevision = RegistroRevision::find(Hashids::decode($solicitudId)[0]);
        $persona = $registroRevision->persona;
        $roles = Roles::all();

        if($persona->puesto_persona()->activo()->get()->count()>0){
            $puestoPersona = $persona->puesto_persona()->activo()->get()->first();
        }else{
            $puestoPersona  = new PuestosPersona();
        }

        return view('admin.solicitudes.view',compact('registroRevision','persona','puestoPersona','solicitudId','roles'));
    }

    public function update(Request $request, $solicitudId)
    {
        DB::beginTransaction();
        try {
            $registroRevision = RegistroRevision::find(Hashids::decode($solicitudId)[0]);
            $persona = $registroRevision->persona;
            if ($request->aceptar) {
                //SE ACEPTA LA SOLICITUD
                $status_persona_id = 'P'; //PENDIENTE DE ACTIVACION
                $activo = true;

                $persona->id_status_persona= $status_persona_id;
                $persona->save();
                $urlActivacion = route('activar', Hashids::encode($persona->usuario->id));
                Mail::to($persona->email)->send(new ActivacionMail(null, $urlActivacion));
                if (count(Mail::failures()) > 0) {
                    $respuesta = "fail";
                } else {
                    $respuesta = "ok";
                }
                
            } else {
                //SE RECHAZA SU SOLICITUD
                Mail::to($persona->email)->send(new DesactivarUsuarioMail($persona));
                $status_persona_id = 'C'; //CANCELADA
                $activo = false;

                $persona->usuario->activo = $activo;
                $persona->usuario->save();
                $persona->id_status_persona= $status_persona_id;
                $persona->activo=$activo;
                $persona->save();
            }

            RegistroRevision::where('persona_id', $registroRevision->persona->id)->activos()->update(['activo' => false, 'updated_by' => Auth::user()->persona->id]);
            $nuevoRegistroRevision = RegistroRevision::create([
                'status_persona_id' => $status_persona_id,
                'persona_id' => $registroRevision->persona->id,
                'activo' => true,
                'created_by' => Auth::user()->persona->id
            ]);

           
            $mensaje = $activo ? 'Se ha enviado un correo al usuario con la liga de activacion' : 'Se ha notificado al usuario ya que su solicitud ha sido denegada';

            DB::commit();
            if($activo){
                return redirect()->route('users.show',$persona->usuario->id)->with('success', $mensaje);
            }else{
                return redirect()->route('usuarios.solicitudes.index')->with('success', $mensaje);
            }
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
            return redirect()->route('usuarios.solicitudes.index');
        }
    }
}

