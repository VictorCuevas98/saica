<?php


namespace App\Http\Controllers\Contratos;

use Illuminate\Http\Request;

class ContratosArchivosController
{
    public function showModalPDF(Request $request){
        $path = $request->path;
        return view('contratos.pdf._show', compact('path'))->render();
    }
}
