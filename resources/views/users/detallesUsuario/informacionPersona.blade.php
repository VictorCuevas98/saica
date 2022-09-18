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
            <a href="{{ route('users.show',$usuario->id) }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
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

	<!--BEGIN::Inicia card titulo-->
	<div class="col-md-12">
		<div class="card card-custom gutter-b">
			<div class="card-header">
				  <div class="card-title">
					   <h2 class="card-title"><strong>Detalles de usuario</strong></h2>
				  </div>
			 </div>
		</div>	
	</div>
	<!--END::Finaliza card titulo-->

	@include('users._delete_modal')
	@include('users._enviarCambioPassword_modal')
	@include('users._inhabilitarUsuario_modal')
	@include('users._reactivarUsuario_modal')
	<!--BEGIN::Card izquierdo menu detalles usuario-->
	<div class="col-sm-5">
		<div class="card card-custom gutter-b">
			<!--BEGIN::Card header nombre y acciones usuario-->
			<div class="card-header">
				  <div class="card-title">
					   <h6 class="card-label">
					   	{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}
					   </h6> 
				  </div>
				  <div class="card-toolbar">
				  		<div class="dropdown dropdown-inline" data-toggle="tooltip" title data-placement="left" data-original-title="Acciones">
				  			<a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
				  				<i class="ki ki-bold-more-hor"></i>
				  			</a>
					  		<div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-217px, 33px, 0px);">
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
	    								<li class="navi-item">
	    									<a href="#" class="navi-link" data-toggle="modal" data-target="#myModalDeleteUser" >
	    										<span class="navi-icon">
	    											<i class="fa fa-trash" aria-hidden="true"></i>
	    										</span>
	    										<span class="navi-text">
	    											Eliminar usuario
	    										</span>
	    									</a>
	    								</li>
	  								</ul>
	  						</div>
				  		</div>
				  		
				  </div>
			 </div>
			 <!--END::Card header nombre y acciones usuario-->

			 <div class="card-body">
			 	<div class="row">
			 		<table class="table table-striped">
						<tbody>
							<tr>
								<td>Estado del usuario:</td>
								<td><span class="label label-success label-pill label-inline mr-2"> ACTIVO </span></td>
							</tr>			
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
			 	</div><br>

			 	<hr><br>

			 	<div class="form-group row">
			 		<div class="col-xs-1"></div>
			 		<div class="col-md-10">
			 			<h5>Acciones</h5>
			 		</div>
			 	</div>

			 	<div class="form-group row">
			 		<div class="col-xs-1"></div>
			 		<div class="col-md-10">
			 			<a href="{{ route('users.show',$usuario->id) }}" class="navi-link py-4">
			 				<span>
			 					<i class="fa fa-check-square" aria-hidden="true"></i>
			 				</span>
			 				<span class="navi-text font-size-lg">Inicio</span>
			 			</a>
			 		</div>
			 	</div>

			 	<div class="form-group row">
			 		<div class="col-xs-1"></div>
			 		<div class="col-md-10">
			 			<a href="{{ route('users.showInformacionPersona',$usuario->id) }}" class="navi-link py-4 active">
			 				<span>
			 					<i class="fa fa-user-circle" aria-hidden="true"></i>
			 				</span>
			 				<span class="navi-text font-size-lg">Datos personales</span>
			 			</a>
			 		</div>
			 	</div>

			 	<div class="form-group row">
			 		<div class="col-xs-1"></div>
			 		<div class="col-md-10">
			 			@if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
			 				<a href="{{ route('users.showInformacionEstructura',$usuario->id) }}" class="navi-link py-4">
				 				<span>
				 					<i class="fa fa-archive" aria-hidden="true"></i>
				 				</span>
				 				<span class="navi-text font-size-lg">Datos laborales</span>
				 			</a>
			 			@else
				 			<a href="{{ route('users.showInformacionNoEstructura',$usuario->id) }}" class="navi-link py-4">
				 				<span>
				 					<i class="fa fa-briefcase" aria-hidden="true"></i>
				 				</span>
				 				<span class="navi-text font-size-lg">Datos laborales</span>
				 			</a>
			 			@endif
			 		</div>
			 	</div>

			 </div>
		</div>
	</div>
	<!--END::Card izquierdo menu detalles usuario-->		
	
	<div class="col-lg-7">
		<div class="card " >
			<div class="card-body">
				<h3 class="card-title">Datos personales</h3>
				<p class="card-text">&nbsp;</p>
				<hr>
				<div class="">
					<form class="form" action="{{route('users.updateus',$usuario->id)}}" method="POST">
						@method('PUT')
						@csrf
						 <div class="card-body">
							  <div class="form-group row">
							  		<div class="col-lg-6">
									    <label>Curp:</label>
									    <input type="text" class="form-control" value="{{$usuario->persona->curp}}"  readonly="" />
									    <span class="form-text text-muted">Este campo no es posible cambiar.</span>
								   </div>
								   <div class="col-lg-6">
									    <label>RFC:</label>
									    <input type="text" class="form-control" value="{{$usuario->persona->rfc}}"  readonly="" />
									    <span class="form-text text-muted">Este campo no es posible cambiar.</span>
								   </div>
							  </div><br>
							  <div><h5>Contacto</h5></div><br>
							  <div class="form-group row">
								   <div class="col-lg-6">
									    <label>Correo electrónico:</label>
									    <input type="email" class="form-control @if($errors->has('email')) is-invalid @else  @endif" name="email" value="@if(old('email')){{old('email')}}@else{{$usuario->persona->email}}@endif">
									    <span class="form-text text-muted">Este campo es obligatorio.</span>
								   </div>
								   <div class="col-lg-6">
									    <label>Teléfono:</label>
									    <input type="text" class="form-control" value="{{$usuario->persona->telefono}}" readonly="" />
									    <span class="form-text text-muted">Este campo no es posible cambiar.</span>
								   </div>
							  </div>
						 </div>
						 <div class="card-footer">
							  <div class="row">
								   <div class="col-md-8"></div>
								   <div class="col-md-4">
									    <button type="reset" class="btn btn-secondary">Cancelar</button>
									    <button type="submit" class="btn btn-primary">Actualizar</button>
								   </div>
							  </div>
						 </div>
					</form>
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
	//BEGIN::Mensaje recuperacion de contraseña
	$( "#frm_envio_remember_pass" ).submit(function( event ) {
	    event.preventDefault();
	    var rfc = $("#rfc").val();

	    disableButton();
	    
	    //BEGIN::ajax
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
            });//END::ajax


	  });//END::Mensaje recuperacion de contraseña
	
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

    //BEGIN::Mensaje desactivar usuario
	$( "#frm_desactivar_usuario" ).submit(function( event ) {
	    event.preventDefault();
	    //var rfc = $("#rfc").val();

	   	var btnEnviar = document.getElementById('kt_login_forgot_submit_IN');
        btnEnviar.disabled = true;

        var btnCancelar = document.getElementById('btnCancelarIn');
        btnCancelar.disabled = true;

	    //BEGIN::ajax
	    
	    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

	    $.ajax({

                type:"PUT",
        		url:"{{route('users.inhabilitarusuario',$usuario->id)}}",
                dataType: "JSON",
                success: function(respuesta) {

                swal.fire("Proceso finalizado",respuesta.message, "success").then(function(){
                	location.reload();
                });
                closeOpenModals();
                btnEnviar.disabled = false;
                btnCancelar.disabled = false;
                    
                },
                error: function(respuesta_error) {
                    swal.fire("Error",respuesta_error.error, "error").then(function(){
                	location.reload();
                });
                    closeOpenModals();
                    btnEnviar.disabled = false;
                	btnCancelar.disabled = false;
                    return false;
                }
            });//END::ajax


	  });//END::Mensaje desactivar usuario*/

	//BEGIN::Mensaje activar usuario
	$( "#frm_reactivar_usuario" ).submit(function( event ) {
	    event.preventDefault();
	    
	    var rfc = $("#rfc").val();
	    var btnEnviar = document.getElementById('kt_login_forgot_submit_Re');
        btnEnviar.disabled = true;
        var btnCancelar = document.getElementById('btnCancelarRe');
        btnCancelar.disabled = true;

	    
	    //BEGIN::ajax
	    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

	    $.ajax({

                type:"POST",
        		url:"{{route('envioReactivarUsuario')}}",
        		data:{rfc:rfc},
                dataType: "JSON",
                success: function(respuesta) {

                swal.fire("ENVIADO",respuesta.message, "success").then(function(){
                	location.reload();
                });
                closeOpenModals();
                enableButton();
                    
                },
                error: function(respuesta_error) {
                    swal.fire("Error",respuesta_error.error, "error").then(function(){
                	location.reload();
                });
                    closeOpenModals();
                    enableButton();
                    return false;
                }
            });//END::ajax

	  });

	//END::Mensaje activar usuario

	//BEGIN::Mensaje eliminar usuario
	$( "#frm_delete_usuario" ).submit(function( event ) {
	    event.preventDefault();
	    //var rfc = $("#rfc").val();

	   	var btnEnviar = document.getElementById('kt_login_forgot_submit_De');
        btnEnviar.disabled = true;

        var btnCancelar = document.getElementById('btnCancelarDe');
        btnCancelar.disabled = true;

	    //BEGIN::ajax
	    
	    $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

	    $.ajax({

                type:"DELETE",
        		url:"{{ route('users.destroy' , $usuario->id) }}",
                dataType: "JSON",
                success: function(respuesta) {

                swal.fire("Proceso finalizado",respuesta.message, "success").then(function(){
                	location.href = '{{ route('users.index') }}';
                });
                closeOpenModals();
                btnEnviar.disabled = false;
                btnCancelar.disabled = false;
                    
                },
                error: function(respuesta_error) {
                    swal.fire("Error",respuesta_error.error, "error").then(function(){
                	location.reload();
                });
                    closeOpenModals();
                    btnEnviar.disabled = false;
                	btnCancelar.disabled = false;
                    return false;
                }
            });//END::ajax*


	  });//END::Mensaje eliminar usuario*/

</script>

@endsection


