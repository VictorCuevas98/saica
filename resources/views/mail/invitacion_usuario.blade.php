<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificación de Pre-registro</title>
</head>

<body>
<header>
<img src="{{asset('media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png')}}" width="35%">
</header>
<div>
    <h3>Estimado Usuario con RFC: <b>{{ $data['rfc'] }}</b></h3>
    <br>
    <p>Se le ha dado de alta en el sistema "Comisión para la Reconstrucción", como enlace de entidad: <b>{{ $data['rol']->name }}.</b></p><br>
    <br>
    <p>Para poder continuar con el tramite es necesario que acceda a la siguiente liga:</p>
    <br>
    <p><a href="{{$data['url']}}">Mesa de Financiamiento con la Sociedad Hipotecaria Federal para el Programa de Vivienda y de Reconstrucción</a></p>
    <br><br><br>
</div>
<footer>
    
</footer>
</body>
</html>
