<?php

namespace App\Http\Controllers;

use App\CatOrigenRecurso;
use Illuminate\Http\Request;

class OrigenRecursoController extends Controller
{
    //CONSULTA SI EXISTE UN ORIGEN DE RECURSO
    public function idHaveAny($id)
    {
        if ($id != null) {
            $valor = CatOrigenRecurso::where('id', $id)->first();
            if ($valor->count() <= 0) {
                return false;
            } else {
                return ['origen' => $valor];
            }
        }
    }
}
