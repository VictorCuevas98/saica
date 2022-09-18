<div class="modal fade" id="mod_edit_almacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar almacen:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_almacen_edit"></div>
                <form role="form" name="frm_editar_almacen" id="frm_editar_almacen" method="POST">
                    <input type="hidden" class="form-control" id="id_almacen" name="id_almacen" value="{{$almacen->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave almacen<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_almacen" name="clave_almacen" required="required" value="{{$almacen->clave_almacen}}">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Nombre almacen<b>*</b></label>
                                        <textarea class="form-control" id="almacen" name="almacen" required="required" value="{{$almacen->almacen}}">{{$almacen->almacen}}</textarea>
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Calle<b>*</b></label>
                                        <input type="text" class="form-control" id="domi_calle" name="domi_calle" required="required" value="{{$almacen->domi_calle}}">
                                        <span id="calle-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Número exterior</label>
                                        <input type="text" class="form-control" id="domi_num_ext" name="domi_num_ext" value="{{$almacen->domi_num_ext}}">
                                        <span id="interior-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Número interior</label>
                                        <input type="text" class="form-control" id="domi_num_int" name="domi_num_int" value="{{$almacen->domi_num_int}}">
                                        <span id="exterior-error" class="help-block"></span>
                                    </div>

                                    <div class="input-group mb-3">  
                                      <input type="text" class="form-control" id="cp" name="cp" placeholder="Buscar código postal" aria-label="Buscar código postal" aria-describedby="basic-addon2" value="{{$almacen->cp}}">
                                      <div class="input-group-append">
                                        <a class="btn btn-outline-secondary" href="javascript:void(0)" role="button" id="buscar" onclick="buscarColoniaEditar();">Buscar</a>
                                      </div>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="asentamiento">Colonia</label>
                                        <select id="asentamiento" name="asentamiento" class="form-control select2" required="required">                                          
                                          <option value="{{$almacen->id}}" {{(old('asentamiento')==$almacen->id)? 'selected':''}}>{{$almacen->asentamiento}}</option>
                                        </select>
                                        <span id="asentamiento-error" class="help-block"></span>
                                    </div>

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($almacen->activo != 0) ? 'checked' : ''}} name="estatusAlmacen" id="estatusAlmacen">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>                             
                                </div>
                            </div>
                            <label><b>*</b>Campos requeridos</label>
                        </div>
                    </div>
                    <div id="error_alerta"> </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_almacen_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>