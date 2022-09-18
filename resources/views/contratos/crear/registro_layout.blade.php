{{-- Extends layout --}}
@extends('layout.default')
@section('css')
    <link href="{{asset('css/pages/wizard/sedesa/wizard-1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Administrativo</h5>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted">Contratos</span>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->

                <!--begin::Search Form-->
            {{--<div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Total:  </span>
                <form class="ml-5">
                    <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                        <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Buscar..." />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="svg-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                            </span>
                        </div>
                    </div>
                </form>
            </div>--}}
            <!--end::Search Form-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b mt-5">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbard wizard-panel flex-grow-1">
                        <div class="d-flex justify-content-around">
                            <ul class="nav nav-tabs nav-tabs-line flex-fill">
                                <li class="nav-item">
                                    <a class="nav-link {{$seccion1 ?? 'disabled'}}" href="#">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Registro de datos</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{$seccion2 ?? 'disabled'}}" href="#">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Agregar artículo</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{$seccion3 ?? 'disabled'}}" href="#">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Previsualización</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{$seccion4 ?? 'disabled'}}" href="#">
                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                        <span class="nav-text">Ingrese archivo(s)</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="my-auto" style="display: @if(isset($seccion2)){{($seccion2 === 'active') ? 'block':'none'}}@else none @endif">
                                <a href="#" id="btn-modal-search-artmed2"
                                   class="btn btn-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Agregar
                                    Artículo</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-toolbard"></div>

                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @yield('contrato')
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script type="text/javascript" charset="utf8"
                    src="{{ asset('plugins\custom\datatables\datatables.bundle.min.js') }}"></script>
            <script src="{{ asset('js/contratos/crear_contratos.js')}}" type="text/javascript"></script>
            <script src="{{asset('js/cat_artmed/cat_artmed.js')}}"></script>
            <script type="text/javascript" charset="utf8"
                    src="{{asset('js/contratos/bootstrap-datepicker.js')}}"></script>
            <script charset="utf8" src="{{asset('js/contratos/bootstrap-datepicker.es.js')}}"></script>
            <script type="text/javascript" src="{{asset('js/proveedores/proveedores.js')}}"></script>
            <script type="text/javascript"
                    src="{{asset('js/contratos/contrato_artmed/crear_contrato_artmed.js')}}"></script>
            <script type="text/javascript">
                $(document).on('click', "#btn-modal-search-artmed", function() {
                    closeOpenModals();
                    agregarClave();
                });
                //Begin::Proveedor

                function clearProveedorFields() {
                    $('#razon_social_del_proveedor').val("");
                    $('#nombres').val("");
                    $('#primer_apellido').val("");
                    $('#segundo_apellido').val("");
                    $('#tipo_de_persona option[value=M]').prop('selected', null);
                    $('#tipo_de_persona option[value=F]').prop('selected', null);
                    $(".persona_fisica_content").hide();
                    $('#representante_del_proveedor').val("");

                }

                function enableProveedorFields() {
                    $('#razon_social_del_proveedor').attr('disabled', false);
                    $('#nombres').attr('disabled', false);
                    $('#primer_apellido').attr('disabled', false);
                    $('#segundo_apellido').attr('disabled', false);
                    $('#tipo_de_persona').attr('disabled', false);
                    $("#representante_del_proveedor").attr('disabled', false);

                }

                function disabledProveedorFields() {
                    $('#razon_social_del_proveedor').attr('disabled', true);
                    $('#nombres').attr('disabled', true);
                    $('#primer_apellido').attr('disabled', true);
                    $('#segundo_apellido').attr('disabled', true);
                    $('#tipo_de_persona').attr('disabled', true);
                    $("#representante_del_proveedor").attr('disabled', true);
                }

                $('select[name="tipo_de_persona"]').change(function (param) {
                    switch ($(this).val()) {
                        case 'F':
                            $(".persona_fisica_content").show();
                            break;
                        case 'M':
                            $(".persona_fisica_content").hide();
                            $('#nombres').val("");
                            $('#primer_apellido').val("");
                            $('#segundo_apellido').val("");
                            break;
                        default:
                            //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                            break;
                    }
                    _validations[1].revalidateField("razon_social_del_proveedor");
                    _validations[1].revalidateField("nombres");
                    _validations[1].revalidateField("primer_apellido");
                    _validations[1].revalidateField("segundo_apellido");
                });

                $("#btn-proveedor-search").click(function (a) {
                    var rfc_proveedor = $("#rfc_del_proveedor").val();
                    ws_proveedorBuscar(rfc_proveedor, function (res) {
                        if (res.error.code == 0) {
                            if (typeof (res.data) == 'undefined') {
                                swal.fire(
                                    "Lo lamento!",
                                    "El proveedor no fue encontrado.<br> ¿su rfc es correcto?",
                                    "warning"
                                );
                                disabledProveedorFields();
                                clearProveedorFields();
                            } else {
                                //TODO::SE ENCONTRÓ LLENAR LOS CAMPOS
                                swal.fire(
                                    "Exito",
                                    "Proveedor encontrado",
                                    "success"
                                );

                                disabledProveedorFields();
                                switch (res.data.tipo_persona.toLowerCase()) {
                                    case 'fisica':
                                        $('#razon_social_del_proveedor').val("--");
                                        $('#nombres').val(res.data.nombre);
                                        $('#primer_apellido').val(res.data.paterno);
                                        $('#segundo_apellido').val(res.data.materno);
                                        $('#tipo_de_persona option[value=M]').prop('selected', null);
                                        $('#tipo_de_persona option[value=F]').prop('selected', 'selected');
                                        $('#representante_del_proveedor').val(res.data.tipo_representante);
                                        $(".persona_fisica_content").show();
                                        break;
                                    case 'moral':
                                        console.log("persona moral");
                                        //console.log(res.data.tipo_persona.toLowerCase());
                                        $('#razon_social_del_proveedor').val(res.data.razon_social);
                                        $('#nombres').val('--');
                                        $('#primer_apellido').val('--');
                                        $('#segundo_apellido').val('--');
                                        $('#tipo_de_persona option[value=F]').prop('selected', null);
                                        $('#tipo_de_persona option[value=M]').prop('selected', 'selected');
                                        $('#representante_del_proveedor').val(res.data.tipo_representante);
                                        $(".persona_fisica_content").hide();
                                        break;
                                    default:
                                        //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                                        break;
                                }
                                _validations[1].revalidateField("tipo_de_persona");
                                _validations[1].revalidateField("razon_social_del_proveedor");


                            }
                        } else {//ERROR AL CONSUMIR EL WS
                            //
                            //TODO::si existe un error entonces abrir los campos para captura
                            swal.fire(
                                "Lo lamento!",
                                "El servicio de busqueda del proveedor no esta habilitado, así que deberás agregar los datos del proveedor <strong>Manualmente</strong>",
                                "warning"
                            );
                            clearProveedorFields();
                            enableProveedorFields();
                        }
                        //seteando valores
                    });

                });//end::click btn proveedor search

                <!--End::Proveedor-->
            </script>
            <!-- Table Builder -->
@endsection
