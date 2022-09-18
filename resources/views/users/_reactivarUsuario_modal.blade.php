<div class="modal inmodal" id="myModalReactivarUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-1000" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle">Reactivar usuario</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('envioReactivarUsuario')}}" method="POST" class="" id="frm_reactivar_usuario">
      
        @method('POST')
        @csrf

      <div class="modal-body">
        <h5 align="justify">Se habilitará el siguiente usuario <strong>{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}</strong>,
            <input type="hidden" id="rfc" name="rfc" style="text-transform:uppercase;" value="{{$usuario->persona->rfc}}" /> 
            se enviará por correo electronico (<strong>{{$usuario->persona->email}}</strong>) el link para reactivar su cuenta.
            <br><br>¿Desea continuar con esta acción?</h5>
      </div>
       
         <div class="modal-footer">
            <button type="button" id="btnCancelarRe" class="btn btn-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="kt_login_forgot_submit_Re" class=" btn btn-success">Si, enviar y continuar</button>
         </div>
       </form>
    </div>
  </div>
</div>