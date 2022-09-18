<?php

namespace App\Http\Controllers\Contratos;

use App\CatAlmacen;
use App\ContratoCerrado;
use App\ContratoCerradoAbastecimiento;
use App\ContratoCerradoDetalle;
use App\Contratos;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class ContratosCerradosController extends ContratosAbiertosController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function storeContratoCerrado(Request $request)
    {
        $request->validate([
        ]);

            //Se crea el contrato cerrado
            $contrato = Contratos::where('num_contrato', $request->numero_contrato)->first();
            $contrato_cerrado = ContratoCerrado::create([
                'id' => $contrato->id,
                'monto_subtotal' => null,
                'monto_impuesto' => null,
                'monto_total' => null,
            ]);
        return ['mensaje' => 'Se registro correctamente', 'id' => Hashids::encode($contrato->id)];
    }

    public function updateContratoCerrado($id){
        // Se actualiza el contrato cerrado
        $contrato_cerrado = ContratoCerrado::find($id);
        if ($contrato_cerrado != null){
            $contratos_cerrados_detalle = ContratoCerradoDetalle::where('id', $id)->get();
            $monto_subtotal=0;
            $monto_impuesto=0;
            $monto_total=0;
            foreach ($contratos_cerrados_detalle as $item){
                $monto_subtotal += $item->monto_subtotal;
                $monto_impuesto += $item->monto_impuesto;
                $monto_total += $item->monto_total;
            }
            $contrato_cerrado->monto_subtotal = $monto_subtotal;
            $contrato_cerrado->monto_impuesto = $monto_impuesto;
            $contrato_cerrado->monto_total = $monto_total;
            $contrato_cerrado->save();
        }
        return ['mensaje' => 'Se actualizo correctamente', 'id' => $contrato_cerrado];
    }
    public function storeContratosCerradosDetalle(Request $request){

        $artmed = Hashids::decode($request->id_artmed);
        $contrato = Hashids::decode($request->id_contrato);
        $artmed = $artmed[0];
        $contrato = $contrato[0];
        $cantidad_unidades= (int) $request->cantidad_de_articulos;
        $monto_unitario = (float) $request->precio_del_articulo;
        $monto_subtotal = $cantidad_unidades * $monto_unitario;
        $monto_impuesto = $monto_subtotal * .16;
        $monto_total = $monto_impuesto + $monto_subtotal;

        $periodos = $request->periodos;


        $contrato_cerrado = ContratoCerradoDetalle::where('id', $contrato)->where('id_artmed', $artmed)->first();

        $mensaje = '';
        if ($contrato_cerrado !== null){
            $contrato_cerrado->cantidad_unidades = $cantidad_unidades;
            $contrato_cerrado->monto_unitario = $monto_unitario;
            $contrato_cerrado->monto_subtotal = $monto_subtotal;
            $contrato_cerrado->monto_impuesto = $monto_impuesto;
            $contrato_cerrado->monto_total = $monto_total;
            $contrato_cerrado->activo = true;
            $contrato_cerrado->save();
            $this->updateContratoCerrado($contrato_cerrado->id);
            $this->storeContratoCerradoAbastecimiento($contrato, $artmed, $periodos);
            $mensaje = 'Se actualizó un artículo al contrato, exitosamente';
        }else{
            $quantity = ContratoCerradoDetalle::where('id', $contrato)->get();
            $num = $quantity->count();
            $contrato_cerrado = new ContratoCerradoDetalle();
            $contrato_cerrado->id = $contrato;
            $contrato_cerrado->id_artmed = $artmed;
            $contrato_cerrado->partida = $num + 1;
            $contrato_cerrado->cantidad_unidades = $cantidad_unidades;
            $contrato_cerrado->monto_unitario = $monto_unitario;
            $contrato_cerrado->monto_subtotal = $monto_subtotal;
            $contrato_cerrado->monto_impuesto = $monto_impuesto;
            $contrato_cerrado->monto_total = $monto_total;
            $contrato_cerrado->activo = true;
            $contrato_cerrado->save();
            $this->updateContratoCerrado($contrato_cerrado->id);
            $this->storeContratoCerradoAbastecimiento($contrato, $artmed, $periodos);
            $mensaje = 'Se agregó un artículo al contrato, exitosamente';

        }

        $id = Hashids::encode($contrato_cerrado->id);
        return ['mensaje' => $mensaje,'cantidad' => $cantidad_unidades, 'precio' => $monto_unitario, 'hashid' => $id];
    }

    public function destroyContratoCerradoDetalle($contrato_id, $element_id){
        $del = ContratoCerradoAbastecimiento::where('id', $contrato_id)->where('id_artmed', $element_id)->delete();
        $deleted = ContratoCerradoDetalle::where('id', $contrato_id)->where('id_artmed', $element_id)->delete();
        $this->updateContratoCerrado($contrato_id);

        //Actualizar partida
        $contratosArtmeds = ContratoCerradoDetalle::where('id', $contrato_id)->get();
        $var = 1;
        foreach ($contratosArtmeds as $contratosArtmed){
            $contratosArtmed->partida = $var++;
            $contratosArtmed->save();
        }
        return $deleted;
    }

    public function storeContratoCerradoAbastecimiento($contrato, $artmed, $periodos){
        $almacen = CatAlmacen::where('clave_almacen', 'AC')->first();
        $contratos_cerrados_abastecimientos = ContratoCerradoAbastecimiento::where('id', $contrato)->where('id_artmed', $artmed)->delete();
        foreach ($periodos as $periodo){
            $contratos_cerrados_abastecimientos = new ContratoCerradoAbastecimiento();
            $contratos_cerrados_abastecimientos->id = $contrato;
            $contratos_cerrados_abastecimientos->id_artmed = $artmed;
            $contratos_cerrados_abastecimientos->id_almacen = $almacen->id;
            $contratos_cerrados_abastecimientos->fecha_inicio = DateTime::createFromFormat("d/m/Y", $periodo[0]);
            $contratos_cerrados_abastecimientos->fecha_termino = DateTime::createFromFormat("d/m/Y", $periodo[1]);
            $contratos_cerrados_abastecimientos->cantidad_unidades = $periodo[2];
            $contratos_cerrados_abastecimientos->activo = true;
            $contratos_cerrados_abastecimientos->save();
        }
        return $contratos_cerrados_abastecimientos;
    }
}
