<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
  <div class="alert-icon"><i class="flaticon-warning"></i></div>
  <div class="alert-text">Para la captura de los datos adicionales de DRO, PDU o PSA es necesario antes validar el RFC oprimiendo Buscar!</div>
</div>

<div class="form-group">
   <div class="alert alert-success" role="alert">INFORMACIÓN DEL PERSONAL ESPECIALIZADO</div>
</div>

  <!-- Button trigger modal-->
<button type="button" class="btn btn-light-success btn-lg float-light" data-toggle="modal" data-target="#nuevoPersonalEspecializadoModal" id="btn_agregar_personal_especializado">
    <i class="flaticon-user-add"></i> Agregar personal especializado
</button>

<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Proceso de envío de información (Datos del Proyecto)</h5>
         </div>
         <div class="modal-body" style="text-align:justify">
            Antes de su envío, se recomienda ampliamente revise su información, ya que una vez enviada, NO podrá hacer correcciones enviarla de nueva cuenta.<br><br>
            ¿Esta seguro de enviar la información?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal">CANCELAR</button>
            <button type="button" class="btn btn-primary font-weight-bold" onclick="guardar_datos_especializado();">CONTINUAR CON EL ENVÍO</button>
         </div>
      </div>
   </div>
</div>

<!--<form class="form" id="kt_form_datos_personal">-->
<div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Datos del responsable de la obra</h3>
  </div>
  <div class="row">
      <div class="col-xl-4">
        <!--begin::Input-->


        <div class="form-group">
          <label>RFC del D.R.O.</label>

          <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="13" name="rfc_dro" id="rfc_dro" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <div class="input-group-append">
              <button class="btn btn-success " type="button" id="dro_rfc_buscar" name="btn_dro_rfc_buscar" >Buscar!</button>
            </div>
          </div>

          <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>


<!--
        <div class="form-group input-group">
          <label>RFC del D.R.O.</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="rfc_dro" id="rfc_dro" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
          <div class="input-group-append">
            <button class="btn btn-warning" type="button">Buscar!</button>
          </div>
          <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>

-->


        <!--end::Input-->
     </div>

      <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>Número de Registro del D.R.O.</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="30" name="n_registro_dro" id="n_registro_dro" >
          <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>Correo electrónico del D.R.O.</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="correo_registro_dro" id="correo_registro_dro">
          <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
  </div>

  <div class="row">

         <div class="col-xl-4">
            <!--begin::Input-->
             <div class="form-group">
                <label>Nombre del D.R.O.</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="nombre_dro" id="nombre_dro" readonly>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
             </div>
             <!--end::Input-->
         </div>
         <div class="col-xl-4">
            <!--begin::Input-->
             <div class="form-group">
                <label>Apellido paterno del D.R.O.</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="paterno_dro" id="paterno_dro" readonly>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
             </div>
             <!--end::Input-->
         </div>
         <div class="col-xl-4">
            <!--begin::Input-->
             <div class="form-group">
                <label>Apellido Materno del D.R.O.</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="materno_dro" id="materno_dro" readonly>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
             </div>
             <!--end::Input-->
         </div>
  </div>



  <hr>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Datos del Prestador de Servicios Ambientales</h3>
  </div>
  <div class="row">
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>RFC del P.S.A.</label>
          <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="13" name="rfc_servicios_ambientales" id="rfc_servicios_ambientales" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
            <div class="input-group-append">
              <button class="btn btn-success " type="button" id="btn_servicios_ambientales_rfc_buscar" name="btn_servicios_ambientales_rfc_buscar" >Buscar!</button>
            </div>
          </div>
          <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
   </div>
  <div class="row">
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="nombre_servicios_ambientales" id="nombre_servicios_ambientales">
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Apellido paterno</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="paterno_servicios_ambientales" id="paterno_servicios_ambientales">
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Apellido materno</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="materno_servicios_ambientales" id="materno_servicios_ambientales">
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>N. de cédula</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="20" name="cedula_servicios_ambientales" id="cedula_servicios_ambientales">
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>Formación profesional</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="formacion_academica" id="formacion_academica">
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
          <label>Correo electrónico</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="correo_servicios_ambientales" id="correo_servicios_ambientales">
        </div>
        <!--end::Input-->
     </div>
  </div>

<div class="personal_especializado_content">
  &nbsp;
</div>

<hr>
  <div class="form-group">
    <label class="checkbox checkbox-success">
		    <input type="checkbox" id="check_conocimiento" name="check_conocimiento">
        <div style="text-align:justify">
          Conocemos la normativa aplicable en la materia, misma que nos comprometemos a cumplir a cabalidad o en su defecto, a responder ante las sanciones que se determine por la autoridad competente. Enterados de los alcances legales y conforme con lo establecido en el ACUERDO MEDIANTE EL CUAL SE ESTABLECE EL PROGRAMA DE REACTIVACIÓN ECONÓMICA Y PRODUCCIÓN DE VIVIENDA INCLUYENTE, POPULAR, SOCIAL Y DE TRABAJADORES EN LA CIUDAD DE MÉXICO, se firma por el Promovente o su Representante legal.
        </div>
				<span></span>
    </label>
  </div>
  <!--<div class="card-footer">
     <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
           <button type="button" class="btn btn-primary btn-lg btn-block" onclick="valida_datos_especializado();">GUARDAR Y CONTINUAR</button>
        </div>
     </div>
  </div>-->
<!--</form>-->







