@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">datos de carpeta</span>
</li>
@endsection

@section('FOC_content')

<!--begin::INICIA CARD 2-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-primary"></i>
            </span>
            <h3 class="card-label">
                Editar datos de carpeta
            </h3>
        </div>
    </div>
    <div class="card-body">
        
        <form name="" id="frm_nueva_entrada" action="{{route('entradas.fondoOficinas.store')}}" method="post">
            @method('POST')
            @csrf
            
            <div class="form-group row">
                
                <div class="col-lg-3">
                    <label>Folio:</label>
                    <input id="folio" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value="{{$adquisicion->folio_adquisicion}}"   disabled autofoc>
                </div>

                <div class="col-lg-3">
                    <label>Oficio adjudicación:</label>
                    <input id="oficio_adjudicacion" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value="{{$adquisicion->num_oficio_adjudicacion}}"  autofoc>
                </div>
                <div class="col-lg-3">
                    <label>Contrato:</label>
                    <input id="contrato" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value=""  autofoc>
                </div>
                <div class="col-lg-3">
                    <label>Requisición:</label>
                    <input id="contrato" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value="{{$adquisicion->num_requisicion}}"  autofoc>
                </div>
            </div><hr>
            
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('RFC (con homoclave) del proveedor:') }}</label>
                    <div class="input-group">
                        <input id="rfc" type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" value="{{$adquisicion->proveedor->rfc}}"  autofocus>
                        @if ($errors->has('rfc'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rfc') }}</strong>
                            </span>
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btn-proveedor-searh">buscar</button>
                        </div>
                    </div>
                    <span class="form-text text-muted">Buscar proveedor por RFC</span>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Nombre/Razón social:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }}" name="proveedor_razon" id="proveedor_razon" value="{{$adquisicion->proveedor->razon_social}}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Representante:') }}</label>
                    <input type="text" class="form-control{{ $errors->has('pedido') ? ' is-invalid' : '' }}" name="" value="" id="proveedor_domicilio" disabled="" autofoc>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('Nombre:') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" id="proveedor_telefono" value="{{$adquisicion->proveedor->fisica_nombre}}" disabled="" autofoc>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Primer Apellido:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }}" name="proveedor" id="proveedor_email" value="{{$adquisicion->proveedor->fisica_primer_ap}}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Segundo Apellido:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('representante') ? ' is-invalid' : '' }}" id="proveedor_representante" name="representante" value="{{$adquisicion->proveedor->fisica_segundo_ap}}" disabled="" autofoc>
                </div>
                
            </div>
            

        <div class="card-footer">
            <div class="row">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" href="" class="btn btn-primary font-weight-bold">Guardar</button>
                </div>
            </div>
        </div>      
    </form>
    <!-- end:: TERMINA FORMULARIO DATOS GENERALES -->
 </div>
</div>
<!--begin::TERMININA CARD 2 -->



@endsection
@section('scripts')
    <script type="text/javascript">
            //$("#rfc").val("SACN870414");
            //$("#proveedor_razon").val("soluciones integrales sa de cv");
             //$("#proveedor_razon").val("soluciones integrales sa de cv");
             //$("#proveedor_domicilio").val("avelino valencia 1c, tlalpan cdmx");
             //$("#proveedor_telefono").val("5554851763");
             //$("#proveedor_email").val("jnoesalgadomx@gmail.com");
             //$("#proveedor_representante").val("jose noe salgado casiano");
             //$("#giro_del_proveedor").val("Farmaceuticos y de salud");
            //$("#contrato").val("ADS-2021-09898");
             

    </script>
@endsection