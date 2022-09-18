@extends('layout.default')

@section('breadcrumbs')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
		
			<h2>Usuarios con este Rol</h2>

			<ol class="breadcrumb">
				<li>
					<a href="{{route('home')}}">Inicio</a>
				</li>
				<li>
					<a href="{{route('roles.index')}}">Roles</a>
				</li>
				<li class="active">
					<strong>Usuarios</strong>
				</li>
			</ol>
		</div>
		<div class="col-lg-2">
	
		</div>
	</div>
@endsection
@section('content')


<div class="row">
	@if(Session::has('flash'))
		<div class="col-sm-12">
			<div class="alert alert-success">
				<strong>{{session('flash')}}</strong>
			</div>
		</div>
	@endif
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Rol <small>{{$role->name}}</small></h5>
                    <span class="pull-right">&nbsp;
                    </span>
                   
                </div>
                    <div class="ibox-content">
                        <form action="{{route('roles.asignUsersToRole',$role->id)}}" method="post">
                        @method('POST')
                        @csrf
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-lg-1">ID</th>
                                    <th>Usuario</th>
                                    <th>Mail</th>
                                    <th class="col-lg-1">Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td class=""> {{$user->email}}</td>
                                    <td>
                                        <input type="checkbox" name="usuarios[]" value="{{$user->id}}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#myModalRoleUser"><i class="fa fa-user fa-fw"></i>
                                        Guardar 
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


	
@endsection
