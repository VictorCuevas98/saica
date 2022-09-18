<!--<form class="form" id="kt_form_datos_proyecto">-->
 
  <div class="form-group">
     <div class="alert alert-success" role="alert">INFORMACIÓN DEL PROYECTO</div>
  </div>
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
              <button type="button" class="btn btn-primary font-weight-bold" onclick="guardar_datos_proyecto();">CONTINUAR CON EL ENVÍO</button>
           </div>
        </div>
     </div>
  </div>
  <div class="row">
     <div class="col-xl-6">
       <!--begin::Input-->
       <div class="form-group">
          <label>Nombre del proyecto</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="nombre_proyecto" id="nombre_proyecto" value="{{$proyecto->nombre_proyecto}}">
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-6">
        

        <div class="form-group ">
          <label>Programa o Norma de Aplicación</label>
        <div class="col-12 col-form-label">
            <div class="checkbox-list">
                <label class="checkbox">
                    <input type="checkbox"  name="id_programa[]" value="1" {{($proyecto->programas()->where('id_programa',1)->count() >0)?'checked':''}} />
                    <span></span>
                    Programa Especial de Regeneración Urbana y Vivienda Incluyente (PRUVI) 2019-2024 para la Ciudad de México
                </label>
                <label class="checkbox">
                    <input type="checkbox"  name="id_programa[]" value="2" {{($proyecto->programas()->where('id_programa',2)->count() >0)?'checked':''}}/>
                    <span></span>
                    Norma para Impulsar y Facilitar la Construcción de Vivienda para los Trabajadores Derechohabientes de los Organismos Nacionales de Vivienda en Suelo Urbano
                </label>
                <label class="checkbox">
                    <input type="checkbox"  name="id_programa[]" value="3" {{($proyecto->programas()->where('id_programa',3)->count() >0)?'checked':''}}/>
                    <span></span>
                    La Norma de Ordenación Número 26.
                </label>
            </div>
             <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
    </div>



     </div>
  </div>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Ubicación</h3>
  </div>
  <div class="row">
     <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
           <label>Código postal</label>
           <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" name="cpostal_proyecto" id="cpostal_proyecto" onchange="buscar_cp_proyecto();" value="{{$proyecto->colonia->cp}}">
           <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
     </div>
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Alcaldía o Municipio</label>
          <select name="id_alcaldia_proyecto" id="id_alcaldia_proyecto" class="form-control form-control-solid form-control-lg">
             <option value="">Selecciona</option>
             <option value="{{$proyecto->colonia->id}}" selected="">{{$proyecto->colonia->alcaldia}}</option>              
          </select>
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Colonia</label>
          <select name="id_colonia_proyecto" id="id_colonia_proyecto" class="form-control form-control-solid form-control-lg">
             <option value="">Selecciona</option>
             <option value="{{$proyecto->colonia->id}}" selected="">{{$proyecto->colonia->colonia}}</option>
          </select>
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
       <!--end::Input-->
     </div>
  </div>

  <div class="row">
     <div class="col-xl-6">
       <!--begin::Input-->
       <div class="form-group">
          <label>Calle</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="calle_proyecto" id="calle_proyecto" value="{{$proyecto->calle}}">
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>N. Exterior</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="nexterior_proyecto" id="nexterior_proyecto" value="{{$proyecto->num_ext}}">
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-3">
       <!--begin::Input-->
       <div class="form-group">
          <label>N. Interior</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="ninterior_proyecto" id="ninterior_proyecto" value="{{$proyecto->num_int}}">
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="row">
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Cuenta predial</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="12" name="cuenta_catastral" id="cuenta_catastral" value="{{$proyecto->cuenta_catastral}}">
          <span class="form-text text-muted">Este campo es obligatorio y debe contener 12 caracteres.</span>
       </div>
       <!--end::Input-->
     </div>
     <div class="col-xl-4">
       <!--begin::Input-->
       <div class="form-group">
          <label>Cuenta de Agua</label>
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="16" name="cuenta_agua" id="cuenta_agua" value="{{$proyecto->cuenta_agua}}">
          <span class="form-text text-muted">Este campo debe contener 16 caracteres.</span>
       </div>
       <!--end::Input-->
     </div>
  </div>
  <div class="form-group">
     <h3 class="mb-10 font-weight-bold text-dark">Breve Descripción</h3>
  </div>
  <div class="row">
     <div class="col-xl-12">
       <div class="form-group">
          <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="descripcion" id="descripcion" value="{{$proyecto->breve_descripcion}}">
          <span class="form-text text-muted">Este campo es obligatorio.</span>
       </div>
     </div>
  </div>
  
  
  
  <!--<div class="card-footer">
     <div class="row">
        <div class="col-9"></div>
        <div class="col-3">
           <button type="button" class="btn btn-primary btn-lg btn-block" onclick="valida_datos_proyecto();">GUARDAR Y CONTINUAR</button>
        </div>
     </div>
  </div>-->

<!--</form>-->
