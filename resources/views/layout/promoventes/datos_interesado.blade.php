<div class="form-group">
   <div class="alert alert-success" role="alert">DATOS DE LA PERSONA INTERESADA  (PERSONA FÍSICA O MORAL)</div>
</div>

<div class="modal fade" id="ModalAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Proceso de envío de información (Datos del Promovente)</h5>
         </div>
         <div class="modal-body" style="text-align:justify">
            Antes de su envío, se recomienda ampliamente revise su información, ya que una vez enviada, NO podrá hacer correcciones enviarla de nueva cuenta.<br><br>
            ¿Esta seguro de enviar la información?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">CANCELAR</button>
            <button type="button" class="btn btn-primary font-weight-bold" onclick="guardar_datos_interesado();">CONTINUAR CON EL ENVÍO</button>
         </div>
      </div>
   </div>
</div>

<form class="form" id="kt_form_datos_interesado" method="post">

  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Domicilio Fiscal</h3>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Código postal</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" name="cpostal_fiscal" id="cpostal_fiscal" onchange="buscar_cp();">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Entidad Federativa</label>
           <select name="id_entidad_fiscal" id="id_entidad_fiscal" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Alcaldía o Municipio</label>
           <select name="id_alcaldia_fiscal" id="id_alcaldia_fiscal" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
  </div>

  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Colonia</label>
           <select name="id_colonia_fiscal" id="id_colonia_fiscal" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-8">
        <!--begin::Input-->
        <div class="form-group">
           <label>Calle</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="calle_fiscal" id="calle_fiscal">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>N. Exterior</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="nexterior_fiscal" id="nexterior_fiscal">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>N. Interior</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="ninterior_fiscal">
        </div>
        <!--end::Input-->
     </div>
  </div>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Representante Legal</h3>
  </div>
  <div class="row">
     <div class="col-xl-4">
       <div class="form-group">
          <label>Nombre(s)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="nombre_representante_legal" id="nombre_representante_legal">
       </div>
     </div>
     <div class="col-xl-4">
       <div class="form-group">
          <label>Apellido Paterno</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="paterno_representante_legal" id="paterno_representante_legal">
       </div>
     </div>
     <div class="col-xl-4">
       <div class="form-group">
          <label>Apellido Materno</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="materno_representante_legal" id="materno_representante_legal">
       </div>
     </div>
  </div>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Domicilio para recibir notificaciones</h3>
  </div>

  <div class="form-group">
    <label class="checkbox checkbox-success">
		    <input type="checkbox" id="check_domicilio_notificaciones" name="check_domicilio_notificaciones" onclick="valida_dnotificaciones();">
        <div style="text-align:justify">
          Mi domicilio para recibir notificaciones es el mismo que el domicilio Fiscal.
        </div>
				<span></span>
    </label>
  </div>
  <div id="cont_domicilio_notificacion">
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Código postal</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" name="cpostal_notificaciones" id="cpostal_notificaciones" onchange="buscar_cp_notificaciones();">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Entidad Federativa</label>
           <select name="id_entidad_notificaciones" id="id_entidad_notificaciones" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Alcaldía o Municipio</label>
           <select name="id_alcaldia_notificaciones" id="id_alcaldia_notificaciones" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
  </div>

  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Colonia</label>
           <select name="id_colonia_notificaciones" id="id_colonia_notificaciones" class="form-control form-control-solid form-control-lg">
              <option value="">Selecciona</option>
           </select>
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-8">
        <!--begin::Input-->
        <div class="form-group">
           <label>Calle</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="calle_notificaciones" id="calle_notificaciones">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>N. Exterior</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="nexterior_notificaciones" id="nexterior_notificaciones">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>N. Interior</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="ninterior_notificaciones">
        </div>
        <!--end::Input-->
     </div>
  </div>
  </div>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Datos de Contacto</h3>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Teléfonos</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="10" name="ntelefono1" id="ntelefono1">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>correo electrónico</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="10" name="ntelefono2" id="ntelefono2">
        </div>
        <!--end::Input-->
     </div>
  </div>
  <div class="card-footer">
     <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
           <button type="button" class="btn btn-primary btn-lg btn-block" onclick="valida_datos_interesado();">GUARDAR Y CONTINUAR</button>
        </div>
     </div>
  </div>

</form>
