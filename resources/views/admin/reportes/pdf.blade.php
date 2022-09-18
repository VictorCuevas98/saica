<html>
   <head>
     <style>
       .titulo{
         color: gray;
         text-align: center;
         font-family: 'PT Sans';
       }

       .text{
         color: gray;
         text-align: right;
         font-family: 'PT Sans';
         font-size: 12px;
       }

       .subtitulo{
         color: gray;
         text-align: left;
         font-family: 'PT Sans';
         font-size: 14px;
       }

       table, td, th {
         border: 1px solid black;
       }
       table {
         border-collapse: collapse;
         width: 100%;
       }
       th {
         height: 50px;
         font-size: 14px;
       }
       td {
         text-align: center;
         color:#007f2d;
       }

     </style>
   </head>
   <body>
     <div align="center">
       <img src="{{ public_path().'/media/logos/logo_saf.png' }}" style="width:90%">
     </div><br>
     <div style="background:#00b140; height:5px"></div><br>
     <div class="titulo">
       INFORME DEL PROGRAMA DE REACTIVACIÓN ECONÓMICA Y PRODUCCIÓN DE VIVIENDA INCLUYENTE, POPULAR, SOCIAL Y DE TRABAJADORES EN LA CIUDAD DE MÉXICO
     </div><br><br>
     <div class="subtitulo">
       USUARIOS REGISTRADOS
     </div><br>

     <table>
      <tr>
        <th rowspan="2" style="background-color:#EEE">Total de Usuarios Registrados</th>
        <th colspan="2">Representante legal</th>
        <th rowspan="2">DRO <br>(Director General de Obra)</th>
        <th rowspan="2">PDU <br>(Perito en Desarrollo Urbano)</th>
        <th rowspan="2">PSA <br>(Prestadora de Servicios Ambientales)</th>
        <th rowspan="2">TA <br>(Persona Tercera Acreditada)</th>
        <th rowspan="2">CRI <br>(Corresponsables en instalaciones)</th>
        <th rowspan="2">CRS <br>(Corresponsables en Seguridad Estructural)</th>
        <th rowspan="2">CRD <br>(Corresponsables en Diseño Urbano y Arquitectónico)</th>
      </tr>
      <tr>
        <th>Física</th>
        <th>Moral</th>
      </tr>
      <tr>
        <td style="color:red">{{ $total_usuarios }}</td>
        <td>{{ $total_rep_fisica }}</td>
        <td>{{ $total_rep_moral }}</td>
        <td>{{ $total_dro }}</td>
        <td>{{ $total_pdu }}</td>
        <td>{{ $total_psa }}</td>
        <td>{{ $total_ta }}</td>
        <td>{{ $total_cri }}</td>
        <td>{{ $total_crs }}</td>
        <td>{{ $total_crd }}</td>
      </tr>
    </table><br><br>

    <div class="subtitulo">
      REGISTRO POR PROGRAMA O NORMA DE APLICACIÓN
    </div><br>

    <table>
     <tr>
       <th>Tipo de proyecto</th>
       <th>Total, de proyectos</th>
       <th>%</th>
     </tr>
     <tr>
       <td style="color: #5f5f5f;">Programa Especial de Regeneración Urbana y Vivienda Incluyente (PRUVI)</td>
       <td>{{ $total_pruvi }}</td>
       <td>{{ $porcentaje_pruvi }}%</td>
     </tr>
     <tr>
       <td style="color: #5f5f5f;">Norma para Impulsar y Facilitar la Construcción de Vivienda para los Trabajadores Derechohabientes de los Organismos Nacionales de Vivienda en Suelo Urbano</td>
       <td>{{ $total_norma }}</td>
       <td>{{ $porcentaje_norma }}%</td>
     </tr>
     <tr>
       <td style="color: #5f5f5f;">La Norma de Ordenación Número 26</td>
       <td>{{ $total_norma26 }}</td>
       <td>{{ $porcentaje_norma26 }}%</td>
     </tr>
    </table>

    <div style="page-break-after:always;"></div>

    <div class="subtitulo">
      LISTADO DE PERSONAS REGISTRADAS
    </div><br>

    <table>
     <tr>
       <th>Núm.</th>
       <th>Nombre o Razón Social</th>
       <th>RFC</th>
       <th>Total de proyectos</th>
       <th>%</th>
     </tr>
     @php $i=1; @endphp
     @foreach($personas_registradas as $personas)
     <tr>
       <td style="color: #5f5f5f;">{{ $i }}</td>
       <td style="color: #5f5f5f;">
         @if($personas->tipo_persona=='F')
          {{ mb_strtoupper($personas->nombre) }} {{ mb_strtoupper($personas->primer_ap) }} {{ mb_strtoupper($personas->segundo_ap) }}
        @else
          {{ mb_strtoupper($personas->razon_social) }}
        @endif
       </td>
       <td style="color: #5f5f5f;">{{ $personas->rfc }}</td>
       <td>{{ $array_proyectos[$personas->id] }}</td>
       <td>{{ $array_proyectos_porcentaje[$personas->id] }}%</td>
     </tr>

     @php $i=$i+1; @endphp
     @endforeach
   </table><br><br>

   <div class="subtitulo">
     ESTATUS DE LOS PROYECTOS REGISTRADOS
   </div><br>

   <table>
    <tr>
      <th>Núm.</th>
      <th>Nombre de proyecto</th>
      <th>Estatus</th>
      <th>CUZUS</th>
      <th>SEDUVI</th>
      <th>SEDEMA</th>
      <th>SAF</th>
      <th>SACMEX</th>
      <th>SERVIMET</th>
    </tr>
    @php $num=1; @endphp
    @foreach($desc_proyectos as $pro)
    <tr>
      <td style="color: #5f5f5f;">{{ $num }}</td>
      <td style="color: #5f5f5f;">{{ mb_strtoupper($pro->nombre_proyecto) }}</td>
      <td style="color: #af601a;">{{ $array_estatus[$pro->id] }}</td>
      <td>{{ $pro->folio_cuzus }}</td>
      <td>{{ $array_actividades[$pro->id]['seduvi'] }} actividades</td>
      <td>{{ $array_actividades[$pro->id]['sedema'] }} actividades</td>
      <td>{{ $array_actividades[$pro->id]['saf'] }} actividades</td>
      <td>{{ $array_actividades[$pro->id]['sacmex'] }} actividades</td>
      <td>{{ $array_actividades[$pro->id]['servimet'] }} actividades</td>
    </tr>
    @php $num=$num+1; @endphp
    @endforeach
   </table>

   <div style="page-break-after:always;"></div>

   <div class="subtitulo">
     PROYECTOS POR ALCALDÍA
   </div><br>
   <table>
    <tr>
      <th>Núm.</th>
      <th>Alcaldía</th>
      <th>Total de Proyectos</th>
      <th>%</th>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">1</td>
      <td style="color: #5f5f5f;">Álvaro Obregón</td>
      <td>{{ $array_proyectos_alcaldia['ao'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['ao'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">2</td>
      <td style="color: #5f5f5f;">Azcapotzalco</td>
      <td>{{ $array_proyectos_alcaldia['azcapo'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['azcapo'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">3</td>
      <td style="color: #5f5f5f;">Benito Juárez</td>
      <td>{{ $array_proyectos_alcaldia['bj'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['bj'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">4</td>
      <td style="color: #5f5f5f;">Coyoacán</td>
      <td>{{ $array_proyectos_alcaldia['coy'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['coy'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">5</td>
      <td style="color: #5f5f5f;">Cuajimalpa de Morelos</td>
      <td>{{ $array_proyectos_alcaldia['cdm'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['cdm'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">6</td>
      <td style="color: #5f5f5f;">Cuauhtémoc</td>
      <td>{{ $array_proyectos_alcaldia['cua'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['cua'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">7</td>
      <td style="color: #5f5f5f;">Gustavo A. Madero</td>
      <td>{{ $array_proyectos_alcaldia['gam'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['gam'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">8</td>
      <td style="color: #5f5f5f;">Iztacalco</td>
      <td>{{ $array_proyectos_alcaldia['iztac'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['iztac'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">9</td>
      <td style="color: #5f5f5f;">Iztapalapa</td>
      <td>{{ $array_proyectos_alcaldia['iztapa'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['iztapa'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">10</td>
      <td style="color: #5f5f5f;">La Magdalena Contreras</td>
      <td>{{ $array_proyectos_alcaldia['lmc'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['lmc'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">11</td>
      <td style="color: #5f5f5f;">Miguel Hidalgo</td>
      <td>{{ $array_proyectos_alcaldia['mh'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['mh'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">12</td>
      <td style="color: #5f5f5f;">Milpa Alta</td>
      <td>{{ $array_proyectos_alcaldia['ma'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['ma'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">13</td>
      <td style="color: #5f5f5f;">Tláhuac</td>
      <td>{{ $array_proyectos_alcaldia['tlah'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['tlah'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">14</td>
      <td style="color: #5f5f5f;">Tlalpan</td>
      <td>{{ $array_proyectos_alcaldia['tlal'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['tlal'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">15</td>
      <td style="color: #5f5f5f;">Venustiano Carranza</td>
      <td>{{ $array_proyectos_alcaldia['vc'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['vc'] }}%</td>
    </tr>
    <tr>
      <td style="color: #5f5f5f;">16</td>
      <td style="color: #5f5f5f;">Xochimilco</td>
      <td>{{ $array_proyectos_alcaldia['xochi'] }}</td>
      <td>{{ $array_proyectos_alcaldia_porcentaje['xochi'] }}%</td>
    </tr>

  </table><br><br>

    <div class="text">
      Informe con corte al: {{date('d')}} de {{trans(mes(date('n')))}} de {{date('Y')}} a las {{date('H:s:i')}}
    </div><br>

   </body>
</html>
