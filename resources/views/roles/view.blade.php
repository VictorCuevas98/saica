@extends('layout.default')

@section('breadcrumbs')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Roles</h2>
			<ol class="breadcrumb">
				<li>
					<a href="{{route('home')}}">Inicio</a>
				</li>
				<li>
					<a href="{{route('roles.index')}}">Roles</a>
				</li>
				<li class="active">
					<strong>ver</strong>
				</li>
			</ol>
		</div>
		<div class="col-lg-2">
		</div>
	</div>
@endsection

@section('content')

	<div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Detalle del Rol</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                               
                    </div>
                    <div class="ibox-content profile-content">
						<h3><strong>{{$rol->name}}</strong></h3>
                                
                        <h5>
                            Acerca de:
                        </h5>
                        <p>
                                Creado el: {{$rol->created_at}} 
                        </p>
                        <div class="row m-t-lg">
                        </div>
                        <div class="user-button">
                            <div class="row">
								@can('roles.edit')
									<div class="col-md-6">
										<a href="{{route('roles.edit',$rol->id)}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Editar</a>
									</div>
								@endcan
								@can('roles.destroy')
									<div class="col-md-6">
										<a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#myModalDeleteRole" ><i class="fa fa-envelope"></i> Eliminar</a>
									</div>
									@include('roles.delete_modal')
								@endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Permisos del rol {{$rol->name}}</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                                
                                <!--<a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>-->
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
						<div class="feed-activity-list">									
							<div class="feed-element">
                                
                                    <div class="media-body ">
                                        
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-lg-1 col-sm-2">id</th>
                                                    <th class="col-lg-3 col-sm-3">permiso</th>
                                                    <th>descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rol->permissions()->get() as $permiso )
                                                <tr>
                                                    <td>{{$permiso->id}}</td>
                                                    <td>{{$permiso->name}}</td>
                                                    <td>{{$permiso->description}}</td>
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

		</div>
	</div>	
			
@endsection
