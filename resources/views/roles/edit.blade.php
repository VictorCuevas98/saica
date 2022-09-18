@extends('layout.default')


@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Control de Usuarios</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Roles</span>
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
            <a href="{{route('roles.index')}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->


<div class="row">
	@if(Session::has('flash'))
		<div class="col-sm-12">
			<div class="alert alert-success">
				<strong>{{session('flash')}}</strong>
			</div>
		</div>
	@endif
				
	<div class="col-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Detalle del Rol</h3>
			</div>
			<div class="card-body">
				
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
				<div class="">
					
					<table class="table table-bordered table-striped">
					<form class="form-horizontal" action="{{route('roles.update',$rol->id)}}" method="post">
						@method('PUT')
						@csrf	
						<thead>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>
									<h5>{{$rol->name}}</h5>
									<small>Este campo no es posible cambiar.</small>
								</td>
							</tr>
							<tr>
								<td>Creado el:</td>
								<td>{{$rol->created_at}} </td>
							</tr>
							<tr>
								<td>Modificado el:</td>
								<td>{{$rol->updated_at}}</td>
							</tr>
							<tr>
								<td>Descripción
								</td>
								<td>
									<textarea class="col-md-12  form-control @if($errors->has('descripcion')) is-invalid @else  @endif" name="descripcion">@if(old('descripcion')){{old('descripcion')}}@else{{$rol->description}}@endif</textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Guardar</button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#myModalDeleteRole" ><i class="fa fa-envelope"></i> Eliminar</a>
                                            </div>
                                    </div>
								</td>
							</tr>
						</tbody>
					</form>
					</table>
					@include('roles.delete_modal')
				</div>
				
			</div>
			<div class="card-footer">
				
			</div>
		</div>
	</div>
	
	<div class="col-8">
		<div class="card " >
			<div class="card-header">
				<h3 class="card-title">Permisos del rol {{$rol->name}}</h3>
			</div>
			<div class="card-body">
				<div class="">

					<form id="formSelectPermisos" name="formSelectPermisos" method="post" action="{{route('roles.editPermissions',$rol->id)}}">
						@method('POST')
						@csrf
						{{--
						<table class="table table-bordered table-striped" id="tablePermisos" name="tablePermisos">
							<thead>
								<tr>
									<th class="">id</th>
									<th class="">permiso</th>
									<th>descripción</th>
									<th>asignar</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($permisos as $permiso )
								<tr>
									<td>{{$permiso->id}}</td>
									<td>{{$permiso->name}}</td>
									<td>{{$permiso->description}}</td>
									<td>
										<input type="checkbox" name="permisos[]" value="{{$permiso->name}}" 
										@php
											echo($rol->hasPermissionTo($permiso->name))?"checked":'' ;
										@endphp
										 >
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>

						--}}
						<table class="table table-striped" id="tablaPermisos" name="tablaPermisos">
							<thead>
								<tr>
									<th class="">id</th>
									<th class="">permiso</th>
									<th>descripción</th>
									<th>asignar</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($permisos as $permiso )
								<tr>
									<td>{{$permiso->id}}</td>
									<td>{{$permiso->name}}</td>
									<td>{{$permiso->description}}</td>
									<td>
										<input type="checkbox" name="permisos[]" value="{{$permiso->name}}" 
										@php
											echo($rol->hasPermissionTo($permiso->name))?"checked":'' ;
										@endphp
										 >
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-10"></div>
					<div class="col-lg-2">
						<button type="submit" id="btnSelectPermisos" name="btnSelectPermisos" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<div class="col-4">
	</div>
	
</div>

@endsection
@section('scripts')
<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	
	$('#tablePermisos').DataTable({
		language: {
            "url": "{{url('/')}}/js/dataTable/Spanish.json"
        }
	});

	$(document).ready(function() { 

		$('#tablaPermisos').dataTable({ 
			"paging": false,
			"scrollY": 400, 
			"scrollX": true
		}); 
	});

</script>
@endsection