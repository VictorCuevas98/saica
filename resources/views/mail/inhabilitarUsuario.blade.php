@component('mail::message')
![Logo de Programación y más][logo]
<h1>Estimado Usuario:</h1> <p style="font-weight:bold;">{{-- {{$usuario}} --}}</p><br>
Se le informa que su usuario a sido desactivado del sistema SAICA, por lo que no tendra acceso. Si esto es un error, favor de comunicarse con los administradores.
{{-- @component('mail::button', ['url' => $urlActivacion,'color' => 'success'])
    Activación
@endcomponent --}}
<br>
Saludos.<br>
SEDESA Secretaría de Salud.
{{-- {{ config('app.name') }} --}}
{{-- ![logo]: ({{asset('/img/secretaria-finanzas.png')}}) "Logo" --}}

[logo]:https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/logo-sedesa.png
{{--https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/LOG-GOB-SECRETARIA-DE-SALUD.png--}}
@endcomponent
