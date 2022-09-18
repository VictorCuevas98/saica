<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Bloque;
use App\CatStatus;
use App\CatTipoParticipante;
use App\Correo;
use App\EntesPulicos;
use App\Evento;
use App\ParticipanteEvento;
use App\Personas;
use App\Ponente;
use App\PuestosFuncionales;
use App\PuestosPersona;
use App\Roles;
use App\UnidadesAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeParticipantes;


class AdminController extends Controller
{
    //
    protected $wsRenapo;
    protected $wsCapitalH;
    function __construct(WebServicesRENAPO $RENAPO, WsCapitalHController $CapitaLH)
    {
        $this->wsRenapo = $RENAPO;
        $this->wsCapitalH = $CapitaLH;
    }

    public function inicio(){

        return view('admin.inicio');
    }
    public function guardar_video(Request $request){
        $videoUrl = $request->video;
        if($videoUrl == ''){
            return ['mensaje' => [
                'success' => "false",
                'datos' => []
            ],
                'codigo' => 206,
                'aviso' => "ingresa correctamente la url del video"];
        }
        if(strlen($videoUrl) < 50){
            return ['mensaje' => [
                'success' => "false",
                'datos' => []
            ],
                'codigo' => 206,
                'aviso' => "El link no corresponde a una URL"];
        }
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);
        $bloque->url = $videoUrl.'/download';
        $bloque->save();
        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardó correctamente el video",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
            ]
        ],
            'codigo' => 200];
    }

    public function actualizar_evento_fin(Request $request){
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);
        $bloque->updated_by = Auth::user()->persona->id;
        $bloque->hora_fin = $request->hora;
        $bloque->save();

        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardó correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento
                    ]
                ],
            'codigo' => 200];
    }

    public function publicar(Request $request){
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);

        $bloque->publicado = $request->publicar;
        $bloque->updated_by = Auth::user()->persona->id;

        $bloque->save();

        $mensaje = $request->publicar == 'true' || $request->publicar == true? 'El evento se publicó correctamente' : 'El evento se oculto correctamente';

        return ['mensaje' => [
            'success' => "true",
            'aviso' => $mensaje,
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento,
                'tipo_evento' => $bloque->evento->tipo_evento
                    ]
                ],
            'codigo' => 200];
    }

    public function nuevo_recurrente(Request $request){
        try{
            DB::beginTransaction();
            $newEvento = Evento::find($request->eventoId);
            $tipoEvento = DB::table('cat_eventos')->where('id', $newEvento->cat_evento_id)->first();

            $estatus = DB::table('cat_status')->where('clave_status', 'A')->first();

            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $bloquePrincipal = $newEvento->bloques()->first();

            //crearemos los bloques y generaremos el codigo de asistencia
            $nuevoBloque = new Bloque();
            $nuevoBloque->evento_id = $newEvento->id;
            $nuevoBloque->hora_inicio = $request->hora_inicio;
            $nuevoBloque->hora_fin = $request->hora_fin;
            $nuevoBloque->fecha_inicio = $request->fecha;
            $nuevoBloque->fecha_fin = $request->fecha; //cambiar si el sistema requeire una fecha diferente
            $nuevoBloque->color_etiqueta = $bloquePrincipal->color_etiqueta;
            $nuevoBloque->color_icono = $bloquePrincipal->color_icono;
            $nuevoBloque->url = $bloquePrincipal->url;
            $nuevoBloque->id_conferencia = '';
            $nuevoBloque->pass_conferencia = '';
            $nuevoBloque->liga = '';
            $nuevoBloque->status_id = $estatus->id;
            $nuevoBloque->capacidad = $bloquePrincipal->capacidad;
            $nuevoBloque->titulo = $newEvento->titulo.' ('.($newEvento->bloques()->count()+1).')';
            $nuevoBloque->created_by = Auth::user()->persona->id;

            //codigo generacion
            $input_length = strlen($permitted_chars);
            $random_string = '';
            for($i = 0; $i < 10; $i++) {
                $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            $nuevoBloque->codigo_evento = $random_string;
            $nuevoBloque->save();

            //ya que tenemos los bloques lo que haremos será generar a los ponentes de los eventos

            DB::commit();
            return ['mensaje' => [
                'success' => "true",
                'aviso' => "Se guardó correctamente el evento",
                'datos' => [
                    'bloque' => $nuevoBloque,
                    'evento' => $newEvento,
                    'ponentes' => $newEvento->ponentes(),
                    'tipo_evento' => $tipoEvento
                        ]
                    ],
                'codigo' => 200];
        } catch(Exception $e){
            DB::rollBack();
            return ['mensaje' => [
                'success' => "false",
                'aviso' => $e],
                'codigo' => 206];
        }
    }

    public function actualizar_evento_inicio(Request $request){
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);

        $bloque->fecha_inicio = $request->fecha;
        $bloque->fecha_fin = $request->fecha;
        $bloque->hora_inicio = $request->hora;
        $bloque->updated_by = Auth::user()->persona->id;
        $bloque->save();

        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardó correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento
                    ]
                ],
            'codigo' => 200];
    }

    public function hacer_recurrente(Request $request){
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);

        $evento = $bloque->evento;
        $evento->recurrente = true;
        $evento->updated_by = Auth::user()->persona->id;
        $evento->save();
        $tipoEvento = DB::table('cat_eventos')->where('id', $evento->cat_evento_id)->first();
        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardo correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento,
                'ponentes' => $evento->ponentes(),
                'tipo_evento' => $tipoEvento

                    ]
                ],
            'codigo' => 200];
    }
    public function eliminar_evento(Request $request){
        $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);
        $bloque->activo = false;
        $bloque->deleted_by = Auth::user()->persona->id;
        $bloque->save();
        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardó correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento
                    ]
                ],
            'codigo' => 200];
    }

    public function ejes(){
        //lo que haremos sera imprimir un archivo string que sriva como seeder
        $ejes = DB::table('cat_ejes')->get();
        $strinPrintSeeder = '';
        foreach ($ejes as $eje)
        {
            //por cada ente y cada concpto crearemos un registro en la BD
                $strinPrintSeeder .= 'DB::table("cat_ejes")->updateOrInsert([
                "punto" => "'.$eje->punto.'",
                "eje" => "'.$eje->eje.'",
                "padre" => "'.($eje->padre? $eje->padre:"null").'",
                "color" => "'.($eje->color?$eje->color:null).'"
                ]);';

        }

      return $strinPrintSeeder;
       }

    public function cancelar_evento(Request $request){

        try{
            DB::beginTransaction();
            $bloqueId = $request->bloqueId;
        $bloque = Bloque::find($bloqueId);
        $estatus = CatStatus::where('clave_status', 'X')->first();
        $bloque->titulo = '(CANCELADO) '.$bloque->titulo;
        $bloque->status_id = $estatus->id;
        $bloque->updated_by = Auth::user()->persona->id;
        $bloque->save();
        $participantes = $bloque->evento->asistentes()->get();
        //dd($participantes);
        foreach($participantes as $participante){
            $persona = $participante->persona;

            $cuerpoEmail = new MensajeParticipantes(['email' => $persona->email, 'evento'=> substr($bloque->titulo, 11)]);

                Mail::to($persona->email)->send($cuerpoEmail);
            //Correo::enviarMensajeAParticipantes(['email' => $persona->email, 'evento'=> $bloque->titulo]);
        }
        DB::commit();
        return ['mensaje' => [
            'success' => "true",
            'aviso' => "Se guardó correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                'evento' => $bloque->evento,
                'tipo_evento' => $bloque->evento->tipo_evento,
                'ponentes' => $bloque->evento->ponentes(),
                    ]
                ],
            'codigo' => 200];
        } catch(Exception $e){
            DB::rollBack();
            return ['mensaje' => [
                'success' => "true",
                'aviso' => 'Ocurrio un error en el servidor',
                'datos' => []],
                'codigo' => 206];
        }
    }

    public function nuevo_evento(Request $request){
        try{
            DB::beginTransaction();
            $newEvento = new Evento();

            $tipoEvento = DB::table('cat_eventos')->where('codigo_evento', $request->tipo_evento)->first();
            $estatus = DB::table('cat_status')->where('clave_status', 'A')->first();

            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $newEvento->titulo = $request->titulo;
            $newEvento->descripcion = $request->descripcion;
            $newEvento->hora_inicio = $request->hora_inicio;
            $newEvento->hora_fin = $request->hora_fin;
            $newEvento->fecha_inicio = $request->fecha_inicio;
            $newEvento->created_by = Auth::user()->persona->id;
            $newEvento->fecha_fin = $request->fecha_inicio; //cambiar si el sistema requeire una fecha diferente
            //guardaremos la urle del evento y el archivo del evento
            if($request->file('programa')){
                $path = $request->file('programa')->storeAs(
                    'public/programas_eventos', str_replace(' ', '', $request->file('programa')->getClientOriginalName())
                );
                $newEvento->path_file = $path;
            }

            //$newEvento->url_evento = $request->url;
            $newEvento->liga_conferencia = $request->zoom;
            $newEvento->cat_evento_id = $tipoEvento->id;
            $newEvento->status_id = $estatus->id;
            $newEvento->dirigido_a = $request->a_quien;
            $newEvento->cat_eje_id = $request->eje;
            $newEvento->save();

            //crearemos los bloques y generaremos el codigo de asistencia
            $nuevoBloque = new Bloque();
            $nuevoBloque->evento_id = $newEvento->id;
            $nuevoBloque->titulo = $request->titulo;
            $nuevoBloque->hora_inicio = $request->hora_inicio;
            $nuevoBloque->hora_fin = $request->hora_fin;
            $nuevoBloque->fecha_inicio = $request->fecha_inicio;
            $nuevoBloque->fecha_fin = $request->fecha_inicio; //cambiar si el sistema requeire una fecha diferente
            $nuevoBloque->created_by = Auth::user()->persona->id;
            //$nuevoBloque->url = $request->url;
            $nuevoBloque->liga = $request->zoom;
            $nuevoBloque->id_conferencia = $request->id_conferencia;
            $nuevoBloque->pass_conferencia = $request->pass_conferencia;
            $nuevoBloque->status_id = $estatus->id;
            $nuevoBloque->capacidad = $request->capacidad;

            //codigo generacion
            $input_length = strlen($permitted_chars);
            $random_string = '';
            for($i = 0; $i < 10; $i++) {
                $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            $nuevoBloque->codigo_evento = $random_string;
            $nuevoBloque->save();

            //ya que tenemos los bloques lo que haremos será generar a los ponentes de los eventos
            if($request->ponentes){
                //buscamos en la base el tipo de participante ponente
                $tipo_participante = CatTipoParticipante::where('clave_tipo_part', 'PON')->first();
                foreach($request->ponentes as $ponenteId){
                    $ponente = Ponente::find($ponenteId);
                    $nuevoPonente = new ParticipanteEvento();
                    $nuevoPonente->persona_id = $ponente->persona->id;
                    $nuevoPonente->tipo_participante_id = $tipo_participante->id;
                    $nuevoPonente->evento_id = $newEvento->id;
                    $nuevoPonente->save();
                }
            }

            DB::commit();
            return ['mensaje' => [
                'success' => "true",
                'aviso' => "Se guardó correctamente el evento",
                'datos' => [
                    'bloque' => $nuevoBloque,
                    'evento' => $newEvento,
                    'status' => $nuevoBloque->status,
                    'ponentes' => $newEvento->ponentes(),
                    'tipo_evento' => $tipoEvento
                        ]
                    ],
                'codigo' => 200];
        } catch(Exception $e){
            DB::rollBack();
            return ['mensaje' => [
                'success' => "false",
                'aviso' => $e],
                'codigo' => 206];
        }
    }

    public function editar_evento(Request $request){
     try{
            DB::beginTransaction();

            $tipoEvento = DB::table('cat_eventos')->where('codigo_evento', $request->tipo_eventoE)->first();
            //$estatus = DB::table('cat_status')->where('clave_status', 'P')->first();

            //crearemos los bloques y generaremos el codigo de asistencia
            $bloque = Bloque::find($request->bloque_id);
            //$bloque->url = $request->urlE;
            $bloque->hora_inicio = $request->hora_inicioE;
            $bloque->hora_fin = $request->hora_finE;

            $bloque->liga = $request->zoomE;
            $bloque->id_conferencia = $request->id_conferenciaE;
            $bloque->pass_conferencia = $request->pass_conferenciaE;
            $bloque->capacidad = $request->capacidadE;
            $bloque->titulo = $request->tituloE;
            $bloque->updated_by = Auth::user()->persona->id;
            $bloque->save();

            $evento = $bloque->evento;
            $evento->cat_eje_id = $request->ejeE;
            $evento->descripcion = $request->descripcionE;
            //$evento->url_evento = $request->urlE;
            $evento->liga_conferencia = $request->zoomE;
            $evento->cat_evento_id = $tipoEvento->id;
            $evento->updated_by = Auth::user()->persona->id;
            $evento->dirigido_a = $request->a_quienE;

            if($request->file('programaE')){
                $path = $request->file('programaE')->storeAs(
                    'public/programas_eventos', str_replace(' ', '', $request->file('programaE')->getClientOriginalName())
                );
                $evento->path_file = $path;
            }
            $evento->save();
            $tipo_participante = CatTipoParticipante::where('clave_tipo_part', 'PON')->first();
            //ya que tenemos los bloques lo que haremos será generar a los ponentes de los eventos
            if($request->ponentesE){
                //buscamos en la base el tipo de participante ponente

                $participantes = $evento->ponentes();

                if($participantes){
                    if(count($participantes) > count($request->ponentesE)){
                        foreach($participantes as $participante){
                            $existe = array_search($participante->id, $request->ponentesE);
                            if($existe === false){
                                $ponente = $participante->persona->participaciones_eventos()
                                ->where('evento_id', $evento->id)
                                ->where('tipo_participante_id', $tipo_participante->id)
                                ->where('activo', true)->first();
                                $ponente->activo = false;
                                $ponente->save();
                            }
                        }
                        $arrayParticipantes = array();

                        foreach($participantes as $participante){
                            array_push($arrayParticipantes, $participante->id);
                        }

                        foreach($request->ponentesE as $ponenteId){

                            $existe = array_search($ponenteId, $arrayParticipantes);

                            if($existe === false){

                                $ponente = Ponente::find($ponenteId);
                                $nuevoPonente = new ParticipanteEvento();
                                $nuevoPonente->persona_id = $ponente->persona->id;
                                $nuevoPonente->tipo_participante_id = $tipo_participante->id;
                                $nuevoPonente->evento_id = $evento->id;
                                $nuevoPonente->save();
                            }
                        }
                    } else if(count($participantes) < count($request->ponentesE)){

                        $arrayParticipantes = array();

                        foreach($participantes as $participante){
                            array_push($arrayParticipantes, $participante->id);
                        }

                        foreach($request->ponentesE as $ponenteId){

                            $existe = array_search($ponenteId, $arrayParticipantes);

                            if($existe === false){

                                $ponente = Ponente::find($ponenteId);
                                $nuevoPonente = new ParticipanteEvento();
                            $nuevoPonente->persona_id = $ponente->persona->id;
                            $nuevoPonente->tipo_participante_id = $tipo_participante->id;
                            $nuevoPonente->evento_id = $evento->id;
                            $nuevoPonente->save();
                            }
                        }
                        foreach($participantes as $participante){
                            $existe = array_search($participante->id, $request->ponentesE);
                            if($existe === false){
                                $ponente = $participante->persona->participaciones_eventos()
                                    ->where('evento_id', $evento->id)
                                    ->where('tipo_participante_id', $tipo_participante->id)
                                    ->where('activo', true)->first();
                                $ponente->activo = false;
                                $ponente->save();
                            }
                        }
                    } else{
                        foreach($participantes as $participante){
                            $existe = array_search($participante->id, $request->ponentesE);
                            if($existe === false){
                                $ponente = $participante->persona->participaciones_eventos()
                                    ->where('evento_id', $evento->id)
                                    ->where('tipo_participante_id', $tipo_participante->id)
                                    ->where('activo', true)->first();
                                $ponente->activo = false;
                                $ponente->save();
                            }
                        }
                        $arrayParticipantes = array();

                        foreach($participantes as $participante){
                            array_push($arrayParticipantes, $participante->id);
                        }
                        foreach($request->ponentesE as $ponenteId){

                            $existe = array_search($ponenteId, $arrayParticipantes);

                            if($existe === false){

                                $ponente = Ponente::find($ponenteId);
                                $nuevoPonente = new ParticipanteEvento();
                                $nuevoPonente->persona_id = $ponente->persona->id;
                                $nuevoPonente->tipo_participante_id = $tipo_participante->id;
                                $nuevoPonente->evento_id = $evento->id;
                                $nuevoPonente->save();
                            }
                        }
                    }

                } else{
                    foreach($request->ponentesE as $ponenteId){
                        $ponente = Ponente::find($ponenteId);
                        $nuevoPonente = new ParticipanteEvento();
                        $nuevoPonente->persona_id = $ponente->persona->id;
                        $nuevoPonente->tipo_participante_id = $tipo_participante->id;
                        $nuevoPonente->evento_id = $evento->id;
                        $nuevoPonente->save();
                    }
                }

            } else{
                //viene vacio los ponentes del request pero si hay en la bd
                $participantes = $evento->ponentes();

                if($participantes){
                    foreach($participantes as $participante){

                            $ponente = $participante->persona->participaciones_eventos()
                            ->where('evento_id', $evento->id)
                            ->where('tipo_participante_id', $tipo_participante->id)
                            ->where('activo', true)->first();

                            //dump($ponente->activo);
                        $ponente->activo = false;
                            $ponente->save();
                        //dump($ponente->activo);

                    }
                   // dd();
                }
            }

       DB::commit();
       return ['mensaje' => [
          'success' => "true",
            'aviso' => "Se guardó correctamente el evento",
            'datos' => [
                'bloque' => $bloque,
                'status' => $bloque->status,
                  'evento' => $evento,
                'ponentes' => $evento->ponentes(),
                'tipo_evento' => $tipoEvento
           ]
              ],
            'codigo' => 200];
        } catch(Exception $e){
            DB::rollBack();
            return ['mensaje' => [
                'success' => "false",
                'aviso' => $e],
                'codigo' => 206];
  }
    }

    public function constancias(){
        $bloques = Bloque::activo()->publicado()->orderBy('fecha_inicio', 'ASC')->get();
        return view('admin.constancias.constancias', compact('bloques'));
    }

    public function registar_constancia($bloqueId){
        $bloque = Bloque::find(Hashids::decode($bloqueId)[0]);
        $horaInicio = new \DateTime($bloque->hora_inicio);
        $horaTermino = new \DateTime($bloque->hora_fin);

        $interval = $horaInicio->diff($horaTermino);

        $hora =  $interval->h;
        $minutos = 0;
        if($hora){
            $minutos = intval($hora) * 60;
        }

        $total = $minutos + intval($interval->i);

        $asistencias = $bloque->asistencias()->with(['participante' => function ($q) {
            $q->with(['persona' => function ($q2) {
                $q2->orderBy('nombre', 'ASC');
            }]);
        }])->where('activo', true)->orderBy('id', 'ASC')->get();
        return view('admin.constancias.registrar_constancia', compact('bloque', 'asistencias', 'total'));
    }

    public function guardarDuracion(Request $request){
        try{
            DB::beginTransaction();
            $asistencia = Asistencia::find($request->asistenciaId);
            $asistencia->tiempo_asistencia = $request->duracion;
            $asistencia->save();
            DB::commit();
            return ['mensaje' => 'Se guardo la duracion correctamente',
                'success' => "true",
                'aviso' => "Se guardó correctamente el evento",
                'datos' => [],
                'codigo' => 200];
        } catch (Exception $e){
            DB::rollBack();
            return ['mensaje' => 'Fallo el guardado',
                'success' => "false",
                'aviso' => [],
                'codigo' => 206];
        }

    }
    public function guardarCheck(Request $request){
        try{
            DB::beginTransaction();
        $asistencia = Asistencia::find($request->asistenciaId);
        $asistencia->constancia = $request->check == 'true'? true : false;
        $asistencia->save();
        DB::commit();
        return ['mensaje' => 'Se guardo la constancia correctamente',
            'success' => "true",
            'aviso' => "Se guardó correctamente el check",
            'datos' => [],
            'codigo' => 200];
        } catch (Exception $e){
DB::rollBack();
return ['mensaje' => 'Fallo el guardado',
'success' => "false",
'aviso' => [],
'codigo' => 206];
}
    }


    public function usuarios(){

        //$datosUser = DB::table('users as u')
               // ->join('personas as p','u.id_persona','=','p.id')
              //  ->join('model_has_roles as mh','u.id','=','mh.model_id')
             //   ->join('roles as r','r.id','=','mh.role_id')
             //   ->whereNull('u.deleted_at')
              //  ->where('r.id', '!=', 1)
              //  ->get();
        $datosUser = [];
        $cat_roles = Roles::all();
        $entes = EntesPulicos::where('activo', true)->get();
        //dd($datosUser);

        return view('admin.usuarios.inicio', compact("datosUser", 'cat_roles', 'entes'));
    }

    public function usuarios_entes($enteId){

        $datosUser = DB::table('users as u')
            ->select('p.rfc', 'p.curp', 'p.nombre', 'p.primer_ap', 'p.segundo_ap', 'p.email', 'p.telefono', 'pf.id_tipo_contratacion',
                'p.id as id_persona', 'r.id as role_id', 'pf.id as id_puesto_funcional', 'pf.puesto_funcional',
                'ua.id as id_unidad_admin', 'ua.unidad_admin', 'ep.id as id_ente_publico', 'ep.ente_publico')
            ->join('personas as p','u.id_persona','=','p.id')
            ->join('model_has_roles as mh','u.id','=','mh.model_id')
            ->join('roles as r','r.id','=','mh.role_id')
            ->join('puestos_persona as pp', 'pp.id_persona', '=', 'p.id' )
            ->join('puestos_funcionales as pf', 'pf.id', '=', 'pp.id_puesto_funcional')
            ->join('unidades_admin as ua', 'ua.id', '=', 'pf.id_unidad_admin')
            ->join('entes_publicos as ep', 'ep.id', '=', 'ua.id_ente_publico')
            ->whereNull('u.deleted_at')
            ->whereNull('fecha_termino')
            ->where('ep.id',  $enteId)
            ->where('r.id',  4)
            ->get();
        $cat_roles = Roles::all();
        $entes = EntesPulicos::where('activo', true)->get();
        $entePublico = EntesPulicos::find($enteId);
        //dd($datosUser);

        return view('admin.usuarios.inicio', compact("datosUser", 'cat_roles', 'entes', 'enteId', 'entePublico'));
    }

    public function buscar_curp(Request $request){
        if(strlen($request->curp) != 18){
            return 'false';
        }
        $usuarioEncontrado = $this->wsRenapo->getCurp($request);
        if($usuarioEncontrado){
            return $usuarioEncontrado;
        }
         return 'false';
    }

    public function buscar_curp_manual_registros(Request $request){
        if(strlen($request->curp) != 18){
            $data = array(
                'error'=>"3",
                'mensaje' => "No cumple con la longitud!",
                'estatus' => 'false');
            return compact("data");
            /* return 'no cumple con la longitud'; */
        }

        $usuarioEncontrado = $this->wsRenapo->getCurp($request);
        $validarExistenciaCurp = $this->wsRenapo->buscaCurp($request);
        /* dd($usuarioEncontrado); */
        if($usuarioEncontrado['error'] == "EXITOSO" && !$validarExistenciaCurp){
            /* dd($usuarioEncontrado); */
            $data = array(
                'error'=>"3",
                'mensaje' => $usuarioEncontrado,
                'estatus' => 'true');
            return compact('data');
        }
        $data = array(
            'error'=>"3",
            'mensaje' => "CURP no encontrado en RENAPO!",
            'estatus' => 'false');
        return $usuarioEncontrado['error'] == "NO EXITOSO"?compact('data'):$validarExistenciaCurp;
    }
    public function buscar_rfc(Request $request){
        if(strlen($request->rfc) != 13){
            return 'false';
        }
        $usuarioEncontrado = $this->wsCapitalH->buscaRfcPonentes($request);
        if($usuarioEncontrado){
            return $usuarioEncontrado;
        }
        return 'false';
    }
    public function buscar_rfc_oci(Request $request){
        if(strlen($request->rfc) != 13){
            return 'false';
        }
        $usuarioEncontrado = $this->wsCapitalH->buscaRfc($request);
        if($usuarioEncontrado){
            /* dd($usuarioEncontrado); */
            $entidad = Auth::user()->persona->puesto_persona->first()->puesto_funcional->unidad_admin->ente_publico;
            $enteDeLapersonaQueseBusca = UnidadesAdmin::find($usuarioEncontrado['datosUA'][0]->id)->ente_publico;
            if($entidad->id !== $enteDeLapersonaQueseBusca->id){
                $usuarioEncontrado['mismaEntidad'] = false;
                return $usuarioEncontrado;
            }
            $usuarioEncontrado['mismaEntidad'] = true;
            return $usuarioEncontrado;
        }
        return 'false';
    }


    public function obtener_usuario(Request $request){
        $persona = DB::table('users as u')
            ->select('p.rfc', 'p.curp', 'p.nombre', 'p.primer_ap', 'p.segundo_ap', 'p.email', 'p.telefono', 'pf.id_tipo_contratacion',
                'p.id as id_persona', 'r.id as role_id', 'pf.id as id_puesto_funcional', 'pf.puesto_funcional',
                'ua.id as id_unidad_admin', 'ua.unidad_admin', 'ep.id as id_ente_publico', 'ep.ente_publico')
            ->join('personas as p','u.id_persona','=','p.id')
            ->join('model_has_roles as mh','u.id','=','mh.model_id')
            ->join('roles as r','r.id','=','mh.role_id')
            ->join('puestos_persona as pp', 'pp.id_persona', '=', 'p.id' )
            ->join('puestos_funcionales as pf', 'pf.id', '=', 'pp.id_puesto_funcional')
            ->join('unidades_admin as ua', 'ua.id', '=', 'pf.id_unidad_admin')
            ->join('entes_publicos as ep', 'ep.id', '=', 'ua.id_ente_publico')
            ->whereNull('u.deleted_at')
            ->whereNull('fecha_termino')
            ->where('p.id',  $request->get('id'))
            ->first();

        if($persona){
            $datosUniAdm = UnidadesAdmin::getUnidades($persona->id_ente_publico);
            $puestos = DB::table("puestos_funcionales")
                ->select("id","puesto_funcional")
                ->where("id_unidad_admin","=", $persona->id_unidad_admin)
                ->where("activo","=","true")
                ->get();
            return ['mensaje' => [
                'persona' => $persona,
                'unidades' => $datosUniAdm,
                'puestos' => $puestos
                ], 'codigo' => 200];
        }
        return ['mensaje' => $persona, 'codigo' => 206];
    }

    public function borrar_usuario(Request $request){
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
    public function buscar_cargos(Request $request){
        $areaId = $request->get('areaId');
        $tipoC = $request->get('tipoContratacion');
        $cargos = DB::table('puestos_funcionales')
            ->where('id_unidad_admin', $areaId)
            ->where('id_tipo_contratacion', $tipoC)
        ->get();
        if(!$cargos){
            return ['mensaje' => 'No hay cagos o puestos registrados en la BD', 'codigo' => 206];
        }
        return ['mensaje' => $cargos, 'codigo' => 200];
    }

    public function reportes(){
        //TODO::SCAR LOS EVENTOS TODOS
        $estatusCancelado = CatStatus::where('clave_status','X')->get();
        $bloques = Bloque::where('activo', true)->whereNotIn('status_id',$estatusCancelado->pluck('id'))->publicado()->orderBy('fecha_inicio')->orderBy('hora_inicio')->get();
        return view('admin.reportes.mostrar_reportes',compact('bloques'));
    }

    public function generar_pdf(){

      $total_rep_fisica = DB::table('profesionales_persona')->join('personas', 'personas.id', '=', 'profesionales_persona.id_persona')->where('id_tipo_prof','=',2)->where('tipo_persona','=','F')->count();
      $total_rep_moral = DB::table('profesionales_persona')->join('personas', 'personas.id', '=', 'profesionales_persona.id_persona')->where('id_tipo_prof','=',2)->where('tipo_persona','=','M')->count();
      $total_dro = DB::table('profesionales_persona')->where('id_tipo_prof','=',3)->count();
      $total_pdu = DB::table('profesionales_persona')->where('id_tipo_prof','=',4)->count();
      $total_psa = DB::table('profesionales_persona')->where('id_tipo_prof','=',5)->count();
      $total_ta = DB::table('profesionales_persona')->where('id_tipo_prof','=',6)->count();
      $total_cri = DB::table('profesionales_persona')->where('id_tipo_prof','=',7)->count();
      $total_crs = DB::table('profesionales_persona')->where('id_tipo_prof','=',8)->count();
      $total_crd = DB::table('profesionales_persona')->where('id_tipo_prof','=',9)->count();
      $total_usuarios=$total_rep_fisica+$total_rep_moral+$total_dro+$total_pdu+$total_psa+$total_ta+$total_cri+$total_crs+$total_crd;

      $total_pruvi=DB::table('programas_proyecto')->where('id_programa','=',1)->count();
      $total_norma=DB::table('programas_proyecto')->where('id_programa','=',2)->count();
      $total_norma26=DB::table('programas_proyecto')->where('id_programa','=',3)->count();
      $total_programas=$total_pruvi+$total_norma+$total_norma26;

      $porcentaje_pruvi=round(($total_pruvi/$total_programas)*100,2,PHP_ROUND_HALF_ODD);
      $porcentaje_norma=round(($total_norma/$total_programas)*100,2,PHP_ROUND_HALF_ODD);
      $porcentaje_norma26=round(($total_norma26/$total_programas)*100,2,PHP_ROUND_HALF_ODD);

      $personas_registradas=DB::table('personas')->where('es_empleado','=','f')->get();

      $total_proyectos=DB::table('proyectos')->where('activo','=','t')->count();
      // se obtienen proyectos
      $array_proyectos=array();
      $array_proyectos_porcentaje=array();
      foreach ($personas_registradas as $personas){
        $tota_proyectos=DB::table('proyectos')->where('activo','=','t')->where('id_persona','=',$personas->id)->count();
        $array_proyectos[$personas->id]=$tota_proyectos;
        $array_proyectos_porcentaje[$personas->id]=round(($tota_proyectos/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);
      }

      //obtiene estatus proyectos
      $array_estatus=array();
      $array_actividades=array();
      $desc_proyectos=DB::table('proyectos')->select('proyectos.id','proyectos.nombre_proyecto','detalles_proyecto.folio_cuzus')->join('detalles_proyecto', 'detalles_proyecto.id_proyecto', '=', 'proyectos.id')->where('activo','=','t')->get();

      foreach ($desc_proyectos as $pro){
        $estatus=DB::table('etapas_proyecto')->join('cat_etapas', 'cat_etapas.id', '=', 'etapas_proyecto.id_etapa')->where('activo','=','t')->where('id_proyecto','=',$pro->id)->get();
        $array_estatus[$pro->id]=$estatus[0]->etapa;
        //obtiene tareas
        $total_actividades_seduvi = DB::table('procesos')->join('actividades', 'actividades.id_proceso', '=', 'procesos.id')->join('laborales_persona', 'laborales_persona.id_persona', '=', 'procesos.owner')->where('id_proyecto',$pro->id)->where('id_uniadm',2)->where('actividades.id_status','!=',3)->count();
        $total_actividades_sedema = DB::table('procesos')->join('actividades', 'actividades.id_proceso', '=', 'procesos.id')->join('laborales_persona', 'laborales_persona.id_persona', '=', 'procesos.owner')->where('id_proyecto',$pro->id)->where('id_uniadm',1)->where('actividades.id_status','!=',3)->count();
        $total_actividades_saf = DB::table('procesos')->join('actividades', 'actividades.id_proceso', '=', 'procesos.id')->join('laborales_persona', 'laborales_persona.id_persona', '=', 'procesos.owner')->where('id_proyecto',$pro->id)->where('id_uniadm',3)->where('actividades.id_status','!=',3)->count();
        $total_actividades_sacmex = DB::table('procesos')->join('actividades', 'actividades.id_proceso', '=', 'procesos.id')->join('laborales_persona', 'laborales_persona.id_persona', '=', 'procesos.owner')->where('id_proyecto',$pro->id)->where('id_uniadm',4)->where('actividades.id_status','!=',3)->count();
        $total_actividades_servimet = DB::table('procesos')->join('actividades', 'actividades.id_proceso', '=', 'procesos.id')->join('laborales_persona', 'laborales_persona.id_persona', '=', 'procesos.owner')->where('id_proyecto',$pro->id)->where('id_uniadm',5)->where('actividades.id_status','!=',3)->count();

        $array_actividades[$pro->id]['seduvi']=$total_actividades_seduvi;
        $array_actividades[$pro->id]['sedema']=$total_actividades_sedema;
        $array_actividades[$pro->id]['saf']=$total_actividades_saf;
        $array_actividades[$pro->id]['sacmex']=$total_actividades_sacmex;
        $array_actividades[$pro->id]['servimet']=$total_actividades_servimet;

      }

      //obtiene proyectos por alcaldia
      $array_proyectos_alcaldia=array();
      $array_proyectos_alcaldia_porcentaje=array();

      $proyectos_alcaldia_ao=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',1)->count();
      $proyectos_alcaldia_azcapo=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',2)->count();
      $proyectos_alcaldia_bj=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',3)->count();
      $proyectos_alcaldia_coy=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',4)->count();
      $proyectos_alcaldia_cdm=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',5)->count();
      $proyectos_alcaldia_cua=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',6)->count();
      $proyectos_alcaldia_gam=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',7)->count();
      $proyectos_alcaldia_iztac=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',8)->count();
      $proyectos_alcaldia_iztapa=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',9)->count();
      $proyectos_alcaldia_lmc=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',10)->count();
      $proyectos_alcaldia_mh=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',11)->count();
      $proyectos_alcaldia_ma=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',12)->count();
      $proyectos_alcaldia_tlah=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',13)->count();
      $proyectos_alcaldia_tlal=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',14)->count();
      $proyectos_alcaldia_vc=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',15)->count();
      $proyectos_alcaldia_xochi=DB::table('proyectos')->join('cat_colonias', 'cat_colonias.id', '=', 'proyectos.id_colonia')->where('id_alcaldia','=',16)->count();

      $array_proyectos_alcaldia['ao']=$proyectos_alcaldia_ao;
      $array_proyectos_alcaldia_porcentaje['ao']=round(($proyectos_alcaldia_ao/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['azcapo']=$proyectos_alcaldia_azcapo;
      $array_proyectos_alcaldia_porcentaje['azcapo']=round(($proyectos_alcaldia_azcapo/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['bj']=$proyectos_alcaldia_bj;
      $array_proyectos_alcaldia_porcentaje['bj']=round(($proyectos_alcaldia_bj/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['coy']=$proyectos_alcaldia_coy;
      $array_proyectos_alcaldia_porcentaje['coy']=round(($proyectos_alcaldia_coy/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['cdm']=$proyectos_alcaldia_cdm;
      $array_proyectos_alcaldia_porcentaje['cdm']=round(($proyectos_alcaldia_cdm/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['cua']=$proyectos_alcaldia_cua;
      $array_proyectos_alcaldia_porcentaje['cua']=round(($proyectos_alcaldia_cua/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['gam']=$proyectos_alcaldia_gam;
      $array_proyectos_alcaldia_porcentaje['gam']=round(($proyectos_alcaldia_gam/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['iztac']=$proyectos_alcaldia_iztac;
      $array_proyectos_alcaldia_porcentaje['iztac']=round(($proyectos_alcaldia_iztac/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['iztapa']=$proyectos_alcaldia_iztapa;
      $array_proyectos_alcaldia_porcentaje['iztapa']=round(($proyectos_alcaldia_iztapa/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['lmc']=$proyectos_alcaldia_lmc;
      $array_proyectos_alcaldia_porcentaje['lmc']=round(($proyectos_alcaldia_lmc/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['mh']=$proyectos_alcaldia_mh;
      $array_proyectos_alcaldia_porcentaje['mh']=round(($proyectos_alcaldia_mh/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['ma']=$proyectos_alcaldia_ma;
      $array_proyectos_alcaldia_porcentaje['ma']=round(($proyectos_alcaldia_ma/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['tlah']=$proyectos_alcaldia_tlah;
      $array_proyectos_alcaldia_porcentaje['tlah']=round(($proyectos_alcaldia_tlah/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['tlal']=$proyectos_alcaldia_tlal;
      $array_proyectos_alcaldia_porcentaje['tlal']=round(($proyectos_alcaldia_tlal/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['vc']=$proyectos_alcaldia_vc;
      $array_proyectos_alcaldia_porcentaje['vc']=round(($proyectos_alcaldia_vc/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $array_proyectos_alcaldia['xochi']=$proyectos_alcaldia_xochi;
      $array_proyectos_alcaldia_porcentaje['xochi']=round(($proyectos_alcaldia_xochi/$total_proyectos)*100,2,PHP_ROUND_HALF_ODD);

      $pdf = PDF::loadView('admin.reportes.pdf', compact('total_dro','total_pdu','total_psa','total_ta','total_cri','total_crs','total_crd','total_rep_fisica','total_rep_moral','total_usuarios','total_pruvi','total_norma','total_norma26','porcentaje_pruvi','porcentaje_norma','porcentaje_norma26','personas_registradas','array_proyectos','array_proyectos_porcentaje','desc_proyectos','array_estatus','array_actividades','array_proyectos_alcaldia','array_proyectos_alcaldia_porcentaje'));
      $pdf->setPaper('letter', 'landscape');
      return $pdf->download('archivo.pdf');

      //return view('admin.reportes.pdf');

    }

    public function data_listar_usuarios(){
        $personas = Personas::all();
        $usuarios = User::all();
        //$rolesUsuariosNuevos = Roles::whereIn('id', array(2,3,9,10,11,12,13))->get();
        $rolesUsuariosNuevos = Roles::all();
        $roles = Roles::all();
        $modelHasRoles = DB::table('model_has_roles')->get();
        $respuesta = ['mensaje' => [
            'usuarios' => $usuarios,
            'personas' => $personas,
            'roles' => $roles,
            'rolesParaUsuarios' => $rolesUsuariosNuevos,
            'model_has_roles' => $modelHasRoles
        ],
        'codigo' => 200];
        return $respuesta;
    }

    public function guardar_usuario(Request $request){
        //primero revisaremos que no exista un correo con ese correo
        try {
            DB::beginTransaction();
            $rfc = Personas::where('rfc', $request->get('rfc'))->first();
            $rfcEnUser = User::where('rfc', $request->get('rfc'))->first();
            if ($rfc && $rfcEnUser) {
                return ['mensaje' => 'Ya existe un usuario registrado con ese rfc', 'codigo' => 206];
            } else if (!$rfc && $rfcEnUser) {
                return ['mensaje' => 'Ya existe un usuario registrado con ese rfc', 'codigo' => 206];
            }
            //buscaremos su rol
            $rol = DB::table('roles')->where('id', '=', $request->get('perfil'))->first();


            //primero la personsa
            $nuevaPersona = new Personas();
            $nuevaPersona->curp = $request->get('curp');
            $nuevaPersona->rfc = $request->get('rfc').$request->get('homoclave');
            $nuevaPersona->nombre = $request->get('nombre');
            $nuevaPersona->primer_ap = $request->get('paterno');
            $nuevaPersona->segundo_ap = $request->get('materno');
            $nuevaPersona->email = $request->get('correo');
            $nuevaPersona->telefono = $request->get('telefono');
            $nuevaPersona->id_status_persona = 'A';
            $nuevaPersona->created_at = date('Y-m-d');
            $nuevaPersona->save();

            //ahora creamos su puesto
            $nuevoPuesto = new PuestosPersona();
            $nuevoPuesto->id_persona = $nuevaPersona->id;
            $nuevoPuesto->id_puesto_funcional = $request->get('cargo');
            $nuevoPuesto->fecha_inicial = date('Y-m-d');
            $nuevoPuesto->created_at = date('Y-m-d');
            $nuevoPuesto->id_tipo_desempeno = 'T';
            $nuevoPuesto->save();



            $nuevoUsuarioId = DB::table('users')->insertGetId([
                'rfc' => strtoupper($request->get('rfc').$request->get('homoclave')),
                'activo' => false,
                'id_persona' => $nuevaPersona->id,
            ]);

            $user = User::find($nuevoUsuarioId);

            //asignar roles
            $user->assignRole($rol->name);
            $idUsuario =  Hashids::encode($nuevoUsuarioId);
            $url = url('activar/' . $idUsuario);
            $entidad = $nuevaPersona->puesto_persona->first()->puesto_funcional->unidad_admin->ente_publico;
            $envioMail =Correo::sendEmailActivateUser(['email' => $nuevaPersona->email, 'id_usuario' => $idUsuario]);
            DB::commit();

            return ['mensaje' => ['mensaje' => 'Se guardo correctamente el nuevo usuario', 'entePub' => $entidad], 'codigo' => 200];
        } catch (\Exception $e){
            DB::rollBack();
            return ['mensaje' => 'No se guardo el usuario, revisa tus datos', 'codigo' => 206];
        }
    }

    public function editar_usuario(Request $request){
        //primero revisaremos que no exista un correo con ese correo
        try {
            DB::beginTransaction();
            $rfc = Personas::where('rfc', $request->get('rfcE'))->first();
            $rfcEnUser = User::where('rfc', $request->get('rfcE'))->first();
            if ($rfc && $rfcEnUser) {
                return ['mensaje' => 'Ya existe un usuario registrado con ese rfc', 'codigo' => 206];
            } else if (!$rfc && $rfcEnUser) {
                return ['mensaje' => 'Ya existe un usuario registrado con ese rfc', 'codigo' => 206];
            }
            //buscaremos su rol
            $rol = DB::table('roles')->where('id', '=', $request->get('perfilE'))->first();


            //primero la personsa
            $persona = Personas::find($request->get('hashidE'));
            $persona->curp = $request->get('curpE');
            $persona->rfc = $request->get('rfcE').$request->get('homoclaveE');
            $persona->nombre = $request->get('nombreE');
            $persona->primer_ap = $request->get('paternoE');
            $persona->segundo_ap = $request->get('maternoE');
            $persona->email = $request->get('correoE');
            $persona->telefono = $request->get('telefonoE');
            $persona->created_at = date('Y-m-d');
            $persona->save();

            //ahora creamos su puesto
            $puesto = $persona->puesto_persona->whereNull('fecha_termino')->first();
            $puesto->fecha_termino= date('Y-m-d');
            $puesto->save();

            $nuevoPuesto = new PuestosPersona();
            $nuevoPuesto->id_persona = $persona->id;
            $nuevoPuesto->id_puesto_funcional = $request->get('cargoE');
            $nuevoPuesto->fecha_inicial = date('Y-m-d');
            $nuevoPuesto->created_at = date('Y-m-d');
            $nuevoPuesto->id_tipo_desempeno = 'T';
            $nuevoPuesto->save();


            DB::commit();

            return ['mensaje' => 'Se guardaron los datos correctamente', 'codigo' => 200];
        } catch (\Exception $e){
            DB::rollBack();
            return ['mensaje' => 'No se guardo el usuario, revisa tus datos', 'codigo' => 206];
        }
    }
    public function eliminarUsuario(Request $request){

    }

    public function registrar_cargo(Request $request){
        try{
            DB::beginTransaction();

            /*$nuevoPF = new PuestosFuncionales();
            $nuevoPF->puesto_funcional = $request->get('puesto');
            $nuevoPF->created_at = date('Y-m-d');
            $nuevoPF->id_unidad_admin = $request->get('areaId');
            $nuevoPF->id_tipo_contratacion = $request->get('tipoContratacion');
            $nuevoPF->nivel = 20;
            $nuevoPF->activo = true;
            $nuevoPF->save();
            */
            $ultimoID = DB::table('puestos_funcionales')->select('id')->latest('id')->first();
            $id = (intval($ultimoID->id) + 1);
            DB::table('puestos_funcionales')->insert([
                'id' => $id,
                'puesto_funcional' => $request->get('puesto'),
                'created_at' => date('Y-m-d'),
                'id_unidad_admin' => $request->get('areaId'),
                'id_tipo_contratacion' => $request->get('tipoContratacion'),
                'nivel' => 20,
                'activo' => true
            ]);

            DB::commit();
           return ['mensaje' => ['mensaje' => 'registro correcto', 'id' => $id], 'codigo' => 200];

        } catch (\Exception $e){
            //dd($e);
            DB::rollBack();
            return ['mensaje' => 'No se guardo el usuario, revisa tus datos', 'codigo' => 206];
        }
    }
}
