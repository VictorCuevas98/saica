@extends('layout.default')

@section('breadcrumbs')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">

			<h2>Permisos del Rol</h2>
			<ol class="breadcrumb">
				<li>
					<a href="{{route('home')}}">Inicio</a>
				</li>
				<li>
					<a href="{{route('roles.index')}}">Roles</a>
				</li>
				<li class="active">
					<strong>Permisos</strong>
				</li>
			</ol>
		</div>
		<div class="col-lg-2">
	
		</div>
	</div>
@endsection

@section('content')
<div class="row animated fadeInRight">
	<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Permiso</th>
            </tr>
        </thead>
            <tbody>
                @foreach($permissions as $perm)
					<tr>
						<td>{{$perm->id}}</td>
						<td>
							<small>{{$perm->name}}</small>
						</td>
					</tr>
                @endforeach
            </tbody>
    </table>
	
	<div class="user-button">
        <div class="row">
			<div class="col-md-6">
                <a href="" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#myModalRolePerm"><i class="fa fa-envelope"></i>
					Agregar Permiso
				</a>
            </div>
        </div>
    </div>
	
	<div class="modal inmodal" id="myModalRolePerm" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated bounceInRight">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<!--<i class="fa fa-question modal-icon"></i>-->
					<h4 class="modal-title">Agregar Permiso a este Rol</h4>
					<small class="font-bold">&nbsp;</small>
				</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Permiso</th>
							<th>Asignar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($permisos as $perm)
						<tr>
							<td>{{$perm->id}}</td>
							<td>
								<small>{{$perm->name}}</small>
							</td>
							<td>
								<input type="checkbox" name="permiso">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div>
					<button type="button" class="btn btn-primary btn-block">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	
@endsection
</div>
