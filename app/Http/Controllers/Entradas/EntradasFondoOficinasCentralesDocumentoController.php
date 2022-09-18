<?php

namespace App\Http\Controllers\Entradas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\Entradas\ContratoAbierto\UpdateEntradaFondoOficinaDocumentoRequest;
use App\Adquisicion;
use App\AdquisicionDocPago;
use App\CatTipoDocPago;

class EntradasFondoOficinasCentralesDocumentoController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['role_or_permission:ADMIN']);
    }
    
    

    public function create($adquisicionId){
        //TODO::SI TIENES PERMISOS PARA MODER CREAR 

        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        return view('entradas.fondoOficina.documento.create',compact('adquisicionId','adquisicion'));

    }

    public function store(Request $request,$fondoOficinaId){
        //TODO::GUARDAR 

        //$validated = $request->validated();

        //SE CREA ID -> PARA DOCUMENTO
        $newFondoOficinasDocumentoId = Hashids::encode(100);
 
        //TODO::PASAR EL ID DE FONDO DE OFICINA PADRE
        return redirect()->route('entradas.fondoOficinas.articulos.index',$fondoOficinaId);

    }

    public function edit($adquisicionId,$adquisicionDocPagoId){
        $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
        $adquisicionDocPago = AdquisicionDocPago::find(Hashids::decode($adquisicionDocPagoId)[0]);
        $catTipoDocPago = CatTipoDocPago::activos()->get();
        return view('entradas.fondoOficina.documento.edit',compact('adquisicion','adquisicionId','adquisicionDocPago','adquisicionDocPagoId','catTipoDocPago'));
    }

    public function update(UpdateEntradaFondoOficinaDocumentoRequest $request,$adquisicionId,$adquisicionDocPagoId){
        
        try {
            $adquisicion = Adquisicion::find(Hashids::decode($adquisicionId)[0]);
            $adquisicionDocPago = AdquisicionDocPago::find(Hashids::decode($adquisicionDocPagoId)[0]);
            $tipoDocPago = CatTipoDocPago::where('clave_tipo_doc_pago',$request->tipo_de_documento)->get();

            $adquisicionDocPago->id_tipo_doc_pago = $tipoDocPago->first()->id ;
            $adquisicionDocPago->num_doc_pago =  $request->numero_o_folio_del_documento ;
            $adquisicionDocPago->monto_subtotal =  $request->monto_subtotal ;
            $adquisicionDocPago->monto_impuesto =  $request->monto_de_impuesto ;
            $adquisicionDocPago->monto_total = $request->monto_total  ;
            $adquisicionDocPago->save();

            return redirect()->route('entradas.fondoOficinas.checklist.index',['fondoOficina'=>$adquisicionId]);
            
        } catch (Exception $e) {
            Log::error(__METHOD__." -> ".$e->getMessage());
            return redirect()->route('entradas.fondoOficinas.documento.edit',[
                'adquisicionId'=>$adquisicionId,
                'adquisicionDocPagoId'=>$adquisicionDocPagoId
            ])
            ->with('flash','Error al actualizar los datos');
        }
        

    }
        
}
