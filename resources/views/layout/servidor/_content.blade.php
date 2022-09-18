{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('content')
@else
    <div class="d-flex flex-column-fluid contenedor_pagina">
        <div class="{{ Metronic::printClasses('content-container', false) }}" id="contenido">
            @yield('content')
        </div>
    </div>
    <div class="d-flex flex-column-fluid contenedor_pagina">
        <img id="img_footer" style="width: 100%" src="{{ asset('assets/media/eventos/pie_de_pagina.png')}}">    
    </div>
@endif
