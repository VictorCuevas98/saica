<div class="modal fade" id="mod_add_laboratorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo laboratorio:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body" id="modal_content">
                <div id="error_laboratorio_add"></div>
                <form role="form" name="frm_nuevo_laboratorio" id="frm_nuevo_laboratorio" method="POST">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave laboratorio<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_laboratorio" name="clave_laboratorio" required autofocus>
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Nombre laboratorio<b>*</b></label>
                                        <textarea class="form-control" id="laboratorio" name="laboratorio" required="required"></textarea>
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                </div>

                                {{--<div class="col-md-6">   
                                    <div class="col-md-12 text-right">
                                        <label class="col-4 col-form-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="estatusLaboratorio" id="estatusLaboratorio">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_laboratorio_create();">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>