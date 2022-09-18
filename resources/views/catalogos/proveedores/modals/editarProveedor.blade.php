<div class="modal fade" id="mod_edit_proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar proveedor:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_proveedor_edit"></div>
                <form role="form" name="frm_editar_proveedor" id="frm_editar_proveedor" method="POST">
                    <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor" value="{{$proveedor->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">RFC<b>*</b></label>
                                        <input type="text" class="form-control" id="rfc" name="rfc" required="required" value="{{$proveedor->rfc}}">
                                        <span id="rfc-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Tipo persona<b>*</b></label>
                                            <select class="form-control select2" id="tipo_persona" name="tipo_persona">
                                                <option value="M" {{($proveedor->tipo_persona ==='M') ? 'selected' : ''}}> Moral </option>
                                                <option value="F" {{($proveedor->tipo_persona ==='F') ? 'selected' : ''}}> Física </option>
                                            </select>
                                        <span id="tipo-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Nombre<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_nombre" name="fisica_nombre" required="required" value="{{$proveedor->fisica_nombre}}">
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Apellido paterno<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_primer_ap" name="fisica_primer_ap" required="required" value="{{$proveedor->fisica_primer_ap}}">
                                        <span id="primer-ap-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Apellido materno<b>*</b></label>
                                        <input type="text" class="form-control" id="fisica_segundo_ap" name="fisica_segundo_ap" required="required" value="{{$proveedor->fisica_segundo_ap}}">
                                        <span id="segundo-ap-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Razón social<b>*</b></label>
                                        <input type="text" class="form-control" id="razon_social" name="razon_social" required="required"value="{{$proveedor->razon_social}}">
                                        <span id="razon-error" class="help-block"></span>
                                    </div>      

                                    <div class="form-group">
                                        <label class="control-label">Representante legal<b>*</b></label>
                                        <input type="text" class="form-control" id="representante_legal" name="representante_legal" required="required" value="{{$proveedor->representante_legal}}">
                                        <span id="representante-error" class="help-block"></span>
                                    </div>

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($proveedor->activo != 0) ? 'checked' : ''}} name="estatusProveedor" id="estatusProveedor">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_proveedor_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>