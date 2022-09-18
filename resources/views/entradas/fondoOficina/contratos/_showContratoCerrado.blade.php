<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>articulo</td>
            <td>Clave</td>
            <td>partida</td>
            <td>cantidad unidades</td>
            <td>monto unitario</td>
            <td>monto subtotal</td>
            <td>monto impuesto</td>
            <td>monto total</td>
        </tr>
    </thead>
    <tbody>
        
        @foreach($contrato->contratosCerrados as $contratoCerrado)
            @foreach($contratoCerrado->contratosCerradosDetalle as $articulo)
            <tr>
                <td>{{$articulo->artmed->artmed}}</td>
                <td>{{$articulo->artmed->clave_artmed}}</td>
                <td>{{$articulo->partida}}</td>
                <td>{{$articulo->cantidad_unidades}}</td>
                <td>{{$articulo->monto_unitario}}</td>
                <td>{{$articulo->monto_subtotal}}</td>
                <td>{{$articulo->monto_impuesto}}</td>
                <td>{{$articulo->monto_total}}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>