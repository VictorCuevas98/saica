<?php


namespace App\Http\Controllers\Contratos;


use App\Adquisicion;
use App\CatAlmacen;
use App\CatArtmed;
use App\CatFundamentoLegal;
use App\CatOrigenRecurso;
use App\CatPartidaEspecifica;
use App\CatPuestoEstructuraParticipanteContrato;
use App\CatStatusAdquisicion;
use App\CatTipoContrato;
use App\CatTipoParticipanteContrato;
use App\CatTipoSeccion;
use App\CatUnidadConsolidadora;
use App\ContratoAbierto;
use App\ContratoAbiertoDetalle;
use App\ContratoCerrado;
use App\ContratoCerradoAbastecimiento;
use App\ContratoCerradoDetalle;
use App\ContratoFundamento;
use App\Documento;
use App\Licitacion;
use App\ParticipanteContrato;
use App\Personas;
use App\Proveedor;
use App\PuestosPersona;
use DateTime;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;
use App\Contratos;

class ContratosController extends ContratosCerradosController
{


    public function index()
    {
         $contratos = $this->showAll();
        return view('contratos.ver_contratos', compact('contratos'));
    }

    public function showContratos(Request $request){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $seccion1 = 'active';
        $tipo_contratos = CatTipoContrato::all();
        $almacenes = CatAlmacen::all();
        $origenes = CatOrigenRecurso::all();
        $fundamentos = CatFundamentoLegal::all();
        $partidas = CatPartidaEspecifica::all();
        $unidades_consolidadoras = CatUnidadConsolidadora::all();

        return view('contratos.crear.registro_principal', compact('proveedores', 'seccion1', 'tipo_contratos', 'almacenes', 'origenes', 'fundamentos', 'partidas', 'unidades_consolidadoras'));
    }

    /**
     * Show the form for creating a new Articulo
     *
     * @param $id
     * @return Factory|View
     */
    public function createArticulo($id)
    {
        $seccion2 = 'active';
        $contrato = $this->showOne($id);
        $id = Hashids::decode($id);
        $id = $id[0];
        if ($contrato->clave_tipo_contrato === 'C') {
            $contratoArtmeds = ContratoCerradoDetalle::where('id', $id)->get();
            foreach ($contratoArtmeds as $artmed) {
                $artmed->hashid = Hashids::encode($artmed->id_artmed);
                $artmed->object = CatArtmed::where('id', $artmed->id_artmed)->first();
            }
        } else if ($contrato->clave_tipo_contrato === 'A') {
            $contratoArtmeds = ContratoAbiertoDetalle::where('id', $id)->get();
            foreach ($contratoArtmeds as $artmed) {
                $artmed->hashid = Hashids::encode($artmed->id_artmed);
                $artmed->object = CatArtmed::where('id', $artmed->id_artmed)->first();
            }
        }
        return view('contratos.crear.registro_articulo', compact('contrato', 'seccion2', 'contratoArtmeds'));

    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function createArchivo($id)
    {
        $seccion4 = 'active';
        $contrato = $this->showOne($id);
        $tipo_seccion = CatTipoSeccion::where('clave_tipo_seccion', 'CONT')->first();
        $documento = Documento::where('id_adquisicion', $contrato->id_adquisicion)->where('id_tipo_seccion', $tipo_seccion->id)->first();
        return view('contratos.crear.registro_archivo', compact('seccion4', 'documento', 'contrato', 'id'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function showPrevisualizacion($id)
    {
        $seccion3 = 'active';
        $contrato = $this->showOne($id);
        $proveedor = Proveedor::find($contrato->id_proveedor);
        $adquisicion = Adquisicion::find($contrato->id_adquisicion);
        $licitacion = Licitacion::where('id_adquisicion', $contrato->id_adquisicion)->first();
        if (isset($licitacion->id_unidad_consolidadora)){
            $unidad_consolidadora = CatUnidadConsolidadora::find($licitacion->id_unidad_consolidadora);
            $licitacion->unidad_consolidadora = $unidad_consolidadora;
        }
        if (isset($adquisicion->id_origen_recurso)){
            $origen_recurso = CatOrigenRecurso::find($adquisicion->id_origen_recurso);
            $adquisicion->origen_recurso = $origen_recurso;
        }
        if (isset($licitacion)){
            $adquisicion->licitacion = $licitacion;
        }
        $id_importe = Hashids::decode($contrato->id);
        $id_importe = $id_importe[0];
        $cerrado = null;
        $abierto = null;
        if ($contrato->clave_tipo_contrato === 'C') {
            $articulos = ContratoCerradoDetalle::where('id', Hashids::decode($contrato->id))->get();
            foreach ($articulos as $articulo) {
                $articulo->artmed = CatArtmed::find($articulo->id_artmed);
            }
            $importe = ContratoCerrado::find($id_importe);
            $cerrado = true;
        } else if ($contrato->clave_tipo_contrato === 'A') {
            $articulos = ContratoAbiertoDetalle::where('id', Hashids::decode($contrato->id))->get();
            foreach ($articulos as $articulo) {
                $articulo->artmed = CatArtmed::find($articulo->id_artmed);
            }
            $importe = ContratoAbierto::find($id_importe);
            $abierto = true;
        }
        return view('contratos.crear.previsualizacion', compact('contrato', 'seccion3', 'id', 'proveedor', 'adquisicion', 'articulos', 'importe', 'cerrado', 'abierto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $arr = array();
        $v = Adquisicion::select('num_oficio_adjudicacion')->get();
        foreach ($v as $b) {
            array_push($arr, $b->num_oficio_adjudicacion);
        }
        //VALIDACION EN UN CONTRATO CERRADO
        $hoy = 'now';
        //$reg = preg_match("#^[A-Z]*[-]*[0-9]*[\/]*[0-9]*$#", 'holi');
        //$reg = preg_match("/^[[[A-Za-z]|[0-9]][/][[A-Za-z]|[0-9]]]+$/", 'holi');
        //$reg = preg_match("/^[A-Za-z0-9]*[/]*[A-Za-z0-9]*$/", 'holi');
        $reg = preg_match("/^[A-Za-z0-9\-\/]+$/", 'holi');

        $request->validate([
            'crear_fecha_contrato' => 'required',
            'crear_contrato' => ['required','unique:App\Contratos,num_contrato','regex:#^[A-Za-z0-9\-\/\.]+$#'],
            'crear_tipocontrato' => 'required',
            'crear_num_oficio_adjudicacion' => ['required','regex:#^[A-Za-z0-9\-\/\.\ ]+$#'],
            'crear_flegal_select' => 'required',
        ]);

        //VALIDACION EN UN CONTRATO ABIERTO
        $monto_maximo = (int)$request->monto_maximo;
        $request->validate([
            ($request->c2) ? 'monto_minimo' : '' => ($request->c2) ? 'required|numeric|min:1|lt:monto_maximo' : '',
            ($request->c3) ? 'monto_maximo' : '' => ($request->c3) ? 'required|numeric|min:1' : '',
        ]);

        //VALIDACION EN UNA ADQUISICION
        $request->validate([
            'numero_requisicion' => ['required','unique:App\Adquisicion,num_requisicion', 'regex:#^[A-Za-z0-9\-\/]+$#'],
            'rfc_del_proveedor' => 'required',
            'tipo_de_persona' => 'required',
            'razon_social_del_proveedor' => 'required',
            ($request->licitacion) ? 'licitacion' : '' => ($request->licitacion) ? 'required' : '',
            ($request->unidad_consolidadora_required) ? 'unidad_consolidadora' : '' => ($request->unidad_consolidadora_required) ? 'required' : '',
        ]);

        try {
            DB::beginTransaction();
            //SE CREA O ACTULIZA LA ADQUISICION
            $this->storeAdquisicion($request);

            $fun = (array)$request->crear_flegal_select;
            $tipo_contrato = CatTipoContrato::where('clave_tipo_contrato', $request->crear_tipocontrato)->first();
            $adquisicion = Adquisicion::where('num_oficio_adjudicacion', $request->crear_num_oficio_adjudicacion)->first();
            $fundamentos = CatFundamentoLegal::whereIn('clave_fundamento_legal', $fun)->get();

            $contrato = Contratos::create([
                'id_tipo_contrato' => $tipo_contrato->id,
                'id_tipo_doc_contrato' => 1,
                'num_contrato' => $request->crear_contrato,
                'fecha_contrato' => DateTime::createFromFormat("d/m/Y", $request->crear_fecha_contrato),
                'id_adquisicion' => $adquisicion->id,
                'validado' => false,
                'activo' => true,
                'observaciones' => $request->observaciones,
            ]);
            foreach ($fundamentos as $fundamento) {
                $f = ContratoFundamento::create([
                    'id_contrato' => $contrato->id,
                    'id_fundamento_legal' => $fundamento->id,
                    'activo' => true,
                ]);
            }
            DB::commit();
            return response()->json([
                'mensaje' => 'Se registro correctamente',
                'id' => Hashids::encode($contrato->id),
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(__METHOD__. " -> ". $e->getMessage());
            return response()->json([
                'mensaje' => 'El contrato no se pudo crear ' . $e,
            ], 400);
        }
    }

    /**
     * Store a newly created Articulo in storage.
     *
     * @param Request $request
     * @return array
     */
    public function storeArticulo(Request $request)
    {
        /*
         $rules_periodos = [];
        if ($request->periodos) {
            $var = 0;
            foreach ($periodos as $periodo) {
                $val1 = $periodo[0];
                $val2 = $periodo[1];
                $val3 = $periodo[2];
                $reglas = array(
                    function ($attribute,$value, $fail) {
                        if ($value === '') {
                            $fail($attribute . ' Nah.');
                        }
                    },
                    function ($attribute,$value, $fail) {
                        if ($value === '') {
                            $fail($attribute . ' NAH.');
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if ($value === '') {
                            $fail($attribute . ' NAh.');
                        }
                    });
                $array = array('periodo' . $var++ => 'required');
                array_push($rules_periodos, $array);
            }
            $this->validate($request, $rules_periodos);
        }
         */
        $contrato = $this->showOne($request->id_contrato);

        if ($contrato->clave_tipo_contrato === 'C') {
            $periodos = $request->periodos;
            //No se puede repitir la fecha-start
            //Deben tener tres valor por cada periodo
            //Cantidad a entregar debe ser menor a la cantidad de articulos
            $fechas_iniciales= array();
            $cantidad_de_articulos_a_entregar = 0;
            for ($val=0; $val<count($periodos); $val++){
                $name1 = 'fecha_start' .($val + 1);
                $name2 = 'fecha_end' .($val + 1);
                $name3 = 'cantidad_de_articulos_a_entregar' .($val + 1);
                $cantidad_de_articulos_a_entregar += (int) $periodos[$val][2];
                array_push($fechas_iniciales, $periodos[$val][0]);
            }

            $request->validate([
                'id_artmed' => 'required',
                'id_contrato' => ' required',
                'cantidad_de_articulos' => 'required|integer|min:1',
                'precio_del_articulo'  => 'required|numeric|min:1',
            ]);


            $array= array();
            for ($val=0; $val<count($periodos); $val++){
                $name1 = 'fecha_start' .($val + 1);
                $name2 = 'fecha_end' .($val + 1);
                $name3 = 'cantidad_de_articulos_a_entregar' .($val + 1);
                for ($val2=0; $val2<3; $val2++){
                    $request->validate([
                        $name1 => 'required',
                        $name2 => 'required',
                        $name3 => 'required|integer|min:1',
                    ]);
                }
            }

            $count_values = array_count_values($fechas_iniciales);
            $error_fechas=false;
            $fecha_erronea = '';
            foreach ($count_values as $key => $item) {
                if ($item !== 1){
                    $error_fechas = true;
                    $fecha_erronea = $key;
                }
            }
            if ($error_fechas){
                return response()->json([
                    'message'=> 'Fechas de Inicio Invalidas, las fechas iniciales no pueden repetirse. Fecha repetida: ' . $fecha_erronea,
                    'error'=>'existe'],422);
            }
            if ($cantidad_de_articulos_a_entregar < 0 || $cantidad_de_articulos_a_entregar > $request->cantidad_de_articulos){
                return response()->json([
                    'message'=> 'Cantidad Invalida, la cantidad total "'.$cantidad_de_articulos_a_entregar.'" a entregar no puede ser menor a 0 y no debe exceder de ' . $request->cantidad_de_articulos,
                    'error'=>'existe'],422);
            }


            $var = $this->storeContratosCerradosDetalle($request);
        } else if ($contrato->clave_tipo_contrato === 'A') {
            $cantidad_maxima = (int)$request->cantidad_maxima;
            $request->validate([
                'id_artmed' => 'required',
                'id_contrato' => ' required',
                'monto_del_articulo'  => 'required|numeric|min:1',
                'cantidad_minima'  => 'required|integer|min:1|lt:cantidad_maxima',
                'cantidad_maxima'  => 'required|integer|min:2',
            ]);
            $var = $this->storeContratoAbiertoDetalle($request);
        }

        return $var;
    }

    public function storeAdquisicion(Request $request)
    {
        $statusAdquisicion = CatStatusAdquisicion::where('clave_status_adquisicion', 'A')->get();

        $obj = Adquisicion::where('num_oficio_adjudicacion', $request->crear_num_oficio_adjudicacion)->first();
        if ($obj !== null) {
            try{
                DB::beginTransaction();
                $adquisicion = Adquisicion::where('num_oficio_adjudicacion', $request->crear_num_oficio_adjudicacion)->first();
                $user = Auth::user();
                $puesto_persona = PuestosPersona::where('id_persona', $user->id)->first();
                $adquisicion->id_puesto_persona = $puesto_persona->id;
                $adquisicion->id_status_adquisicion = $statusAdquisicion->first()->id;
                $adquisicion->activo = true;
                if (isset($request->numero_requisicion)) {
                    $adquisicion->num_requisicion = $request->numero_requisicion;
                }

                if (isset($request->origen_de_recurso)) {
                    $origen = CatOrigenRecurso::where('clave_origen_recurso', $request->origen_de_recurso)->first();
                    $adquisicion->id_origen_recurso = $origen->id;
                }

                if (isset($request->tipo_de_movimiento)) {
                    //esta por verse
                }

                if (isset($request->rfc_del_proveedor)) {
                    $proveedor = Proveedor::where('rfc', $request->rfc_del_proveedor)->first();
                    if ($proveedor) {
                        $adquisicion->id_proveedor = $proveedor->id;
                    }else{
                        $proveedor = Proveedor::createOrUpdate([
                            'rfc' => $request->rfc_del_proveedor,
                            'tipo_persona' => $request->tipo_persona,
                            'razon_social' => $request->razon_social_del_proveedor,
                        ]);
                        $adquisicion->id_proveedor = $proveedor->id;
                    }
                }

                $adquisicion->save();

                if (isset($request->crear_licitacion)) {
                    $unidad_consolidada = CatUnidadConsolidadora::where('clave_unidad_consolidadora', $request->unidad_consolidadora)->first();
                    Licitacion::create([
                        'num_licitacion' => $request->crear_licitacion,
                        'id_unidad_consolidadora' => $unidad_consolidada->id,
                        'id_adquisicion' => $adquisicion->id,
                        'activo' => true,
                    ]);
                }
                DB::commit();
                return response()->json(['mensaje' => 'Se actualizó la adquisicion', 'id' => $adquisicion], 200);
            }catch(Exception $e){
                DB::rollBack();
                Log::error(__METHOD__. " -> ". $e->getMessage());
                return response()->json(['mensaje' => 'No se logro actualizar la adquisicion', 'id' => $adquisicion], 400);
            }
        } else {
            try{
                $user = Auth::user();
                $puesto_persona = PuestosPersona::where('id_persona', $user->id)->first();
                $adquisicion = new Adquisicion();
                $adquisicion->id_puesto_persona = $puesto_persona->id;
                $adquisicion->num_oficio_adjudicacion = $request->crear_num_oficio_adjudicacion;
                $adquisicion->id_status_adquisicion = $statusAdquisicion->first()->id;
                $adquisicion->activo = true;
                if (isset($request->numero_de_requisicion)) {
                    $adquisicion->num_requisicion = $request->numero_de_requisicion;
                }

                if (isset($request->numero_de_requisicion)) {
                    $adquisicion->num_requisicion = $request->numero_de_requisicion;
                }

                if (isset($request->origen_de_recurso)) {
                    $origen = CatOrigenRecurso::where('clave_origen_recurso', $request->origen_de_recurso)->first();
                    $adquisicion->id_origen_recurso = $origen->id;
                }

                if (isset($request->tipo_de_movimiento)) {
                    //esta por verse
                }

                if (isset($request->rfc_del_proveedor)) {
                    $proveedor = Proveedor::where('rfc', $request->rfc_del_proveedor)->first();
                    if ($proveedor) {
                        $adquisicion->id_proveedor = $proveedor->id;
                    }else{
                        $proveedor = Proveedor::createOrUpdate([
                            'rfc' => $request->rfc_del_proveedor,
                            'tipo_persona' => $request->tipo_persona,
                            'razon_social' => $request->razon_social_del_proveedor,
                        ]);
                        $adquisicion->id_proveedor = $proveedor->id;
                    }
                }

                $adquisicion->save();

                if (isset($request->crear_licitacion)) {
                    Licitacion::where('id_adquisicion', $adquisicion->id)->delete();
                    $unidad_consolidada = CatUnidadConsolidadora::where('clave_unidad_consolidadora', $request->unidad_consolidadora)->first();
                    Licitacion::create([
                        'num_licitacion' => $request->crear_licitacion,
                        'id_unidad_consolidadora' => $unidad_consolidada->id,
                        'id_adquisicion' => $adquisicion->id,
                        'activo' => true,
                    ]);
                }
                return response()->json(['mensaje' => 'Se registro la adquisicion', 'id' => $adquisicion], 200);
            }catch(Exception $e){
                DB::rollBack();
                Log::error(__METHOD__. " -> ". $e->getMessage());
                return response()->json(['mensaje' => 'No se pudo registrar la adquisicion'], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function showContratoArtmed($element_id, $contrato_id)
    {
        $contrato = $this->showOne($contrato_id);
        $id = Hashids::decode($element_id);
        $id = $id[0];
        $artmed = CatArtmed::find($id);
        if ($contrato->clave_tipo_contrato === 'C') {
            $contratoArtmed = ContratoCerradoDetalle::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->first();
            $contratoArtmed->contratoCerrado = ContratoCerrado::where('id', Hashids::decode($contrato_id))->first();
            $contratoArtmed->periodos = ContratoCerradoAbastecimiento::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->get();
            $option = 1;
        } else if ($contrato->clave_tipo_contrato === 'A') {
            $option = 2;
            $contratoArtmed = ContratoAbiertoDetalle::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->first();
            $contratoArtmed->contratoAbierto = ContratoAbierto::where('id', Hashids::decode($contrato_id))->first();
        }
        return view('contratos.articulos._show', compact('artmed', 'contrato', 'contratoArtmed', 'option'))->render();
    }

    public function showCreateContratoArtmed($element_id, $contrato_id)
    {
        $contrato = $this->showOne($contrato_id);
        if ($contrato->clave_tipo_contrato === 'C') {
            //Articulo con cantidad, precio y periodo de entregas parciales
            $option = 1;
            $contratoArtmed = ContratoCerradoDetalle::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->first();
            if (isset($contratoArtmed)) {
                $contratoArtmed->periodos = ContratoCerradoAbastecimiento::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->get();
                foreach ($contratoArtmed->periodos as $periodo) {
                    $periodo->fecha_inicio = date("d/m/Y", strtotime($periodo->fecha_inicio));
                    $periodo->fecha_termino = date("d/m/Y", strtotime($periodo->fecha_termino));
                }
            }
        } else if ($contrato->clave_tipo_contrato === 'A') {
            //Articulo con cantidad minima, cantidad maxima, precio
            $option = 2;
            $contratoArtmed = ContratoAbiertoDetalle::where('id', Hashids::decode($contrato_id))->where('id_artmed', Hashids::decode($element_id))->first();
        }
        //$contratoArtmed->artmed = CatArtmed::find(Hashids::decode($element_id))->first();
        $artmed = CatArtmed::find(Hashids::decode($element_id))->first();
        return view('contratos.articulos.modal_articulo_inicial', compact('element_id', 'contrato_id', 'option', 'artmed', 'contratoArtmed'))->render();

    }

    public function getArticulos($contrato)
    {
        $tipo_de_contrato = CatTipoContrato::where('id', $contrato->id_tipo_contrato)->first();
        $articulos = null;
        if ($tipo_de_contrato->clave_tipo_contrato == 'C') {
            $articulos = DB::table('contratos_cerrados')
                ->join('cat_artmed', 'contratos_cerrados.id_artmed', 'cat_artmed.id')
                ->select('cat_artmed.*', 'contratos_cerrados.*')
                ->where('contratos_cerrados.id', Hashids::decode($contrato->id))->get();
        } else if ($tipo_de_contrato->clave_tipo_contrato == 'A') {
            $articulos = DB::table('contratos_abiertos_detalle')
                ->join('cat_artmed', 'cat_artmed.id', 'contratos_abiertos_detalle.id_artmed')
                ->select('contratos_abiertos_detalle.*', 'cat_artmed.*')
                ->where('contratos_abiertos_detalle.id', Hashids::decode($contrato->id))->get();
        }

        if (isset($articulos)) {
            $arr = array();
            foreach ($articulos as $articulo) {
                array_push($arr, $articulo->id);
            }
            $artmeds = CatArtmed::whereIn('id', $arr)->get();
        }
        return $articulos;
    }

    public function showCreateContratos($contrato = null)
    {

    }

    public function validarArchivos($id, Request $request)
    {
        try {
            $contrato = $this->showOne($id);
            $id_contrato = Hashids::decode($contrato->id);
            $id_adquisicion = $contrato->id_adquisicion;
            $tipo_seccion = CatTipoSeccion::where('clave_tipo_seccion', 'CONT')->first();
            $id_tipo_seccion = $tipo_seccion->id;
            //$user = Auth::user()->persona->puesto_persona->first();
            $user = Auth::user();
            $puesto_persona = PuestosPersona::where('id_persona', $user->id)->first();
            $puesto_estructura = CatPuestoEstructuraParticipanteContrato::where('id_puesto_estructura', $puesto_persona->id_puesto_funcional)->first();
            if ($puesto_estructura !== null) {
                $tipo_participante_contrato = CatTipoParticipanteContrato::where('id', $puesto_estructura->id_tipo_participante_contrato)->first();
                $mensaje = 'no paso nada';
                if ($request->hasFile('file')) {
                    $mensaje = 'entro a has file';
                    // Upload path
                    $destinationPath = public_path('storage/pdfs/');

                    // Get file extension
                    $extension = $request->file('file')->getClientOriginalExtension();

                    // Valid extensions
                    $validextensions = array("pdf");

                    // Check extension
                    if (in_array(strtolower($extension), $validextensions)) {
                        $mensaje = 'Archivos guardados correctamente';

                        $var = explode(".", ($request->file('file')->getClientOriginalName()));
                        $nombreOriginal = '';
                        for ($f = 0; $f < (count($var) - 1); $f++) {
                            $nombreOriginal .= $var[$f] . '.';
                        }
                        // Rename file
                        $fileName = $nombreOriginal . time() . '.' . $extension;
                        // Uploading file to given path
                        $request->file('file')->move($destinationPath, $fileName);
                        $documento = new Documento();
                        $documento->id_adquisicion = $id_adquisicion;
                        $documento->id_tipo_seccion = $id_tipo_seccion;
                        $documento->id_puesto_persona = $puesto_persona->id;
                        $documento->filename = $fileName;
                        $documento->real_path = $destinationPath;
                        $documento->download_path = $destinationPath;
                        $documento->activo = true;
                        $documento->save();

                        $participante_contrato = new ParticipanteContrato();
                        $participante_contrato->id_contrato = $id_contrato[0];
                        $participante_contrato->id_puesto_persona = $puesto_persona->id;
                        $participante_contrato->id_tipo_participante_contrato = $tipo_participante_contrato->id;
                        $participante_contrato->activo = true;
                        $participante_contrato->save();

                        $participantes = ParticipanteContrato::all();
                    }
                }
            }
            return ['mensaje' => $mensaje, 'id' => $contrato->id, 'documento' => $documento, 'ver' => $var, 'participantes' => $participantes];
        } catch (Exception $e) {
            return $e;
        }
    }

    public function validarPrevisualizacion(Request $request)
    {
        //Si las cantidades a entregar son iguales a las cantidades establecidas se publicara
        //Exista 3 participantes en el contrato, elaboro | revisó | autorizo
        $id_contrato = Hashids::decode($request->id);
        $id_contrato = $id_contrato[0];
        $contrato = $this->showOne($request->id);
        $validado = true;
        $cantidades = true;
        $usuarios = true;

        //comprobar si los usuarios que participaron son los necesarios para publicar | formalizar
        $participantes_contrato = ParticipanteContrato::where('id_contrato', $id_contrato)->get();
        $array_id=[];
        foreach ($participantes_contrato as $participante){
            array_push($array_id,$participante->id_tipo_participante_contrato);
        }
        $participantes = DB::table('cat_tipo_participante_contrato')->whereIn('id', $array_id)->get();
        $array_clave_tipo_participante_contrato = [];
        foreach ($participantes as $participante){
            array_push($array_clave_tipo_participante_contrato, $participante->clave_tipo_participante_contrato);
        }
        if (!in_array("ELA", $array_clave_tipo_participante_contrato))
            $usuarios=false;

        if (!in_array("REV", $array_clave_tipo_participante_contrato))
            $usuarios=false;

        if (!in_array("AUT", $array_clave_tipo_participante_contrato))
            $usuarios=false;

        if ($contrato->clave_tipo_contrato === 'C') {
            $contrato_cerrado = ContratoCerrado::where('id', $id_contrato)->first();
            $contratos_cerrados_detalle = ContratoCerradoDetalle::where('id', $id_contrato)->get();
            foreach ($contratos_cerrados_detalle as $con) {
                $count = 0;
                $con->cantidad_unidades;
                $contrato_cerrado_abastecimiento = ContratoCerradoAbastecimiento::where('id', $con->id)->where('id_artmed', $con->id_artmed)->get();
                foreach ($contrato_cerrado_abastecimiento as $con2) {
                    $count += $con2->cantidad_unidades;
                }
                if ($count !== $con->cantidad_unidades) {
                    $cantidades = false;
                }
            }



            //Condicion para validar el contrato
            if ($cantidades && $usuarios) {
                $contrato = Contratos::where('id', $id_contrato)->first();
                $contrato->validado = true;
                $contrato->save();
            }
        }
        if ($contrato->clave_tipo_contrato === 'A') {
            if ($usuarios) {
                $contrato = Contratos::where('id', $id_contrato)->first();
                $contrato->validado = true;
                $contrato->save();
            }
        }
        //$participantes = ParticipanteContrato::where('id', $id_contrato)->get();

        return ['mensaje' => 'Finalizado', 'id' => Hashids::encode($contrato->id)];
    }

    public function destroyArchivo(Request $request)
    {
        $contrato = $this->showOne($request->id);
        $id_contrato = Hashids::decode($contrato->id);
        $id_contrato = $id_contrato[0];
        $id_adquisicion = $contrato->id_adquisicion;
        $tipo_seccion = CatTipoSeccion::where('clave_tipo_seccion', 'CONT')->first();

        $id_tipo_seccion = $tipo_seccion->id;
        //$user = Auth::user()->persona->puesto_persona->first();
        $user = Auth::user();
        $puesto_persona = PuestosPersona::where('id_persona', $user->id)->first();

        $tipo_participante_contrato = CatTipoParticipanteContrato::where('clave_tipo_participante_contrato', 'TC')->first();

        $mensaje = 'no paso nada';
        $documento = Documento::where('id_adquisicion', $id_adquisicion)->where('id_tipo_seccion', $id_tipo_seccion)->first();
        if ($documento !== null) {
            // Upload path
            $destinationPath = public_path('storage/pdfs/');
            $ruta = $destinationPath . $documento->filename;

            if (is_file($ruta)) {
                //File::delete($image_path);
                unlink($ruta);
            }

            $documento->delete();
            $participante_contrato = ParticipanteContrato::where('id_contrato', $id_contrato)->where('id_puesto_persona', $puesto_persona->id)->first();
            if ($participante_contrato !== null) {
                $participante_contrato->delete();
            }
            $mensaje = 'Documento eliminado' . $documento . ' Participante en espera de eliminacion';
        }
        return ['mensaje' => $mensaje, 'id' => $contrato->id];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy(Request $request)
    {
        // Dos tablas puede que tengan el id de contratos
        $id = Hashids::decode($request->id);
        $id = $id[0];
        $contrato = $this->showOne($request->id);
        $seccion = CatTipoSeccion::where('clave_tipo_seccion', 'CONT')->first();

        /*
         * $contratos_fundamento = DB::table('contratos_fundamento')->where('id_contrato', $id)->delete();
        $contratos_cerrados_abastecimiento = DB::table('contratos_cerrados_abastecimiento')->where('id', $id)->delete();
        $contratos_cerrados_detalle = DB::table('contratos_cerrados_detalle')->where('id', $id)->delete();
        $contratos_cerrados = DB::table('contratos_cerrados')->where('id', $id)->delete();
        $contratos_abiertos_detalle = DB::table('contratos_abiertos_detalle')->where('id', $id)->delete();
        $contratos_abiertos = DB::table('contratos_abiertos')->where('id', $id)->delete();
        $participantes = DB::table('participantes_contrato')->where('id_contrato', $id)->delete();
        $documento = DB::table('documentos')->where('id_adquisicion', $contrato->id_adquisicion)->where('id_tipo_seccion', $seccion->id)->delete();
         */
        $contrato = Contratos::findOrFail($id);
        $contrato->activo = false;
        $contrato->save();

        //$registro = DB::table('contratos')->where('id', $id)->delete();

        return ['mensaje' => 'Se elimino correctamente'];
    }

    public function destroyContratoArticulo(Request $request)
    {
        $contrato = $this->showOne($request->contrato_id);

        $contrato_id = Hashids::decode($request->contrato_id);
        $element_id = Hashids::decode($request->element_id);
        $contrato_id = $contrato_id[0];
        $element_id = $element_id[0];
        if ($contrato->clave_tipo_contrato === 'C') {
            $deleted = $this->destroyContratoCerradoDetalle($contrato_id, $element_id);
        } else if ($contrato->clave_tipo_contrato === 'A') {
            $deleted = $this->destroyContratoAbiertoDetalle($contrato_id, $element_id);
        }
        return ['mensaje' => 'Se elimino correctamente el Artículo', 'id' => $deleted];
    }

    public function showOne($code)
    {
        $id = Hashids::decode($code);
        $contrato = DB::table('contratos')
            ->join('cat_tipo_contrato', 'contratos.id_tipo_contrato', 'cat_tipo_contrato.id')
            ->join('adquisiciones', 'contratos.id_adquisicion', '=', 'adquisiciones.id')
            ->where('contratos.id', $id)
            ->where('contratos.activo', '=', true)
            ->first();
        $contrato->id = $code;

        if ($contrato->id_proveedor !== null) {
            $proveedor = Proveedor::where('id', $contrato->id_proveedor)->first();
            $contrato->razon_social = $proveedor->razon_social;
        }

        $array = array();
        $contrato_fundamento = ContratoFundamento::where('id_contrato', Hashids::decode($contrato->id))->get();
        foreach ($contrato_fundamento as $fundamento) {
            array_push($array, $fundamento->id_fundamento_legal);
        }
        $fundamento_legal = CatFundamentoLegal::whereIn('id', $array)->get();
        if ($contrato_fundamento !== null) {
            $contrato->fundamentos_legales = $fundamento_legal;
        }

        return $contrato;
    }

    public function showAll()
    {
        $contratos = DB::table('contratos')
            ->join('adquisiciones', 'contratos.id_adquisicion', '=', 'adquisiciones.id')
            ->join('cat_tipo_contrato', 'contratos.id_tipo_contrato', 'cat_tipo_contrato.id')
            ->select('contratos.*', 'adquisiciones.num_oficio_adjudicacion', 'adquisiciones.id_proveedor', 'cat_tipo_contrato.tipo_contrato')
            ->where('contratos.activo', '=', true)
            ->get()
            ->each(function ($contrato) {
                $contrato->id = Hashids::encode($contrato->id);
            });

        foreach ($contratos as $contrato) {
            if ($contrato->id_proveedor !== null) {
                $proveedor = Proveedor::where('id', $contrato->id_proveedor)->first();
                $contrato->razon_social = $proveedor->razon_social;
            }
        }

        foreach ($contratos as $contrato) {
            $contrato_fundamento = ContratoFundamento::where('id_contrato', Hashids::decode($contrato->id))->get();
            if ($contrato_fundamento !== null) {
                $contrato->fundamentos_legales = $contrato_fundamento;
            }
        }
        return $contratos;
    }

    //Corroborar si existe un registros
    public function contratosHaveAny(Request $request, $id = null)
    {
        if (isset($request->numero_de_contrato))
            $id = $request->numero_de_contrato;
        $valor = false;
        $contrato = Contratos::whereRaw("LOWER(num_contrato) = ? ", strtolower($request->id));
        if (isset($request->adquisicion)) {
            $contrato = $contrato->whereNotIn('id_adquisicion', [Hashids::decode($request->adquisicion)[0]]);
        }
        $contrato = $contrato->get();
        $valor = ($contrato->count() > 0) ? true : false;
        if (isset($request->form_validation_format)) { //si se consulta desde un formvalidation
            return json_encode(array(
                'valid' => !$valor,
            ));
        } else {
            //  AQUI ENTRA EN EL CODIGO DE VIC
            if ($contrato->count() <= 0) {
                return false;
            } else {
                return
                    [
                        'status' => true,
                        'contrato' => $this->showOne(Hashids::encode($contrato->first()->id))
                    ];
            }
        }
    }
}
