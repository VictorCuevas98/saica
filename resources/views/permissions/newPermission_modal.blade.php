{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalNewPermission">
        Nuevo
    </button>
</div> --}}

<!-- sample modal content -->
<div id="myModalNewPermission" class="modal animated bounceInRight " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content ">
			<div class="modal-header">
				<h4 class="modal-title">Nuevo permiso</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="{{route('permissions.store')}}" method="post">
			@method('POST')
			@csrf
			<div class="modal-body">
				<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus />
                                
                                <span class="form-text text-muted">Nombre unico del permiso (este campo no podrá ser cambiado posteriormente)</span>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="nombre_para_mostrar" class="col-md-4 col-form-label text-md-right">{{ __('Nombre para mostrar') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre_para_mostrar" type="text" class="form-control{{ $errors->has('nombre_para_mostrar') ? ' is-invalid' : '' }}" name="nombre_para_mostrar" value="{{ old('nombre_para_mostrar') }}" required autofocus>
                                @if ($errors->has('nombre_para_mostrar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre_para_mostrar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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
