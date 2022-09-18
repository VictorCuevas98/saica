{{-- Extends layout --}}
@extends('layout.default')
@section('content')
    @include('contratos.validar_contrato')
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
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                    <span class="card-icon svg-icon menu-icon">
                        <!-- svg icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                    fill="#000000" opacity="0.3"></path>
                                <path
                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                    fill="#000000"></path>
                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"></rect>
                                </g>
                        </svg>
                        <!-- svg icon end -->
                    </span>
                        <h3 class="card-label">Contratos</h3>
                    </div>
                    <div class="d-flex align-items-center float-right">

                    </div>
                </div>
                <div class="card-body">
                    <!-- inicio: Formulario de busqueda -->
                    <form class="kt-form kt-form--fit mb-15">
                        <div class="row mb-6">
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Fecha:</label>
                                <input type="text" data-date-format="yyyy-mm-dd" class="form-control datatable-input" id="buscar-fecha-contrato" placeholder="E.g: 2021/12/12"
                                       data-col-index="0" autocomplete="off"/>
                            </div>
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Contrato:</label>
                                <input type="text" class="form-control datatable-input" placeholder="E.g: 12345"
                                       data-col-index="1" autocomplete="off"/>
                            </div>
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Tipo de Contrato:</label>
                                <select class="form-control datatable-input" data-col-index="2" autocomplete="off">
                                    <option value="9999" disabled selected>Seleccione una opción</option>
                                    <option>CERRADO</option>
                                    <option>ABIERTO</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Adquisición:</label>
                                <input type="text" class="form-control datatable-input" placeholder="E.g: 12345"
                                       data-col-index="3" autocomplete="off"/>
                            </div>
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Proveedor:</label>
                                <select class="form-control datatable-input" data-col-index="4" autocomplete="off">
                                    <option value="9999" disabled selected>Seleccione una opción</option>
                                    <option>2C MEX, SA DE CV</option>
                                    <option>2E ESPACIO EMPRESARIAL, S.A DE C.V</option>
                                    <option>5M2ANDENES SA PI DE CV</option>
                                    <option>6B INVENT GERMANT, S.A DE C.V</option>
                                    <option>7 KAT, S.A DE C.V</option>
                                    <option>A1, S.A DE C.V</option>
                                    <option>ABA GRADAS, EVENTOS Y VALLAS DE SA DE CV</option>
                                    <option>ABALAT, S.A DE C.V</option>
                                    <option>ABAMEX CHEVROLET, S.A DE C.V</option>
                                    <option>ABASI SERVICIOS INTEGRALES S.A DE C.V</option>
                                    <option>ABASTECEDORA COMERCIAL DEL VALLE SA DE CV</option>
                                    <option>ABASTECEDORA COYOACAN SA DE CV</option>
                                    <option>ABASTECEDORA DE COLCHONES Y ACCESORIOS S.A DE C.V</option>
                                    <option>ABASTECEDORA DE COLCHONES Y ACCESORIOS, S.A DE C.B.</option>
                                    <option>ABASTECEDORA DE INSUMOS PARA LA SALUD S.A. DE C.V.</option>
                                    <option>ABASTECEDORA LIVIER SA DE CV</option>
                                    <option>ABASTECEDORA MEDICA DEL GOLFO AMEGOL SA DE CV</option>
                                    <option>ABASTECEDORA MERCURIO, S.A DEC.V.</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-lg-0 mb-6">
                                <label>Validacion:</label>
                                <select class="form-control datatable-input" data-col-index="5" autocomplete="off">
                                    <option value="9999" disabled selected>Seleccione una opción</option>
                                    <option>Validado</option>
                                    <option>Sin Validar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset_contratos">
                                    <span>
                                        <i class=""></i>
                                        <span>Restablecer</span>
                                    </span>
                                </button>&#160;&#160;
                                <button class="btn btn-primary btn-primary--icon" id="kt_search_contratos">
                                    <span>
                                        <i class=""></i>
                                        <span>Buscar</span>
                                    </span>
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <table class="table table-bordered table-hover display" style="display: none"
                                   id="tablaContratos">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Núm. Contrato</th>
                                    <th>Tipo de Contrato</th>
                                    <th>Núm. Oficio de Adjudicacion</th>
                                    <th>Proveedor</th>
                                    <th>Validado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contratos as $contrato)
                                    <tr>
                                        <td>{{$contrato->fecha_contrato}}</td>
                                        <td>{{$contrato->num_contrato}}</td>
                                        <td>{{$contrato->tipo_contrato}}</td>
                                        <td>{{$contrato->num_oficio_adjudicacion}}</td>
                                        <td>{{$contrato->razon_social ?? ''}}</td>
                                        <td>
                                            @if($contrato->validado === true)
                                                <span class="label label-inline label-light-success font-weight-bold">
                                                Validado
                                                </span>
                                                @endif
                                            @if($contrato->validado === false)
                                                    <span class="label label-inline label-light-danger font-weight-bold">
                                                        Sin Validar
                                                    </span>
                                                @endif
                                        </td>
                                        <td>
                                            <!--
                                            <button
                                                title="detalles"
                                                class="btn btn-sm btn-clean btn-icon btn-editar-contrato" data-detalles=""><i
                                                    class="fas fa-arrow-right"></i></button>
                                            -->
                                            <button
                                                title="seguimiento"
                                                class="btn btn-sm btn-clean btn-icon btn-seguimiento-contrato" data-seguimiento="{{$contrato->id}}"><i
                                                    class="fas fa-folder-open"></i></button>

                                            <button title="eliminar" type="submit"
                                                    class="btn btn-sm btn-clean btn-icon btn-eliminar-contrato"
                                                    data-content-del="{{$contrato->id}}"><i class="far fa-trash-alt"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        pageloader_in(1000, "Cargando....");
    </script>

    <!-- Biblioteca JavaScript DataTables -->
    <script type="text/javascript" charset="utf8"
            src="{{ asset('plugins\custom\datatables\datatables.bundle.min.js') }}"></script>

    <!-- Table Builder -->
    <script src="{{ asset('js/contratos/crear_contratos.js')}}" type="text/javascript"></script>

    <script src="{{ asset('js/contratos/ver_contratos.js')}}" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8"
    src="{{asset('js/contratos/bootstrap-datepicker.js')}}"></script>
    <script charset="utf8" src="{{asset('js/contratos/bootstrap-datepicker.es.js')}}"></script>



@endsection
{{--
<form action="route('products.destroy',$product->id)" method="POST">
<a href=" route('contrato.edit',$product->id) "
   data-toggle="tooltip" title="editar"><i class="far fa-edit"></i></a>
<a href=" route('contrato.valudar',$product->id) "
   data-toggle="tooltip" title="detalles"><i class="fas fa-arrow-right"></i></a>
<a href="" data-toggle="tooltip" title="eliminar"><i class="far fa-trash-alt"></i></a>
@csrf
@method('DELETE')
<button style="border: none;" type="submit"
        onclick="return confirm_elimination()" data-toggle="tooltip"
        data-placement="top" title="eliminar"><i
        class="fas fa-trash-alt text-danger mr-5"></i></button>
</form>


--}}
