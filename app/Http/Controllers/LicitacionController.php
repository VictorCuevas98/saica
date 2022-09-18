<?php

namespace App\Http\Controllers;

use App\Licitacion;
use Illuminate\Http\Request;

class LicitacionController extends Controller
{
    //CONSULTA SI EXISTE UNA LICITACION
    public function idHaveAny($id)
    {
        if ($id !== null) {
            $valor = Licitacion::where('id_adquisicion', $id)->get();
            if ($valor->count() <= 0) {
                return false;
            } else {
                return ['licitacion' => $valor->first()];
            }
        }
    }
}
