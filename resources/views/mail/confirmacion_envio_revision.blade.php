@component('mail::message')
![Logo de Programación y más][logo]
<h1>Estimado Usuario:</h1> <p style="font-weight:bold;">{{-- {{$usuario}} --}}</p><br>
La información proporcionada será revisada para poder generar su acceso al sistema SAICA, nos estaremos comunicando por este medio para informarle de su estatus de su cuenta.
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
