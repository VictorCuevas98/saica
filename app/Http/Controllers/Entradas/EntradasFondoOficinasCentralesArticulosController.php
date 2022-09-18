<?php

namespace App\Http\Controllers\Entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\CatLaboratorio;
use App\Adquisicion;
use App\EntradaAdquisicionDetalle;
use App\EntradaAdquisicion;
use Carbon\Carbon;

class EntradasFondoOficinasCentralesArticulosController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMIN']);
    }

    public function index($adquisicionId,$entradaId){
        if(!Auth::user()->can('entradas.contratosAbiertos.articulos.listar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');

        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);       
        $articulos = $entradaAdquisicion->entradasAdquisicionDetalle()->activos()->get();
        return view('entradas.fondoOficina.articulos.articulosIndex',compact('adquisicionId','adquisicion','entradaId','articulos'));
    }

    public function articulosDatatable(Request $request,$adquisicionId,$entradaId){
        $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);
        $articulos = $entradaAdquisicion->entradasAdquisicionDetalle()->activos()->get();
        $data = [];
        foreach ($articulos as $key => $articulo) {
            $art =[
                $articulo->artmed->clave_artmed,
                $articulo->artmed->unidad_medida,
                $articulo->num_lote,
                $articulo->cantidad_unidades, //number_format($articulo->cantidad_unidades, 0, '.', ','),
                $articulo->monto_unitario, //number_format($articulo->monto_unitario, 2, '.', ','),
                $articulo->monto_impuesto, //number_format($articulo->monto_impuesto, 2, '.', ','),
                $articulo->monto_subtotal,
                $articulo->monto_total, //number_format($articulo->monto_total, 2, '.', ','),
                Carbon::parse($articulo->fecha_caducidad)->diffForHumans(), //$articulo->fecha_caducidad,
                Str::limit($articulo->artmed->artmed, $limit = 100, $end = '...').
                '
                <a href="#" id="" class="btn-xs  btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="'.$articulo->artmed->artmed.'">
                            <i class="fas fa-info "></i>
                        </a>
                ',
                '
                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details" id="articulo-btn-edit" data-articulo-id="'.Hashids::encode($articulo->id).'" data-articulo-artmed="'.$articulo->artmed->artmed.'">
                                    <i class="far fa-edit"></i>
                                </a>
                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" id="articulo-btn-delete" data-articulo-id="'.Hashids::encode($articulo->id).'" data-articulo-artmed="'.$articulo->artmed->artmed.'">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                '
            ];
            array_push($data, $art);
        }
        //array_push($data,['-','-','-','inidades','unitario','impuesto','total','cducidad','desc','acciones']);
        return ['data'=>$data];
    }

    public function create(Request $request,$adquisicionId,$entradaId ){
        if(!Auth::user()->can('entradas.contratosAbiertos.articulos.agregar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $articulo =  json_decode($request->input('articulo',true)) ;
        $catLaboratorio = CatLaboratorio::all();
        return view('entradas.fondoOficina.articulos.articulo_new_modal',compact('articulo','catLaboratorio','adquisicionId','adquisicion','entradaId'))->render();
    }

    public function store(Request $request , $adquisicionId,$entradaId){
        if(!Auth::user()->can('entradas.contratosAbiertos.articulos.agregar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        //dd($request->all());
        DB::beginTransaction();
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);
        $laboratorio = CatLaboratorio::where('clave_laboratorio',$request->laboratorio)->get();
        $artmed = Hashids::decode($request->artmed)[0];
        
        try {
            $cantidad_unidades = (int)str_replace(',', "", $request->cantidad);
            $monto_unitario  = (float) str_replace(',', "", $request->precio_unitario);
            $monto_subtotal =  $cantidad_unidades * $monto_unitario ;
            $monto_impuesto  = (isset($request->iva_check)) ?  $monto_subtotal * 0.16 :  $monto_subtotal * 0 ;

            $entradaAdquisicionDetalle = EntradaAdquisicionDetalle::create([
                'id_artmed'=>$artmed,
                'cantidad_unidades'=> $cantidad_unidades,
                'num_lote'=>$request->lote,
                'fecha_caducidad'=>$request->caducidad,
                'id_laboratorio'=>$laboratorio->first()->id,
                'monto_unitario'=>$monto_unitario,
                'monto_impuesto'=> $monto_impuesto,
                'monto_subtotal'=>$monto_subtotal, 
                'monto_total'=>  $monto_subtotal + $monto_impuesto,
                'id_entrada'=>$entradaAdquisicion->entrada->id,
                'activo'=>true,
            ]);
            DB::commit();
            return ['data'=>$entradaAdquisicionDetalle,'error'=>false,'msg','msgError'=>null];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__." -> ".$e->getMessage());
            return ['data'=>null,'error'=>true,'msg'=>null,'msgError'=>$e->getMessage()];
        }
        
    }

    
    public function destroy(Request $request, $adquisicionId, $entradaId, $articuloId){
        if(!Auth::user()->can('entradas.contratosAbiertos.articulos.quitar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        DB::beginTransaction();
        try {
            $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
            $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);
            $entradaAdquisicionDetalle = EntradaAdquisicionDetalle::find(Hashids::decode($articuloId)[0]);
            $entradaAdquisicionDetalle->activo = false;
            $entradaAdquisicionDetalle->save();
            DB::commit();
            return ['data'=>$entradaAdquisicionDetalle,'error'=>false,'msg'=>'Registro eliminado correctamente','msgError'=>null];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__." -> ".$e->getMessage());
            return ['data'=>null,'error'=>true,'msg'=>null,'msgError'=>$e->getMessage()];
        }

    }

    public function edit(Request $request,$adquisicionId,$entradaId ,$articuloId){
        //dd($request->all());
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);
        $entradaAdquisicionDetalle = EntradaAdquisicionDetalle::find(Hashids::decode($articuloId)[0]);
        $articulo = $entradaAdquisicionDetalle->artmed;
        $catLaboratorio = CatLaboratorio::all();

        return view('entradas.fondoOficina.articulos.articulo_edit_modal',compact('catLaboratorio','adquisicionId','adquisicion','entradaId','entradaAdquisicionDetalle','articuloId','articulo'))->render();
    }

    public function update(Request $request,$adquisicionId,$entradaId ,$articuloId){

        if(!Auth::user()->can('entradas.contratosAbiertos.articulos.agregar'))
            abort(403,'Lo sentimos pero no tienes los permisos para esta operación');
        DB::beginTransaction();
        try {
            $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
            $entradaAdquisicion = EntradaAdquisicion::find(Hashids::decode($entradaId)[0]);
            $laboratorio = CatLaboratorio::where('clave_laboratorio',$request->laboratorio)->get();
            $artmed = Hashids::decode($request->artmed)[0];

            $cantidad_unidades = (int)str_replace(',', "", $request->cantidad);
            $monto_unitario  = (float) str_replace(',', "", $request->precio_unitario);
            
            $monto_subtotal =  $cantidad_unidades * $monto_unitario ;
            $monto_impuesto  = (isset($request->iva_check)) ?  $monto_subtotal * 0.16 :  $monto_subtotal * 0 ;

            $entradaAdquisicionDetalle = EntradaAdquisicionDetalle::find(Hashids::decode($articuloId)[0]);
            $entradaAdquisicionDetalle->cantidad_unidades = $cantidad_unidades;
            $entradaAdquisicionDetalle->num_lote = $request->lote;
            $entradaAdquisicionDetalle->fecha_caducidad = $request->caducidad;
            $entradaAdquisicionDetalle->id_laboratorio = $laboratorio->first()->id;
            $entradaAdquisicionDetalle->monto_unitario = $monto_unitario;
            $entradaAdquisicionDetalle->monto_impuesto = $monto_impuesto;
            $entradaAdquisicionDetalle->monto_subtotal = $monto_subtotal;
            $entradaAdquisicionDetalle->monto_total = $monto_subtotal + $monto_impuesto;
            $entradaAdquisicionDetalle->save();

            DB::commit();
            return ['data'=>$entradaAdquisicionDetalle,'error'=>false,'msg'=>'Registro guardado correctamente','msgError'=>null];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__." -> ".$e->getMessage());
            return ['data'=>null,'error'=>true,'msg'=>null,'msgError'=>$e->getMessage()];
        }

    }
}
