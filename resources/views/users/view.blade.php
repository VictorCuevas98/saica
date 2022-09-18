@extends('layout.default')

@section('breadcrumbs')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Usuarios</h2>
			<ol class="breadcrumb">
				<li>
					<a href="{{route('home')}}">Inicio</a>
				</li>
				<li>
					<a href="{{route('users.index')}}">Usuarios</a>
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
                            <h5>Detalle de Usuario</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                               
                            </div>
                            <div class="ibox-content profile-content">
                                <h3><strong>{{$usuario->name}}</strong></h3>
                                
                                <h5>
                                    Acerca de:
                                </h5>
                                <p>
                                    Creado el: {{$usuario->created_at}} 
                                </p>
								<p>
									Email: {{$usuario->email}}
								</p>
                                <div class="row m-t-lg">
                                </div>
                                <div class="user-button">
                                    <div class="row">
										<div class="col-md-6">
                                            <a href="{{route('users.edit',$usuario->id)}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Editar</a>
                                        </div>
										@can('users.destroy')
											<div class="col-md-6">
												<a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#myModalDeleteUser" ><i class="fa fa-envelope"></i> Eliminar</a>
											</div>
											@include('users.delete_modal')
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
                            <h5>Roles y permisos</h5>
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
                                    @foreach ($usuario->roles()->get() as $role  )
									<div class="feed-element">
                                        <div class="media-body ">
                                            <small class="pull-right">&nbsp;</small>
                                            <strong>{{$role->name}}</strong> con los siguientes permisos <br>
                                            <small class="text-muted">&nbsp;</small>
											
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>permiso</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($role->permissions()->get() as $permission )
                                                    <tr>
                                                        <td>{{$permission->id}}</td>
                                                        <td>{{$permission->name}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
									@endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
			
@endsection
