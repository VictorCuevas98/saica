@extends('layout.default')



@section('content')
<div >
	@if(count( $errors ) > 0)
	   @foreach ($errors->all() as $error)
		  <!-- Alert with image / icon -->
			<div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
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
                    <span class="text-muted">Contratos abiertos</span>
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
            @can('entradas.contratosAbiertos.crear')
            <!-- Button trigger modal-->
			
			<a href="{{route('entradas.fondoOficinas.create')}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Nueva carpeta</a>
            @endcan
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->

@if(Session::has('flash'))
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-info">
							<strong>{{session('flash')}}</strong>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<div class="row" >
	<div class="col-lg-12">
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header">
				<div class="card-title">
					<span class="card-icon">
						<i class="fa fa-search text-primary"></i>
					</span>
					<h3 class="card-label">Busqueda</h3>
				</div>
				<div class="card-toolbar">
					
					
				</div>
			</div>
			<div class="card-body">
				<!--begin: Search Form-->
				<form class="kt-form kt-form--fit ">
					<div class="row mb-6">
						<div class="col-lg-3 ">
							<label>Folio carpeta:</label>
							<input type="text" class="form-control datatable-input" placeholder="E.g: 4590" data-col-index="1" />
						</div>
						<!--<div class="col-lg-3 ">
							<label>Factura o Remisión:</label>
							<input type="text" class="form-control datatable-input" placeholder="E.g: 37000-300" data-col-index="1" />
						</div> -->
						
						<div class="col-lg-3 ">
							<label>Número de contrato:</label>
							<input type="text" class="form-control datatable-input" placeholder="E.g: 978987987" data-col-index="4" />
						</div>
						<div class="col-lg-3 ">
							<label>Número de requisición:</label>
							<input type="text" class="form-control datatable-input" placeholder="E.g: 978987987" data-col-index="6" />
						</div>
						<div class="col-lg-3 ">
							<label>Oficio de adjudicación:</label>
							<input type="text" class="form-control datatable-input" placeholder="E.g: 978987987" data-col-index="5" />
						</div>
					</div>
					<div class="row mb-8">
						<!--<div class="col-lg-3 mb-lg-0 mb-6">
							<label>Fecha Creacion:</label>
							<div class="input-daterange input-group" id="kt_datepicker">
								<input type="text" class="form-control datatable-input" name="start" placeholder="desde" data-col-index="8" />
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-ellipsis-h"></i>
									</span>
								</div>
								<input type="text" class="form-control datatable-input" name="end" placeholder="hasta" data-col-index="8" />
							</div>
						</div>-->
						<div class="col-lg-3 mb-lg-0 mb-6">
							<label>Estatus adquisición:</label>
							<select class="form-control datatable-input" data-col-index="3">
								<option value="">Selecciona...</option>
								@foreach($catStatusAdquisicion as $statusAdquisicion)
								<option value="{{$statusAdquisicion->id}}">{{$statusAdquisicion->status_adquisicion}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-3 mb-lg-0 mb-6">
							<label>Proveedor:</label>
							<input type="text" class="form-control datatable-input" placeholder="RFC, razón social o persona física" data-col-index="2" />
						</div>
					</div>
					<div class="row mt-8 ">
						<div class="col-lg-12 ">
							<button class="btn btn-secondary btn-secondary--icon mr-3 " id="kt_reset">
								<span>
									<i class="fas fa-eraser"></i>
									<span>Reestablecer</span>
								</span>
							</button>
							<button class="btn btn-primary btn-primary--icon " id="kt_search">
								<span>
									<i class="fas fa-search	"></i>
									<span>Buscar</span>
								</span>
							</button>
							
						</div>
					</div>
				</form>
				<!--begin: Datatable-->
				<!--begin: Datatable-->
				<table class="table table-bordered table-hover table-checkable" id="kt_datatable">
					<thead>
						<tr>
							<th>id</th>
							<th>folio_adquisicion</th>
                        	<th>proveedor</th>
							<th>estatus</th>
                        	<th>contrato</th>
                        	<th>oficio de adjudicacion</th>
                        	<th>requisicion</th>
							<th>creado por</th>
							<th>creado el</th>
                        	<th>Acciones</th>
						</tr>
					</thead>
					
				</table>
				<!--end: Datatable-->
			</div>
		</div>
		<!--end::Card-->

	</div>
</div>


<input type="hidden" name="url" id="url" value="{{url('/')}}">
<div id="" class="page-loader">
	<div class="spinner spinner-primary spinner-lg mr-10 "></div>
	<h5 id="pageloader_spinner_mesage">Cargando..</h5>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	 pageloader_in(1000,"Cargando....");
</script>
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>-->


<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('js/entradas/fondoOficina/fondoOficina.js')}}"></script>
<!--end::Page Scripts-->

@endsection
