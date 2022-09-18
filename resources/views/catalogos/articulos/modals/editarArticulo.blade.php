<div class="modal fade" id="mod_edit_articulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar artículo:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_articulo_edit"></div>
                <form role="form" name="frm_editar_articulo" id="frm_editar_articulo" method="POST">
                    <input type="hidden" class="form-control" id="id_clave" name="id_clave" value="{{$articulo->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave artículo<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_artmed" name="clave_artmed" value="{{$articulo->clave_artmed}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Descripción<b>*</b></label>
                                        <textarea class="form-control" id="artmed" name="artmed" value="{{$articulo->artmed}}" required="required">{{$articulo->artmed}}</textarea>
                                        <span id="descripcion-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">CABMS<b>*</b></label>
                                        <select class="form-control select2" name="cabms" id="cabms">
                                            @foreach($cabms as $cabm)
                                                <option value="{{ $cabm->id }}" {{ ($articulo->id_cabms == $cabm->id)? "selected" : ""}} >{{ $cabm->clave_cabms }} <b>-</b> {{ $cabm->cabms }}</option>
                                            @endforeach
                                        </select>
                                        <span id="cabms-error" class="help-block"></span>
                                    </div>     

                                    <div class="form-group">
                                        <label class="control-label">Unidad de medida<b>*</b></label>
                                        <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" value="{{$articulo->unidad_medida}}" required="required">
                                        <span id="unidad-error" class="help-block"></span>
                                    </div> 

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($articulo->activo != 0) ? 'checked' : ''}} name="estatusArticulo" id="estatusArticulo">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_articulo_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>