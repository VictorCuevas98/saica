{{-- Sticky Toolbar --}}
<ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">
    {{-- Item --}}
    <!--<li class="nav-item mb-2" id="kt_demo_panel_toggle" data-toggle="tooltip"  title="Terminos y condiciones" data-placement="right">
        <a class="btn btn-sm btn-icon btn-bg-light btn-text-success btn-hover-success" href="#" data-toggle="modal" data-target="#condTerminos">
            <i class="flaticon2-drop"></i>
        </a>
    </li>-->

    {{-- Item --}}
    <!--<li class="nav-item mb-2" data-toggle="tooltip" title="Layout Builder" data-placement="left">
        <a class="btn btn-sm btn-icon btn-bg-light btn-text-primary btn-hover-primary" href="#">
            <i class="flaticon2-gear"></i>
        </a>
    </li> -->

    {{-- Item --}}
    {{--<li class="nav-item mb-2" data-toggle="tooltip" title="Ubicación" data-placement="left">
        <a class="btn btn-sm btn-icon btn-bg-light btn-text-warning btn-hover-warning" href="#" data-toggle="modal" data-target="#ubicacionModal">
            <i class="flaticon-map-location"></i>
        </a>
    </li>--}}

    <li class="nav-item mb-2" id="kt_sticky_toolbar_chat_toggler" data-toggle="tooltip" title="Contacto" data-placement="left">
        <a class="btn btn-sm btn-icon btn-bg-light btn-text-warning btn-hover-warning" href="#" data-toggle="modal" data-target="#modal_mensaje_ente">
            <i class="flaticon2-chat-1"></i>
        </a>
    </li>

    @if (config('segumiento_proceso') == true)
        {{-- Item --}}
        <li class="nav-item mb-2" id="kt_sticky_toolbar_chat_toggler" data-toggle="tooltip" title="Contacto" data-placement="left">
            <a class="btn btn-sm btn-icon btn-bg-light btn-text-danger btn-hover-danger" href="#" data-toggle="modal" data-target="#modalContacto">
                <i class="flaticon2-chat-1"></i>
            </a>
        </li>
    @endif
    {{-- 
    <li class="nav-item mb-2" data-toggle="tooltip" title="Tutoriales"  data-placement="left">
        <a class="btn btn-sm btn-icon btn-bg-light btn-text-primary btn-hover-primary" href="{{ url('videotutoriales') }}">
            <i class="fas fa-video"></i>
        </a>
    </li>
     --}}

    {{--<li class="nav-item mb-2" data-toggle="tooltip" title="Manual de usuario" data-placement="left">
    <a class="btn btn-sm btn-icon btn-bg-light btn-text-success btn-hover-success" target="_blank" href="{{asset('manuales/Manual_de_Usuario_PREVIT.pdf')}}">
            <i class="flaticon-book"></i>
        </a>
    </li> --}}
</ul>

@include('home.ubicacionModal')
@include('home.condTerminos')
@include('home.contactoModal')
