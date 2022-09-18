<div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="myModalLabel">Atención a Usuarios</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">X</span>X
         </button>
      </div>
      <div class="modal-body" id="modal_content">
         <div id="error_usuario_add"></div>
         <form role="form" name="frm_nuevo_concepto" id="frm_nuevo_concepto">
            <div class="panel panel-primary">
               <div class="panel-body">
                  <div class="row">
                     <!--<div align="center" class="col-md-12 img-fluid rounded mx-auto d-block" alt="Responsive image" srcset="" style="background-repeat: no-repeat;background-size: cover; background-image: url('/assets/media/bg/MESADESERVICIO-FN1.png'">-->
                     <!--<div class="col-md-12 " style="background: url('/assets/media/bg/MESADESERVICIO-FN1.png') no-repeat fixed center;  -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 10%; width: 10% ; text-align: center">-->
                     <div class="col-md-8">
                        <div class="form-group">
                           <label class="control-label">
                              <h4>Para dudas y aclaraciones del Programa de Reactivación Económica y Producción de Vivienda Incluyente, Popular, Social y de Trabajadores en la Ciudad de México (PREVIT):</h4>
                           </label>
                           <span id="nombre-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              Escribenos al Correo:
                              <h4>previt@seduvi.cdmx.gob.mx</h4>
                           </label>
                           <span id="nombre-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <h4>Para dudas y aclaraciones del funcionamiento del sistema (PREVIT):</h4>
                           </label>
                           <span id="nombre-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              Escribenos al Correo:
                              <h4>mesadeservicio@finanzas.cdmx.gob.mx</h4>
                           </label>
                           <span id="nombre-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              También puedes comunicarte al Teléfono:
                              <h4>51342500 Ext: 5556</h4>
                           </label>
                           <span id="nombre-error" class="help-block"></span>
                        </div>
                        <br>
                     </div>
                     <div class="col-md-4" style="text-align: center">
                        <img style="margin: 20px 0px 20px 0px;" class="img-fluid rounded mx-auto d-block" alt="Responsive image" src="{{ asset('media/bg/mesa_servicio.png') }}" srcset="">
                     </div>
                  </div>
               </div>
               <div id="error_alerta"> </div>
               <!-- <input type="hidden" id="cat_status" name="cat_status" value="3">
                  <input type="hidden" id="change_pass" name="change_pass" value="10"> -->
         </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">
            Cerrar
            </button>
         </div>
      </div>
   </div>
</div>
</div>
