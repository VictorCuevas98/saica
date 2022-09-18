@extends('layout.default')

@section('content')
<div >
    @if(count( $errors ) > 0)
       @foreach ($errors->all() as $error)
          <!-- Alert with image / icon -->
            <div class="alert alert-danger"> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
      @endforeach
    @endif
</div>

<!-- begin::Subheader -->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Entradas</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Fondo de Oficinas Centrales</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
                <a  href="{{route('entradas.fondoOficinas.checklist.index',[$adquisicionId])}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2" >Regresar</a>
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->


<div class="row">
    <div class="col-lg-12">
        
        @if(Session::has('flash'))
        <div class="card">
            <div class="card-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <strong>{{session('flash')}}</strong>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
        @endif

       <!--begin::INICIA CARD 2-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-primary"></i>
            </span>
            <h3 class="card-label">
                Datos del documento de pago
            </h3>
        </div>
    </div>
    <div class="card-body">
        <!-- begin:: INICIA FORMULARIO DATOS GENERALES -->
        <form name="" id="" action="{{route('entradas.fondoOficinas.documento.update',[$adquisicionId,$adquisicionDocPagoId])}}" method="post">
            @method('PUT')
            @csrf

            <div class="form-group row">
          
              
           
             </div>


            <div class="form-group row">
                <div class="col-lg-4">
                    
                    <label class="  col-sm-12">Tipo de documento</label>
                     <div class="col-sm-12">
                       <select class="form-control{{ $errors->has('tipo_de_documento') ? ' is-invalid' : '' }}"   name="tipo_de_documento">
                        <option value="">Seleccione ...</option>
                        @foreach($catTipoDocPago as $tipoPago)
                        @php
                            $selected = ($adquisicionDocPago->id_tipo_doc_pago == $tipoPago->id) ? 'selected' : '' ;
                        @endphp
                        <option value="{{$tipoPago->clave_tipo_doc_pago}}" {{$selected}} >{{$tipoPago->tipo_doc_pago}}</option>                        
                        @endforeach
                       </select>
                       <span class="form-text text-muted">Please select an option.</span>
                    </div>

                </div>
            <!--
                <div class="col-lg-4">
                    <label>Fecha del documento:</label>
                    <input id="fecha_del_documento" type="date" class="form-control{{ $errors->has('fecha_del_documento') ? ' is-invalid' : '' }}" name="fecha_del_documento" value="{{ old('fecha_del_documento') }}"    autofocus>
                        @if ($errors->has('rfc'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rfc') }}</strong>
                            </span>
                        @endif
                </div>
            -->
                <div class="col-lg-4">
                    <label>Número o Folio del documento:</label>
                    <input id="numero_o_folio_del_documento" type="text" class="form-control{{ $errors->has('numero_o_folio_del_documento') ? ' is-invalid' : '' }}" name="numero_o_folio_del_documento" value="{{ (old('numero_o_folio_del_documento')) ? old('numero_o_folio_del_documento') : $adquisicionDocPago->num_doc_pago }}"  autofoc>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                
                <div class="col-lg-4">
                    <label>Monto subtotal:</label>
                    <input id="monto_subtotal" type="text" class="form-control{{ $errors->has('monto_subtotal') ? ' is-invalid' : '' }}" name="monto_subtotal" value="{{ (old('monto_subtotal')) ? old('monto_subtotal') : $adquisicionDocPago->monto_subtotal }}"    autofocus>
                        @if ($errors->has('rfc'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rfc') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="col-lg-4">
                    <label>Monto de impuesto:</label>
                    <input id="monto_de_impuesto" type="text" class="form-control{{ $errors->has('monto_de_impuesto') ? ' is-invalid' : '' }}" name="monto_de_impuesto" value="{{ (old('monto_de_impuesto')) ? old('monto_de_impuesto') : $adquisicionDocPago->monto_impuesto }}"  autofoc>
                </div>
                <div class="col-lg-4">
                    <label>Monto total:</label>
                    <input id="monto_total" type="text" class="form-control{{ $errors->has('monto_total') ? ' is-invalid' : '' }}" name="monto_total" 
                    value="{{ (old('monto_total')) ? old('monto_total') : $adquisicionDocPago->monto_total }}"  autofoc>
                </div>
            </div>
            <!-- end:: TERMINA PRIMERA SECCIÓN (TIPO DE DOCUMENTO, FECHA DEL No. DE FACTURA O REMISION )-->

            <!--begin:: INICIA SEGUNDA SECCION (No DE AUTORIZACION, FOLIO, No CONTRATO/ADJUDICACIÓN, PEDIDO)-->
        
            <!-- end::TEMRINA SEGUNDA SECCION (No DE AUTORIZACION, FOLIO, No CONTRATO/ADJUDICACIÓN, PEDIDO)-->

            <!--begin::INICIA TERCERA SECCION (PROVEEDOR) -->
            <!--
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('RFC (con homoclave) del proveedor:') }}</label>
                    <div class="input-group">
                        <input id="rfc" type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" value="{{ old('rfc') }}"  autofocus>
                        @if ($errors->has('rfc'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rfc') }}</strong>
                            </span>
                        @endif
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">Ir</button>
                        </div>
                    </div>
                    <span class="form-text text-muted">Buscar proveedor por RFC</span>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Nombre/Razón social:') }}</label>
                    <input id="proveedor" type="text" class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }}" name="proveedor" value="{{ old('proveedor') }}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Domicilio:') }}</label>
                    <input id="pedido" type="text" class="form-control{{ $errors->has('pedido') ? ' is-invalid' : '' }}" name="pedido" value="{{ old('pedido') }}" disabled="" autofoc>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('Teléfono:') }}</label>
                    <div class="input-group">
                        <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" disabled="" autofoc>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Correo electrónico:') }}</label>
                    <input id="proveedor" type="text" class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }}" name="proveedor" value="{{ old('proveedor') }}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Representante:') }}</label>
                    <input id="representante" type="text" class="form-control{{ $errors->has('representante') ? ' is-invalid' : '' }}" name="representante" value="{{ old('representante') }}" disabled="" autofoc>
                </div>
            </div>
        -->
        <div class="card-footer">
            <div class="row">
               
                <div class="col-lg-12">
                    <a type="button" href="{{route('entradas.fondoOficinas.checklist.index',[$adquisicionId])}}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary font-weight-bold float-right">Guardar</button>
                </div>
            </div>
        </div>      
    </form>
    <!-- end:: TERMINA FORMULARIO DATOS GENERALES -->
 </div>
</div>
<!--begin::TERMININA CARD 2 -->

    </div>
</div>
@endsection