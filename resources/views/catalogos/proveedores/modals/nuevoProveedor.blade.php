<div class="modal fade" id="mod_add_proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo proveedor:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body" id="modal_content">
                <div id="error_proveedor_add"></div>
                <form role="form" name="frm_nuevo_proveedor" id="frm_nuevo_proveedor" method="POST">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">RFC<b>*</b></label>
                                        <input type="text" class="form-control" id="rfc" name="rfc" required="required">
                                        <span id="rfc-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Tipo persona<b>*</b></label><br>
                                        <select class="form-control select2" name="tipo_persona" id="tipo_persona" required ="required">
                                            <option disabled selected>Seleccione una opción</option>
                                            <option value="M">Moral</option>
                                            <option value="F">Física</option>
                                        </select>
                                        <span id="tipo-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Nombre(s)<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_nombre" name="fisica_nombre" required="required">
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Apellido paterno<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_primer_ap" name="fisica_primer_ap" required="required">
                                        <span id="primer-ap-error" class="help-block"></span>
                                    </div>

                                </div>

                                <div class="col-md-6"> 

                                    <div class="form-group">
                                        <label class="control-label">Apellido materno<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_segundo_ap" name="fisica_segundo_ap" required="required">
                                        <span id="segundo-ap-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Razón social<b>*</b></label>
                                        <input type="text" class="form-control" id="razon_social" name="razon_social" required="required">
                                        <span id="razon-error" class="help-block"></span>
                                    </div>      

                                    <div class="form-group">
                                        <label class="control-label">Representante legal<b>*</b></label>
                                        <input type="text" class="form-control" id="representante_legal" name="representante_legal" required="required">
                                        <span id="representante-error" class="help-block"></span>
                                    </div>                              
                                
                                    {{--<div class="col-md-12 text-right">
                                        <label class="col-4 col-form-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="estatusProveedor" id="estatusProveedor">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>--}}
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_proveedor_create();">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>