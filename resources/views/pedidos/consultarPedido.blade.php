@extends('layout.default')
@section('content')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Pedidos</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Mis pedidos</span>
                </li>
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
            <a href="{{ url('/admin') }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
           Consultar pedidos realizados
        </h3>
        <div class="card-toolbar">
            <div class="ml-auto d-flex no-block align-items-center">
                <div class="dl">
                    <a class="btn btn-light-info" href="{{ url('pedidosProgramacion/') }}">
                        Crear Pedido
                    </a>
                </div>
            </div>
        </div>
    </div>
 <!--begin::Form-->
    <form>       
        <div class="card-body"> 
            <div class="row mb-8 justify-content-center">
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label class="col-form-label">Número de pedido:</label>
                    <input type="text" name="numeroPedido" id="numeroPedido" class="form-control datatable-input" placeholder="Ingresa número" data-col-index="4" />
                </div>
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label class="col-form-label">Fecha de solicitud:</label>
                    <div class="input-daterange input-group" id="kt_datepicker">
                        <input type="date" name="fechaSolicitud" id="fechaSolicitud" class="form-control datatable-input" name="start" placeholder="De" data-col-index="5" />
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 mb-6">
                    <label class="col-form-label">Solicitado a:</label>
                    <select class="form-control datatable-input" data-col-index="7" name="solicita" id="solicita" required ="required">
                        <option value="9999" disabled selected>Seleccione una opción</option>
                        @foreach($almacenes as $almacen)
                            <option value="{{ $almacen->id }}">{{ $almacen->almacen }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12 text-lg-right">
                <button class="btn btn-secondary btn-secondary" id="kt_reset">Limpiar</button>&#160;&#160;
                <button class="btn btn-primary btn-primary" id="kt_search" href="javascript:void(0)" onclick="buscarPedido();">Buscar</button>
            </div>
            <hr><br><br>

            <div>
                <div class="col-md-12">
                    <table class="table table-striped table-checkable" id="tablePedidosRealizados">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Número de pedido</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12</td>
                                <td>P-002934</td>
                                <td>Para uso medico</td>
                                <td>
                                    <a href="{{ url('/pedidosProgramacion/seguimientoPedidos') }}" class="btn btn-icon btn-clean" title="Detalle"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>P-002935</td>
                                <td>Para uso medico</td>
                                <td>
                                    <a href="{{ url('/pedidosProgramacion/seguimientoPedidos') }}" class="btn btn-icon btn-clean" title="Detalle"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
        <div class="card-footer">
            
        </div>
    </form>
 <!--end::Form-->
</div>
    {{-- Scripts Section --}}
    @section('scripts')
    <script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{URL::asset('js/pedidos/consultar_pedido.js')}}" type="text/javascript"></script>
    @endsection
@endsection