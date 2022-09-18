<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('media/logos/favicon.ico') }}" sizes="48X16">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Acta Entrega') }}</title>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <!-- Biblioteca JavaScript DataTables -->
      <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> -->
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
