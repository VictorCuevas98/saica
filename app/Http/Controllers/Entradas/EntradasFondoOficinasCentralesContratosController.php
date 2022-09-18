<?php

namespace App\Http\Controllers\Entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



use App\Adquisicion;
use App\Contratos;

class EntradasFondoOficinasCentralesContratosController extends Controller
{
    public function index($adquisicionId){
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        return view('entradas.fondoOficina.contratos.index',compact('adquisicion','adquisicionId'));
    }

    public function show($adquisicionId,$contratoId){
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $contrato = Contratos::find(Hashids::decode($contratoId)[0]);
        return view('entradas.fondoOficina.contratos.show',compact('adquisicion','adquisicionId','contratoId','contrato'));
    }
}
