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
            </div>
            <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<div class="d-md-flex align-items-center">
					<div>
						<h4 class="card-title">Roles disponibles</h4>
						<h5 class="card-subtitle">&nbsp;</h5>
					</div>
					<div class="ml-auto d-flex no-block align-items-center">
						<div class="dl">
							@can('roles.create')
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalNewRol">
								Nuevo rol
							</button>
							@include('roles.newRole_modal') 
							@endcan
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				
				
				<div class="row">
				
					<div class="col-md-12">
						<table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="" >ID</th>
                                    <th class="">Rol</th>
                                    <th class="">creado el </th>
									<th>Rol con Permisos</th>
									<th  class="">Usuarios asignados</th>
                                    <th  class="">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($role as $rol)
                                <tr>
                                    <td>{{$rol->id}}</td>
                                    <td>{{$rol->name}}</td>
                                    <td>{{$rol->created_at}}</td>
									<td>
                                        @foreach($permisos->all() as $perm)
                                            @if($rol->hasPermissionTo($perm->name) )
                                            <span class="badge bg-success text-white">{{$perm->name}}</span>&nbsp;
                                            @endif
                                        @endforeach
                                    </td>
									<td>{{ $usuario::role($rol->name)->get()->count() }} 
									</td>
									<td>
										<div class="col-md-12">
											@if(auth()->user()->can('roles.edit') || auth()->user()->can('roles.show')  )
												<a href="{{ route('roles.show',$rol->id) }}" class="btn btn-sm btn-clean btn-icon" title="Detalles rol">
													<i class="far fa-eye"></i>
												</a>
											@else
												sin permiso
											@endif
										</div>
										@include('roles.delete_modal')
									</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>
					<div class="col-md-12 " >
					 {{ $role->onEachSide(5)->links() }}
					</div >
				</div>
			</div>
			<div class="card-footer">
				
			</div>
		</div>
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

@endsection