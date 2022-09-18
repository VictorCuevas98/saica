
<div id="editar_articulo_modal" class="modal animated bounceInRight " tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="modal-title">Editar Artículo</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  id="formedit" name="formedit">
                @csrf 
                @method('POST')
                  <input type="text" class="form-control" id="id1" name="id1" value="">
                    @csrf 
              
                <div class="modal-body">

                    <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">Clavé</label>
                    <div class="col-sm-6">
                        <input id="clave1" type="text" readonly class="form-control" name="clave1" value="" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> 
                 <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label text-md-right">Cantidad Solisitada</label>
                    <div class="col-sm-6">
                        <input id="Cantidad1" type="number" class="form-control" name="Cantidad1" value="" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                   
                    
                </div>
                
            </form>
            <div class="modal-footer">
                     
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button id="btneditar" type="button" class="btn btn-success " onclick="updateDataAjax();">Guardar</button>
                
                </div>
        </div>
    </div>
</div>
