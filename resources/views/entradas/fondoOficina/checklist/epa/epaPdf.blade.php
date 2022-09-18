<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            margin: 1cm 1cm;
            font-family: 'Times New Roman', Times, serif;
        }
        .page-break {
            page-break-after: always;
        }
         header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3.5cm;
            background-color: #fff;
            color: black;
            border: solid blue 0px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            /*line-height: 35px;*/
        }
        .pagenum:before {
            content: counter(page);
        }

        body{
            margin: 3.4cm 0cm 2.5cm;
            right: 0;
            left: 0;
            height: 10cm;
            border: solid green 0px;
        }
        main{
            display: inline-block;
        }
        table {
            border-collapse:collapse;
        }

        tr th {
            text-align: center;
            background-color: #9F2241;
            color: white;
            font-size: 11px;
        }
        .articulos{

        }
        .articulos td{
            border: 1px solid #9F2241;
            /*border-bottom: 1px solid #9F2241 ;*/
        }
        
        .total-container {            
            
            width: 8cm;
            float: right;
            margin-right: 2px;
        }
        table.total{
            
        }
        table.total tr td {
            background-color: #9F2241;
            color: #fff;
            text-align: right;

        }

        p{
            color: black;
            font-size: 15px;
        }
        .text-right{
            text-align: right;
        }
        .mt{
            margin-top: 7px;
        }

        .column-header-left {
            float: left;
            width: 60%;
        }

        .column-header-right {
            float: left;
            width: 40%;
        }

        .logo {
            /*width: 80%;*/
            max-height: 2cm;
            height: 2cm;
        }

        .text-header {
            color: black;
            font-size: 13px;
        }

        .text-asunto {
            color: gray;
            font-size: 15px;
        }

        .text-proveedor {
            color: black;
            font-size: 12px;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .small-cell{
            text-align: center;
            font-size: 13px;
        }

        .mid-cell{
            text-align: center;
            font-size: 15px;
        }
        .big-cell{
            text-align: center;
            font-size: 17px;
        }
        .firma{
            align-items: flex-end;
            width: auto;
            height: 2.5cm;
            background-repeat: no-repeat;
            background-size: contain;
            bottom: 0px;
            position: fixed;
        }
        .firma-left{
            float: left;
            height: auto;
            border: solid black 1px;
            width: 33.2%;
        }
        .firma-center{
            float: left;
            height: auto;
            border: solid black 1px;
            width: 33.2%;
        }
        .firma-right{
            float: left;
            height: auto;
            border: solid black 1px;
            width: 33.2%;
        }
        .firma-column-header{
            text-align: center;
            font-size: 11px;
             height: 0.5cm;
        }
        .firma-column-area{
            border-top: solid black 1px;
            height: 2cm;
        }
        

       

    </style>
</head>


<body>
    <header>
        <div class="column-header-left ">
            <img class="logo" src="{{ asset('media/logos/logo-sedesa.png') }}" >
            <div><b>Entrada por contrato abierto en {{$entrada->almacen->almacen}}</b></div>
            {{-- BEGIN:DATOS DEL PROVEEDOR --}}
            <div class="row text-proveedor mt">
                @if($adquisicion->proveedor->tipo_persona=='F')
                <div>
                    <strong>PROVEEDOR:</strong> {{$adquisicion->proveedor->fisica_nombre}} {{$adquisicion->proveedor->fisica_primer_ap}} {{$adquisicion->proveedor->fisica_segundo_ap}}
                </div>
                @else
                <div>
                    <strong>PROVEEDOR:</strong> {{$adquisicion->proveedor->razon_social}}
                </div>
                @endif
                <div>
                    <strong>R.F.C.:</strong> {{$adquisicion->proveedor->rfc}}
                </div>
            </div>
            {{-- END:DATOS DEL PROVEEDOR --}}

        </div>
        <div class="column-header-right">
            <div>FOLIO: <strong>{{$entrada->folio_entrada}}</strong> </div>
            <div>CONTRATO: <strong>{{$adquisicion->contratos->first()->num_contrato}}</strong></div>
            <div>FECHA DE RECEPCIÓN: <strong>{{ Carbon::parse($entrada->fecha_entrada)->format('d/m/Y') }}</strong></div>
            <div>{{$adquisicion->docsPago->first()->tipoDocPago->tipo_doc_pago}}: <strong>{{$adquisicion->docsPago->first()->num_doc_pago}}</strong></div>
            
        </div>
       
    </header>
    <footer>
        <div class="row mt firma">
            
                <div class="firma-left">
                    <div class="firma-column-header">Recibió:</div> 
                    <div class="firma-column-area"></div>
                </div>
                <div class="firma-center">
                    <div class="firma-column-header">Responsable de área:</div> 
                    <div class="firma-column-area"></div>
                </div>
                <div class="firma-right">
                    <div class="firma-column-header">Autorizó:</div> 
                    <div class="firma-column-area"></div>
                </div>
            
        </div>
        
    </footer>
    <main>
         {{-- BEGIN:ARTICULOS --}}
         <div class="row">
        <table class="mt articulos" width="100%">
            <tr>
                <th>#</th>
                <th>PART.</th>
                <th>CLAVE</th>
                <th>DESCRIPCIÓN</th>
                <th>CADUCIDAD</th>
                <th>LOTE</th>
                <th>OBS</th>
                <th>U. MEDIDA</th>
                <th>CANT.</th>
                <th>PU</th>
                <th>IVA</th>
                <th>SUBTOTAL</th>
                <th>TOTAL</th>
                
            </tr>
            <tbody>
                @php
                    $subTotal = 0;
                    $totalIva = 0;
                    $total = 0;
                @endphp
                @foreach($entrada->entradaAdquisicion->entradasAdquisicionDetalle()->activos()->get() as $articuloKey => $articuloValue)
                @php
                    $subTotal += $articuloValue->monto_subtotal;
                    $totalIva += $articuloValue->monto_impuesto;
                    $total += $articuloValue->monto_total;
                @endphp
                <tr>
                    <td class="big-cell">{{$articuloKey+1}}</td>
                    <td class="mid-cell">{{$articuloValue->artmed->cabms->partidaEspecifica->clave_partida}}</td>
                    <td class="small-cell">{{$articuloValue->artmed->clave_artmed}}</td>
                    <td class="small-cell">{{ Str::limit($articuloValue->artmed->artmed, $limit = 100, $end = '...') }}</td>
                    <td class="mid-cell">{{ Carbon::parse($articuloValue->fecha_caducidad)->format('d/m/Y')}}</td>
                    <td class="small-cell">{{$articuloValue->num_lote}}</td>
                    <td class="small-cell">s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was pop</td>
                    <td class="small-cell">{{$articuloValue->artmed->unidad_medida}}</td>
                    <td class="small-cell">{{number_format($articuloValue->cantidad_unidades, 0, '.', ',') }}</td>
                    <td class="small-cell">{{number_format($articuloValue->monto_unitario, 2, '.', ',') }}</td>
                    <td class="small-cell">{{number_format($articuloValue->monto_impuesto, 2, '.', ',') }}</td>
                    <td class="small-cell">{{ number_format($articuloValue->monto_subtotal, 2, '.', ',')}}</td>
                    <td class="small-cell">{{number_format($articuloValue->monto_total, 2, '.', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
            <!--<tfoot>
                <tr>
                    <th colspan="13" class="text-right">&nbsp;</th>
                </tr>
            </tfoot>-->
        </table>
        {{-- END:ARTICULOS --}}
        </div>
        <div class="total-container">
            <table class="text-right total" >           
                <tbody>
                    <tr>
                        <td style="width: 3cm; ">SUBTOTAL</td>
                        <td style="width: 5cm;" class="text-right"><strong>{{ number_format($subTotal, 2, '.', ',')}}</strong></td>
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td><strong>{{number_format($totalIva, 2, '.', ',')}}</strong></td>
                    </tr>
                    <tr>
                        <td >TOTAL</td>
                        <td><strong>{{number_format($total, 2, '.', ',')}}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </main>
    
   

    

    <script type="text/php">
    if (isset($pdf)) {
        $x = 670;
        $y = 590;
        
        $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
    

</body>

</html>
