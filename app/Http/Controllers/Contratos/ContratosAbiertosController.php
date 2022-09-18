<?php

namespace App\Http\Controllers\Contratos;

use App\ContratoAbierto;
use App\ContratoAbiertoDetalle;
use App\Contratos;
use App\Http\Controllers\Controller;
use App\PedidoDetalleContratoAbierto;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class ContratosAbiertosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function storeContratoAbierto(Request $request)
    {
        $contrato = Contratos::where('num_contrato', $request->numero_contrato)->first();

        /*
         * if ($request->monto_minimo_a !== '') {
            $monto_subtotal_minimo = $request->monto_minimo_a;
            $monto_subtotal_maximo = $request->monto_maximo_a;

            $monto_impuesto_minimo = $monto_subtotal_minimo * .16;
            $monto_impuesto_maximo = $monto_subtotal_maximo * .16;

            $monto_total_minimo = $monto_subtotal_minimo + $monto_impuesto_minimo;
            $monto_total_maximo = $monto_subtotal_maximo + $monto_impuesto_maximo;
        } else {
        $monto_subtotal_minimo = null;
        $monto_subtotal_maximo = null;

        $monto_impuesto_minimo = null;
        $monto_impuesto_maximo = null;

        $monto_total_minimo = null;
        $monto_total_maximo = null;
        }

         */

        $contrato_abierto = ContratoAbierto::create([
            'id' => $contrato->id,
            'recursos_disponibles' => true,
        ]);

        return ['mensaje' => 'Se registro correctamente', 'id' => Hashids::encode($contrato->id)];
    }

    public function updateContratoAbierto($id){
        // Se actualiza el contrato cerrado
        $contrato_abierto = ContratoAbierto::find($id);
        if ($contrato_abierto != null){
            $contratos_abiertos_detalle = ContratoAbiertoDetalle::where('id', $id)->get();
            $monto_subtotal_minimo=0;
            $monto_impuesto_minimo=0;
            $monto_total_minimo=0;

            $monto_subtotal_maximo=0;
            $monto_impuesto_maximo=0;
            $monto_total_maximo=0;
            foreach ($contratos_abiertos_detalle as $item){
                $monto_subtotal_minimo += $item->monto_unitario_fijo * $item->cantidad_unidades_minima;
                $monto_subtotal_maximo += $item->monto_unitario_fijo * $item->cantidad_unidades_maxima;

                $monto_impuesto_minimo += $monto_subtotal_minimo * .16;
                $monto_impuesto_maximo += $monto_subtotal_maximo * .16;

                $monto_total_minimo += $monto_impuesto_minimo + $monto_subtotal_minimo;
                $monto_total_maximo += $monto_impuesto_maximo + $monto_subtotal_maximo;
            }
            $contrato_abierto->monto_subtotal_minimo = $monto_subtotal_minimo;
            $contrato_abierto->monto_impuesto_minimo = $monto_impuesto_minimo;
            $contrato_abierto->monto_total_minimo = $monto_total_minimo;
            $contrato_abierto->monto_subtotal_maximo = $monto_subtotal_maximo;
            $contrato_abierto->monto_impuesto_maximo = $monto_impuesto_maximo;
            $contrato_abierto->monto_total_maximo = $monto_total_maximo;
            $contrato_abierto->save();
        }
        return ['mensaje' => 'Se actualizo correctamente', 'id' => $contrato_abierto];
    }

    public function storeContratoAbiertoDetalle(Request $request)
    {
        $id_contrato = Hashids::decode($request->id_contrato);
        $id_artmed = Hashids::decode($request->id_artmed);
        $id_contrato = $id_contrato[0];
        $id_artmed = $id_artmed[0];

        if ($request->monto_del_articulo){
            $precio = (float) $request->monto_del_articulo;
        }

        if ($request->cantidad_minima){
            $cantidad_minima = (int) $request->cantidad_minima;
        }

        if ($request->cantidad_maxima){
            $cantidad_maxima = (int) $request->cantidad_maxima;
        }

        $contrato_abierto_detalle = ContratoAbiertoDetalle::where('id', $id_contrato)->where('id_artmed', $id_artmed)->first();
        if ($contrato_abierto_detalle == null){
            $quantity = ContratoAbiertoDetalle::where('id', $id_contrato)->get();
            $num = $quantity->count();
            $contrato_abierto_detalle = ContratoAbiertoDetalle::create([
                'id' => $id_contrato,
                'id_artmed' => $id_artmed,
                'partida' => $num + 1,
                'monto_unitario_fijo' => $precio,
                'cantidad_unidades_minima' => $cantidad_minima,
                'cantidad_unidades_maxima' => $cantidad_maxima,
                'activo' => true,
            ]);
            $this->updateContratoAbierto($contrato_abierto_detalle->id);
            $mensaje = 'Se agrego un artículo al contrato, exitosamente';
        }else{
            $contrato_abierto_detalle->monto_unitario_fijo = $precio;
            $contrato_abierto_detalle->cantidad_unidades_minima = $cantidad_minima;
            $contrato_abierto_detalle->cantidad_unidades_maxima = $cantidad_maxima;
            $contrato_abierto_detalle->save();
            $this->updateContratoAbierto($contrato_abierto_detalle->id);
            $mensaje = 'Se actualizó un artículo, exitosamente';
        }
        return ['mensaje' => $mensaje,'cantidad' => null, 'precio' => $precio, 'cantidad_minima'=> $cantidad_minima, 'cantidad_maxima' => $cantidad_maxima, 'hashid' => $id_contrato];
    }
    public function destroyContratoAbiertoDetalle($contrato_id, $element_id){

        $pedidos = PedidoDetalleContratoAbierto::where('id_contrato_abierto', $contrato_id)->where('id_artmed', $element_id)->delete();
        $deleted = ContratoAbiertoDetalle::where('id', $contrato_id)->where('id_artmed', $element_id)->delete();
        $this->updateContratoAbierto($contrato_id);

        //Actualizar partida
        $contratosArtmeds = ContratoAbiertoDetalle::where('id', $contrato_id)->get();
        $var = 1;
        foreach ($contratosArtmeds as $contratosArtmed){
            $contratosArtmed->partida = $var++;
            $contratosArtmed->save();
        }
        return $deleted;
    }
}
