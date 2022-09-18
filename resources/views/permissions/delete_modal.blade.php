 
{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalDeletePermission">
        Eliminar
    </button>
</div> --}}

<div class="modal inmodal" id="myModalDeletePermission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
			<div class="modal-header">
				
				<h4 class="modal-title">¿Quieres eliminar al Permiso?</h4>
				<small class="font-bold">&nbsp;</small>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<h3><center>{{$permission->name}}</center></h3>
			</div>
		
			<form action="{{ route('permissions.destroy' , $permission->id) }}" method="post">
				@method('DELETE')
				@csrf
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">No</button>
					<input type="submit"  class="btn btn-primary" value="Si, Quiero Eliminarlo">
				</div>
			</form>
        </div>
    </div>
</div>