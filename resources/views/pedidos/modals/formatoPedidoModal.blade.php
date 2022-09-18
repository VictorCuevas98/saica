<!-- sample modal content -->
<div id="myModalFormato" class="modal animated bounceInRight" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Formato de pedido</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<form action="" method="post">
			@method('POST')
			@csrf
			<div class="modal-body">
				<iframe width="100%" height="350px" src="{{ url('/pedidosProgramacion/formatoPedido') }}" frameborder="0"></iframe>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->