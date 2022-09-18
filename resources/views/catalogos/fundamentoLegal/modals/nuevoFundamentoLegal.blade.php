<div class="modal fade" id="mod_add_fundamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo Fundamento Legal:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
       
            <div class="modal-body" id="modal_content">
                <div id="error_Fundamento_add"></div>
                <form role="form" name="frm_nuevo_fundamento" id="frm_nuevo_fundamento" method="POST">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave Fundamento Legal<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_fundamento_legal" name="clave_fundamento_legal" required autofocus>
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Fundamento Legal<b>*</b></label>
                                        <textarea class="form-control" id="fundamento_legal" name="fundamento_legal" required="required"></textarea>
                                        <span id="fundamento-error" class="help-block"></span>
                                    </div>

                                </div>

                                {{--<div class="col-md-6">   
                                    <div class="col-md-12 text-right">
                                        <label class="col-4 col-form-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="estatus" id="estatus">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>--}}
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_fundamento_create();">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>