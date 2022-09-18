


	<div class="col-5">
		<div class="card">
			<div class="card-body">
				
				<div class="">
					<form class="form-horizontal">
						<center class="m-t-30">
							<img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" class="rounded-circle" width="150">
							<h4 class="card-title m-t-10">
									{{$usuario->name}}
							</h4>
						</center>
						<div>
							<hr>
						</div>
						<div class="card-body">
							<small class="text-muted">Correo electronico:</small>
							<h6>
								{{$usuario->email}}
							</h6>
							@if(!is_null($usuario->dependencia_id))
							<small class="text-muted">Dependencia</small>
							<h6>
								{{ $usuario->dependencia->nombre}}, ({{ $usuario->dependencia->nombre_corto}})
							</h6>
							@endif
							<small class="text-muted">Creado el:</small> 
							<h6>
								{{$usuario->created_at}}
							</h6>
							
							<small class="text-muted">	Modificado el: </small> 
							<h6>	
								{{$usuario->updated_at}}
							</h6>
						</div>
						<h6>
					
				</h6>
					</form>
				</div>
			</div>
		</div>
	</div>
