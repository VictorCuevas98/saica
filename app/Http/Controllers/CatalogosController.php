<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\CatArtmed;
use App\Cabms;
use App\CatPartidaEspecifica;
use App\CatElementoCog;
use App\CatLaboratorio;
use App\CatAsentamiento;
use App\CatAlmacen;
use App\CatPreguntaRevisionEntrada;
use App\CatTipoRevision;
use App\CatUnidadConsolidadora;
use App\CatOrdenGobierno;

class CatalogosController extends Controller
{
    public function catalogos(){

    	return view('catalogos.index');
    }

    public function catalogoArticulos(){

        $articuloLista = CatArtmed::select('cat_artmed.id', 'cat_artmed.clave_artmed', 'cat_artmed.artmed', 'cat_artmed.id_cabms', 'cabms.clave_cabms', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida', 'cat_artmed.unidad_medida', 'cat_artmed.activo')->join('cabms', 'cat_artmed.id_cabms', '=', 'cabms.id')->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->orderBy('artmed', 'ASC')->get();
        return Datatables::of($articuloLista)->toJson();

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
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }

    //Catalogo CABMS
    public function catalogoCabms(){

        $cabmsLista = Cabms::select('cabms.id', 'cabms.clave_cabms', 'cabms.cabms', 'cabms.id_partida', 'cat_partidas_especificas.clave_partida', 'cabms.unidad_medida', 'cabms.activo')->join('cat_partidas_especificas', 'cabms.id_partida', '=', 'cat_partidas_especificas.id')->orderBy('cabms', 'ASC')->get();
        return Datatables::of($cabmsLista)->toJson();

    }

    public function crearCabms(){

        $partidas = CatPartidaEspecifica::select('id', 'clave_partida', 'partida')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.cabms.modals.nuevoCabms', compact('partidas'));
    }

    public function guardarCabms(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_cabms' => ["required" , "max:150"],
                'cabms' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'unidad_medida' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_cabms = $request->clave_cabms;
        $clave = Cabms::where('clave_cabms',$clave_cabms)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo cabms');
            DB::beginTransaction();
            try{
                //Creamos un nuevo cabms    
                $cabmsLista = new Cabms();       
                $cabmsLista->clave_cabms = $request->clave_cabms;
                $cabmsLista->cabms = $request->cabms; 
                $cabmsLista->id_partida = $request->partida; 
                $cabmsLista->unidad_medida = $request->unidad_medida;             
                $cabmsLista->activo = true;//Activo en creación 
                $cabmsLista->created_at = date('Y-m-d H:i:s');             
                $cabmsLista->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }    
    }

    public function editarCabms(Request $request){

        $partidas = CatPartidaEspecifica::select('id', 'clave_partida', 'partida')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        $cabms = Cabms::findOrFail($request->id);
        return view('catalogos.cabms.modals.editarCabms', compact('partidas', 'cabms'));

    }

    public function guardarEdicionCabms(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_cabms' => ["required" , "max:150"],
                'cabms' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'unidad_medida' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar cabms');
        DB::beginTransaction();
        try{
            $idCabms = $request->id_cabms;
            
            $cabmsLista = Cabms::find($idCabms);
            $estatus = ($request->estatusCabms == "on" ) ? 1 : 0;
            $cabmsLista->clave_cabms = $request->clave_cabms;
            $cabmsLista->cabms = $request->cabms; 
            $cabmsLista->id_partida = $request->partida; 
            $cabmsLista->unidad_medida = $request->unidad_medida;   
            $cabmsLista->activo = $estatus;
            $cabmsLista->updated_at = date('Y-m-d H:i:s');
            $cabmsLista->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }

    public function catalogoPartidas(){

        $partidasLista = CatPartidaEspecifica::select('cat_partidas_especificas.id', 'cat_partidas_especificas.clave_partida', 'cat_partidas_especificas.partida','cat_partidas_especificas.id_elemento_cog', 'cat_elementos_cog.clave_elemento_cog', 'cat_partidas_especificas.activo')->join('cat_elementos_cog', 'cat_partidas_especificas.id_elemento_cog', '=', 'cat_elementos_cog.id')->orderBy('partida', 'ASC')->get();
        return Datatables::of($partidasLista)->toJson();
    }

    public function crearPartida(){

        $elementos = CatElementoCog::select('id', 'clave_elemento_cog', 'elemento_cog')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.partidas.modals.nuevoPartida', compact('elementos'));
    }

    public function guardarPartida(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_partida' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'elemento' => ["required" , "max:150"],
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_partida = $request->clave_partida;
        $clave = CatPartidaEspecifica::where('clave_partida',$clave_partida)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva partida');
            DB::beginTransaction();
            try{
                //Creamos un nueva partida especifica    
                $partidasLista = new CatPartidaEspecifica();       
                $partidasLista->clave_partida = $request->clave_partida;
                $partidasLista->partida = $request->partida; 
                $partidasLista->id_elemento_cog = $request->elemento;       
                $partidasLista->activo = true;//Activo en creación 
                $partidasLista->created_at = date('Y-m-d H:i:s');             
                $partidasLista->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 

    }

    public function editarPartida(Request $request){

        $elementos = CatElementoCog::select('id', 'clave_elemento_cog', 'elemento_cog')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        $partida = CatPartidaEspecifica::findOrFail($request->id);
        
        return view('catalogos.partidas.modals.editarPartida', compact('elementos', 'partida'));
    }


    public function guardarEdicionPartida(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_partida' => ["required" , "max:150"],
                'partida' => ["required" , "max:150"],
                'elemento' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar partida');
        DB::beginTransaction();
        try{
            $idPartida = $request->id_partida;
            
            $partidasLista = CatPartidaEspecifica::find($idPartida);
            $estatus = ($request->estatusPartida == "on" ) ? 1 : 0;
            $partidasLista->clave_partida = $request->clave_partida;
            $partidasLista->partida = $request->partida; 
            $partidasLista->id_elemento_cog = $request->elemento;  
            $partidasLista->activo = $estatus;
            $partidasLista->updated_at = date('Y-m-d H:i:s');
            $partidasLista->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }

    //Catalogo Laboratorio
    public function catalogoLaboratorios(){

        $laboratoriosLista = CatLaboratorio::select('id', 'clave_laboratorio', 'laboratorio', 'activo')->orderBy('laboratorio', 'ASC')->get();
        return Datatables::of($laboratoriosLista)->toJson();
    }

    public function crearLaboratorio(){

        return view('catalogos.laboratorios.modals.nuevoLaboratorio');
    }

    public function guardarLaboratorio(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_laboratorio' => ["required" , "max:150"],
                'laboratorio' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_laboratorio = $request->clave_laboratorio;
        $clave = CatLaboratorio::where('clave_laboratorio',$clave_laboratorio)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo laboratorio');
            DB::beginTransaction();
            try{
                //Creamos un nuevo laboratorio    
                $laboratorio = new CatLaboratorio();       
                $laboratorio->clave_laboratorio = $request->clave_laboratorio;
                $laboratorio->laboratorio = $request->laboratorio;     
                $laboratorio->activo = true;//Activo en creación 
                $laboratorio->created_at = date('Y-m-d H:i:s');             
                $laboratorio->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 
    }

    public function editarLaboratorio(Request $request){

        $laboratorio = CatLaboratorio::findOrFail($request->id);
        return view('catalogos.laboratorios.modals.editarLaboratorio', compact('laboratorio'));
    }


    public function guardarEdicionLaboratorio(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_laboratorio' => ["required" , "max:150"],
                'laboratorio' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar laboratorio');
        DB::beginTransaction();
        try{
            $idLaboratorio = $request->id_laboratorio;
            
            $laboratorio = CatLaboratorio::find($idLaboratorio);
            $estatus = ($request->estatusLaboratorio == "on" ) ? 1 : 0;
            $laboratorio->clave_laboratorio = $request->clave_laboratorio;
            $laboratorio->laboratorio = $request->laboratorio; 
            $laboratorio->activo = $estatus;
            $laboratorio->updated_at = date('Y-m-d H:i:s');
            $laboratorio->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    } 

    public function catalogoAlmacenes(){

        $almacen = CatAlmacen::select('cat_almacenes.id', 'cat_almacenes.clave_almacen', 'cat_almacenes.almacen', 'cat_almacenes.domi_calle', 'cat_almacenes.domi_num_ext', 'cat_almacenes.domi_num_int', 'cat_asentamientos.asentamiento', 'cat_almacenes.activo')->join('cat_asentamientos', 'cat_almacenes.id_asentamiento', '=', 'cat_asentamientos.id')->orderBy('almacen', 'ASC')->get();
        return Datatables::of($almacen)->toJson();

    }  

    public function crearAlmacen(){

        $asentamientos = CatAsentamiento::select('id', 'asentamiento', 'cp', 'ciudad', 'municipio', 'entidad')->get();
        return view('catalogos.almacenes.modals.nuevoAlmacen', compact('asentamientos'));
    } 

    public function guardarAlmacen(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_almacen' => ["required" , "max:150"],
                'almacen' => ["required" , "max:150"],
                'domi_calle' => ["required" , "max:150"],
                //'domi_num_ext' => ["required" , "max:150"],
                //'domi_num_int' => ["required" , "max:150"],
                'asentamiento' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_almacen = $request->clave_almacen;
        $clave = CatAlmacen::where('clave_almacen',$clave_almacen)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nuevo almacen');
            DB::beginTransaction();
            try{
                //Creamos un nuevo almacen    
                $almacen = new CatAlmacen();       
                $almacen->clave_almacen = $request->clave_almacen;
                $almacen->almacen = $request->almacen; 
                $almacen->domi_calle = $request->domi_calle; 
                $almacen->domi_num_ext = $request->domi_num_ext; 
                $almacen->domi_num_int = $request->domi_num_int; 
                $almacen->id_asentamiento = $request->asentamiento;     
                $almacen->activo = true;//Activo en creación 
                $almacen->created_at = date('Y-m-d H:i:s');             
                $almacen->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 
    }

    public function editarAlmacen(Request $request){

        $almacen = CatAlmacen::findOrFail($request->id);
        return view('catalogos.almacenes.modals.editarAlmacen', compact('almacen'));

    }

    public function guardarEdicionAlmacen(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_almacen' => ["required" , "max:150"],
                'almacen' => ["required" , "max:150"],
                'domi_calle' => ["required" , "max:150"],
                //'domi_num_ext' => ["required" , "max:150"],
                //'domi_num_int' => ["required" , "max:150"],
                'asentamiento' => ["required" , "max:150"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres
                ',
            ]
        );

        \Log::info(__METHOD__.' Editar almacen');
        DB::beginTransaction();
        try{
            $idAlmacen = $request->id_almacen;
            
            $almacen = CatAlmacen::find($idAlmacen);
            $estatus = ($request->estatusAlmacen == "on" ) ? 1 : 0;
            $almacen->clave_almacen = $request->clave_almacen;
            $almacen->almacen = $request->almacen; 
            $almacen->domi_calle = $request->domi_calle; 
            $almacen->domi_num_ext = $request->domi_num_ext; 
            $almacen->domi_num_int = $request->domi_num_int; 
            $almacen->id_asentamiento = $request->asentamiento; 
            $almacen->activo = $estatus;
            $almacen->updated_at = date('Y-m-d H:i:s');
            $almacen->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }

    public function catalogoPreguntasRevision(){

        $preguntasRevision = CatPreguntaRevisionEntrada::select('cat_preguntas_revision_entrada.id', 'cat_preguntas_revision_entrada.clave_pregunta', 'cat_preguntas_revision_entrada.pregunta', 'cat_tipo_revision.tipo_revision', 'cat_preguntas_revision_entrada.orden', 'cat_preguntas_revision_entrada.activo')->join('cat_tipo_revision', 'cat_preguntas_revision_entrada.id_tipo_revision', '=', 'cat_tipo_revision.id')->orderBy('pregunta', 'ASC')->get();
        return Datatables::of($preguntasRevision)->toJson();
    }

    public function crearPreguntasRevision(){

        $tipoRevision = CatTipoRevision::select('id', 'clave_tipo_revision', 'tipo_revision')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.preguntasRevision.modals.nuevoPreguntasRevision', compact('tipoRevision'));
    }

    public function guardarPreguntasRevision(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_pregunta' => ["required" , "max:150"],
                'pregunta' => ["required" , "max:150"],
                'tipo_revision' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_pregunta = $request->clave_pregunta;
        $clave = CatPreguntaRevisionEntrada::where('clave_pregunta',$clave_pregunta)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva pregunta revisión entrada');
            DB::beginTransaction();
            try{
                //Creamos un nueva pregunta revision    
                $preguntasRevision = new CatPreguntaRevisionEntrada();       
                $preguntasRevision->clave_pregunta = $request->clave_pregunta;
                $preguntasRevision->pregunta = $request->pregunta; 
                $preguntasRevision->id_tipo_revision = $request->tipo_revision; 
                $preguntasRevision->activo = true;//Activo en creación 
                $preguntasRevision->created_at = date('Y-m-d H:i:s');             
                $preguntasRevision->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            } 

    }

    public function editarPreguntasRevision(Request $request){

        $preguntasRevision = CatPreguntaRevisionEntrada::findOrFail($request->id);
        $tipoRevision = CatTipoRevision::select('id', 'clave_tipo_revision', 'tipo_revision')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.preguntasRevision.modals.editarPreguntasRevision', compact('preguntasRevision', 'tipoRevision'));

    }

    public function guardarEdicionPreguntasRevision(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_pregunta' => ["required" , "max:150"],
                'pregunta' => ["required" , "max:150"],
                'tipo_revision' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        \Log::info(__METHOD__.' Editar pregunta revisión entrada');
        DB::beginTransaction();
        try{
            $idPregunta = $request->id_pregunta;
            
            $preguntasRevision = CatPreguntaRevisionEntrada::find($idPregunta);
            $estatus = ($request->estatusPregunta == "on" ) ? 1 : 0;
            $preguntasRevision->clave_pregunta = $request->clave_pregunta;
            $preguntasRevision->pregunta = $request->pregunta; 
            $preguntasRevision->id_tipo_revision = $request->tipo_revision; 
            $preguntasRevision->activo = $estatus;
            $preguntasRevision->updated_at = date('Y-m-d H:i:s');
            $preguntasRevision->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }

    }

    public function catalogoUnidadConsolidadora(){

        $unidadConsolidadora = CatUnidadConsolidadora::select('cat_unidades_consolidadoras.id', 'cat_unidades_consolidadoras.clave_unidad_consolidadora', 'cat_unidades_consolidadoras.unidad_consolidadora', 'cat_orden_gobierno.orden_gobierno', 'cat_unidades_consolidadoras.activo')->join('cat_orden_gobierno', 'cat_unidades_consolidadoras.id_orden_gobierno', '=', 'cat_orden_gobierno.id')->orderBy('unidad_consolidadora', 'ASC')->get();
        return Datatables::of($unidadConsolidadora)->toJson();
    }

    public function crearUnidadConsolidadora(){

        $ordenGobierno = CatOrdenGobierno::select('id', 'clave_orden_gobierno', 'orden_gobierno')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.unidadesConsolidadoras.modals.nuevoUnidadConsolidadora', compact('ordenGobierno'));
    }

    public function guardarUnidadConsolidadora(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_unidad_consolidadora' => ["required" , "max:150"],
                'unidad_consolidadora' => ["required" , "max:150"],
                'orden_gobierno' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        $clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
        $clave = CatUnidadConsolidadora::where('clave_unidad_consolidadora',$clave_unidad_consolidadora)->count();

        if($clave>0){
            return response()->json(['status'=>'no_valido', 'data' => 'Ya existe un registro con esa clave','code' => 'CDC004'],200);

        }
            \Log::info(__METHOD__.' Crear nueva unidad consolidadora');
            DB::beginTransaction();
            try{
                //Creamos un nueva unidad consolidadora    
                $unidadConsolidadora = new CatUnidadConsolidadora();       
                $unidadConsolidadora->clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
                $unidadConsolidadora->unidad_consolidadora = $request->unidad_consolidadora; 
                $unidadConsolidadora->id_orden_gobierno = $request->orden_gobierno; 
                $unidadConsolidadora->activo = true;//Activo en creación 
                $unidadConsolidadora->created_at = date('Y-m-d H:i:s');             
                $unidadConsolidadora->save();
                //Proceso concluido
                DB::commit();

                return response()->json(['status'=>'valido', 'data' => 'El registro se creo correctamente', 'code' => 'CDC001'],200);

            }catch(Exception $e){
                DB::rollback();
                
                //Retornamos error
                return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC002'],200);
            }

    }

    public function editarUnidadConsolidadora(Request $request){

        $unidadConsolidadora = CatUnidadConsolidadora::findOrFail($request->id);
        $ordenGobierno = CatOrdenGobierno::select('id', 'clave_orden_gobierno', 'orden_gobierno')->whereNull('activo')->orWhere('activo', '!=', '0')->get();
        return view('catalogos.unidadesConsolidadoras.modals.editarUnidadConsolidadora', compact('unidadConsolidadora', 'ordenGobierno'));
    }

    public function guardarEdicionUnidadConsolidadora(Request $request){

        $validatedData = $request->validate(
            //Reglas
            [
                'clave_unidad_consolidadora' => ["required" , "max:150"],
                'unidad_consolidadora' => ["required" , "max:150"],
                'orden_gobierno' => ["required"]
            ],
            //Mensajes
            [
                'required' => 'El :attribute es requerido.',
                'max'      => 'El :attribute debe de contener un máximo de: :max caracteres',
            ]
        );

        \Log::info(__METHOD__.' Editar unidad consolidadora');
        DB::beginTransaction();
        try{
            $idUnidad = $request->id_unidad;
            
            $unidadConsolidadora = CatUnidadConsolidadora::find($idUnidad);
            $estatus = ($request->estatusUnidad == "on" ) ? 1 : 0;
            $unidadConsolidadora->clave_unidad_consolidadora = $request->clave_unidad_consolidadora;
            $unidadConsolidadora->unidad_consolidadora = $request->unidad_consolidadora; 
            $unidadConsolidadora->id_orden_gobierno = $request->orden_gobierno; 
            $unidadConsolidadora->activo = $estatus;
            $unidadConsolidadora->updated_at = date('Y-m-d H:i:s');
            $unidadConsolidadora->save();
            //Proceso concluido
            DB::commit();

            return response()->json(['status'=>'valido', 'data' => 'Se actualizo correctamente', 'code' => 'CDC004'],200);

        }catch(Exception $e){
            DB::rollback();
            
            //Retornamos error
            return response()->json(['status'=>'no_valido', 'data' => 'No se pudo realizar la solicitud, por favor, intete más tarde', 'code' => 'CDC005'],200);
        }
    }
}