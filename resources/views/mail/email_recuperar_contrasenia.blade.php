@component('mail::message')
![Logo de Programación y más][logo]
<h1>Estimado Usuario:</h1> <p style="font-weight:bold;">{{-- {{$usuario}} --}}</p><br>
Para poder cambiar su contraseña ingrese a esta liga:
@component('mail::button', ['url' => $urlRecordar,'color' => 'success'])
    Cambiar
@endcomponent
<br>
Saludos.<br>
SEDESA Secretaría de Salud.
{{-- {{ config('app.name') }} --}}
{{-- ![logo]: ({{asset('/img/secretaria-finanzas.png')}}) "Logo" --}}


[logo]: https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/logo-sedesa.png
@endcomponent
