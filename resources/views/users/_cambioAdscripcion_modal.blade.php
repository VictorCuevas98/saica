<div class="modal inmodal" id="cambioAdscripcion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-1000" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLongTitle">Cambio de adscripción</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" id="kt_form_1">
        <!-- area de formulario -->
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-lg-12">
              <label class="col-form-label">Unidad administrativa:</label>
               <select class="form-control" name="entes_llenados">
                <option value="">Seleccione una opción</option>
                @foreach($entesPublicos as $ente)
                  <option value="{{$ente->id}}">{{$ente->ente_publico}}</option>
                @endforeach
               </select>
               @if ($errors->has('entes_llenados'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('entes_llenados') }}</strong>
                  </span>
                @endif
               <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
          </div>
           <div class="form-group row">
              <div class="col-lg-12">
                <label class="col-form-label ">Fecha de adscripción:</label>
                <input type="date" class="form-control" name="fecha_Adscripcion" id="fecha_Adscripcion" />
                <span class="form-text text-muted">Este campo es obligatorio.</span>
              </div>
           </div> 
        </div>
        
        <!-- div botones -->
        <div class="modal-footer">
          <button type="button" id="btnCancelarRe" class="btn btn-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="form_success" class="btn btn-success font-weight-bold mr-2">Actualizar</button>
        </div>
      </form>



    </div>
  </div>
</div>