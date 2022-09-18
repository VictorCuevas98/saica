{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalNewRol">
        Nuevo
    </button>
</div> --}}

<!-- sample modal content -->
<div id="myModalNewRol" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content  animated bounceInRight">
			<div class="modal-header">
				<h4 class="modal-title">Nuevo Rol</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{route('roles.store')}}" method="post">
			@method('POST')
			@csrf
			<div class="modal-body">
				<div class="form-group row">
					<label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
					<div class="col-md-6">
						<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
						@if ($errors->has('nombre'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('nombre') }}</strong>
							</span>
						@endif
						<span class="form-text text-muted">ejemplo: "almacen.inventario" o también "farmacia"</span>

					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
					<div class="col-md-6">
						<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
						@if ($errors->has('descripcion'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('descripcion') }}</strong>
							</span>
						@endif
						<span class="form-text text-muted">Breve descrición del proposito del rol</span>
					</div>
				</div> 
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <input type="submit" href="" class="btn btn-primary" value="Guardar">
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->

