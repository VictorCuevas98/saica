<div class="modal fade" id="mod_edit_laboratorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar laboratorio:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_laboratorio_edit"></div>
                <form role="form" name="frm_editar_laboratorio" id="frm_editar_laboratorio" method="POST">
                    <input type="hidden" class="form-control" id="id_laboratorio" name="id_laboratorio" value="{{$laboratorio->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave laboratorio<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_laboratorio" name="clave_laboratorio" value="{{$laboratorio->clave_laboratorio}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Nombre laboratorio<b>*</b></label>
                                        <textarea class="form-control" id="laboratorio" name="laboratorio" value="{{$laboratorio->laboratorio}}" required="required">{{$laboratorio->laboratorio}}</textarea>
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($laboratorio->activo != 0) ? 'checked' : ''}} name="estatusLaboratorio" id="estatusLaboratorio">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_laboratorio_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>