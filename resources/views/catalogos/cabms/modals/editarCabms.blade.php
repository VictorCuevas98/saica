<div class="modal fade" id="mod_edit_cabms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar CABMS:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_cabms_edit"></div>
                <form role="form" name="frm_editar_cabms" id="frm_editar_cabms" method="POST">
                    <input type="hidden" class="form-control" id="id_cabms" name="id_cabms" value="{{$cabms->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave cabms<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_cabms" name="clave_cabms" value="{{$cabms->clave_cabms}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Descripción<b>*</b></label>
                                        <textarea class="form-control" id="cabms" name="cabms" value="{{$cabms->cabms}}" required="required">{{$cabms->cabms}}</textarea>
                                        <span id="descripcion-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Partida<b>*</b></label>
                                        <select class="form-control select2" name="partida" id="partida">
                                            @foreach($partidas as $partida)
                                                <option value="{{ $partida->id }}" {{ ($cabms->id_partida == $partida->id)? "selected" : ""}} >{{ $partida->clave_partida }} <b>-</b> {{ $partida->partida }}</option>
                                            @endforeach
                                        </select>
                                        <span id="cabms-error" class="help-block"></span>
                                    </div>     

                                    <div class="form-group">
                                        <label class="control-label">Unidad de medida</label>
                                        <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" value="{{$cabms->unidad_medida}}">
                                        <span id="unidad-error" class="help-block"></span>
                                    </div> 

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($cabms->activo != 0) ? 'checked' : ''}} name="estatusCabms" id="estatusCabms">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_cabms_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>