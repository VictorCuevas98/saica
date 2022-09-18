 
{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModalDeleteUser">
        Eliminar
    </button>
</div> --}}

<div class="modal inmodal" id="myModalDeleteUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h1 class="modal-title">Eliminar usuario</h1>
                    <small class="font-bold">&nbsp;</small>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    
                </div>
                
                <div class="modal-body">
                    <h5 align="justify">El siguiente usuario <strong>{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}</strong> sera eliminado del sistema SAICA.<br><br>
                    ¿Desea continuar con esta acción?
                    </h5>
                </div>
            
                <form action="{{ route('users.destroy' , $usuario->id) }}" method="POST" id="frm_delete_usuario">
                    @method('DELETE')
                    @csrf
                    <div class="modal-footer">
                        <button type="button" id="btnCancelarDe" class="btn btn-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="kt_login_forgot_submit_De" class=" btn btn-success">Sí, continuar</button>
                    </div>
                </form>
        </div>
    </div>
</div>