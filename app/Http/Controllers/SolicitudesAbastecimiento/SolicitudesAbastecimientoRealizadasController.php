<?php

namespace App\Http\Controllers\SolicitudesAbastecimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CatAlmacen;

class SolicitudesAbastecimientoRealizadasController extends Controller
{
    public function consultarPedidosRealizados(){

        $almacenes = CatAlmacen::all();

        return view('pedidos.consultarPedido', compact('almacenes'));
    }
}
