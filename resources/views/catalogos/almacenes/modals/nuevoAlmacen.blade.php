<div class="modal fade" id="mod_add_almacen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo almacen:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($errors->any())
                 <div class="alert alert-danger fade show" role="alert" id="alert">
                    <div class="alert-text">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="modal-body" id="modal_content">
                <div id="error_almacen_add"></div>
                <form role="form" name="frm_nuevo_almacen" id="frm_nuevo_almacen" method="POST">
                    @csrf
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Clave almacen<b>*</b></label>
                                        <input type="text" class="form-control" id="clave_almacen" name="clave_almacen" required="required">
                                        <span id="clave-error" class="help-block"></span>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="control-label">Nombre almacen<b>*</b></label>
                                        <textarea class="form-control" id="almacen" name="almacen" required="required"></textarea>
                                        <span id="nombre-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Calle<b>*</b></label>
                                        <input type="text" class="form-control" id="domi_calle" name="domi_calle" required="required">
                                        <span id="calle-error" class="help-block"></span>
                                    </div>

                                </div>

                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <label class="control-label">Número exterior</label>
                                        <input type="text" class="form-control" id="domi_num_ext" name="domi_num_ext">
                                        <span id="interior-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Número interior</label>
                                        <input type="text" class="form-control" id="domi_num_int" name="domi_num_int">
                                        <span id="exterior-error" class="help-block"></span>
                                    </div>

                                    <div class="input-group mb-3">  
                                      <input type="text" class="form-control" id="cp" name="cp" placeholder="Buscar código postal" aria-label="Buscar código postal" aria-describedby="basic-addon2">
                                      <div class="input-group-append">
                                        <a class="btn btn-outline-secondary" href="javascript:void(0)" role="button" id="buscar" onclick="buscarColonia();">Buscar</a>
                                      </div>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="asentamiento">Colonia<b>*</b></label>
                                        <select id="asentamiento" name="asentamiento" class="form-control select2" required="required">
                                          <option disabled selected>Seleccione una opción</option>
                                        </select>
                                        <span id="asentamiento-error" class="help-block"></span>
                                    </div>                        
                                
                                    {{--<div class="col-md-12 text-right">
                                        <label class="col-4 col-form-label">Habilitado</label>
                                        <div class="form-group">
                                            <span class="kt-switch kt-switch--icon">
                                                <label>
                                                    <input type="checkbox" checked="checked" name="estatusAlmacen" id="estatusAlmacen">
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
                <button type="button" class="btn btn-primary" id="usr_js_fn_04" onclick="save_almacen_create();">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>