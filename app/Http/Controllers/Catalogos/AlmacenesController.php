<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\CatAsentamiento;
use App\CatAlmacen;

class AlmacenesController extends Controller
{

    public function catalogoAlmacenesLista(){

        return view('catalogos.almacenes.almacenes');
    }

    public function catalogoAlmacenes(){

        $almacen = CatAlmacen::select('cat_almacenes.id', 'cat_almacenes.clave_almacen', 'cat_almacenes.almacen', 'cat_almacenes.domi_calle', 'cat_almacenes.domi_num_ext', 'cat_almacenes.domi_num_int', 'cat_asentamientos.asentamiento', 'cat_almacenes.activo')->join('cat_asentamientos', 'cat_almacenes.id_asentamiento', '=', 'cat_asentamientos.id')->orderBy('almacen', 'ASC')->get();
        return Datatables::of($almacen)->toJson();

    }  

    public function crearAlmacen(Request $request){

        
        return view('catalogos.almacenes.modals.nuevoAlmacen');
    } 

    public function buscarColonia(Request $request){

        $cp = trim($request->cp);
        $asentamientos = CatAsentamiento::select('id', 'asentamiento', 'cp', 'municipio')->where('cp', $cp)->get();
        if($asentamientos){

            $colonia = CatAsentamiento::select('id', 'asentamiento')->where('cp', $cp)->get();
    
        $arrayDatos = [];
        array_push($arrayDatos, ['asentamientos' => $asentamientos, 'colonia' => $colonia]);

        if (count($colonia)<1) {

            $response = ['msg' => 'No existe el codigo postal ' . $cp, 'codigo' => 201];

        }else{

            $response = ['msg' => $arrayDatos, 'codigo' => 200];

        }
        }else{

            $response = ['msg' => 'No existe el codigo postal '. $cp, 'codigo' => 201];
        }
        
        return $response;
    }

    public function guardarAlmacen(Request $request){

        $validator = Validator::make($request->all(), 
            [
                'clave_almacen' => 'required',
                'almacen' => 'required',
                'domi_calle' => 'required',
                //'domi_num_ext' => 'required',
                //'domi_num_int' => 'required',
                'asentamiento' => 'required'
            ],

            [
                'required'=>'El campo :attribute es requerido.'
            ]);

            if ($validator->fails()) {
                return redirect('almacenes/crearAlmacen')
                            ->withErrors($validator)
                            ->withInput();
            }

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

        $idAlmacen = $request->id;
        //$almacen = CatAlmacen::findOrFail($request->id);
        $almacen = CatAlmacen::select('cat_almacenes.id', 'cat_almacenes.clave_almacen', 'cat_almacenes.almacen', 'cat_almacenes.domi_calle', 'cat_almacenes.domi_num_ext', 'cat_almacenes.domi_num_int', 'cat_asentamientos.asentamiento', 'cat_asentamientos.cp', 'cat_almacenes.activo')->join('cat_asentamientos', 'cat_almacenes.id_asentamiento', '=', 'cat_asentamientos.id')->where('cat_almacenes.id', $idAlmacen)->first();
        return view('catalogos.almacenes.modals.editarAlmacen', compact('almacen'));

    }

    public function buscarColoniaEditar(Request $request){

        $cp = trim($request->cp);
        $asentamientos = CatAsentamiento::select('id', 'asentamiento', 'cp', 'municipio')->where('cp', $cp)->get();
        if($asentamientos){

            $colonia = CatAsentamiento::select('id', 'asentamiento')->where('cp', $cp)->get();
    
        $arrayDatos = [];
        array_push($arrayDatos, ['asentamientos' => $asentamientos, 'colonia' => $colonia]);

        if (count($colonia)<1) {

            $response = ['msg' => 'No existe el codigo postal ' . $cp, 'codigo' => 201];

        }else{

            $response = ['msg' => $arrayDatos, 'codigo' => 200];

        }
        }else{
            
            $response = ['msg' => 'No existe el codigo postal '. $cp, 'codigo' => 201];
        }
        
        return $response;
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
}
