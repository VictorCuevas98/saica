<?php

namespace App\Http\Controllers\Entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Str; //para el random
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use \Illuminate\Pagination\Paginator;


use App\Adquisicion;
use App\Proveedor;
use App\CatStatusAdquisicion;
use App\Contratos;
use App\CatTipoContrato;
use App\CatTipoDocContrato;

class EntradasFondoOficinasCentralesController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMIN']);
    }

    public function index(){

        if(!Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista','entradas.contratosCerrados.listar']))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');

        $catStatusAdquisicion = CatStatusAdquisicion::activos()->get();
        return view('entradas.fondoOficina.index',compact('catStatusAdquisicion'));
    }
    public function create(){
        //la vista del modal que crear se incluyó dentro del archivo entradas.fondoOficina.index

        if(!Auth::user()->can('entradas.contratosAbiertos.crear'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');

        return view('entradas.fondoOficina.apertura.create_wizard');
    }

    public function store(Request $request){
        
        if(!Auth::user()->can('entradas.contratosAbiertos.crear'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        DB::beginTransaction();
        try {
            $proveedor = Proveedor::where('rfc',$request->rfc_del_proveedor)->get();
            if($proveedor->count()>0){
                $proveedor = $proveedor->first();
            }else{
                //NO EXISTE EL PROVEEDOR, crearlo
                $proveedor = Proveedor::create([
                    'rfc'=>$request->rfc_del_proveedor,
                    'tipo_persona'=>$request->tipo_de_persona,
                    'fisica_nombre'=>$request->nombres,
                    'fisica_primer_ap'=>$request->primer_apellido,
                    'fisica_segundo_ap'=>$request->segundo_apellido,
                    'razon_social'=>$request->razon_social_del_proveedor,
                    'representante_legal'=>$request->representante_del_proveedor,
                    'activo'=> true,
                ]);
            }

            $puestoPersona = Auth::user()->persona->puesto_persona()->activo()->get();
            $statusAdquisicion = CatStatusAdquisicion::where('clave_status_adquisicion','A')->get();

            $query = Adquisicion::query();
            $query = (is_null($request->numero_de_requisicion))? $query : $query->where('num_requisicion', $request->numero_de_requisicion );
            $query = (is_null($request->oficio_de_adjudicacion))? $query : $query->orWhere('num_oficio_adjudicacion', $request->oficio_de_adjudicacion );
            $query = (is_null($request->numero_de_contrato))? $query : $query->orWhereHas('contratos', function ( $query) use($request) {
                $query->where('num_contrato',  $request->numero_de_contrato);
            });
            $adquisicion = $query->get();
            
            if($adquisicion->count()>0){
                $adquisicion = $adquisicion->first();
            }else{
                $adquisicion = Adquisicion::create([
                    'id_tipo_adquisicion'=>null,
                    'num_carpeta'=>Adquisicion::getNumCarpeta(),
                    'num_requisicion'=>$request->numero_de_requisicion,
                    'fecha_adjudicacion'=>null,
                    'num_oficio_adjudicacion'=>$request->oficio_de_adjudicacion,
                    'fecha_oficio_adjudicacion'=>null,
                    'monto_subtotal'=>null,
                    'monto_impuesto'=>null,
                    'monto_total'=>null,
                    'tiempo_entrega_dias'=>null,
                    'fecha_limite_entrega'=>null,
                    'id_status_adquisicion'=>$statusAdquisicion->first()->id,
                    'id_proveedor'=>$proveedor->id,
                    'id_puesto_persona'=>$puestoPersona->first()->id,
                    'activo'=>true,
                ]);
            }

            //CONSUTAR SI NO YA EXISTE EL CONTRATO O CREARLO, PUEDE EXISTIR UNA ADQUISICION SIN EL REGISTRO DEL CONTRATO
            if(!is_null($request->numero_de_contrato)){
                $contrato = $adquisicion->contratos()->where('num_contrato',$request->numero_de_contrato)->get();
                if($contrato->count()>0){
                    $contrato = $contrato->first();
                }else{
                    $tipoDeContrato = CatTipoContrato::where('clave_tipo_contrato','A')->get();
                    $catTipoDocContrato = CatTipoDocContrato::where('clave_tipo_doc_contrato','C')->get();
                    $contrato= Contratos::create([
                        'id_tipo_contrato'=>$tipoDeContrato->first()->id ,
                        'id_tipo_doc_contrato'=> $catTipoDocContrato->first()->id,
                        'num_contrato'=> $request->numero_de_contrato,
                        'fecha_contrato'=> null,
                        'id_adquisicion'=> $adquisicion->id,
                        'activo'=>true,
                    ]);
                }
            }

            $adquisicionId = Hashids::encode($adquisicion->id);
            DB::commit();
            return redirect()->route('entradas.fondoOficinas.checklist.index',$adquisicionId);
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
        }

    }

    //VISTA QUE MOSTRABA EL LAYOUT INICIAL QUE NORMAL MENTE TENDRÍA ESTADISTICAS
    public function edit($adquisicionId){
        //if(!Auth::user()->can('entradas.contratosAbiertos.editar'))
        //    abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        //return view('entradas.fondoOficina.layout',compact('adquisicionId','adquisicion'));
        return redirect()->route('entradas.fondoOficinas.checklist.index',[$adquisicionId]);
    }

    //EDITA LOS DATOS DE LA CARPETA
    public function carpetaEdit($adquisicionId){
        if(!Auth::user()->can('entradas.contratosAbiertos.editar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $contratoBase= $adquisicion->getContratoBase()->activos()->get();
        return view('entradas.fondoOficina.apertura.edit_wizard',compact('adquisicionId','adquisicion','contratoBase'));
    }

    public function update(Request $request,$adquisicionId){
        if(!Auth::user()->can('entradas.contratosAbiertos.editar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $puestoPersona = Auth::user()->persona->puesto_persona()->activo()->get();

        DB::beginTransaction();

        try {
            $proveedor = Proveedor::where('rfc',$request->rfc_del_proveedor)->get();
            if($proveedor->count()>0){
                $proveedor = $proveedor->first();
            }else{
                //NO EXISTE EL PROVEEDOR, crearlo
                $proveedor = Proveedor::create([
                    'rfc'=>$request->rfc_del_proveedor,
                    'tipo_persona'=>$request->tipo_de_persona,
                    'fisica_nombre'=>$request->nombres,
                    'fisica_primer_ap'=>$request->primer_apellido,
                    'fisica_segundo_ap'=>$request->segundo_apellido,
                    'razon_social'=>$request->razon_social_del_proveedor,
                    'representante_legal'=>$request->representante_del_proveedor,
                    'activo'=> true,
                ]);
            }

            $adquisicion->num_requisicion = $request->numero_de_requisicion ;
            $adquisicion->num_oficio_adjudicacion = $request->oficio_de_adjudicacion ;
            $adquisicion->save();


            //CONSUTAR SI NO  EXISTE EL CONTRATO O CREARLO,
            if(!is_null($request->numero_de_contrato)){
                $contrato = $adquisicion->contratos()->where('num_contrato',$request->numero_de_contrato)->get();
                if($contrato->count()>0){
                    $contrato = $contrato->first();
                    $contrato->first()->update(['activo' => true]);
                }else{
                    $tipoDeContrato = CatTipoContrato::where('clave_tipo_contrato','A')->get();
                    $catTipoDocContrato = CatTipoDocContrato::where('clave_tipo_doc_contrato','C')->get();
                    $contrato= Contratos::create([
                        'id_tipo_contrato'=>$tipoDeContrato->first()->id ,
                        'id_tipo_doc_contrato'=> $catTipoDocContrato->first()->id,
                        'num_contrato'=> $request->numero_de_contrato,
                        'fecha_contrato'=> null,
                        'id_adquisicion'=> $adquisicion->id,
                        'activo'=>true,
                    ]);
                }
            }else{
                $contratoBase = $adquisicion->getContratoBase();
                if($contratoBase->get()->count()>0){
                    //EXISTE UN CONTRATO BASE
                    $contratoBase->update(['activo' => false]);
                }else{
                    //NO EXISTE CONTRATO BASE
                    //NO HACER NADA
                }
            }
            DB::commit();
            return redirect()->route('entradas.fondoOficinas.checklist.index',$adquisicionId);
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            DB::rollBack();
        }

    }
    
    public function show($adquisicionId){
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        dd($adquisicion);
        if(!Auth::user()->can('entradas.contratosAbiertos.ver_registro'))
            abort(403,'Lo sentimos pero no tienes los permisos para ver entradas por fondo de oficinas centrales');
        
        return view('entradas.fondoOficina.show',compact('adquisicionId','adquisicion'));
    }

    

    public function advanceSearh(Request $request){
        //dd($request->all());
        $responseArr = [];
        $start = $request->start;
        $end = $start + $request->length;
        $totalRows = 0;
        $paginate = $request->length;
        $query = Adquisicion::query();

        
        if(Auth::user()->can('entradas.contratosAbiertos.lista') && !Auth::user()->can('entradas.contratosCerrados.listar')){
            //SE AÑADE ESTA CONSULTA SI SOLO PUEDE VER CONTRATOS ABIERTOS
            $catTiposContrato = CatTipoContrato::where('clave_tipo_contrato','A')->get();
            $query = $query->whereHas('contratos', function ( $query) use($catTiposContrato) {
                $query->whereIn('id_tipo_contrato',$catTiposContrato->pluck('id'));
            }, '>=', 1)->orDoesnthave('contratos');
        }
        if(Auth::user()->can('entradas.contratosCerrados.listar') && !Auth::user()->can('entradas.contratosAbiertos.lista')){
            //SE AÑADE ESTA CONSULTA SI SOLO PUEDE VER CONTRATOS CERRADOS
            $catTiposContrato = CatTipoContrato::where('clave_tipo_contrato','C')->get();
            $catNotInTiposContrato = CatTipoContrato::where('clave_tipo_contrato','A')->get();
            $query = $query->whereHas('contratos', function ( $query) use($catTiposContrato) {
                $query->whereIn('id_tipo_contrato',$catTiposContrato->pluck('id'));
            }, '>=', 1);
        }
        
        foreach ($request->columns as $key => $column) {
            switch ($column['data']) {
                case 'id':
                    //--code
                    break;
                case 'estatus':
                    $query = (is_null($column['search']['value']))? $query : $query->where('id_status_adquisicion', $column['search']['value'] );
                    break;
                case 'num_oficio_adjudicacion':
                    $query = (is_null($column['search']['value']))? $query : $query->where('num_oficio_adjudicacion',  'ILIKE', '%'.$column['search']['value'].'%' );
                    break;
                case 'num_requisicion':
                    $query =  (is_null($column['search']['value']))? $query : $query->where('num_requisicion',  'ILIKE', '%'.$column['search']['value'].'%' );
                    break;
                case 'folio_adquisicion':
                    $query =  (is_null($column['search']['value']))? $query : $query->where('num_carpeta',  'ILIKE', '%'.$column['search']['value'].'%' );
                    break;
                case 'proveedor':
                    $proveedor = $column['search']['value'];
                    if(!is_null($proveedor)){
                        $query = $query->whereHas('proveedor', function ( $query) use($proveedor) {
                            $query->where('rfc',  'ILIKE', '%'.$proveedor.'%' )
                            ->orWhere('razon_social',  'ILIKE', '%'.$proveedor.'%' )
                            ->orWhereRaw('CONCAT(fisica_nombre, \' \', fisica_primer_ap, \' \', fisica_segundo_ap)  ILIKE ?', '%'.$proveedor.'%');
                        });
                    }
                    break;
                    case "num_contrato":
                    $contrato = $column['search']['value'];
                    if(!is_null($contrato)){
                        $query = $query->whereHas('contratos', function ( $query) use($contrato) {
                            $query->where('num_contrato',  'ILIKE', '%'.$contrato.'%' );
                        });
                    }
                    break;

                //TODO::FALTA LA BUSQUEDA POR FECHA DE CREACION
                case 'campo_n':
                    //code condition
                    break;
            }
        }

        $totalRows =  $query->count();
        $currentPage = ($totalRows / $paginate) - ( ($totalRows - $start) / $paginate ) + 1;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $resultadoBusqueda = $query->paginate($request->length);
        $responseArr = [];
        foreach ($resultadoBusqueda as $key => $row) {
            array_push($responseArr ,
                [
                    'acciones'=>null,
                    'id'=>Hashids::encode($row->id),
                    'folio_adquisicion'=> $row->num_carpeta ,
                    'proveedor'=>($row->proveedor->tipo_persona=='M') ? $row->proveedor->razon_social : $row->proveedor->fisica_nombre." ".$row->proveedor->fisica_primer_ap." ".$row->proveedor->fisica_segundo_ap,
                    'estatus'=> $row->statusAdquisicion->status_adquisicion,
                    'num_contrato'=> ($row->getContratoBase()->activos()->get()->count()>0) ? $row->getContratoBase()->activos()->get()->first()->num_contrato : null,
                    'num_oficio_adjudicacion'=> $row->num_oficio_adjudicacion,
                    'num_requisicion'=> $row->num_requisicion,
                    'creado_por'=>!is_null($row->puestoPersona) ? $row->puestoPersona->persona->nombre ." ".$row->puestoPersona->persona->primer_ap ." ".$row->puestoPersona->persona->segundo_ap : '',
                    'creado_el'=>$row->created_at,
                ]
            );
        }
        return ['data'=>$responseArr,'recordsFiltered'=>$totalRows, 'recordsTotal'=>$totalRows];
    }

    

   


}
