<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            font-family: 'Times New Roman', Times, serif;
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

        td{
            border: 1px solid #9F2241;
        }

        p{
            color: black;
            font-size: 15px;
        }

        .mt{
            margin-top: 7px;
        }

        .column-header-left {
            float: left;
            width: 40%;
        }

        .column-header-right {
            float: left;
            width: 60%;
        }

        .logo {
            width: 80%;
            max-height: 8cm;
            height: auto;
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
            font-size: 15px;
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
            height: 4cm;
            background-repeat: no-repeat;
            background-size: contain;
            background-image: url('images/firma-pedido.jpg');   
        }

    </style>
</head>

<body>
    {{-- BEGIN:HEADER --}}
    <div class="row text-header mt">
        <div class="column-header-left">
            <img class="logo" src="{{ asset('media/logos/logo-sedesa.png') }}">
        </div>
        <div class="column-header-rigth">
            SECRETRIA DE SALUD DE LA CIUDAD DE MEXICO
            <br>
            DIRECCIÓN GENERAL DE ADMINISTRACIÓN Y FINANZAS
            <br>
            DIRECCIÓN DE RECURSOS MATERIALES, ABARTECIMIENTOS Y SERVICIOS
            <br>
            SUBDIRECCIÓN DE ABASTECIMIENTOS
            <br>
        </div>
    </div>
    {{-- END:HEADER --}}

    {{-- BEGIN:DATOS DE ASUNTO --}}
    <div class="row text-asunto mt">
        <div style="text-align: right">
            Ciudad de México, a 23 de marzo de 2021
            <br>
            Pedido {{ $pedido->folio_pedido }}
            <br>
            Asunto: Solicitud de Medicamentos Controlados
            <br>
        </div>
    </div>
    {{-- END:DATOS DE ASUNTO --}}

    {{-- BEGIN:DATOS DEL PROVEEDOR --}}
    <div class="row text-proveedor mt">
        {{ $proveedor->dataLegal->data->nombre }} {{ $proveedor->dataLegal->data->paterno }} {{ $proveedor->dataLegal->data->materno }}
        <br>
        REPRESENTANTE LEGAL
        <br>
        {{ $contrato->adquisicion->proveedor->razon_social }}
        <br>
        @if (count($direccionProv->data->dataFiscal) > 0)
            {{ $direccionProv->data->dataFiscal[0]->calle }} #{{ $direccionProv->data->dataFiscal[0]->num_ext }} - {{ $direccionProv->data->dataFiscal[0]->num_int }}
            COL. {{ $direccionProv->data->dataFiscal[0]->colonia }}
            <br>
            ALCALDIA {{ $direccionProv->data->dataFiscal[0]->municipio }} CP {{ $direccionProv->data->dataFiscal[0]->cp }}, {{ $direccionProv->data->dataFiscal[0]->estado }}
            <br>
        @endif
        PRESENTE
    </div>
    {{-- END:DATOS DEL PROVEEDOR --}}
    
    <div class="row mt">
        <p>Hago referencia al contrato {{ $contrato->num_contrato }}, para la Adquisición de Medicinas y
             Productos Farmacéutiso (Medicamento controlado),celebrado entre su representado y esta Dependencia</p>
        <p>Sobre el particular, sele notifica la solicitud de medicamento controlado que deberá entregar
             a más tardar el dia {{ $pedido->fecha_entrega }}, cuyas claves, cantidades requerias y sitios
              de entrega señalan a constinuacion:</p>
    </div>

    {{-- BEGIN:ARTICULOS --}}
    <table class="mt">
        <tr>
            <th>CNS</th>
            <th>CLAVE <br> S.A.I.C.A.</th>
            <th>DESCRIPCIÓN</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>CANTIDAD SOLICITADA</th>
            <th>SITIOS DE ENTREGA</th>
        </tr>
        @php
        $counter = 0;
        @endphp
        @foreach ($pedido->detalles as $detalle)
        @php
            $currentArt = App\CatArtmed::where('id','=',$detalle->id_artmed)->first();
            $currentAlmacen = App\CatAlmacen::where('id','=',$detalle->id_almacen)->first();
            $counter++;
        @endphp
        <tr>
            <td class="big-cell">1</td>
            <td class="mid-cell">{{ $currentArt->clave_artmed }}</td>
            <td class="small-cell">{{ $currentArt->artmed }}</td>
            <td class="mid-cell">{{ $currentArt->unidad_medida }}</td>
            <td class="big-cell">{{ $detalle->cantidad_unidades }}</td>
            <td class="mid-cell">{{ $currentAlmacen->almacen }}</td>
        </tr>
        @endforeach
    </table>
    {{-- END:ARTICULOS --}}

    <div class="row mt">
        <p>Asimismo, la entrega del citado medicamento deberá efectuarse en la unidad hospitalaria, con la documentación que a continuación se detalla</p>
        <ul>
            <li>FACTURA EN ORIGINAL Y CUATRO COPIAS CON LOS DATOSO FISCALES "GOBIERNO DE LA CIUDAD DE MEXICO/SECRETARIA DE SALUD, PLAZA DE LA CONSTITUCIÓN S/N CENTRO DE LA CIUDAD DE MÉXICO ÁREA 1, C.P. 06000, ALCALDÍA CUAUHTÉMOC, RFC GDF9712054NA"</li>
            <li>CUATRO COPIAS DEL PEDIDO REFERIDO DEBIDAMENTE FIRMADO POR SU REPRESENTANTE.</li>
            <li>PRESENTAR COPIA SIMPLE (POR ANVERSO Y REVERSO) DEL REGISTRO SANITARIO VIGENTE DE CADA INSUMO ENTREGADO Y/O LA SOLICITUD DE PRORROGA, ASI COMO COPIA SIMPLE DE LA LICENCIA SANITARIA Y DEL RESPONSABLE SANITARIO DE CADA PROVEEDOR</li>
            <li>UN CERTIFICADO ANALÍTICO POR LOTE</li>
            <li>UNA CARTA DE CANJE</li>
            <li>UNA CARTA DE VICIOS OCULTOS</li>
        </ul>
        <P>Los insumos deberan ser entrehgados en un horario de 9:00 a 14:00hrs de lunes a viernes y deben venir etiquetados en envase secundario detallando; número de contrato, nombre del proveedor,
            clave SAICA, descripción, lote y caducidad siendo esta no menor a doce meses.
        </P>
        <p>Es importante señalar, que en caso de que exista desabasto en alguno de los insumos adjudicados, deberá presentar ORIGINAL de 
            carta de "No producción" emitida por la empresa fabricante de cada uno de los mismos,
            justificando la imposibilidad de surtimiento por parte de su representada.
        </p>
        <p>Sin otro particular, reciba un cordial saludo.</p>
    </div>

    <div class="row mt">
        <div class="column">
            ATENTAMENTE
            <br>
            EL SUBDIRECTOR
            <br>
            <br><br><br><br>
            CP.FÉLIX REYES ELVIRA
        </div>
        <div class="column" >
            <div class="firma"></div>
        </div>
    </div>
</body>

</html>
