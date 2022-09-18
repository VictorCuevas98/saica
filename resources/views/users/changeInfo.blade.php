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
	
	<div class="col-lg-7">
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
	@if(Session::has('flash'))
		<div class="col-sm-12">
			<div class="alert alert-success">
				<strong>{{session('flash')}}</strong>
			</div>
		</div>
	@endif
	<div class="card">
		<form class="form-horizontal" action="{{route('users.updateus',Auth::user()->id)}}" method="post">
			@method('PUT')
			@csrf	
			
				<div class="card-body">
					<small class="text-muted">Nombre:</small>
					<h6>
						<input type="text" class="col-md-5 form-control @if($errors->has('name')) is-invalid @else  @endif" name="name" value="@if(old('name')){{old('name')}}@else{{$usuario->name}}@endif">
					</h6><hr>
					<small class="text-muted">Correo electronico:</small>
					<h6>
						<input type="text" class="col-md-5 form-control @if($errors->has('email')) is-invalid @else  @endif" name="email" value="@if(old('email')){{old('email')}}@else{{$usuario->email}}@endif">
					</h6><hr>
					<div class="row col-md-12">
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary btn-sm btn-block float-rigth"><i class="fa fa-envelope"></i> Guardar</button>
					</div>
					<div class="col-md-4">
							<a class="btn btn-danger btn-sm btn-block float-rigth" href="{{ url('/home') }}"><i class="fa fa-envelope"></i> Cancelar</a>
					</div>
					</div>
				</div>
		</form>
		</div>
	</div>
</div>
@endsection