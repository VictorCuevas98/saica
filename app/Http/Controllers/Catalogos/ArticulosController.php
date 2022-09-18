<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatArtmed;
use App\Cabms;

class ArticulosController extends Controller
{
    public function catalogoArticulosLista(){

        $articulos = CatArtmed::select('cat_artmed.id', 'cat_artmed.clave_artmed', 'cat_artmed.artmed', 'cat_artmed.id_cabms', 'cabms.clave_cabms', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida', 'cat_artmed.unidad_medida', 'cat_artmed.activo')->join('cabms', 'cat_artmed.id_cabms', '=', 'cabms.id')->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->orderBy('clave_artmed', 'ASC')->paginate(5);
        return view('catalogos.articulos.articulosCatalogo', ['articulos' => $articulos]);

        //return view('catalogos.articulos.articulos');
    }

    public function catalogoArticulos(Request $request){

        $busqueda = $request->get('busqueda');
        $datosBusqueda = $request->all();
        
        $articulos = CatArtmed::select('cat_artmed.id', 'cat_artmed.clave_artmed', 'cat_artmed.artmed', 'cat_artmed.id_cabms', 'cabms.clave_cabms', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida', 'cat_artmed.unidad_medida', 'cat_artmed.activo')->join('cabms', 'cat_artmed.id_cabms', '=', 'cabms.id')->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->where('clave_artmed', 'LIKE', '%'.$busqueda.'%')->orWhere('artmed', 'LIKE', '%'.$busqueda.'%')->orderBy('clave_artmed', 'ASC')->paginate(5)->appends($datosBusqueda);
        return view('catalogos.articulos.articulosCatalogo', ['articulos' => $articulos]);

        //$articulos = CatArtmed::select('cat_artmed.id', 'cat_artmed.clave_artmed', 'cat_artmed.artmed', 'cat_artmed.id_cabms', 'cabms.clave_cabms', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida', 'cat_artmed.unidad_medida', 'cat_artmed.activo')->join('cabms', 'cat_artmed.id_cabms', '=', 'cabms.id')->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->orderBy('artmed', 'ASC')->get();
        //return DataTables::of($articulos)->toJson();

    }

    public function crearArticulo(){

        $cabms = Cabms::select('id', 'clave_cabms', 'cabms')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.articulos.modals.nuevoArticulo', compact('cabms'));
    }

    public function guardarArticulo(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_artmed' => ["required" , "max:150"],
                'artmed' => ["required" , "max:150"],
                'cabms' => ["required" , "max:150"],
                'unidad_medida' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_artmed = $request->clave_artmed;
        $clave = CatArtmed::where('clave_artmed',$clave_artmed)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo articulo');
            DB::beginTransaction();
            try{
                //Creamos un nuevo artículo    
                $articuloLista = new CatArtmed();       
                $articuloLista->clave_artmed = $request->clave_artmed;
                $articuloLista->artmed = $request->artmed; 
                $articuloLista->id_cabms = $request->cabms; 
                $articuloLista->unidad_medida = $request->unidad_medida;             
                $articuloLista->activo = true;//Activo en creación 
                $articuloLista->created_at = date('Y-m-d H:i:s');             
                $articuloLista->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                \Log::warning(__METHOD__."--->Line:".$e->getLine()."----->".$e->getMessage());
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }        
    }

    public function editarArticulo(Request $request){

        $cabms = Cabms::select('id', 'clave_cabms', 'cabms')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        $articulo = CatArtmed::findOrFail($request->id);
        return view('catalogos.articulos.modals.editarArticulo', compact('cabms', 'articulo'));

    }

    public function guardarEdicionArticulo(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_artmed' => ["required" , "max:150"],
                'artmed' => ["required", "max:150"],
                'cabms' => ["required" , "max:150"],
                'unidad_medida' => ["required", "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        echo \Log::info(__METHOD__.' Editar articulo');
        DB::beginTransaction();
        try{
            $idArticulo = $request->id_clave;
            
            $articuloLista = CatArtmed::find($idArticulo);
            $estatus = ($request->estatusArticulo == "on" ) ? 1 : 0;
            $articuloLista->clave_artmed = $request->clave_artmed;
            $articuloLista->artmed = $request->artmed; 
            $articuloLista->id_cabms = $request->cabms; 
            $articuloLista->unidad_medida = $request->unidad_medida; 
            $articuloLista->activo = $estatus;
            $articuloLista->updated_at = date('Y-m-d H:i:s');
            $articuloLista->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            \Log::warning(__METHOD__."--->Line:".$e->getLine()."----->".$e->getMessage());
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }
}
