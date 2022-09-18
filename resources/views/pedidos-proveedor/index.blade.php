@extends('layout.default')
@section('content')
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
                    <span class="text-muted">Pedidos realizados</span>
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
            <a href="{{ url('/admin') }}"
                class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Consultar pedidos a proveedor realizados
        </h3>
        <div class="card-toolbar">
            <div class="ml-auto d-flex no-block align-items-center">
                <div class="dl">
                    <a class="btn btn-primary" href="{{ url('pedidos-proveedor/create') }}">
                        Crear Pedido a Proveedor
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form>
        <div class="card-body">
            <div class="row mb-8 justify-content-center">
                <div class="col-lg-4 mb-lg-0 mb-6">
                    <label class="col-form-label">Número de Contrato:</label>
                    <input id="contrato" type="text" name="contrato" class="form-control datatable-input" placeholder=""
                        data-col-index="4" />
                </div>
                <div class="col-lg-4 mb-lg-0 mb-6">
                    <label class="col-form-label">Fecha de solicitud:</label>
                    <div class="input-daterange input-group" id="kt_datepicker">
                        <input id="fecha_solicitud" type="date" class="form-control datatable-input"
                            name="fecha_solicitud" data-col-index="5" />
                    </div>
                </div>
                <div class="col-lg-4 mb-lg-0 mb-6">
                    <label class="col-form-label">Fecha de entrega:</label>
                    <div class="input-daterange input-group" id="kt_datepicker">
                        <input id="fecha_entrega" type="date" class="form-control datatable-input"
                            name="fecha_entrega" data-col-index="5" />
                    </div>
                </div>
            </div>
            <div class="row mb-8 justify-content-center">
                <div class="col-lg-4 mb-lg-0 mb-6">
                    <label class="col-form-label">Folio pedido:</label>
                    <input id="folio_pedido" type="text" name="folio_pedido" class="form-control datatable-input" placeholder=""
                        data-col-index="4" />
                </div>
                <div  class="col-lg-4 mb-lg-0 mb-6">
                </div>
                <div style="display: none;" class="col-lg-4 mb-lg-0 mb-6">
                    <label class="col-form-label">Almacen:</label>
                    <select id="almacen" class="form-control datatable-input" name="almacen">
                        <option value="">Seleccione un almacen</option>
                        @foreach ($almacenes as $almacen)
                        <option value="{{ $almacen->id }}">{{ $almacen->almacen}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4 mb-lg-0 mb-6">
                </div>
                <div style="display: none;" class="col-lg-3 mb-lg-0 mb-6">
                    <label class="col-form-label">Proveedor:</label>
                    <input id="proveedorInput" disabled class="form-control datatable-input" name="proveedorInput">
                    <div class="mt-5 text-center">
                        <a class="btn btn-success btn-success" onclick="openBuscaProveedorModal()">Proveedor</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-lg-left">
                <button type="reset" onclick="resetFilters()" class="btn btn-secondary btn-secondary"
                    id="kt_reset">Limpiar filtros</button>
                <button class="btn btn-primary" id="kt_search">Consultar</button>&#160;&#160;
            </div>
            <hr><br><br>
            
            @if (count($pedidos_contrato_abierto) > 0)
            <div class="col-md-12">
                <table class="table table-striped table-checkable" id="tablePedidosRealizados">
                    <thead>
                        <tr>
                            <th>Contrato</th>
                            <th>Folio Pedido</th>
                            <th>Fecha Solicitud</th>
                            <th>Fecha Entrega</th>
                            {{--  <th>Almacen</th>--}}
                            <th>Proveedor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos_contrato_abierto as $current)
                        <tr>
                            <td>{{ $current->contratoAbierto->contrato->num_contrato }}</td>
                            <td>{{ $current->folio_pedido }}</td>
                            <td>{{ $current->fecha_pedido }}</td>
                            <td>{{ $current->fecha_entrega }}</td>
                            {{--  <td>{{ $current->almacen->almacen }}</td>--}}
                            <td>{{ $current->contratoAbierto->contrato->adquisicion->proveedor->razon_social }}</td>
                            <td class="text-center">
                                <a href="{{ url('/pedidos-proveedor/'.$current->getHashid().'/articles-edit') }}" title="ver pedido" class="btn btn-sm btn-clean btn-icon">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($current->getCurrentClaveEtapa() == "RCH")
                                <a target="_blank" href="{{ url('pedidos-proveedor/'.$current->getHashid().'/pdf') }}" title="ver pedido" class="btn btn-sm btn-clean btn-icon">
                                    <i class="fas fa-download"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {!! $pedidos_contrato_abierto->appends($_GET)->links(); !!}
            </div>
            @endif
            <!--begin::Search Form-->
            <div style="display: none;" class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Buscar..."
                                        id="kt_datatable_search_query">
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div style="display: none;" class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <div class="dropdown bootstrap-select form-control"><select class="form-control"
                                            id="kt_datatable_search_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown"
                                            role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox"
                                            aria-expanded="false" data-id="kt_datatable_search_status" title="All">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">All</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none;" class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                    <div class="dropdown bootstrap-select form-control"><select class="form-control"
                                            id="kt_datatable_search_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown"
                                            role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox"
                                            aria-expanded="false" data-id="kt_datatable_search_type" title="All">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">All</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--begin: Datatable-->
            <div style="display: none;" id="pedidos_table"></div>
            <!--end: Datatable-->
        </div>
        <div class="card-footer">

        </div>
    </form>
    <!--end::Form-->
</div>
{{-- Scripts Section --}}
@section('scripts')
<script type="text/javascript">
    
</script>
<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{URL::asset('js/pedidos-proveedor/index.js')}}" type="text/javascript"></script>
@endsection
@endsection
