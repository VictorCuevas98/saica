<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Notificación de Recuperación de Contraseña</title>
</head>

<body>
<header>
<img src="{{asset('media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png')}}" width="35%">
</header>
<div>
    <h3>Estimado Usuario:</h3>
    <br>
    <p>Para poder cambiar su contraseña ingrese a esta liga:</p><br>
    
    <ul>
        <li>Sistema de Acta-Entrega Recepción : <a href="{{url('actualizaPwd')}}/{{$data['id']}}">{{url('actualizaPwd')}}/{{$data['id']}}</a></li>
        
    </ul>
    <br><br><br>
</div>
<footer>    
</footer>
</body>
</html>
