<div class="modal fade" id="mod_edit_unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar unidad consolidadora:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_articulo_edit"></div>
                <form role="form" name="frm_editar_unidad" id="frm_editar_unidad" method="POST">
                    <input type="hidden" class="form-control" id="id_unidad" name="id_unidad" value="{{$unidadConsolidadora->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave unidad consolidadora<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_unidad_consolidadora" name="clave_unidad_consolidadora" value="{{$unidadConsolidadora->clave_unidad_consolidadora}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Unidad Consolidadora<b>*</b></label>
                                        <textarea class="form-control" id="unidad_consolidadora" name="unidad_consolidadora" value="{{$unidadConsolidadora->unidad_consolidadora}}" required="required">{{$unidadConsolidadora->unidad_consolidadora}}</textarea>
                                        <span id="unidad-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Orden gobierno<b>*</b></label>
                                        <select class="form-control select2" name="orden_gobierno" id="orden_gobierno">
                                            @foreach($ordenGobierno as $orden)
                                                <option value="{{ $orden->id }}" {{ ($unidadConsolidadora->id_orden_gobierno == $orden->id)? "selected" : ""}} >{{ $orden->orden_gobierno }}</option>
                                            @endforeach
                                        </select>
                                        <span id="orden-error" class="help-block"></span>
                                    </div>     

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($unidadConsolidadora->activo != 0) ? 'checked' : ''}} name="estatusUnidad" id="estatusUnidad">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_unidad_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>