<div class=" aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="0" data-menu-dropdown-timeout="500"  >
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                                @foreach($seccionesPrimarias  as $seccion_value)
                                    
                                    @if($seccion_value->subsecciones->count()>0 )
                                        <li class="menu-item menu-item-submenu 
                                            @if($seccion_value->subsecciones()->where('id',$seccion->id)->get()->count()>0 || $seccion->id == $seccion_value->id ) 
                                            menu-item-open menu-item-here
                                            @endif " aria-haspopup="true" data-menu-toggle="hover">
                                            <div class="menu-link menu-toggle ">
                                                {{--
                                                    <span class="menu-label px-2">
                                                    @if($seccion_value->no_aplica)
                                                        <span class="label label-inverse label-inline"></span>
                                                    @else
                                                        <span class="label label-light-success label-inline"></span>
                                                    @endif
                                                </span>
                                                --}}
                                                
                                                @if($seccion_value->no_aplica)
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6"/>
                                                            <circle fill="#000000" cx="17" cy="12" r="4"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                @else
                                                <span class="svg-icon menu-icon svg-icon-success">
                                                    <!--begin::Svg Icon --><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6"/>
                                                            <circle fill="#000000" cx="17" cy="12" r="4"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                @endif

                                                
                                                <a href="{{route('seccion.edit',Hashids::encode($seccion_value->id))}}" class="menu-link seccion">
                                                    <span class="menu-text">{{$seccion_value->seccion_template->titulo}}</span>
                                                </a>


                                                <i class="menu-arrow"></i>
                                            </div>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                        <span class="menu-link">
                                                            <span class="menu-text">padre</span>
                                                        </span>
                                                    </li>
                                                    
                                                    {{--
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="{{route('seccion.edit',Hashids::encode($seccion_value->id))}}" class="menu-link seccion">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">{{$seccion_value->seccion_template->titulo}}</span>
                                                        </a>
                                                    </li>
                                                    --}}
                                                    
                                                    @foreach($seccion_value->subsecciones()->orderBy('orden')->get() as $subseccion_value)

                                                   

                                                    @if($subseccion_value->seccion_template->clave_seccion=='APERTURA_TST2' || $subseccion_value->seccion_template->clave_seccion=='APERTURA_OIC' || $subseccion_value->seccion_template->clave_seccion=='GESTION_INFO')


                                                        @if($subseccion_value->seccion_template->clave_seccion=='APERTURA_TST2' && $acta->testigos()->count()>=2  )
                                                        <li class="menu-item  @if($seccion->id == $subseccion_value->id) menu-item-active @endif" aria-haspopup="true">
                                                            <a href="{{route('seccion.edit',Hashids::encode($subseccion_value->id))}}" class="menu-link seccion">
                                                                <i class="menu-bullet menu-bullet-dot">
                                                                    <span></span>
                                                                </i>
                                                                <span class="menu-text">
                                                                    {{$subseccion_value->seccion_template->titulo}}
                                                                    
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                    @else

                                                    <li class="menu-item  @if($seccion->id == $subseccion_value->id) menu-item-active @endif" aria-haspopup="true">
                                                        <a href="{{route('seccion.edit',Hashids::encode($subseccion_value->id))}}" class="menu-link seccion">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">
                                                                {{$subseccion_value->seccion_template->titulo}}
                                                                
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @endif

                                                    
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>


                                    @else {{-- CIERRA SI HAY SUBSECIONES --}}


                                        <li class="menu-item  @if($seccion->id == $seccion_value->id) menu-item-active @endif " aria-haspopup="true">
                                            <a href="{{route('seccion.edit',Hashids::encode($seccion_value->id))}}" class="menu-link seccion">
                                                {{--
                                                <span class="menu-label px-2">
                                                    @if($seccion_value->no_aplica)
                                                        <span class="label label-inverse label-inline"></span>
                                                    @else
                                                        <span class="label label-light-success label-inline"></span>
                                                    @endif
                                                </span>
                                                --}}
                                                @if($seccion_value->no_aplica)
                                                <span class="svg-icon menu-icon">
                                                    <!--begin::Svg Icon -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6"/>
                                                            <circle fill="#000000" cx="17" cy="12" r="4"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                @else
                                                <span class="svg-icon menu-icon svg-icon-success">
                                                    <!--begin::Svg Icon --><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12" rx="6"/>
                                                            <circle fill="#000000" cx="17" cy="12" r="4"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                @endif
                                                
                                                <span class="menu-text">{{$seccion_value->seccion_template->titulo}}</span>
                                                
                                                
                                            </a>
                                        </li>
                                    @endif
                                
                                
                                @endforeach

                                
                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>










{{--
@foreach($seccionesPrimarias  as $seccion_value)
<div class="navi-item mb-0" id="" >
    <div class="navi-link py-2 ml-0 mr-0 px-0  @if($seccion->id == $seccion_value->id) active @endif">
        <span class="navi-label ">
            <form name="aplica_form" class="aplica_form" id="" method="POST" action="{{route('seccion.aplica',[$seccion_value->id])}}" seccion="{{$seccion_value->id}}">
            @csrf   
            <span class="switch switch-sm switch-icon switch-outline  switch-success" data-toggle="tooltip" title="¿La sección me aplica?">
                <label>
                    @if($seccion_value->no_aplica)
                        <input type="checkbox" name="aplica_check" class="aplica_check" id="aplica_check_{{$seccion_value->id}}" />
                    @else
                        <input type="checkbox" name="aplica_check" checked class="aplica_check" id="aplica_check_{{$seccion_value->id}}"/>
                    @endif
                    <span></span>
                </label>
            </span>
            </form>
        </span>
        
        <a href="{{route('seccion.edit',Hashids::encode($seccion_value->id))}}" class="seccion">
            <span class="navi-icon mr-0">
                
            </span>
            <span class="navi-text font-size-lg">{{$seccion_value->seccion_template->titulo }}</span>
        </a>
        
    </div>
</div>
@if($seccion_value->subsecciones->count()>0 )
    @foreach($seccion_value->subsecciones as $subseccion_value)
        <div class="navi-item mb-0" id="" seccion_primaria="{{$subseccion_value->seccion_primaria}}">
            <div class="navi-link py-0 ml-5 mr-0 px-0 @if($seccion->id == $subseccion_value->id) active @endif">
                <span class="navi-label ">
                    <form name="aplica_form" class="aplica_form" id="aplica_form_{{$subseccion_value->id}}" method="POST" action="{{route('seccion.aplica',[$subseccion_value->id])}}" >
                    @csrf   
                    <span class="switch switch-sm switch-icon switch-outline  switch-success" data-toggle="tooltip" title="¿La sección me aplica?">
                        <label>
                            @if($subseccion_value->no_aplica)
                                
                                <input type="checkbox" name="aplica_check" class="aplica_check" id="aplica_check_{{$subseccion_value->id}}" />
                            @else
                                <input type="checkbox" name="aplica_check" checked class="aplica_check" id="aplica_check_{{$subseccion_value->id}}"/>

                            @endif
                            <span></span>
                        </label>
                    </span>
                    </form>
                </span>

                <a href="{{route('seccion.edit',Hashids::encode($subseccion_value->id))}}" class="seccion">
                    <span class="navi-icon mr-0">
                        
                    </span>
                    <span class="navi-text font-size-lg"><small>{{$subseccion_value->seccion_template->titulo}}</small></span>
                </a>
            </div>
        </div>
    @endforeach
@endif


@endforeach --}}