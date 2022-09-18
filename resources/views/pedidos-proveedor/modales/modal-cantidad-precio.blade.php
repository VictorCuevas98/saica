<!-- sample modal content -->
<div id="cantidad-precio-modal" class="modal animated bounceInDown" tabindex="-1" role="dialog"
    aria-labelledby="cantidad-precio-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 id="modalTitle" class="modal-title"></h4>
                <button id="btn-close-cantidad-precio" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form>
                @method('POST')
                @csrf
                <div class="modal-body">
                    <div class="row mb-6">
                        <div class="col-lg-12 mb-6">
                            <label id="articuloLabel"></label>
                        </div>
                    </div>
                    <div id="botonModalRow" class="row mb-6">
                        <div class="col-lg-6 mb-6">
                            <button onclick="buscaModalArtmed2()" type="button"
                            class="btn btn-primary">Buscar artículo</button>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-6 mb-6">
                            <label for="cantidadInput">Cantidad:</label>
                            <input id="cantidadInput" name="cantidadInput" type="number" class="form-control datatable-input" data-col-index="1">
                        </div>
                        <div class="col-lg-6 mb-6">
                            <label for="precioInput">Almacén:</label>
                            <select id="almacenInput" class="form-control datatable-input" name="almacen">
                                <option value="0">Seleccione un almacen</option>
                                @foreach ($almacenes as $almacen)
                                <option value="{{ $almacen->id }}">{{ $almacen->almacen}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: none;" class="col-lg-6 mb-6">
                            <label for="precioInput">Precio:</label>
                            <input id="precioInput" name="precioInput" type="text" class="form-control datatable-input" data-col-index="2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button id="add-btn" onclick="agregarArticulo()" type="button"
                        class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
