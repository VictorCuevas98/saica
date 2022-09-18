<div class="row">
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie total construida (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg " maxlength="22" name="superficie_total_construida" id="superficie_total_construida" value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie s.n.b (m2) </label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_snb" id="superficie_snb" value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie b.n.b (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_bnb" id="superficie_bnb" value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie b.n.b habitable (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_bnb_habitable" id="superficie_bnb_habitable"  value="">
     </div>
     <!--end::Input-->
   </div>
</div>

<div class="row">
  <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie ampliación (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_ampliacion" id="superficie_ampliacion"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Superficie existente (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="superficie_existente" id="superficie_existente"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Área libre (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="area_libre_m2" id="area_libre_m2"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
    <div class="col-xl-3">
        <!--begin::Input-->
        <div class="form-group">
            <label>Área libre (%)</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="area_libre_p" id="area_libre_p"  value="">
            <span class="form-text text-muted"></span>
        </div>
        <!--end::Input-->
    </div>
</div>

<div class="row">
  <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Estacionamiento cubierto (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="estacionamiento_cubierto" id="estacionamiento_cubierto"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Estacionamiento descubierto (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="estacionamiento_descubierto" id="estacionamiento_descubierto"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Semisotano (m2)</label>
        <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="semisotano" id="semisotano"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
   <div class="col-xl-3">
     <!--begin::Input-->
     <div class="form-group">
        <label>Número de niveles s.n.b</label>
        <input type="text" class="form-control form-control-solid form-control-lg numbersOnly" maxlength="22" name="num_niveles_snb" id="num_niveles_snb"  value="">
        <span class="form-text text-muted"></span>
     </div>
     <!--end::Input-->
   </div>
</div>
<div class="row">
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Giro</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="160" name="giro" id="giro"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Número de licencia de contrucción</label>
          <input type="text" class="form-control form-control-solid form-control-lg numbersOnly" maxlength="32" name="num_licencia_construccion" id="num_licencia_construccion"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Fecha de la licencia</label>
          <input class="form-control form-control-solid form-control-lg" type="date" min="@php echo date('Y-01-01'); @endphp" onkeydown="return false" name="fecha_licencia" id="fecha_licencia" onchange="" value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Población fija</label>
          <input type="text" class="form-control form-control-solid form-control-lg numbersOnly" maxlength="5" name="poblacion_fija" id="poblacion_fija"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
</div>

<div class="row">
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Población flotante</label>
          <input type="text" class="form-control form-control-solid form-control-lg numbersOnly" maxlength="5" name="poblacion_flotante" id="poblacion_flotante"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Consumo promedio de agua potable (m3 / día)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="consumo_prom_agua_potable" id="consumo_prom_agua_potable"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Consumo Promedio de agua residual (m3 / día)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="consumo_prom_agua_residual" id="consumo_prom_agua_residual"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Gasto sanitario generado (lps)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="gasto_sanitario" id="gasto_sanitario"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
</div>


<div class="row">
    <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>Gasto pluvial y sanitario (lps)</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="22" name="gasto_pluvial_sanitario" id="gasto_pluvial_sanitario"  value="">
          <span class="form-text text-muted"></span>
       </div>
       <!--end::Input-->
    </div>
</div>