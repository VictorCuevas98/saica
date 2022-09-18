@component('mail::message')
![Logo de Programación y más][logo]
<h1>Reporte de fallas:</h1> <p style="font-weight:bold;"></p><br>
El usuario {{ $data['nombre'] }} ({{ $data['emailPersona'] }}) reporta lo siguiente:
<br>
<p>{{ $data['mensaje'] }}</p>

<br>
<p>SAF Secretaria de Administracion y Finanzas</p>



[logo]: https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png
@endcomponent
