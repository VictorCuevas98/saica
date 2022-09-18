@extends('layout.default')
@section('breadcrumbs')
	{{-- <div class="page-breadcrumb">
        <div class="row">
            <div class="col-6 align-self-center">
                <h4 class="page-title">&nbsp;</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}" >Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page" >Configurar</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-6">  
            </div>
        </div>
    </div>--}}
@endsection


@section('content')
			
<div class="row">



@include('users.configUser')
		
		<div class="col-md-7">
		<div class="card">
						<div>
			@if(count( $errors ) > 0)
			@foreach ($errors->all() as $error)
		  <!-- Alert with image / icon -->
			<div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
			@endforeach
			@endif
		</div>
	@if(Session::has('message'))
		<div class="col-sm-12">
			<div class="alert alert-danger">
				<strong>{{Session::get('message')}}</strong>
			</div>
		</div>
	@endif
	<div class="card-body">
				<h3 class="card-tittle">Cambio de Contraseña</h3><br>
					<form class="form-horizontal" method="post" action="{{route('users.updatepassword',Auth::user()->id)}}">
					 {{csrf_field()}}
					
					<small class="text-muted">Nombre del usuario:</small>
							<h6>
								{{$usuario->name}}
							</h6>
					<small class="text-muted">Correo electronico:</small>
							<h6>
								{{$usuario->email}}
							</h6>					
					<input type="hidden" name="change_password" id="change_password" value="t">
					<small class="text-muted">Contraseña Actual:</small>
					<h6>
						<input type="password" class="col-md-5 form-control @if($errors->has('old_password')) is-invalid @else  @endif" name="old_password" placeholder="Escriba su contraseña actual">
					</h6><hr>
					
					<small class="text-muted">Nueva Contraseña:</small>
					<h6>
						<input type="password" class="col-md-5 form-control @if($errors->has('new_password')) is-invalid @else  @endif" name="new_password" placeholder="Escriba su nueva contraseña">
					</h6><hr>
					<small class="text-muted">Confirmar Contraseña:</small>
					<h6>
						<input type="password" class="col-md-5 form-control @if($errors->has('password_confirmation')) is-invalid @else  @endif" name="password_confirmation" placeholder="Escriba nuevamente su contraseña">
					</h6>
					<div class="row col-md-12">
					<div class="col-md-4">
					<button type="submit" class="btn btn-primary btn-sm btn-block float-rigth">Cambiar mi Constraseña</button>
					</div>
					<div class="col-md-4">
							<a class="btn btn-danger btn-sm btn-block float-rigth" href="{{ url('/home') }}"><i class="fa fa-envelope"></i> Cancelar</a>
					</div>
					</div>
					</form>
	</div>
	</div>
	</div>
</div>
@endsection