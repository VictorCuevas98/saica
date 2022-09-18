@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">Contratos relacionados</span>
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
                        Contratos relacionados
                        <small></small>
                   </h3>
                </div>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Tipo de contrato</th>
                            <th>Fecha</th>
                            <th>Articulos</th>
                            <th>Validado</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adquisicion->contratos as $contrato)

                            <tr>
                                <td>{{$contrato->num_contrato}}</td>
                                <td>
                                    {{$contrato->tipoContrato->tipo_contrato}}
                                </td>
                                <td>{{$contrato->fecha_contrato}}</td>
                                <td>
                                    @if(is_null($contrato->contratoAbierto))
                                        --
                                    @else
                                        {{$contrato->contratoAbierto->articulosContratoAbierto->count()}}
                                    @endif
                                </td>
                                <td>{{$contrato->validado}}</td>
                                <td>{{$contrato->observaciones}}</td>
                                <td>
                                    @if(!is_null($contrato->contratoAbierto) || $contrato->contratosCerrados->count()>0)
                                    <a href="{{route('entradas.fondoOficinas.contratos.show',[$adquisicionId,Hashids::encode($contrato->id)])}}" class="btn btn-sm btn-clean btn-icon" title="Ver">
                                        <i class="fas fa-folder-open"></i>
                                    </a>
                                    @endif
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
