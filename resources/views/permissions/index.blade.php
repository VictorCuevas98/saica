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

@if(Session::has('flash'))
<div class="row">
	<div class="col-sm-12">
		<div class="alert alert-success">
			<strong>{{session('flash')}}</strong>
		</div>
	</div>
</div>
@endif

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
                    <span class="text-muted">Permisos</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
    </div>
</div>
<!--end::Subheader-->

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="d-md-flex align-items-center">
					<div>
						<h4 class="card-title">Permisos dispinibles</h4>
						<h5 class="card-subtitle">&nbsp;</h5>
					</div>
					<div class="ml-auto d-flex no-block align-items-center">
						<div class="dl">
							 @can('permissions.create')
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalNewPermission">
								Nuevo permiso
							</button>
							 @include('permissions.newPermission_modal') 
							@endcan
						</div>
					</div>
				</div>
				
				<div class="row">
				
				<div class="col-md-12 " >
					 {{ $permisos->onEachSide(5)->links() }}
					</div >
					<div class="col-md-12">
						<table class="table table-striped table-bordered">
							<thead>
								<tr class="">
									<th>ID</th>
									<th class="">nombre público</th>
									<th class="">nombre</th>
									<th>creado el </th>
									<th class="">Roles con el permiso</th>
									<th class="">Usuarios con el permiso</th>
									<th class="">acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($permisos as $permiso)
								<tr>
									<td>{{$permiso->id}}</td>
									<td>{{$permiso->nameToShow}}</td>
									<td>{{$permiso->name}}<span><h5>{{$permiso->description}}</h5></span></td>
									<td>{{$permiso->created_at}}</td>
									<td>
										@foreach($role->all() as $rol)
											@if($rol->hasPermissionTo($permiso->name) )
											<span class="badge badge-success">{{$rol->name}}</span>
											@endif
										@endforeach()
									</td>
									<td>{{ $usuario::permission($permiso->name)->get()->count() }}</td>
									<td>
										@if(auth()->user()->can('permissions.edit') || auth()->user()->can('permissions.show')  )
										<a href="{{ route('permissions.show',$permiso->id) }}" class="btn btn-sm btn-clean btn-icon" title="Detalles permiso">
											<i class="far fa-eye"></i>
										</a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						
					</div>
					
					<div class="col-md-12 " >
					 {{ $permisos->onEachSide(5)->links() }}
					</div >
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
