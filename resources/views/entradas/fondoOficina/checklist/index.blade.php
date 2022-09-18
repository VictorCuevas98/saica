@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">Listas de revisión</span>
</li>
@endsection

@section('FOC_content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-chat-1 text-primary"></i>
                    </span>
                   <h3 class="card-label">
                        Listas de revisión
                        <small></small>
                   </h3>
                </div>
                <div class="card-toolbar">
                    @if(Auth::user()->hasAnyPermission(['entradas.contratosAbiertos.lista_de_revision.crear','entradas.contratosCerrados.lista_de_revision.crear']))
                    <a href="{{route('entradas.fondoOficinas.checklist.create',$adquisicionId)}}" class="btn btn-sm btn-primary font-weight-bold">
                        <i class="flaticon2-cube"></i> Nueva lista de revisión
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Folio de revisión:</th>
                            <th>Doc:</th>
                            <th>Núm Doc:</th>
                            <th>Completa:</th>
                            <th>Estatus:</th>
                            <th>Articulos:</th>
                             <th>Aplicada:</th>
                            <th>Creado el:</th>
                            <th>Acciones:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adquisicion->docsPago()->orderBy('id')->get() as $documentoPago)
                        @php
                            $entradaId = $documentoPago->entradasAdquisicion->first()->id ;
                            $clave_status_entrada =  $documentoPago->entradasAdquisicion->first()->entradasAdquisicionRevisionStatus()->activos()->get();
                            $arrTiposContrato = $adquisicion->contratos()->with('tipoContrato')->get()->pluck('tipoContrato.clave_tipo_contrato');
                           
                        @endphp
                        <tr>
                            <td>{{$documentoPago->entradasAdquisicion->first()->entrada->folio_entrada}}</td>
                            <td>{{$documentoPago->tipoDocPago->tipo_doc_pago}}</td>
                            <td>{{$documentoPago->num_doc_pago}}</td>
                            <td>
                                @if($documentoPago->entradasAdquisicion->first()->respuestasRevision()->where('respuesta',false)->get()->count()>0)
                                    <span class="label label-danger label-pill label-inline mr-2">No</span>
                                @else
                                    <span class="label label-success label-pill label-inline mr-2">Si</span>
                                @endif
                            </td>
                            <td>
                                @if($clave_status_entrada->count()>0)
                                    {{ $clave_status_entrada->first()->catStatus->status_revision_entrada }}
                                @else
                                    --
                                @endif
                            </td>
                            <td>{{$documentoPago->entradasAdquisicion->first()->entradasAdquisicionDetalle()->activos()->count()}}</td>
                            <td>--</td>
                            <td>{{$documentoPago->entradasAdquisicion->first()->created_at}}</td>
                            <td>
                                
                               <a href="{{route('entradas.fondoOficinas.checklist.show',[$adquisicionId,Hashids::encode($entradaId)])}}" class="btn btn-sm btn-clean btn-icon" title="Ver Lista">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="{{route('entradas.fondoOficinas.checklist.edit',[$adquisicionId,Hashids::encode($entradaId)])}}" class="btn btn-sm btn-clean btn-icon" title="Editar Lista">
                                    <i class="far fa-list-alt"></i>
                                </a>
                                @if(  $clave_status_entrada->pluck('catStatus.clave_status_revision_entrada')->contains('AO') ||  $clave_status_entrada->pluck('catStatus.clave_status_revision_entrada')->contains('A'))

                                <a href="{{route('entradas.fondoOficinas.documento.edit',[$adquisicionId, Hashids::encode($documentoPago->id)])}}" class="btn btn-sm btn-clean btn-icon" title="Documento de Pago">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </a>
                                    @if($arrTiposContrato->contains('C') && auth()->user()->can('entradas.contratosCerrados.lista_de_revision.listar') )
                                    <a href="{{route('entradas.entradasContratosCerrados.checklist.articulos.index',[$adquisicionId,Hashids::encode($entradaId)])}}" class="btn btn-sm btn-clean btn-icon" title="Articulos para contrato cerrado">
                                        <i class="fas fa-pills"></i>
                                    </a>
                                    @endif
                                    @if($arrTiposContrato->contains('A') && auth()->user()->can('entradas.contratosAbiertos.lista_de_revision.listar') )
                                    <a href="{{route('entradas.fondoOficinas.checklist.articulos.index',[$adquisicionId,Hashids::encode($entradaId)])}}" class="btn btn-sm btn-clean btn-icon" title="Articulos para contrato abierto">
                                        <i class="fas fa-pills"></i>
                                    </a>
                                    @endif
                                
                                @endif
                                @if($adquisicion->contratos->count()>0)
                                <a href="{{route('fondoOficinas.checklist.epa.descarga',[$adquisicionId,Hashids::encode($entradaId)])}}"  class="btn btn-sm btn-clean btn-icon" target="_blank" title="EPA">
                                    <i class="far fa-file-pdf"></i>
                                </a> 
                                @else
                                    <a href="javascript:;"  class="btn btn-sm btn-clean btn-icon" target="" title="Sin contrato">
                                    <i class="far fa-file-excel"></i>
                                </a> 
                                @endif
                                <!--<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                    <i class="far fa-trash-alt"></i>
                                </a> -->
                            </td>
                        </tr>
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between">
                
            </div>
        </div>


    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
     pageloader_in(1000,"Cargando....");


</script>
@endsection
