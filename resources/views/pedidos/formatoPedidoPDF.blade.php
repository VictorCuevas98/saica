<!DOCTYPE html>
<html>
<head>
<style>
	@page {
        font-family:  Liberation Mono, sans-serif;
        font-size: 9pt; 
        margin: 0cm 1cm 2cm;
    }
    .tablaFolio{
        margin-bottom: 20px;
    }
    .tablaFolio table .datos{
        font-size: 8pt;
    }
    .tablaArticulos{
        font-family:  Arial Narrow, sans-serif;
        margin-top: 40px;  
        font-size: 8pt;
        position: relative;
        top: 130px;
        border:solid black 1.5px;

    }
    .tablaArticulos th{
        background: #D98880;
        padding: 0.5em;
        height: 40px;
        border:solid black 1.5px;
    }
    .tablaArticulos td{
        border:solid black 1.5px;
    }
    h2{
        font-family:  Arial Narrow, sans-serif;
        display:inline;
        font-style: normal;
    }
    p{
        display:inline;
    }
	img{
		width: 40%; 
		height: auto;
	}    
    .tablaDestino{
        font-weight: bold;
        border-spacing: 0;
        border-collapse: collapse;
        border-style: hidden;
        width:100%;
        max-width: 100%;
        table-layout: fixed;
    }
    .tablaDestino td, .tablaDestino th{
        border-left: solid black 1.5px;
        border-right: solid black 1.5px;
    }
    .tablaDestino td{
        height: 25px;
    }
    .tablaDestino tr{
        font-family: Arial Narrow, sans-serif;
        font-size: 7pt;
    }
    .tablaDestino th{
        padding: 0.5em;
        background:#CEB37D;
        border-bottom: solid black 1.5px; 
        font-size: 8pt;
        border:solid black 1.5px;
    }
    .tablaBorde{
        border:solid black 1.5px;
        border-collapse: collapse;
        width: 100%;
        overflow:hidden;
        position: relative;
        top: 150px;
    }
    .principal{
        position: relative; 
        top: 95px;
    }
    .div1{
        float:right; 
        border:solid black 1.2px;
        width:25%;
        background:#D98880;
        height:20px;
        vertical-align: middle;
        line-height: 18px;
        text-align: center;
    }
    .div2{
        float:left; 
        border-left: solid black 1.2px;
        border-bottom: solid black 1.2px;
        border-top: solid black 1.2px;
        width:25%;
        height:20px;
        line-height: 18px;
        text-align: center;
    }
    .div3{
        float:left; 
        border-left: solid black 1.2px;
        border-right: solid black 1.2px;
        border-top: solid black 1.2px;
        border-bottom: solid black 1.2px;
        width:15%;
        height:20px;
        line-height: 18px;
        text-align: center;
    }
    .footer{ 
        position: fixed; 
        left: 0px; 
        bottom: -100px; 
        right: 0px; 
        height: 100px; 
        font-size: 8pt;
        font-family: sans-serif;
        text-align: center;
    }
    .footer .page:after{ 
        content: counter(page);
    } 
    header{ 
        position: fixed;
        left: 0px;
        right: 0px;
        height: 50px;
    }  
</style>
<title></title>
</head>
<body>
	<header>
        <table width="100%" class="tablaFolio">
            <tr>
                <td width="65%" align="center"><img src="{{ public_path().'/media/logos/LOGO-GOB-N-L.png' }}" alt=""> </td>
                <td width="100%"  align="justify" style="padding-right:0">
                    <table width="100%">
                        <tr>
                            <td height="10" width="30" align="justify" class="datos"><h2></h2><h2></h2></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</header>
		<div class="footer">
           <p class="page">Página </p>
        </div>
                 
        <div class="principal">
            <div class="div1">
               <p>PEDIDO: </p><b>H.G.D.R.L./MED021/2021</b>
            </div>

            <div class="div2">
               <p>FECHA DE ENVIO DE SOLICITUD: </p>
            </div>
            <div class="div3">
               <p>{{ implode('/', array_reverse(preg_split('/\D/', date('Y-m-d')))) }}</p>
            </div>           
        </div>    

        <div class="tablaBorde">
            <table width="100%" class="tablaDestino">
                <thead>
                      <tr>
                        <th>AUTORIZA</th>
                        <th>AUTORIZA</th>
                        <th>SOLICITA</th>
                        <th>RECIBE</th>
                      </tr>
                      <tr>
                        <td>NOMBRE: DRA. MARÍA DE JESUS HERVER CABRERA</td>
                        <td>NOMBRE: ARQ. ADRIANA COSSETTE FABREGAT REVILLA</td>
                        <td>NOMBRE: C. RAYMUNDO BARAJAS SORIANA</td>
                        <td>NOMBRE: ________________________________</td>
                      </tr>
                      <tr>
                        <td>CARGO: DIRECTORA DEL HOSPITAL GENERAL DR. RUBÉN LEÑERO</td>
                        <td>CARGO: SUBDIRECTORA DE ENLACE ADMINISTRATIVO</td>
                        <td>CARGO: JEFE DE FARMACIA</td>
                        <td>CARGO: _________________________________</td>
                      </tr>
                      <tr>
                        <td>FECHA Y HORA: {{ implode('/', array_reverse(preg_split('/\D/', date('Y-m-d')))) }}</td>
                        <td>FECHA Y HORA: {{ implode('/', array_reverse(preg_split('/\D/', date('Y-m-d')))) }}</td>
                        <td>FECHA Y HORA: {{ implode('/', array_reverse(preg_split('/\D/', date('Y-m-d')))) }}</td>
                        <td>FECHA: __________________________________</td>
                      </tr>
                      <tr>
                        <td>FIRMA: </td>
                        <td>FIRMA: </td>
                        <td>FIRMA: </td>
                        <td>FIRMA: __________________________________</td>
                      </tr>
                </thead>
            </table>  
        </div>              
       
    <table width="100%" class="tablaArticulos" cellspacing="0" cellpadding="0">
        <thead>            
            <tr>
                <th> # </th>
                <th> P.P. </th>
                <th> CLAVE </th>
                <th> DESCRIPCIÓN </th>
                <th> U. MEDIDA </th>         
                <th> CANTIDAD SOLICITADA</th>
                <th> CANTIDAD AUTORIZADA</th>
                <th> CANTIDAD SURTIDA</th>
                <th> OBSERVACIONES</th>
            </tr>
        </thead>
        <tbody>           
            <tr>
                <td align="center">1</td>
                <td align="center">6</td>
                <td align="center">010.000.0103.00</td>
                <td align="center" width="30%">Ácido acetilsalicilico 300 mg. Tabletas solubles o efervecentes.</td>
                <td align="center" width="10%">Envase con 20 tabletas solubles o efervecentes.</td>
                <td align="center" width="8%">120</td>
                <td align="center" width="8%"></td>
                <td align="center" width="8%">240</td>
                <td align="center" width="20%"></td>
            </tr>
            <tr>
                <td align="center">2</td>
                <td align="center">16</td>
                <td align="center">010.000.1344.00</td>
                <td align="center" width="30%">Albendazol 200 mg. Tabletas.</td>
                <td align="center" width="10%">Envase con 2 tabletas.</td>
                <td align="center" width="8%">2</td>
                <td align="center" width="8%"></td>
                <td align="center" width="8%">4</td>
                <td align="center" width="20%"></td>
            </tr>
            <tr>
                <td align="center">3</td>
                <td align="center">20</td>
                <td align="center">010.000.3451.00</td>
                <td align="center" width="30%">Alopurinol 300 mg. Tabletas.</td>
                <td align="center" width="10%">Envase con 20 tabletas.</td>
                <td align="center" width="8%">10</td>
                <td align="center" width="8%"></td>
                <td align="center" width="8%">20</td>
                <td align="center" width="20%"></td>
            </tr>
            <tr>
                <td align="center">4</td>
                <td align="center">22</td>
                <td align="center">010.000.5107.00</td>
                <td align="center" width="30%">Alteplasa 50 mg. Solución inyectable.</td>
                <td align="center" width="10%">Envase con 2 frascos ámpula con liofilizado 2 frascos ámpula con disolvente y equipo esterilizado para su reconstrución.</td>
                <td align="center" width="8%">1</td>
                <td align="center" width="8%"></td>
                <td align="center" width="8%">2</td>
                <td align="center" width="20%"></td>
            </tr>
        </tbody>
    </table>    
</body>
</html>