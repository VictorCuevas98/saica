<?php

namespace App\Http\Controllers;

use App\Cabms;
use App\CatPartidaEspecifica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Str; //para el random
use App\CatArtmed;
use \Illuminate\Pagination\Paginator;
class CatArtmedController extends Controller
{
    //
    /*
      0 => "id"
  1 => "clave"
  2 => "descripcion"
  3 => "cabms"
  4 => "unidad_medida"
  5 => "revision"
  6 => "estatus"
  */

    public function advanceSearch(Request $request){
        //dd($request->all());
        
        $start = $request->start;
        $end = $start + $request->length;
        $totalRows = 0;
        $paginate = $request->length;
        $query = CatArtmed::query();

        foreach ($request->columns as $key => $column) {

            switch ($column['data']) {
                    case 'id':
                        //--code
                        break;
                    case 'clave':
                        $query = (is_null($column['search']['value']))? $query : $query->where('clave_artmed',  'ILIKE', '%'.$column['search']['value'].'%' );
                        break;
                    case 'descripcion':
                        $query = (is_null($column['search']['value']))? $query : $query->where('artmed',  'ILIKE', '%'.$column['search']['value'].'%' );
                        break;
                    case 'unidad_medida':
                        $query =  (is_null($column['search']['value']))? $query : $query->where('unidad_medida',  'ILIKE', '%'.$column['search']['value'].'%' );
                        break;
                    case 'cabms':
                        //$query = $query->where('id_cabms', $column['search']['value']);
                        //$query = $query->orderBy('id_cabms');
                        break;
                    case 'estatus':
                        $status = $column['search']['value'];
                        $query =  (is_null($status))? $query : $query->where('activo',  $status );
                        break;
                    case 'partida':
                        $partida = $column['search']['value'];
                        if(!is_null($partida)){
                            $query = $query->whereHas('Cabms', function ( $query) use($partida) {
                                $query->whereHas('partidaEspecifica', function ( $query) use($partida) {
                                    $query->where('clave_partida',$partida);
                                });
                            });
                        }
                        break;

                }

        }

        $totalRows =  $query->count();

        
        $currentPage = ($totalRows / $paginate) - ( ($totalRows - $start) / $paginate ) + 1;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $resultadoBusqueda = $query->orderBy('clave_artmed')->paginate($request->length);
        
        $responseArr = [];
        foreach ($resultadoBusqueda as $key => $row) {
            array_push($responseArr ,
                [
                    'id'=>Hashids::encode($row->id),
                    'clave'=> $row->clave_artmed ,
                    'descripcion'=> $row->artmed,
                    'cabms'=> $row->id_cabms,
                    'unidad_medida'=> $row->unidad_medida,
                    'revision'=> $row->revision,
                    'estatus'=> $row->activo,
                    'Acciones'=>null,
                ]
            );
        }

        return ['data'=>$responseArr,'recordsFiltered'=>$totalRows, 'recordsTotal'=>$totalRows];
    }

    public function getSearchModal(){
        $catPartidaEspecifica = CatPartidaEspecifica::activos()->orderBy('clave_partida')->get();
        return view('cat_artmed._search_modal',compact('catPartidaEspecifica'))->render();
    }
}
