<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>articulo</td>
            <td>Clave</td>
            <td>monto unitario fijo</td>
            <td>cantidad de unidades minima</td>
            <td>cantidad de unidades maxima</td>
        </tr>
    </thead>
    <tbody>
        @foreach($contrato->contratoAbierto->articulosContratoAbierto as $articulo)
        <tr>
            <td>{{$articulo->artmed->artmed}}</td>
            <td>{{$articulo->artmed->clave_artmed}}</td>
            <td>{{$articulo->monto_unitario_fijo}}</td>
            <td>{{$articulo->cantidad_unidades_minima}}</td>
            <td>{{$articulo->cantidad_unidades_maxima}}</td>
        </tr>
        @endforeach
    </tbody>
</table>