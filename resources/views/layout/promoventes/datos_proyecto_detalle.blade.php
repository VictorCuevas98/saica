<div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Información Adicional</h3>
  </div>
  <div class="row">
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Folio CUZUS</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="30" name="folio_cuzus" id="folio_cuzus" >
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Total de construcción (m2)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="total_construccion" id="total_construccion" value=0>
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       

       <!--begin::Input-->
       <div class="form-group" style="display:none;" id="container_uso_suelo">
          <label>Especifique</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="150" name="otro_uso_suelo" id="otro_uso_suelo" >
       </div>
       <!--end::Input-->

     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Número de Niveles S.N.B. y B.N.B.</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="5" name="n_niveles" id="n_niveles" value=0>
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Superficie de Predio (m2)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="superficie_predio" id="superficie_predio" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Número de Viviendas</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="5" name="n_viviendas" id="n_viviendas" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Demolición (m2)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="demolicion" id="demolicion" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Número de Sótanos</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="4" name="n_sotanos" id="n_sotanos" value=0>
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Excavación (m3)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="excavacion" id="excavacion" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>N. de cajones de estacionamiento</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="5" name="n_cajones_estacionamiento" id="n_cajones_estacionamiento" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Construcción S.N.B (m2)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="construccion_snb" id="construccion_snb" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Inversión total</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="inversion_total" id="inversion_total" value=0>
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Construcción B.N.B (m2)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="" name="construccion_bnb" id="construccion_bnb" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Empleos totales</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="5" name="empleados_totales" id="empleados_totales" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Inicio de obras y actividades</label>
          <input class="form-control form-control-solid form-control-lg" type="date" min="@php echo date('Y-01-01'); @endphp" onkeydown="return false" name="inicio_actividades" id="inicio_actividades" onchange="valida_fechas();" value=0>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Término de obras y actividades</label>
          <input class="form-control form-control-solid form-control-lg" type="date" min="@php echo date('Y-01-01'); @endphp" onkeydown="return false" name="termino_actividades" onchange="valida_fechas();" id="termino_actividades" value=0>
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Superficie desplante</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_desplante" id="superficie_desplante" placeholder="0" value="">
       </div>
       <!--end::Input-->
     </div>
  </div>