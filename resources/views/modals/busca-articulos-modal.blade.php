<!-- sample modal content -->
<div id="busca-articulo-modal" class="modal animated bounceInDown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content ">
			<div class="modal-header">
				<h4 class="modal-title">Artículo</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form id="buscaArticulo" action="" method="post">
			@method('POST')
			@csrf
			<div class="modal-body">
				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">Clave Artículo</label>
					<div class="col-md-6">
						<input id="artmedField" type="text" class="form-control" autocomplete="off" name="artmedField" value="" required autofocus>
						
						<a class="btn btn-primary btn-primary" onclick="buscaArticulo()" id="kt_search">Buscar</a>
					</div>
				</div> 
				<div id="div-cantidad-pedido" class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">Cantidad</label>
					<div class="col-md-6">
						<input id="quantityInput" type="number" class="form-control" name="quantityInput" value="" required autofocus>
						
					</div>
				</div>
				<div id="div-cantidad-pedido" class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">Almacen</label>
					<div class="col-md-6">
						<select id="almacenInput"class="form-control" name="almaceInput"  required autofocus>
							<option value="-1">Selecciona un almacen</option>
							@foreach ($almacenes as $almacen)
								<option value="{{ $almacen->id }}">{{ $almacen->almacen }}</option>
							@endforeach
						</select>
						
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
				<button id="add-btn" onclick="agregarProducto()" type="button" class="btn btn-success">Agregar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->