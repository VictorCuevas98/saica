<div class="modal inmodal" id="cambioAdscripcionEstructura" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
          <div class="modal-header">
          <!--<i class="fa fa-question modal-icon"></i>-->
            <h2 class="modal-title">Cambio de adscripción</h2>

            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          </div>
          <form class="form" id="kt_form_1">  
          {{--@method('POST')
          @csrf--}}
            <div class="card-body" id="">
              <div class="form-group row">
                <div class="col-lg-12">
                  <label>Tipo de contración:</label>
                  {{-- select para posible cambio por promoción
                    <select id="tipo_contratacion" name="tipo_contratacion" class="form-control" >
                      <option value="0">selecciona una opción</option>
                      @foreach($catTipoContratacion as $tipo)
                        <option value="{{$tipo->clave_tipo_contratacion}}" {{ old('tipo_contratacion_manual') == $tipo->id ? 'selected' : '' }}>
                          {{$tipo->tipo_contratacion}}
                        </option>
                    @endforeach
                    </select>
                  --}}
                    <input type="text" class="form-control" value="{{$puestoPersona->puesto_funcional->tipoContratacion->tipo_contratacion}}" readonly="" />
                    <span class="form-text text-muted">Este campo no se puede editar.</span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-4">
                  <label>Fecha de adscripcrión:</label>
                  <input type="date" id="dateAdscripcion" name="dateAdscripcion" class="form-control">
                  <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
                <div class="col-lg-4">
                  <label>Teléfono de oficina:</label>
                  <input type="tel" id="telOficina" name="telOficina" class="form-control" placeholder="Teléfono de oficina">
                  <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
                <div class="col-lg-4">
                  <label>Extesión de oficina:</label>
                  <input type="tel" id="extOficina" name="extOficina" class="form-control" placeholder="Extesión de oficina">
                  <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label>Unidad administrativa:</label>
                    <select id="entes_llenados" name="entes_llenados" class="form-control" >
                      <option value="">Seleccione una opción</option>
                        @foreach($entesPublicos as $ente)
                          <option value="{{$ente->id}}">{{$ente->ente_publico}}</option>
                        @endforeach
                    </select>
                    <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-12">
                  <label>Área:</label>
                    <select id="areas_llenados" name="areas_llenados" class="form-control  ">
                      <option value="">Seleccione una opción</option>
                    </select>
                    <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label>Puesto:</label>
                    <select id="puestos_llenados" name="puestos_llenados" class="form-control  ">
                      <option value="">Seleccione una opción</option>
                    </select>
                    <span class="form-text text-muted">Este campo es obligatorio.</span>
                </div>
              </div>
              
            </div>

            <div class="modal-footer">
                <button type="button" id="btnCancelarRe" class="btn btn-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="form_success" class="btn btn-success font-weight-bold mr-2">Actualizar</button>
            </div>
        </form>
  
      
    </div>
  </div>
</div>        
