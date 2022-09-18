<div class="modal fade" id="mod_edit_pregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar pregunta revisión entrada:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_pregunta_edit"></div>
                <form role="form" name="frm_editar_pregunta" id="frm_editar_pregunta" method="POST">
                    <input type="hidden" class="form-control" id="id_pregunta" name="id_pregunta" value="{{$preguntasRevision->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave pregunta<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_pregunta" name="clave_pregunta" required="required" value="{{$preguntasRevision->clave_pregunta}}">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Pregunta<b>*</b></label>
                                        <textarea class="form-control" id="pregunta" name="pregunta" required="required" value="{{$preguntasRevision->pregunta}}">{{$preguntasRevision->pregunta}}</textarea>
                                        <span id="pregunta-error" class="help-block"></span>
                                    </div>                                    
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Tipo revisión<b>*</b></label>
                                        <select class="form-control select2" name="tipo_revision" id="tipo_revision">
                                            @foreach($tipoRevision as $tipo)
                                                <option value="{{ $tipo->id }}" {{ ($preguntasRevision->id_tipo_revision == $tipo->id)? "selected" : ""}} >{{ $tipo->tipo_revision }}</option>
                                            @endforeach
                                        </select>
                                        <span id="tipo-error" class="help-block"></span>
                                    </div>

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($preguntasRevision->activo != 0) ? 'checked' : ''}} name="estatusPregunta" id="estatusPregunta">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_pregunta_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>