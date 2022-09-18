@component('mail::message')
![Logo de Programación y más][logo]
<h1>Estimado Usuario:</h1> <p style="font-weight:bold;">{{-- {{$usuario}} --}}</p><br>
Para poder reactivar su cuenta en SAICA, entre a la siguiente liga:
@component('mail::button', ['url' => $urlRecordar,'color' => 'success'])
    Reactivar
@endcomponent
<br>
Saludos.<br>
SEDESA Secretaria de Salud
{{-- {{ config('app.name') }} --}}
{{-- ![logo]: ({{asset('/img/secretaria-finanzas.png')}}) "Logo" --}}


[logo]: https://tics.finanzas.cdmx.gob.mx/saica/public/media/logos/logo-sedesa.png
@endcomponent
