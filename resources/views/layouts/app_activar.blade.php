<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('media/logos/favicon.ico') }}" sizes="48X16">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'PREVIT') }}</title>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <style>
        body::after {
            content: "";
            background: url("{{asset('media/bg/FN-N-CONTRASENAS-13.7_Mesa_de_trabajo_1.svg')}}") center center no-repeat;
            opacity: 0.3;
            width:100%; 
            height:100%; 
            z-index: -1;   
            }
        </style>
      @include('layouts/css/css_header_login')
  </head>
  <body>
    @yield('content')
  </body>
  @include('layouts/scripts/js_header_login')
  <script type="text/javascript">
    // var global URL
    var url = '{!! URL::asset('') !!}';

  </script>
  @yield('scripts')
</html>
