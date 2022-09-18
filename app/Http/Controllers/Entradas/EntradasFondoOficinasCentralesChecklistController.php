<?php

namespace App\Http\Controllers\Entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Adquisicion;
use App\CatPreguntaRevisionEntrada;
use App\CatTipoRevision;
use App\AdquisicionDocPago;
use App\Entrada;
use App\EntradaAdquisicion;
use App\EntradaAdquisicionRevision;
use App\CatTipoDocPago;
use App\CatTipoEntrada;
use App\CatAlmacen;
use App\CatStatusRevisionEntrada;
use App\EntradasAdquisicionRevisionStatus;

use Barryvdh\DomPDF\Facade as PDF;
class EntradasFondoOficinasCentralesChecklistController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMIN']);
    }

    public function index($adquisicionId){
        if(!Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista_de_revision.listar','entradas.contratosCerrados.lista_de_revision.listar']))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $flagContratosAbiertos = Auth::user()->can('entradas.contratosAbiertos.lista_de_revision.listar');
        $flagContratosCerrados = Auth::user()->can('entradas.contratosCerrados.lista_de_revision.listar');
        return view('entradas.fondoOficina.checklist.index',compact('adquisicionId','adquisicion','flagContratosAbiertos','flagContratosCerrados'));
    }

    public function create($adquisicionId){
        if(!Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista_de_revision.crear','entradas.contratosCerrados.lista_de_revision.crear']))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');

        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $catTiposRevision = CatTipoRevision::activos()->orderBy('clave_tipo_revision')->get();
        $almacenes = CatAlmacen::all();
        return view('entradas.fondoOficina.checklist.create',compact('adquisicionId','adquisicion','catTiposRevision','almacenes'));
    }

    public function store(Request $request,$adquisicionId){
        if(!Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista_de_revision.crear','entradas.contratosCerrados.lista_de_revision.crear']))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');


        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        DB::beginTransaction();
        try {
            $catTipoDocPago = CatTipoDocPago::where('clave_tipo_doc_pago','REM')->activos()->get();
            $nuevoDocumentoDePago = AdquisicionDocPago::create([
                'id_tipo_doc_pago'=>$catTipoDocPago->first()->id,
                'num_doc_pago'=>'',
                'monto_subtotal'=>0,
                'monto_impuesto'=>0,
                'monto_total'=>0,
                'id_adquisicion'=>$adquisicion->id,
                'activo'=>true,
            ]);
            $catTipoEntrada = CatTipoEntrada::where('clave_tipo_entrada','EPA')->get();
            $puestoPersona = Auth::user()->persona->puesto_persona()->activo()->get();
            $almacen = CatAlmacen::where('clave_almacen',$request->almacen)->get();
            $nuevaEntrada = Entrada::create([
                'id_tipo_entrada'=>$catTipoEntrada->first()->id,
                'folio_entrada'=>$request->folio_de_revision,
                'fecha_entrada'=>$request->fecha_de_entrada,
                'id_puesto_persona'=>$puestoPersona->first()->id ,
                'id_almacen'=>$almacen->first()->id,
                'activo'=>true,
            ]);

            $nuevaEntradaAdquisicion = EntradaAdquisicion::create([
                'id'=>$nuevaEntrada->id,
                'monto_subtotal'=>0,
                'monto_impuesto'=>0,
                'monto_total'=>0,
                'id_adquisicion_doc_pago'=>$nuevoDocumentoDePago->id,
                'id_pedido_contrato_abierto' => null, //TODO:: DEBO DE PREGUNTAR ESTE DATO O BSYUCARLO
                'activo'=>true,
            ]);


            //INSERTAMOS LAS RESPÚESTAS A LAS PREGUNTAS
            $preguntas = CatPreguntaRevisionEntrada::activos()->get();
            foreach ($preguntas as $pregunta) {
                if(isset($request->respuestas)){
                    $respuesta = (in_array($pregunta->clave_pregunta, $request->respuestas))? true : false;
                }else{
                    $respuesta = false;
                }
                EntradaAdquisicionRevision::create([
                    'id_entrada'=>$nuevaEntrada->id,
                    'id_pregunta'=>$pregunta->id,
                    'respuesta'=>$respuesta,
                    'id_puesto_persona'=>$puestoPersona->first()->id,
                    'activo'=>true,
                ]);
            }//END FOREACH PREGUNTAS


            //ESTATUS DE LA ENTRADA
            $respuestasIncumplidas = $nuevaEntrada->entradaAdquisicion->respuestasRevision()->where('respuesta',false)->get();
            if(isset($request->aprobada)){
                //SELCCIONADO APROBACION
                if($respuestasIncumplidas->count()>0){
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','AO')->get();
                }else{
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','A')->get();
                }
            }else{
                //NO SELECCIONADO LA APROBACION
                if($respuestasIncumplidas->count()>0){
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','R')->get();
                }else{
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','A')->get();
                }
            }

            $nuevoEstatusEntrada = EntradasAdquisicionRevisionStatus::create([
                'id_entrada_adquisicion'=>$nuevaEntradaAdquisicion->id,
                'id_status_revision_entrada'=>$statusEntrada->first()->id,
                'id_puesto_persona'=>$puestoPersona->first()->id,
                'activo'=>true,
            ]);
            

            DB::commit();
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
        }
        return redirect()->route('entradas.fondoOficinas.checklist.index',$adquisicionId);
        

    }

    public function show($adquisicionId,$entradaId){ 
        $entrada = Entrada::find(Hashids::decode($entradaId)[0]);
        //TIPOS DE REVISIONES QUE TIENEN RESPUESTAS
        $catTiposRevision = CatTipoRevision::whereHas('catPreguntasRevision', function ($query) use($entrada) {
            $query->whereHas('respuestasRevision', function ($query) use($entrada){
                $query->where('id_entrada', $entrada->id);
            });
        })->orderBy('clave_tipo_revision')->get();
        return view('entradas.fondoOficina.checklist.show',compact('adquisicionId','entradaId','entrada','catTiposRevision'));
    }

    public function edit($adquisicionId,$entradaId){
        if(!Auth::user()->hasAnyPermission('entradas.contratosAbiertos.lista_de_revision.editar','entradas.contratosCerrados.lista_de_revision.editar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');

        $almacenes = CatAlmacen::all();
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $entrada = Entrada::find(Hashids::decode($entradaId)[0]);
        //TIPOS DE REVISIONES QUE TIENEN RESPUESTAS
        $catTiposRevision = CatTipoRevision::whereHas('catPreguntasRevision', function ($query) use($entrada) {
            $query->whereHas('respuestasRevision', function ($query) use($entrada){
                $query->where('id_entrada', $entrada->id);
            });
        })->orderBy('clave_tipo_revision')->get();
        return view('entradas.fondoOficina.checklist.edit',compact('adquisicionId','adquisicion','entrada','entradaId','catTiposRevision','almacenes'));
    }

    public function update(Request $request,$adquisicionId,$entradaId){
        if(!Auth::user()->hasAnyPermission('entradas.contratosAbiertos.lista_de_revision.editar','entradas.contratosCerrados.lista_de_revision.editar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        DB::beginTransaction();
        try {
            $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
            $entrada = Entrada::find(Hashids::decode($entradaId)[0]);
            $entrada->folio_entrada = $request->folio_de_revision;
            $entrada->fecha_entrada=$request->fecha_de_entrada;
            $entrada->save();
            $puestoPersona = Auth::user()->persona->puesto_persona()->activo()->get();

            //registro de las respuestas 
            foreach ($entrada->entradaAdquisicion->respuestasRevision as $respuestaRev) {
                if(isset($request->respuestas)){
                    $respuesta = (in_array($respuestaRev->pregunta->clave_pregunta, $request->respuestas))? true : false;
                }else{
                    $respuesta = false;
                }
                EntradaAdquisicionRevision::updateOrCreate(
                    ['id_entrada' => $entrada->id, 'id_pregunta' => $respuestaRev->id_pregunta],
                    ['respuesta' => $respuesta, 'id_puesto_persona' => $puestoPersona->first()->id , 'activo'=>true ]
                );               
            }//END FOREACH PREGUNTAS
            //DESACTIVAR STATUS ACTIVOS DE LA REVISION
            $registrosDesactivados = $entrada->entradaAdquisicion->desactivarEstatusRevision();
            $respuestasIncumplidas = $entrada->entradaAdquisicion->respuestasRevision()->where('respuesta',false)->get();
            if(isset($request->aprobada)){
                if($respuestasIncumplidas->count()>0){
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','AO')->get();
                }else{
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','A')->get();
                }
            }else{
                //NO SELECCIONADO LA APROBACION
                if($respuestasIncumplidas->count()>0){
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','R')->get();
                }else{
                    $statusEntrada = CatStatusRevisionEntrada::where('clave_status_revision_entrada','A')->get();
                }
            }
            $nuevoEstatusEntrada = EntradasAdquisicionRevisionStatus::create([
                'id_entrada_adquisicion'=>$entrada->id,
                'id_status_revision_entrada'=>$statusEntrada->first()->id,
                'id_puesto_persona'=>$puestoPersona->first()->id,
                'activo'=>true,
            ]); 
            DB::commit();
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
        }
        return redirect()->route('entradas.fondoOficinas.checklist.index',$adquisicionId);
    }
    public function epaDescarga(Request $request,$adquisicionId,$entradaId){
        //$pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        if($adquisicion->contratos->count()<=0)
             abort(503,'Lo sentimos pero no hay ningún contrato relacionado');
        $entrada = Entrada::find(Hashids::decode($entradaId)[0]);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf = PDF::loadView('entradas.fondoOficina.checklist.epa.epaPdf',compact('adquisicionId','entradaId','adquisicion','entrada'));
        //$pdf->set_base_path("/www/public/css/");
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('EPA.pdf');
        //return $pdf->download('archivo.pdf');

    }

}
