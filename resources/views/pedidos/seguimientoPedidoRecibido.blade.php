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
                    <span class="text-muted">Pedidos recibidos</span>
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
            <a href="{{ url('/pedidosProgramacion/consultarPedidosRecibido') }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
           Pedido recibido # P-0023394 12345678
        </h3>
        <div class="card-toolbar">
            <div class="float-right">
		    	<div class="d-grid gap-2 d-md-block">	
		    	  {{--<a href="#" class="btn btn-light-primary btn-icon btn-lg" title="Aceptar"><i class="fa flaticon2-arrow-down"></i></a>
		    	  <a href="#" class="btn btn-light-warning btn-icon btn-lg" title="Generar PDF"><i class="fa flaticon-doc"></i></a>--}}
		    	  {{--<a href="#" class="btn btn-light-primary"><i class="fa flaticon-shopping-basket"></i>Surtir</a>--}}
                  <a href="#" class="btn btn-light-danger"><i class="fa flaticon2-rubbish-bin-delete-button"></i>Rechazar</a>
		    	  {{--<a href="{{ url('/pedidosProgramacion/formato') }}" class="btn btn-light-warning"><i class="fa flaticon-doc"></i>Visualizar PDF</a>--}}
                  <a href="{{ url('/pedidosProgramacion/formatoPedido') }}" target="_blank" class="btn btn-light-primary"><i class="far fa-file-pdf"></i>Visualizar PDF</a>
				</div>
		    </div>
        </div>
    </div>
 <!--begin::Form-->
    <form class="form-horizontal" action="" method="post"> 
    @csrf      
        <div class="card-body"> 
        	<table class="table table-light">        		
				<thead>
				</thead>
				<tbody>
					<tr>
						<td>Unidad de procedencia:</td>
						<td>
							Almacén alterno de la Secretaría de Salud
						</td>
					</tr>
					<tr>
						<td>Descripción:</td>
						<td>
							Varios medicamentos
						</td>
					</tr>
					<tr>
						<td>Tipo de pedido:</td>
						<td>Extraordinario</td>
					</tr>
					<tr>
						<td>Estado:</td>
						<td>Pendiente</td>
					</tr>
					<tr>
						<td>Fecha de creación:</td>
						<td>22/06/2021</td>
					</tr>
					<tr>
                        <table class="table table-light table-striped table-checkable table-sm" id="tableSeguimientoPedidoRecibido">
                            <thead>
                                <tr>
                                    <th>Clave articulo</th>
                                    <th>Descripción</th>
                                    <th>Unidad de medida</th>
                                    <th>Cantidad Solicitada</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>010.000.3451.00</td>
                                    <td>Alopurinol 300 mg. Tabletas</td>
                                    <td>Envase con 20 tabletas</td>
                                    <td>1000</td>
                                    <td>
                                       <button style="border: none; width: 34px;" data-toggle="modal"data-target="#exampleModal"class="btn btn-sm btn-clean btn-icon" title="Editar" ><i class="far fa-edit"></i></button>
                                       <button style="border: none; width: 34px;" type="submit"
                                        onclick="return confirm_elimination()"class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="far fa-trash-alt "></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>    
					</tr>
				</tbody>
			</table>            
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