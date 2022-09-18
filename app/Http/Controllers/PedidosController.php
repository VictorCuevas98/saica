<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use App\CatAlmacen;
use App\CatPartidaEspecifica;
use App\CatTipoSolicitudAbastecimiento;
use App\SolicitudAbastecimiento;
use App\UnidadesAdmin;
use App\PuestosFuncionalesTemp;
use App\SolicitudAbastecimientoDetalle;
use App\CatArtmed;
use App\GenerarClave\NumeroSolicitudAbastecimiento;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function pedidosProgramacion(){

        $almacenes = CatAlmacen::all();
        $partidaEspesificas = CatPartidaEspecifica::all();
        $tipoSolicitudAbastecimiento = CatTipoSolicitudAbastecimiento::select('id', 'tipo_solicitud_abastecimiento',
        'activo')->where('activo', true)->get();
        $periodos = \DB::table('cat_periodos')->get();
        $unidadAdministrativa = UnidadesAdmin::all();
     

    	return view('pedidos.crearPedido',compact('almacenes','partidaEspesificas', 'tipoSolicitudAbastecimiento', 'unidadAdministrativa', 'periodos'));
    }
    public function cargoselect($id){
     
        $select = PuestosFuncionalesTemp::select('id','id_unidad_admin','puesto_funcional')->where('id_unidad_admin',$id)->get();
        
        return $select;
        
    }
    
      
    public  function guardarPedidosProgramacion(Request $request){
        //dd($request);
      $remitente_id_puesto_persona;
      
      if(count(Auth::user()->persona->puesto_persona) < 1){
        $remitente_id_puesto_persona = 125;
      }else{
        $remitente_id_puesto_persona = Auth::user()->persona->puesto_persona->id;
      }

      $tipo = $request->tipo;
      //$partidaPresupuestal = $request->partidaPresupuestal;
      $ObjNumeroPedido = new NumeroSolicitudAbastecimiento();
      $tabla = 'solicitudes_abastecimiento';
      $campo = 'num_solicitud_abastecimiento';
      $generarNumeroPedido = $ObjNumeroPedido->obtenerNumero($tipo, $tabla, $campo);
       
               
          try{
           DB::beginTransaction();
             $guardarPedido =  new SolicitudAbastecimiento();
             $guardarPedido->id_tipo_solicitud_abastecimiento = $request->tipo;
             $guardarPedido->num_solicitud_abastecimiento = $generarNumeroPedido;
             $guardarPedido->id_almacen = $request->solicita;
             $guardarPedido->id_periodo = $request->periodo;
             $guardarPedido->id_unidad_admin = $request->UnidadAdministrativa;
             $guardarPedido->id_puesto_persona = $remitente_id_puesto_persona;
             $guardarPedido->observaciones = $request->observaciones;
             $guardarPedido->activo= true;
             $guardarPedido->created_at = date('Y-m-d H:i:s');
             $guardarPedido->save();
             DB::commit();
            // return response()->json(['message'=> 'El registro se creo correctamente', 'code' => 'CDC001'],200);
             $response = ['success' => true, 'msg' => 'El registro se creo correctamente'];
             //return response()->json(['success'=> true, 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);
             
        }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                $response = ['success' => false,'msg' => 'No se pudo crear el pedido'];
                //return response()->json(['success' => false, 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }

            return $response;
    
    }
  
      
    

    /*public function guardar(Request $request){
    	$fecha_solicitud = $request->fec_env_sol;
    	$tipo_solicitud = $request->get('tipo_contrato');
		dd($tipo_solicitud);
	}*/

    public function consultarPedidos(){

        $almacenes = CatAlmacen::all();

        return view('pedidos.consultarPedido', compact('almacenes'));
    }


    public function seguimientoPedidos(){

        return view('pedidos.seguimientoPedido');
    }


    public function consultarPedidosRecibido(){

        return view('pedidos.consultarPedidoRecibido');
    }


    public function agregarArticulos(Request $request){

        $folio = SolicitudAbastecimiento::select('id','num_solicitud_abastecimiento')->orderBy('id','desc')->first();

        return view('pedidos.agregarArticulo',compact('folio'));
    }

    public function guardarArticulos(Request $request){
        
       $clave = $id_artmed = \Hashids::decode($request->id_artmed)[0];
      
       $solicitud = SolicitudAbastecimiento::select('id')->orderBy('id','desc')->first();
       $id= $solicitud->id;
        try{
             DB::beginTransaction();
             $GuardaArticilos = new SolicitudAbastecimientoDetalle;
             $GuardaArticilos->id = $id;
             $GuardaArticilos->id_artmed = $clave;
             $GuardaArticilos->cantidad_unidades_solicitada = $request->cantidad;
             $GuardaArticilos->cantidad_unidades_autorizada ='0' ;
             $GuardaArticilos->cantidad_unidades_otorgada ='0' ;
             $GuardaArticilos->observaciones = $request->observaciones;
             $GuardaArticilos->activo = true;
             $GuardaArticilos->created_at = date('Y-m-d H:i:s');
             $GuardaArticilos->save();
              DB::commit();
               $respuesta= ['success' => true, 'msg' => 'El registro se creo correctamente'];
        }catch(Exception $e){
             DB::rollback();
              $respuesta = ['success' => false,'msg' => 'Articulo ya agregado'];
 
    }  
             return $respuesta;
    }
    public function tabaArticulo(){

       $solicitud = SolicitudAbastecimiento::select('id')->orderBy('id','desc')->first();
       $id= $solicitud->id;
       $tabla= DB::table('solicitudes_abastecimiento_detalle')->join('solicitudes_abastecimiento','solicitudes_abastecimiento.id','=','solicitudes_abastecimiento_detalle.id')->join('cat_artmed','cat_artmed.id','=','solicitudes_abastecimiento_detalle.id_artmed')->select('solicitudes_abastecimiento_detalle.id','solicitudes_abastecimiento_detalle.id_artmed','solicitudes_abastecimiento_detalle.cantidad_unidades_solicitada','cat_artmed.clave_artmed','cat_artmed.artmed')->where('solicitudes_abastecimiento_detalle.id','=', $id)->where('solicitudes_abastecimiento_detalle.activo','=' ,true)->get();
        return Datatables::of($tabla)->toJson(); 

    }  
     public function editarArticulo(Request $request){ 
        try{
             $id=$request->id;
             $id_artmed=$request->id_artmed;
             $idArticulo = SolicitudAbastecimientoDetalle::UPDATE($id);
             $idArticulo =$id_artmed;
             $idArticulo->cantidad_unidades_solicitada = $request->Cantidad1; 
             $idArticulo->updated_at = date('Y-m-d H:i:s');
             $idArticulo->save();
             DB::commit();
               $respuesta= ['success' => true, 'msg' => 'El registro se creo correctamente'];
        }catch(Exception $e){
             DB::rollback();
              $respuesta = ['success' => false,'msg' => 'ocurrio un error'];
 
    }  
             return $respuesta;
        }

        
      // $id=$request->id;

      // $editar= SolicitudAbastecimientoDetalle::join('cat_artmed','cat_artmed.id','=','solicitudes_abastecimiento_detalle.id_artmed')->select('solicitudes_abastecimiento_detalle.id','solicitudes_abastecimiento_detalle.id_artmed','cat_artmed.clave_artmed','solicitudes_abastecimiento_detalle.cantidad_unidades_solicitada')->where('solicitudes_abastecimiento_detalle.id_artmed',1)->where('solicitudes_abastecimiento_detalle.id', 25 )->where('solicitudes_abastecimiento_detalle.activo','=' ,true)->get();
      // dd($editar);
    // return view('pedidos.modals.modificarPedidoModal');
    
     public function eliminar($id)
    {
     
     $activo=false;
     $eliminar=SolicitudAbastecimientoDetalle::where('id',$id)->update(['activo'=>$activo]);
     
     
   }

    public function formatoPedido(){

        return view('pedidos.formatoPedido');
    }    

    public function seguimientoPedidosRecibido()
    {
        return view('pedidos.seguimientoPedidoRecibido');

    }
    

    public function formatoPedidoPDF(){

        $pdf = PDF::loadView('pedidos/formatoPedidoPDF');
        return $pdf->setPaper('a4', 'landscape')->stream('formatoPedido.pdf');
    }
   

}
