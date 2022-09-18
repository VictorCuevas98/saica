@component('mail::message')
![Logo de Programación y más][logo]
<h1>Estimado Usuario:</h1> <p style="font-weight:bold;">{{-- {{$usuario}} --}}</p><br>
Lo sentimos, su solicitud fue rechazada, la información proporcionada se consideró no valida.

<br>
Saludos.<br>
SEDESA Secretaría de Salud.
{{-- {{ config('app.name') }} --}}
{{-- ![logo]: ({{asset('/img/secretaria-finanzas.png')}}) "Logo" --}}


[logo]: https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png
@endcomponent
