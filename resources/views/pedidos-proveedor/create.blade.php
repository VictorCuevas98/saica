@extends('layout.default')
@section('content')

{{--  @include('modals.busca-articulos-modal')
@include('pedidos-proveedor.modales.busca-proveedor-modal')--}}
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Pedidos a Proveedor</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Crear Pedido</span>
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
            <a href="{{ url('/pedidos-proveedor') }}"
                class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-1" id="kt_wizard_v1" data-wizard-state="step-first"
                    data-wizard-clickable="false">
                    <!--begin::Wizard Nav--> 
                    <div class="wizard-nav border-bottom">
                        <div class="wizard-steps p-8 p-lg-10">
                            <!--begin::Wizard Step 1 Nav-->
                            <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-folder"></i>
                                    <h3 class="wizard-title">Busqueda de Contrato</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3"
                                                transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                x="11" y="5" width="2" height="14" rx="1" />
                                            <path
                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 1 Nav-->
                        
                            <!--begin::Wizard Step 2 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-truck"></i>
                                    <h3 class="wizard-title">2. Datos del proveedor</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3"
                                                transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                x="11" y="5" width="2" height="14" rx="1" />
                                            <path
                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 2 Nav-->
                            <!--begin::Wizard Step 3 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-list"></i>
                                    <h3 class="wizard-title">3. Datos Complementarios</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow last">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3"
                                                transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                x="11" y="5" width="2" height="14" rx="1" />
                                            <path
                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 3 Nav-->
                        </div>
                    </div>
                    <!--end::Wizard Nav-->

                    <!--begin::Wizard Body-->
                    <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-7">
                            <!--begin::Wizard Form-->
                            <form class="form" id="kt_form" action="{{route('create-pedido-proveedor')}}" method="post">
                                @method('POST')
                                @csrf
                                <!--begin::Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    <!--<h3 class="mb-10 font-weight-bold text-dark">Datos de contrato, requisicion u oficio de adjudicación</h3> -->
                                    <!--begin::Input-->
                                    <!--
                                        <div style="display: none;" class="form-group">
                                            <label>folio</label>
                                            <input type="text" class="form-control form-control-solid form-control-lg"
                                                name="folio"
                                                id="folio" placeholder="Address Line 1"
                                                value="EPCA-{{date('Y')}}-{{strtoupper(Str::random(4))}}" readonly="" />
                                            <span class="form-text text-muted">Please enter your Address.</span>
                                        </div>
                                    -->
                                    <!--end::Input-->
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Oficio adjudicación</label>
                                                <input type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="adjudicacionInput" placeholder="" value=""
                                                    id="adjudicacionInput" />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Número de contrato</label>
                                                <input id="contratoInput" type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="contratoInput" placeholder="" value="" />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1-->
                                <!--begin::Wizard Step 2-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <h4 style="display: none;" class="mb-10 font-weight-bold text-dark">Busqueda del proveedor</h4>
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>RFC</label>

                                        <div class="input-group input-group-solid">
                                            <input type="text" class="form-control form-control-lg"
                                                aria-label="botón para buscar el rfc en el padrón de proveedores"
                                                name="rfc_del_proveedor" id="rfc_del_proveedor" value=""
                                                id="" />
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary " onclick="buscaProveedor()"
                                                    id="btn-proveedor-search">
                                                    Buscar RFC
                                                </button>
                                            </div>
                                        </div>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                    <!--end::Input-->
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <!--begin::Select-->
                                            <div class="form-group">
                                                <label>Tipo de persona</label>
                                                <select name="tipo_de_persona"
                                                    class="form-control form-control-solid form-control-lg" disabled
                                                    id="tipo_de_persona">
                                                    <option value="">Selecionar...</option>
                                                    <option value="F">Fisica</option>
                                                    <option value="M">Moral</option>
                                                </select>
                                            </div>
                                            <!--end::Select-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Razón social</label>
                                                <input type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="razon_social_del_proveedor" id="razon_social_del_proveedor"
                                                    placeholder="" value="" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Representante legal:</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg"
                                            name="representante_del_proveedor" id="representante_del_proveedor"
                                            placeholder="" value="" disabled />
                                        <span class="form-text text-muted"></span>
                                    </div>
                                    <!--end::Input-->
                                    <div class="row persona_fisica_content" style="display: none;">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="nombres" placeholder="" id="nombres" value="" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Primer apellido</label>
                                                <input type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="primer_apellido" id="primer_apellido" placeholder="" value=""
                                                    disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="row persona_fisica_content" style="display: none;">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Segundo apellido</label>
                                                <input type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="segundo_apellido" id="segundo_apellido" placeholder=""
                                                    value="" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                </div>
                                <!--end::Wizard Step 2-->
                                <!--begin::Wizard Step 3-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <h4 class="mb-10 font-weight-bold text-dark">Datos Complementarios</h4>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Fecha de solicitud:</label>                                                
                                                <input type="date"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="solicitudInput" placeholder="" value=""
                                                    id="solicitudInput" />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Fecha de entrega</label>
                                                <input id="entregaInput" type="date"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="entregaInput" placeholder="" value="" />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label for="folio">Folio del pedido</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                    name="folio"
                                                    id="folio" placeholder="Folio del pedido"
                                                    value=""/>
                                                    @if($errors->has('folio'))
                                                        <div class="error">{{ $errors->first('folio') }}</div>
                                                    @endif
                                                {{--  <span class="form-text text-muted"></span>--}}
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                        
                                        </div>
                                    </div>
                                    {{--  
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Almacen:</label>                                                
                                                <select type="date"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="almacen" placeholder="" value=""
                                                    id="almacen" >
                                                    <option value="0">Seleccione un almacen</option>
                                                    @foreach ($almacenes as $almacen)
                                                        <option value="{{ $almacen->id }}">{{ $almacen->almacen }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    --}}
                                </div>
                                <!--end::Wizard Step -->
                                <!--begin::Wizard Actions-->
                                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                    <div class="mr-2">
                                        <a onclick="goPrev()" class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-prev">Anterior</a>
                                    </div>
                                    <div>
                                        <a id="buttonGenerar" style="display: none" onclick="generaPedido()" class="btn btn-success font-weight-bold text-uppercase px-9 py-4">Generar pedido</a>
                                        {{-- <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-submit">Aceptar</button>--}}
                                        <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-next">Siguiente</button>
                                    </div>
                                </div>
                                <!--end::Wizard Actions-->
                            </form>
                            <!--end::Wizard Form-->
                        </div>
                    </div>
                    <!--end::Wizard Body-->
                </div>
            </div>
            <!--end::Wizard-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


{{-- Scripts Section --}}
@section('scripts')
{{--<link href="{{asset('css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{asset('css/pages/wizard/sedesa/wizard-1.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{URL::asset('js/pedidos-proveedor/create-wizard.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/pedidos-proveedor/create.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/proveedores/proveedores.js')}}"></script>
@endsection
@endsection
