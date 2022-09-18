<div class="modal fade" id="mod_edit_partida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar partida especifica:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_partida_edit"></div>
                <form role="form" name="frm_editar_partida" id="frm_editar_partida" method="POST">
                    <input type="hidden" class="form-control" id="id_partida" name="id_partida" value="{{$partida->id}}">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave partida<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_partida" name="clave_partida" value="{{$partida->clave_partida}}" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Descripción<b>*</b></label>
                                        <textarea class="form-control" id="partida" name="partida" value="{{$partida->partida}}" required="required">{{$partida->partida}}</textarea>
                                        <span id="descripcion-error" class="help-block"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Elemento<b>*</b></label>
                                        <select class="form-control select2" name="elemento" id="elemento">
                                            @foreach($elementos as $elemento)
                                                <option value="{{ $elemento->id }}" {{ ($partida->id_elemento_cog == $elemento->id)? "selected" : ""}} >{{ $elemento->clave_elemento_cog }} <b>-</b> {{ $elemento->elemento_cog }}</option>
                                            @endforeach
                                        </select>
                                        <span id="cabms-error" class="help-block"></span>
                                    </div>     

                                    <div class="text-right">
                                        <label class="control-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox"  {{ ($partida->activo != 0) ? 'checked' : ''}} name="estatusPartida" id="estatusPartida">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_05" onclick="save_partida_update();">
                
                    Editar
                </button>

            </div>
        </div>
    </div>
</div>