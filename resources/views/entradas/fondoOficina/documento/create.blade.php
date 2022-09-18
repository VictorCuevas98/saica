@extends('layout.default')


@section('content')

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
                <a  href="{{route('entradas.fondoOficinas.index')}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2" >Regresar</a>
            <!--end::Button-->
            <button type="button" class="btn btn-primary" id="btn-modal-search-artmed">
                BUSQUEDA DE ARTICULO
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalArtmedSearch">
                BUSQUEDA DE ARTICULO form
            </button>
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->


<div>
  @if($errors->any())
  <ul>
    @foreach($errors->all as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>

  @endif
</div>

<div class="row">
    <div class="col-md-12">
        <!--begin::INICIA CARD 2-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-chat-1 text-primary"></i>
                    </span>
                    <h3 class="card-label">
                        Datos Generales
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!-- begin:: INICIA FORMULARIO DATOS GENERALES -->
                <form name="" id="" action="{{route('entradas.fondoOficinas.documento.store',[$fondoOficinaId])}}" method="post">
              @method('POST')
              @csrf
                    <!-- begin:: PRIMERA SECCIÓN (TIPO DE DOCUMENTO, FECHA DEL No. DE FACTURA O REMISION, No DE FACTURA O REMISION)-->
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Tipo de documento</label>
                            <div class="radio-inline">
                                <label class="radio radio-solid">
                                <input type="radio" name="example_2" checked="checked" value="2"/> Factura
                                <span></span>
                                </label>
                      
                                <label class="radio radio-solid">
                                <input type="radio" name="example_2" value="2"/>Remisión
                                <span></span>
                                </label>
                            </div>
                            <span class="form-text text-muted">Selecciona una opción</span>
                        </div>
                        <div class="col-lg-4">
                            <label>Fecha del No. de factura o remisión:</label>
                            <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" autofocus>
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="col-lg-4">
                            <label>No. de factura o remisión:</label>
                            <input id="no_factura" type="text" class="form-control{{ $errors->has('no_factura') ? ' is-invalid' : '' }}" name="no_factura" value="{{ old('no_factura') }}" autofoc>
                              @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('folio') }}</strong>
                                  </span>
                              @endif
                        </div>
                    </div><hr>
                    <!-- end:: TERMINA PRIMERA SECCIÓN (TIPO DE DOCUMENTO, FECHA DEL No. DE FACTURA O REMISION )-->

                    <!--begin:: INICIA SEGUNDA SECCION (No DE AUTORIZACION, FOLIO, No CONTRATO/ADJUDICACIÓN, PEDIDO)-->
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>No de Autorización:</label>
                            <input id="no_autorizacion" type="text" class="form-control{{ $errors->has('no_autorizacion') ? ' is-invalid' : '' }}" name="no_autorizacion" value="{{ old('no_autorizacion') }}" autofoc>
                              @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('no_autorizacion') }}</strong>
                                  </span>
                              @endif
                        </div>
                        <div class="col-lg-3">
                            <label>Folio:</label>
                            <input id="folio" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value="{{ old('folio') }}" autofoc>
                              @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('folio') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="col-lg-4">
                            <label>No. de Contrato / Adjudicación:</label>
                            <input id="no_contrato" type="text" class="form-control{{ $errors->has('no_contrato') ? ' is-invalid' : '' }}" name="no_contrato" value="{{ old('no_contrato') }}" autofoc>
                              @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('no_contrato') }}</strong>
                                  </span>
                              @endif
                            <span class="">
                                <div class="radio-inline">
                                <label class="radio radio-solid">
                                <input type="radio" name="example" checked="checked" value=""/>No. De contrato
                                <span></span>
                                </label>
                                <label class="radio radio-solid">
                                <input type="radio" name="example" value=""/>Oficio de Adjudicación
                                <span></span>
                                </label>
                            </div>
                            </span>
                        </div>
                        <div class="col-lg-2">
                            <label>Pedido:</label>
                            <input id="pedido" type="text" class="form-control{{ $errors->has('pedido') ? ' is-invalid' : '' }}" name="pedido" value="{{ old('pedido') }}" autofoc>
                              @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pedido') }}</strong>
                                  </span>
                              @endif
                        </div>
                    </div><hr>
                    <!-- end::TEMRINA SEGUNDA SECCION (No DE AUTORIZACION, FOLIO, No CONTRATO/ADJUDICACIÓN, PEDIDO)-->

                    <!--begin::INICIA TERCERA SECCION (PROVEEDOR) -->
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
                            <input id="domicilio" type="text" class="form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{ old('domicilio') }}" disabled="" autofoc>
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
                    </div><hr>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>{{ __('Observaciones:') }}</label>
                            <div class="input-group">
                                <textarea id="Observaciones" type="text" class="form-control{{ $errors->has('Observaciones') ? ' is-invalid' : '' }}" name="Observaciones" value="{{ old('Observaciones') }}"></textarea>
                            </div>
                        </div>
                    </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                            <button type="submit" href="" class="btn btn-primary font-weight-bold">Continuar</button>
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

{{--
@include('cat_artmed._search_modal')
--}}
@endsection

@section('scripts')
<script type="text/javascript">
     pageloader_in(1000,"Cargando....");
    $("#btn-modal-search-artmed").on('click',function(a){
        getSearchModal(function(element){
            console.log(element);
            //AQUI VA EL CODIGO DE LA ACCION DESPUES DE DARLE CLIC A UN ARTICULO 
            //AQUI NOS REGRESA UN OBJETO QUE SE PEUDE OCUPAR
        });
    });

</script>
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('js/cat_artmed/cat_artmed.js')}}"></script>
<!--end::Page Scripts-->

@endsection