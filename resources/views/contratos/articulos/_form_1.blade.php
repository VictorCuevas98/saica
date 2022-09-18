<form action="">
    <div class="row form-group mb-6 mx-auto">
        <div class="col-lg-6 mb-lg-0 mb-6">
            <label for="">Cantidad:</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                <input type="number" class="form-control" placeholder="Ingrese la cantidad" id="cantidad_de_articulos" name="cantidad_de_articulos" required="true"
                       value="{{$contratoArtmed->cantidad_unidades ?? ''}}">
            </div>
        </div>
        <div class="col-lg-6 mb-lg-0 mb-6">
            <label for="">Monto:</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                <input type="number" class="form-control" placeholder="Ingrese el monto" id="precio_del_articulo" name="precio_del_articulo" required="true"
                       value="{{$contratoArtmed->monto_unitario ?? ''}}">
            </div>
        </div>
    </div>
    @include('contratos.articulos._form_periodo_parcial_de_entregas')
</form>
