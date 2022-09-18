<div class="modal fade" id="mod_add_cabms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo CABMS:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="error_cabms_add"></div>
                <form role="form" name="frm_nuevo_cabms" id="frm_nuevo_cabms" method="POST">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave CABMS<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_cabms" name="clave_cabms" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Descripción<b>*</b></label>
                                        <textarea class="form-control" id="cabms" name="cabms" required="required"></textarea>
                                        <span id="descripcion-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label class="control-label">Partida<b>*</b></label>
                                        <select class="form-control select2" name="partida" id="partida" required="required">
                                            <option value="9999" disabled selected>Seleccione una opción</option>
                                            @foreach($partidas as $partida)
                                                <option value="{{ $partida->id }}">{{ $partida->clave_partida }} <b>-</b> {{ $partida->partida }}</option>
                                            @endforeach
                                        </select>
                                        <span id="partida-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Unidad de medida</label>
                                        <input type="text" class="form-control" id="unidad_medida" name="unidad_medida">
                                        <span id="unidad-error" class="help-block"></span>
                                    </div>                               
                                
                                    {{--<div class="col-md-12 text-right">
                                        <label class="col-4 col-form-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="estatusCabms" id="estatusCabms">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_cabms_create();">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>
