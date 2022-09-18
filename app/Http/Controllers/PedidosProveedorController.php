<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

//Modelos
use App\Proveedor;
use App\CatArtmed;
use App\CatAlmacen;
use App\Contratos;
use App\Adquisicion;
use App\CatTipoContrato;
use App\ContratoAbierto;
use App\ContratoAbiertoDetalle;
use App\PedidoContratoAbierto;
use App\PedidoDetalleContratoAbierto;
use App\CatTipoDocContrato;
use App\CatStatusAdquisicion;
use App\PedidosContratoAbiertoEtapas;
use App\CatEtapasPedido;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Redirect;

class PedidosProveedorController extends Controller
{
    public $basePathViews = "pedidos-proveedor";
    private $itemsPerPage = 5;
    //BEGIN: VIEW functions
    public function index(){
        $num_contrato = request()->query('contrato');
        $folio_pedido = request()->query('folio_pedido');
        $fecha_solicitud = request()->query('fecha_solicitud');
        $fecha_entrega = request()->query('fecha_entrega');
        $almacen = request()->query('almacen');
        $proveedor = request()->query('proveedor');
        //$pedidos_contrato_abierto = $this->getPedidosList($num_contrato,$fecha_solicitud,$almacen);
        $pedidos_contrato_abierto = $this->newGetPedidosList($num_contrato,$folio_pedido,$fecha_solicitud,$fecha_entrega,$almacen,$proveedor);
        //dd($pedidos_contrato_abierto);
        //$puesto_persona = request()->user()->persona->puesto_persona;
        //dd($puesto_persona);
        $almacenes = CatAlmacen::all();
        return view($this->basePathViews.'.index',compact('almacenes','pedidos_contrato_abierto'));
    }

    private function newGetPedidosList($num_contrato,$folio_pedido,$fecha_solicitud,$fecha_entrega,$almacen,$proveedor){
        $contratosIds = Contratos::where('num_contrato','like',"%$num_contrato%")->get()->pluck('id');
        if($fecha_solicitud == null && $almacen == null && $fecha_entrega == null && $proveedor == null && $folio_pedido == null && $num_contrato == null)
            //$pedidosContratoAbierto = PedidoContratoAbierto::paginate($this->itemsPerPage);
            $pedidosContratoAbierto = [];
        else if($fecha_solicitud != null && $almacen == null && $proveedor == null && $fecha_entrega == null && $folio_pedido == null && $num_contrato == null)
            $pedidosContratoAbierto = PedidoContratoAbierto::where('fecha_pedido','=',$fecha_solicitud)->paginate($this->itemsPerPage);
        //else if($almacen != null && $fecha_solicitud == null && $fecha_entrega == null && $proveedor == null && $folio_pedido == null && $num_contrato == null)
            //$pedidosContratoAbierto = PedidoContratoAbierto::where('id_almacen','=',$almacen)->paginate($this->itemsPerPage);
        else if($fecha_entrega != null && $fecha_solicitud == null && $almacen == null && $proveedor == null && $folio_pedido == null && $num_contrato == null)
            $pedidosContratoAbierto = PedidoContratoAbierto::where('fecha_entrega','=',$fecha_entrega)->paginate($this->itemsPerPage);
        else if($folio_pedido != null && $fecha_entrega == null && $fecha_solicitud == null && $almacen == null && $proveedor == null && $num_contrato == null)
            $pedidosContratoAbierto = PedidoContratoAbierto::where('folio_pedido','like',"%$folio_pedido%")->paginate($this->itemsPerPage);
        else if($num_contrato != null && $folio_pedido == null && $fecha_entrega == null && $fecha_solicitud == null && $almacen == null && $proveedor == null)
            $pedidosContratoAbierto = PedidoContratoAbierto::whereIn('id_contrato_abierto',$contratosIds)->paginate($this->itemsPerPage);
        else
            $pedidosContratoAbierto = PedidoContratoAbierto::where('fecha_pedido','=',$fecha_solicitud)
            ->orWhere('fecha_entrega','=',$fecha_entrega)
           // ->orWhere('id_almacen','=',$almacen)
            ->orWhere('folio_pedido','like',"%$folio_pedido%")
            ->whereIn('id_contrato_abierto', $contratosIds)
            ->paginate($this->itemsPerPage);
        return $pedidosContratoAbierto;
    }

    public function createView(){
        $almacenes = CatAlmacen::all();
        return view($this->basePathViews.'.create',compact('almacenes'));
    }

    public function articlesView($pedidoId){
        $pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        if($pedido == null)
            return abort(404,'Lo sentimos, el pedido no existe.');
        $almacenes = CatAlmacen::all();
        $contrato = Contratos::where('id','=',$pedido->id_contrato_abierto)->first();
        return view($this->basePathViews.'.articles-edit',compact('contrato','pedido','almacenes'));
    }
    //END: VIEW functions


    //BEGIN: API functions
    public function create(Request $request){
        $data = request()->validate([
            'contratoInput' => 'required|string',
            'solicitudInput' => 'required',
            'folio' => 'required',
            //'almacen' => 'required',
            'entregaInput' => 'required'
        ]);
        $contrato = Contratos::where('num_contrato','=',$request->contratoInput)->first();
        if($contrato == null)
            return response()->json(['message' => 'La solicitud no pudo ser creada por que el contrato no fue encontrado, verifíquelo nuevamente.'],404);

        if(PedidoContratoAbierto::where('folio_pedido','=',$data['folio'])/*->where('id_contrato_abierto','=',$contrato->id)*/->count() > 0){
            //return Redirect::back()->withErrors(['folio' => 'El folio ya se encuentra utilizado en otro pedido.']);
            return response()->json(['message' => 'El folio ya se encuentra utilizado por otro pedido.'],421);
        }
        $contratoAbierto = ContratoAbierto::where('id','=',$contrato->id)->first();
        if($contratoAbierto == null)
            $contratoAbierto = ContratoAbierto::create([
                'id' => $contrato->id,
                'created_at' => $contrato->created_at
            ]);
        //$folio = $this->generaFolioPedido();
        //TODO: obtener los datos hardcodeados
        $puesto_persona = request()->user()->persona->puesto_persona->first();
        if($puesto_persona != null){
            $catEtapaPedido = CatEtapasPedido::where('clave_etapa_pedido','=','PRO')->first();
            $pedido = PedidoContratoAbierto::create([
                'folio_pedido' => $data['folio'],
                'fecha_pedido' => $request->solicitudInput,
                'fecha_entrega' => $request->entregaInput,
                'id_puesto_persona' => $puesto_persona->id,
                'id_contrato_abierto' => $contratoAbierto->id,
                //'id_almacen' => $request->almacen,
                'activo' => true
            ]);
            PedidosContratoAbiertoEtapas::create([
                'id_pedido_contrato_abierto' => $pedido->id,
                'id_etapa_pedido' => $catEtapaPedido->id,
                'activo' => true
            ]);
            //return redirect('/pedidos-proveedor/'.Hashids::encode($pedido->id).'/articles-edit');
            return response()->json(['message' => 'Pedido creado correctamente.', 'id' => Hashids::encode($pedido->id) ],200);
            //return redirect('/pedidos-proveedor/'.Hashids::encode($pedido->id).'/articles-edit');
        }else{
            return response()->json(['message' => 'El usuario no cuenta con un puesto activo, no puede se puede continuar con la operación.'],422);
        }
    }

    private function generaFolioPedido(){
        $folio = 'PCA-'.date('Y').'-'.strtoupper(Str::random(4));
        if(DB::table('pedidos_contrato_abierto')->where('folio_pedido','=',$folio)->count() == 0)
            return $folio;
        else
            return $this->generaFolioPedido();
    }

    public function consultaArticuloEnDetalle($pedidoId,$articuloId){
        $pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        $artmed= CatArtmed::hashid($articuloId)->first();
        if($pedido == null || $artmed == null){return response()->json(['message' => 'Bad request.'],400);}
        
        $contratoDetalle = ContratoAbiertoDetalle::where('id','=', $pedido->id_contrato_abierto)
        ->where('id_artmed','=',$artmed->id)->first();
        return response()->json([
            'articulo' => [
                'id' => $artmed->getHashid(),
                'clave_artmed' => $artmed->clave_artmed,
                'artmed' => $artmed->artmed,
                'id_cabms' => $artmed->id_cabms,
                'unidad_medida' =>  $artmed->unidad_medida
            ],
            'existe' => $contratoDetalle == null ? false : true,
            'precio' => $contratoDetalle == null ? 0 : (float)$contratoDetalle->monto_unitario_fijo
        ],200);
    }

    public function finalizaPedido($pedidoId,Request $request){
        $pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        if($pedido == null)
            return response()->json(['message' => 'Bad request.'],400);
        if(count($pedido->detalles) == 0){
            return response()->json(['message' => 'No puedes finalizar un pedido sin artículos.'],422);
        }
        $etapa = $pedido->getCurrentEtapa();
        if($etapa != null){
            $etapa->activo = false;
            $etapa->save();
        }
        $catEtapaPedido = CatEtapasPedido::where('clave_etapa_pedido','=','RCH')->first();
        //$catEtapaPedido = CatEtapasPedido::where('clave_etapa_pedido','=','REV')->first();
        $nuevaEtapa = PedidosContratoAbiertoEtapas::where('id_pedido_contrato_abierto','=', $pedido->id)->where( 'id_etapa_pedido', '=', $catEtapaPedido->id)->first();
        if($nuevaEtapa == null){
            PedidosContratoAbiertoEtapas::create([
                'id_pedido_contrato_abierto' => $pedido->id,
                'id_etapa_pedido' => $catEtapaPedido->id,
                'activo' => true
            ]);
        }else{
            $nuevaEtapa->activo = true;
            $nuevaEtapa->save();
        }
        return response()->json(['message' => 'Estatus del pedido actualizado correctamente.'],200);
    }

    public function actualizaDetalle($pedidoId,Request $request){
        //dd($pedidoId,$request->action,$request->articulo);
        $pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        if($pedido == null || $request->action == null || $request->articulo == null)
            return response()->json(['message' => 'Bad request.'],400);
        $artmed = CatArtmed::where('clave_artmed','=',$request->articulo['clave_artmed'])->first();
        if($pedido->getCurrentClaveEtapa() != "PRO"){
            $currentEtapa = $pedido->getCurrentEtapa();
            return response()->json(['message' => 'No puedes agregar articulos a un pedido con estatus: "'.$currentEtapa->etapa->etapa_pedido.'".'],422);
        }
        $idAlmacen = intval($request->articulo['id_almacen']);
        
        switch($request->action){
            case 'add':
                $contratoDetalle = ContratoAbiertoDetalle::where('id','=', $pedido->id_contrato_abierto)
                ->where('id_artmed','=',$artmed->id)->first();
                //$montoUnitario = $request->articulo['precio'];
                if($contratoDetalle == null){
                    //$montoUnitario = $request->articulo['precio'];
                    ContratoAbiertoDetalle::create([
                        'id' => $pedido->id_contrato_abierto,
                        //'partida' => 0,
                        'monto_unitario_fijo' => 0,
                        'id_artmed' => $artmed->id,
                        'activo' => true
                    ]);
                }else{
                    /*
                    $contratoDetalle->update([
                        'monto_unitario_fijo' => $montoUnitario
                    ]);
                    */
                    //$montoUnitario = $contratoDetalle->monto_unitario_fijo;
                }
                //$subtotal = $montoUnitario*$request->articulo['cantidad'];
                //$impuesto = $subtotal * 0.16;
                //$total = $subtotal + $impuesto;
                $pedidoDetalle = PedidoDetalleContratoAbierto::create([
                    'id_contrato_abierto' => $pedido->id_contrato_abierto,
                    'id_artmed' => $artmed->id,
                    'cantidad_unidades' => $request->articulo['cantidad'],
                    'id_pedido_contrato_abierto' => $pedido->id,
                    'id_almacen' => $idAlmacen,
                    'activo' => true
                ]);
                break;
            case 'update':
                $currentPedidoDetalle = PedidoDetalleContratoAbierto::where('id_artmed', $artmed->id)
                ->where('id_contrato_abierto','=', $pedido->id_contrato_abierto)
                ->where('id_pedido_contrato_abierto','=', $pedido->id)->first();
                if($currentPedidoDetalle != null){
                    $contratoDetalle = ContratoAbiertoDetalle::where('id','=', $pedido->id_contrato_abierto)
                    ->where('id_artmed','=',$artmed->id)->first();
                    if($contratoDetalle != null){
                        /*
                        $montoUnitario = $request->articulo['precio'];
                        $contratoDetalle->update([
                            'monto_unitario_fijo' => $montoUnitario
                        ]);
                        $subtotal = $montoUnitario*$request->articulo['cantidad'];
                        $impuesto = $subtotal * 0.16;
                        $total = $subtotal + $impuesto;
                        */
                        $currentPedidoDetalle->update([
                            'cantidad_unidades' => $request->articulo['cantidad'],
                            'id_almacen' => $idAlmacen
                            //'monto_unitario' => $montoUnitario,
                            //'monto_subtotal' => $subtotal,
                            //'monto_impuesto' => $impuesto,
                            //'monto_total' => $total
                        ]);
                    }
                }
                break;
            case 'delete':
                $currentPedidoDetalle = PedidoDetalleContratoAbierto::where('id_artmed', $artmed->id)
                ->where('id_contrato_abierto','=', $pedido->id_contrato_abierto)
                ->where('id_pedido_contrato_abierto','=', $pedido->id)->first();
                if($currentPedidoDetalle != null)
                    $currentPedidoDetalle->delete();
                break;
        }
        
        return response()->json([
            'message' => 'success'
        ],200);
    }

    public function buscaArticulo($claveArticulo){
        $articulo = CatArtmed::where('clave_artmed','=',$claveArticulo)->first();
        if($articulo != null) {
            return response()->json($articulo);
        }else{
            return response()->json([
                'message' => 'Clave no encontrada, pruebe con otra.'
            ],404);
        }
    }

    public function validaContrato(Request $request){
        $numero_contrato = $request->query('contrato');
        //$numero_requisicion = $request->query('numero_requisicion');
        $oficio_adjudicacion = $request->query('oficio_adjudicacion');
        //$folio = $request->query('folio');
        if($oficio_adjudicacion == null)
            return response()->json(['message' => 'Bad Request'],400);
        $puesto_persona = request()->user()->persona->puesto_persona->first();
        if($puesto_persona == null)
            return response()->json(['message' => 'El usuario no cuenta con un puesto activo, no se puede continuar con la operación.'],422);

        //Iniciamos variables de modelo a nulo
        $contrato = null;
        $adquisicion = null;
        $proveedor = null;
        //Buscamos el contrato
        if($numero_contrato != null)
            $contrato = Contratos::where('num_contrato','=',$numero_contrato)->first();
        $catTipoContrato = CatTipoContrato::where('clave_tipo_contrato','=','A')->first();
        $catTipoDocContrato = CatTipoDocContrato::where('clave_tipo_doc_contrato','=','C')->first();
        if($contrato == null){
            //No existe entonces, vemos si existe la adquisicion
            $adquisicion = Adquisicion::where('num_oficio_adjudicacion','=',$oficio_adjudicacion)->first();
            /*
            if($numero_requisicion != null)
                $adquisicion = Adquisicion::where('num_requisicion','=',$numero_requisicion)->first();
            else if($oficio_adjudicacion != null)
                $adquisicion = Adquisicion::where('num_oficio_adjudicacion','=',$oficio_adjudicacion)->first();
            */
            if($adquisicion == null){
                //no existe, la creamos
                $statusAdquisicion = CatStatusAdquisicion::where('clave_status_adquisicion','=','A')->first();
                /*
                $adquisicion = Adquisicion::create([
                    'id_status_adquisicion' => $statusAdquisicion->id,
                    'id_puesto_persona' => $puesto_persona->id,
                    'num_carpeta' => Adquisicion::getNumCarpeta(),
                    //'folio_adquisicion' => $folio,
                    //'num_requisicion' => $numero_requisicion,
                    'num_oficio_adjudicacion' => $oficio_adjudicacion,
                    'activo' => true
                ]);
                */
            }else{
                //existe, obtenemos su proveedor
                $proveedor = Proveedor::where('id','=',$adquisicion->id_proveedor)->first();
                $contrato = $adquisicion->contratos()->where('num_contrato','=',$numero_contrato)->first();
            }
            //creamos el contrato
            if($contrato == null){
                /*
                $contrato = Contratos::create([
                    'id_tipo_doc_contrato' => $catTipoDocContrato->id,
                    'id_tipo_contrato' => $catTipoContrato->id,
                    'num_contrato' => $numero_contrato,
                    'id_adquisicion' => $adquisicion->id,
                    'activo' => true
                ]);
                ContratoAbierto::create([
                    'id' => $contrato->id,
                    'created_at' => $contrato->created_at
                ]);*/
            }
        }else{ // existe el contrato por ende existe una adquisicion, la buscamos
            $adquisicion = Adquisicion::where('id','=',$contrato->id_adquisicion)->first();
            $proveedor = Proveedor::where('id','=',$adquisicion->id_proveedor)->first();
        }
        
        return response()->json(['message' => 'success','proveedor' => $proveedor, 'contrato' => $contrato,'adquisicion' => $adquisicion],200);
        /*
        if($contrato != null && $adquisicion != null){
            return response()->json(['message' => 'success','proveedor' => $proveedor, 'contrato' => $contrato,'adquisicion' => $adquisicion],200);
        }else
            return response()->json(['message' => 'Algo salio mal!'],500);*/
    }

    public function actualizaProveedor($contratoId,Request $request){
        if($contratoId == null || $request->proveedor == null)
            return response()->json(['message' => 'Bad Request'],400);

        $contrato = Contratos::where('id','=',$contratoId)->first();
        if($contrato != null){
            $adquisicion = $contrato->adquisicion;
            if($request->tipo == 'manual'){
                $requestData = $request->datos;
                $prov = Proveedor::where('rfc','=', $requestData['rfc'])->first();
                if($prov == null){
                    if($requestData['tipo_persona'] == 'F'){
                        $prov = Proveedor::create([
                            'rfc' => $requestData['rfc'],
                            'tipo_persona' => $requestData['tipo_persona'],
                            'fisica_nombre' => $requestData['nombres'],
                            'fisica_primer_ap' => $requestData['primer_apellido'],
                            'fisica_segundo_ap' => $requestData['segundo_apellido'],
                            'representante_legal' => $requestData['representante_legal'],
                            'activo' => true
                        ]);
                    }else{
                        $prov = Proveedor::create([
                            'rfc' => $requestData['rfc'],
                            'tipo_persona' => $requestData['tipo_persona'],
                            'razon_social' => $requestData['razon_social_del_proveedor'],
                            'representante_legal' => $requestData['representante_legal'],
                            'activo' => true
                        ]);
                    }
                    $adquisicion->id_proveedor = $prov->id;
                    $adquisicion->save();
                }
            }else{
                $proveedor = Proveedor::where('rfc','=',$request->proveedor)->first();
                $adquisicion->id_proveedor =$proveedor->id;
                $adquisicion->save();
            }
            return response()->json(['message' => 'Proveedor seleccionado correctamente.'],200);
        }else
            return response()->json(['message' => 'El contrato no existe.'],404);

    }

    public function creaPedidoConProveedor(Request $request){
        $requestData = $request->datos;
        $numero_contrato = $requestData['contrato'];
        $oficio_adjudicacion = $requestData['oficio_adjudicacion'];
        if($oficio_adjudicacion == null || $numero_contrato == null)
            return response()->json(['message' => 'El oficio de adjudicacion y numero de contrato son obligatorios.'],400);
        $puesto_persona = request()->user()->persona->puesto_persona->first();
        if($puesto_persona == null)
            return response()->json(['message' => 'El usuario no cuenta con un puesto activo, no se puede continuar con la operación.'],422);


        $adquisicion = Adquisicion::where('num_oficio_adjudicacion','=',$oficio_adjudicacion)->first();
        if($adquisicion == null){
            //no existe, la creamos
            if($request->tipo == 'manual'){
                
                $proveedor = Proveedor::where('rfc','=', $requestData['rfc'])->first();
                if($proveedor == null){
                    if($requestData['tipo_persona'] == 'F'){
                        $proveedor = Proveedor::create([
                            'rfc' => $requestData['rfc'],
                            'tipo_persona' => $requestData['tipo_persona'],
                            'fisica_nombre' => $requestData['nombres'],
                            'fisica_primer_ap' => $requestData['primer_apellido'],
                            'fisica_segundo_ap' => $requestData['segundo_apellido'],
                            'representante_legal' => $requestData['representante_legal'],
                            'activo' => true
                        ]);
                    }else{
                        $proveedor = Proveedor::create([
                            'rfc' => $requestData['rfc'],
                            'tipo_persona' => $requestData['tipo_persona'],
                            'razon_social' => $requestData['razon_social_del_proveedor'],
                            'representante_legal' => $requestData['representante_legal'],
                            'activo' => true
                        ]);
                    }
                    //$adquisicion->id_proveedor = $prov->id;
                    //$adquisicion->save();
                }
            }else{
                $proveedor = Proveedor::where('rfc','=',$request->proveedor)->first();
                //$adquisicion->id_proveedor =$proveedor->id;
                //$adquisicion->save();
            }
            $statusAdquisicion = CatStatusAdquisicion::where('clave_status_adquisicion','=','A')->first();
            $adquisicion = Adquisicion::create([
                'id_status_adquisicion' => $statusAdquisicion->id,
                'id_puesto_persona' => $puesto_persona->id,
                'num_carpeta' => Adquisicion::getNumCarpeta(),
                'id_proveedor' => $proveedor->id,
                'num_oficio_adjudicacion' => $oficio_adjudicacion,
                'activo' => true
            ]);
            $catTipoContrato = CatTipoContrato::where('clave_tipo_contrato','=','A')->first();
            $catTipoDocContrato = CatTipoDocContrato::where('clave_tipo_doc_contrato','=','C')->first();
            $contrato = Contratos::create([
                'id_tipo_doc_contrato' => $catTipoDocContrato->id,
                'id_tipo_contrato' => $catTipoContrato->id,
                'num_contrato' => $numero_contrato,
                'id_adquisicion' => $adquisicion->id,
                'activo' => true
            ]);
            ContratoAbierto::create([
                'id' => $contrato->id,
                'created_at' => $contrato->created_at
            ]);
            return response()->json(['message' => 'Correcto.' , 'adquisicion' => $adquisicion, 'contrato' => $contrato],200);
        }else{
            return response()->json(['message' => 'Ocurrio un error.'],400);
        }
    }

    public function descargaPedido($pedidoId,Request $request){
        $pedido = PedidoContratoAbierto::hashid($pedidoId)->first();
        if($pedido == null)
            return abort(404,'Lo sentimos, el pedido no existe.');
        $contrato = Contratos::where('id','=',$pedido->id_contrato_abierto)->first();
        $proveedor = json_decode($contrato->adquisicion->proveedor->ws_getDataGeneral($contrato->adquisicion->proveedor->rfc));
        $direccionProv = json_decode($contrato->adquisicion->proveedor->w_getDataFiscal($contrato->adquisicion->proveedor->rfc));
        if($proveedor->data == null || $direccionProv->data == null){
            return abort(500,'Ocurrio un error, favor de intentar mas tarde.');
        }
        //dd($pedido->almacen,$contrato->adquisicion->proveedor);
        $pdf = PDF::loadView('pedidos-proveedor.formato.pdf',compact('pedido','contrato','proveedor','direccionProv'));
        //$pdf->set_base_path("/www/public/css/");

        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('archivo.pdf');
        //return $pdf->download('archivo.pdf');

    }
}
