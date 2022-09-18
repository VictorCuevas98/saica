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
                    <span class="text-muted">Permisos</span>
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
            <a href="{{route('permissions.index')}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="row">
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Detalle del permiso</h3>
				<p class="card-text">&nbsp;</p>
				<div class="">
					<table class="table table-bordered table-striped">
					<form class="form-horizontal" action="{{route('permissions.update',$permission->id)}}" method="post">
						@method('PUT')
						@csrf	
						<thead>
						</thead>
						<tbody>
							<tr>
								<td>Nombre</td>
								<td>
									<h5>{{$permission->name}}</h5>
									<small>Este campo no es posible cambiar.</small>
								</td>
							</tr>
							<tr>
								<td>Nombre para mostrar:</td>
								<td>
									<input type="text" name="nombre_para_mostrar" placeholder="" class="form-control" value="{{$permission->nameToShow}}">
								</td>
							</tr>
							<tr>
								<td>Creado el:</td>
								<td>{{$permission->created_at}}</td>
							</tr>
							<tr>
								<td>Modificado el:</td>
								<td>{{$permission->updated_at}}</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Descripción</td>
								<td>
									<textarea class="col-md-12" name="descripcion">{{$permission->description}}</textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Guardar</button>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#myModalDeletePermission" ><i class="fa fa-envelope"></i> Eliminar</a>
                                            </div>
                                    </div>
									 
								</td>
							</tr>
						</tbody>
					</form>
					</table>
				</div>
			</div>
		</div>
	</div>
	@include('permissions.delete_modal')
	<div class="col-8">
		<div class="card " >
			<div class="card-body">
				<h3 class="card-title">Roles Disponibles</h3>
				<p class="card-text">&nbsp;</p>
				<div class="">
					@include('permissions._asignarRoles',['roles'=>$roles])
				</div>
			</div>
		</div>
	</div>
	<div class="col-4">
	</div>
	
</div>

		
@endsection
