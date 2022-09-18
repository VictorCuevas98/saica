@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">Contratos relacionados</span>
</li>
<li class="breadcrumb-item text-muted">
    <span class="text-muted">{{$contrato->num_contrato}}</span>
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
                        Contrato: {{$contrato->num_contrato}}
                        <small>Articulos relacionados</small>
                   </h3>
                </div>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <div class="card-body">

                @if(!is_null($contrato->contratoAbierto))
                    @include('entradas.fondoOficina.contratos._showContratoAbierto')
                @endif
                @if($contrato->contratosCerrados->count()>0)
                    @include('entradas.fondoOficina.contratos._showContratoCerrado')
                @endif
                
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
