<form action="">
    <div class="row form-group mb-6">
        <div class="col-lg-6 mb-lg-0 mb-6">
            <label for="">Cantidad Mínima</label>
            <input type="number" class="form-control" placeholder="Ingrese cantidad mínima" id="cantidad_minima" name="cantidad_minima" required value="{{$contratoArtmed->cantidad_unidades_minima ?? ''}}">
        </div>
        <div class="col-lg-6 mb-lg-0 mb-6">
            <label for="">Cantidad Máxima</label>
            <input type="number" class="form-control" placeholder="Ingrese cantidad máxima" id="cantidad_maxima" name="cantidad_maxima" required value="{{$contratoArtmed->cantidad_unidades_maxima ?? ''}}">
        </div>
    </div>
    <div class="row form-group mb-6">
        <div class="col-lg-6 mb-lg-0 mb-6">
            <label for="">Monto:</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                <input type="number" class="form-control" placeholder="Ingrese el monto" id="monto_del_articulo" name="monto_del_articulo" required value="{{$contratoArtmed->monto_unitario_fijo ?? ''}}">
            </div>
        </div>
    </div>
</form>
