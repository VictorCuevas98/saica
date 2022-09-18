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
                    <span class="text-muted">Usuarios</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <!-- begin::Toolbar -->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="{{ route('users.index') }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
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
			<div class="card-body">
				<div class="row">
					<div class="col-md-10">
						<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark"> Detalles de usuario</span>
						</h3>
					</div>
					<div class="col-md-2">
						<div class="btn-group">
  							<button type="button" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown">
    							<i class="ki ki-bold-more-ver"></i>
  							</button>

  							<div class="dropdown-menu dropdown-menu-md dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-217px, 33px, 0px);">
  								<ul class="navi navi-hover py-5" role="menu">
  									@if($usuario->activo == true)
    								<li class="navi-item">
    									<a href="#" class="navi-link" data-toggle="modal" data-target="#myModalCambioPassword" >
    										<span class="navi-icon">
    											<i class="fa fa-envelope"></i>
    										</span>
    										<span class="navi-text">
    											Recuperar contraseña
    										</span>
    									</a>
    								</li>
    								@endif
    								<li class="navi-item">

    									@if($usuario->activo == true)

    										<a href="#" class="navi-link" data-toggle="modal" data-target="#modalInhabilitarUsuario" >
    											<span class="navi-icon">
    												<i class="fa fa-user-times"></i>
    											</span>
    											<span class="navi-text">
    												Desactivar usuario
    											</span>
    										</a>

    										@else
    										
    											<a href="#" class="navi-link" data-toggle="modal" data-target="#myModalReactivarUsuario" >
    												<span class="navi-icon">
    													<i class="fa fa-user" aria-hidden="true"></i>
    												</span>
    												<span class="navi-text">
    													Activar usuario
    												</span>
    											</a>
    									@endif

    								</li>
  								</ul>
  							</div>
						</div>
					</div>
				</div>
				<hr>
				<p class="card-text">&nbsp;</p>
				<div >
					@if(count( $errors ) > 0)
					   @foreach ($errors->all() as $error)
						  <!-- Alert with image / icon -->
							<div class="alert alert-danger"> 
								
								{{ $error }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
							</div>
					  @endforeach
					@endif
				</div>
				<div class="">
					<div class="card">
						<div class="card-body">
							<table class="table table-striped">
								<tbody>
									
									<tr>
										<td>Creado el:</td>
										<td>{{$usuario->created_at}} </td>
									</tr>
									<tr>
										<td>Modificado el:</td>
										<td>{{$usuario->updated_at}}</td>
									</tr>
									<tr>
										<td>Ultima conexión:</td>
										<td>{{$usuario->last_login}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><br>


					<div class="card">
						<div class="card-body">
							<h5>Información del usuario</h5>
							<table class="table table-striped">
								<form class="form-horizontal" action="{{route('users.updateus',$usuario->id)}}" method="post">
								@method('PUT')
								@csrf
								<thead>
								</thead>
									<tbody>
										<tr>
											<td>Nombre</td>
											<td>
												<h5>{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}</h5>
												<small>Este campo no se puede editar.</small>
											</td>
										</tr>
										<tr>
											<td>email:</td>
											<td>
												<input type="text" class="form-control @if($errors->has('email')) is-invalid @else  @endif" name="email" value="@if(old('email')){{old('email')}}@else{{$usuario->persona->email}}@endif">
											</td>
										</tr>
										<tr>
			                                <td>Unidad Administrativa:</td>
			                                <td>
			                                    <div class="col-9">
			                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
			                                            {{$puestoPersona->puesto_funcional->puestoEstructura->unidadAdministrativa->ente_publico->ente_publico}}
			                                        @else
			                                            {{$puestoPersona->puesto_funcional->puestoNoEstructura->puestosNoEstructuraAdscripcion}}
			                                        @endif
			                                    </div>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td>Área:</td>
			                                <td>
			                                    <div class="col-9">
			                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
			                                            {{$puestoPersona->puesto_funcional->puestoEstructura->unidadAdministrativa->unidad_admin}}
			                                        @else
			                                            
			                                        @endif
			                                    </div>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td>Tipo de Contratación:</td>
			                                <td>
			                                    <div class="col-9">
			                                        {{$puestoPersona->puesto_funcional->tipoContratacion->tipo_contratacion}}
			                                    </div>
			                                </td>
			                            </tr>
			                            <tr>
			                                <td>Puesto:</td>
			                                <td>
			                                    <div class="col-9">
			                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
			                                            {{$puestoPersona->puesto_funcional->puestoEstructura->puesto_estructura}}
			                                        @else
			                                             {{$puestoPersona->puesto_funcional->puestoNoEstructura->puesto_funcional}}
			                                        @endif
			                                    </div>
			                                </td>
			                            </tr>
										<tr>
											<td colspan="2">
												<div class="row">
														<div class="col-md-6">
                                                			<a href="#" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#myModalDeleteUser" ><i class="fa fa-envelope"></i> Eliminar</a>
                                            			</div>
                                            			<div class="col-md-6">
                                                			<button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Guardar</button>
                                            			</div>
 
                                    			</div>
											</td>
										</tr>
									</tbody>
								</form>
							</table>
						</div>
					</div>
					 @include('users.delete_modal')
					 @include('users.enviarCambioPassword_modal')
					 @include('users._inhabilitarUsuario_modal')
					 @include('users._reactivarUsuario_modal')
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="col-8">
		<div class="card " >
			<div class="card-body">
				<h3 class="card-title">Roles para el usuario</h3>
				<p class="card-text">&nbsp;</p>
				<div class="">
					<table class="table table-bordered table-striped">
						@foreach($roles as $rol)

							<tr>
								<td>
									<h5>{{$rol->name}}</h5>
									{{$rol->description}} / <small class="pull-right text-navy">creado el: {{$rol->created_at}}</small>
								</td>
								<td>
									@if(!$usuario->hasRole($rol->name))
									<form method="post" action="{{route('users.assignRole',$usuario->id)}}">
										@method('POST')
										@csrf
										<input type="hidden" value="{{$rol->name}}" name="roles" >
										<button type="submit" class="btn btn-primary" ><i class="fa fa-thumbs-up"></i> Asignar </button>
									</form>
									@else
									<form method="post" action="{{route('users.removeFromRole',$usuario->id)}}">
										@method('POST')
										@csrf
										<input type="hidden" value="{{$rol->name}}" name="roles" >
										<button type="submit" class="btn  btn-danger"><i class="fa fa-minus"></i> remover</button>
									</form>
									@endif
								</td>
							</tr>
						@endforeach
						</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-4">
	</div>
	
</div>


@endsection


@section('scripts')
<script type="text/javascript">
	$( "#frm_envio_remember_pass" ).submit(function( event ) {
	    event.preventDefault();
	    var rfc = $("#rfc").val();
	   
	  
	   
	    disableButton();
	    //ajax
	    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

	    $.ajax({

                type:"POST",
        		url:"{{route('envioRememberPass')}}",
        		data:{rfc:rfc},
                dataType: "JSON",
                success: function(respuesta) {

                swal.fire("ENVIADO",respuesta.message, "success");
                closeOpenModals();
                enableButton();
                    
                },
                error: function(respuesta_error) {
                    swal.fire("Error",respuesta_error.error, "error");
                    closeOpenModals();
                    enableButton();
                    return false;
                }
            });


	  });

	
	const closeOpenModals = () =>{
        $( ".modal" ).each(function( index ) {
	          $(this).modal('hide');
	        });
	 };

	function disableButton() {
        var btnEnviar = document.getElementById('kt_login_forgot_submit_');
        btnEnviar.disabled = true;

        var btnCancelar = document.getElementById('btnCancelar');
        btnCancelar.disabled = true;
    }

    function enableButton() {
        var btnEnviar = document.getElementById('kt_login_forgot_submit_');
        btnEnviar.disabled = false;

        var btnCancelar = document.getElementById('btnCancelar');
        btnCancelar.disabled = false;
    }

</script>
@endsection

