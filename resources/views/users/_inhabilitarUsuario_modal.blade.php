<div class="modal inmodal" id="modalInhabilitarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-1000" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle">Desactivar usuario</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('users.inhabilitarusuario',$usuario->id)}}" method="POST" class="" id="frm_desactivar_usuario">
        @method('PUT')
        @csrf

      <div class="modal-body">
        <h5 align="justify">El siguiente usuario <strong>{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}</strong> será desactivado dentro del sistema SAICA, por lo que no tendra acceso.<br><br>
        ¿Desea continuar con esta acción?</h5>
      </div>
       
         <div class="modal-footer">
            <button type="button" id="btnCancelarIn" class="btn btn-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="kt_login_forgot_submit_IN" class=" btn btn-success">Si, enviar y continuar</button>
         </div>
       </form>
    </div>
  </div>
</div>          