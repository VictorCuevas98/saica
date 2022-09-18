<div class="modal fade" id="mod_edit_fundamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar Fundamento Legal:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_fundamento_edit"></div>
                <form role="form" name="frm_editar_fundamento" id="frm_editar_fundamento" method="POST">
                    <input type="hidden" class="form-control" id="id_fundamento" name="id_fundamento" value="{{$fundamento_legal->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave Fundamento Legal<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_fundamento_legal" name="clave_fundamento_legal" value="{{$fundamento_legal->clave_fundamento_legal}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                 
                                    <div class="form-group">
                                        <label class="control-label">Fundamento Legal<b>*</b></label>
                                        <textarea class="form-control" id="fundamento_legal" name="fundamento_legal" value="{{$fundamento_legal->fundamento_legal}}" required="required">{{$fundamento_legal->fundamento_legal}}</textarea>
                                        <span id="fundamento-error" class="help-block"></span>
                                    </div>

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($fundamento_legal->activo != 0) ? 'checked' : ''}} name="estatusfundamento " id="estatusfundamento ">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_fundamento_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>