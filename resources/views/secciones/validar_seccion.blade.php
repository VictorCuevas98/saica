@extends('layout.default')
@section('styles')

{{-- <link rel="stylesheet" href="{{ URL::asset('css/chat/chat.css')}}" /> --}}
<link href="{{ asset('css/themes/layout/aside/light.css')}}" rel="stylesheet" type="text/css" />
{{-- <link rel="stylesheet" href="{{ URL::asset('css/chat/style.bundle.min.css')}}" /> --}}
@endsection
@section('content')

    <input type="hidden" name="actaId" value="{{$acta->id}}" id="actaId"/>
    <input type="hidden" name="seccionId" value="{{$seccion->id}}" id="seccionId"/>

        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
               
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <!--begin::Mobile Toggle-->
                                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                                        <span></span>
                                    </button>
                                    <!--end::Mobile Toggle-->
                                    <!--begin::Page Heading-->
                                    <div class="d-flex align-items-baseline mr-5">
                                        <!--begin::Page Title-->
                                        <h5 class="text-dark font-weight-bold my-2 mr-5">Solicitud de Entrega</h5>
                                        <!--end::Page Title-->
                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                            <li class="breadcrumb-item">
                                                <a href="" class="text-muted">Entregar</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="" class="text-muted">solicitud</a>
                                            </li>
                                            
                                            <li class="breadcrumb-item">
                                                <a href="" class="text-muted">{{$seccion->seccion_template->titulo}}</a>
                                            </li>
                                        </ul>
                                        <!--end::Breadcrumb-->
                                    </div>
                                    <!--end::Page Heading-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Actions-->

                                    

{{--                                     <div class="dropdown">
                                        <button class="btn btn-light-primary font-weight-bold btn-sm mr-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Quién recibe
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button type="button" id="btn_quien_recibe_ver" class="dropdown-item" >Ver</button>
                                            <button type="button" id="btn_quien_recibe_cambiar" class="dropdown-item " >Cambiar</button>

                                        </div>
                                    </div> --}}
                                    @if ($tipoParticipante == 'OIC')
                                    <a href="#" class="btn btn-light-danger font-weight-bold {{-- btn-sm --}} mr-2 " id="btn_rechazar_acta">Rechazar acta</a>
                                    <a href="#" class="btn btn-light-success font-weight-bold {{-- btn-sm --}} mr-2 " id="btn_aceptar_acta">Aceptar acta</a>
                                        
                                    @endif
                                    {{-- <a href="#" class="btn btn-light font-weight-bold btn-sm">Acciones</a>
                                     --}}<!--end::Actions-->
                                    <!--begin::Dropdown-->
{{--                                     <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-container="body" data-toggle="tooltip" data-placement="bottom" title="Acciones acta">
                                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                                            <!--begin::Navigation-->
                                            <ul class="navi navi-hover">
                                                <li class="navi-header font-weight-bold py-4">
                                                    <span class="font-size-lg">selecciona una acción:</span>
                                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="ayuda..."></i>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-success">Aprobar acta</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-primary">Rechazar acta</span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <!--
                                                <li class="navi-separator mt-3 opacity-70"></li>
                                                <li class="navi-footer py-4">
                                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                    <i class="ki ki-plus icon-sm"></i>Add new</a>
                                                </li>
                                                -->
                                            </ul>
                                            <!--end::Navigation-->
                                        </div>
                                    </div> --}}
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                        </div>
                        <!--end::Subheader-->
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!-- Inicio datos de acta-->
                                <div class="card card-custom gutter-b">
									<div class="card-body">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown dropdown-inline">
                                                <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-hor"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                                    <!--begin::Navigation-->
                                                    <ul class="navi navi-hover py-5">
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-drop"></i>
                                                                </span>
                                                                <span class="navi-text">New Group</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-list-3"></i>
                                                                </span>
                                                                <span class="navi-text">Contacts</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-rocket-1"></i>
                                                                </span>
                                                                <span class="navi-text">Groups</span>
                                                                <span class="navi-link-badge">
                                                                    <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-bell-2"></i>
                                                                </span>
                                                                <span class="navi-text">Calls</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-gear"></i>
                                                                </span>
                                                                <span class="navi-text">Settings</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-separator my-3"></li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-magnifier-tool"></i>
                                                                </span>
                                                                <span class="navi-text">Help</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon">
                                                                    <i class="flaticon2-bell-2"></i>
                                                                </span>
                                                                <span class="navi-text">Privacy</span>
                                                                <span class="navi-link-badge">
                                                                    <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Navigation-->
                                                </div>
                                            </div>
                                        </div>
										<!--begin::Top-->
										<div class="d-flex">
											<!--begin::Pic-->
											<div class="flex-shrink-0 mr-7">
												<div class="symbol symbol-50 symbol-lg-120 symbol-light-primary">
													<span class="font-size-h3 symbol-label font-weight-boldest">SF</span>
												</div>
											</div>
											<!--end::Pic-->
											<!--begin: Info-->
											<div class="flex-grow-1">
												<!--begin::Title-->
												<div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
													<!--begin::User-->
													<div class="mr-3">
														<!--begin::Name-->
														<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">Persona que entrega puesto: {{$personaEntrega->nombre}} {{$personaEntrega->primer_ap}} {{$personaEntrega->segundo_ap}} 
														{{-- <i class="flaticon2-correct text-success icon-md ml-2"></i> --}}</a>
														<!--end::Name-->
														<!--begin::Contacts-->
														<div class="d-flex flex-wrap my-2">
															<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
{{-- 															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
																		<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
																	</g>
																</svg>
                                                                <!--end::Svg Icon--> --}}
                                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo1/dist/../src/media/svg/icons/Files/Folder-solid.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000"/>
                                                                    </g>
                                                                </svg><!--end::Svg Icon--></span>
															{{-- </span> --}}Folio acta: {{$acta->folio_registro}}</a>
															<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
{{-- 															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Lock.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<mask fill="white">
																			<use xlink:href="#path-1"></use>
																		</mask>
																		<g></g>
																		<path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
																	</g>
																</svg>
                                                                <!--end::Svg Icon--> --}}
                                                                

                                                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                                <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
                                                                            </g>
                                                                        </svg>
                                                                    </span>


															{{-- </span> --}}Puesto que entrega: {{$acta->puestoPersona->puesto_funcional->puesto_funcional}}</a>
															{{-- <a href="#" class="text-muted text-hover-primary font-weight-bold">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Map/Marker2.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
																	</g>
																</svg>
																<!--end::Svg Icon-->
															</span>Germany</a> --}}
														</div>
														<!--end::Contacts-->
													</div>
													<!--begin::User-->
													<!--begin::Actions-->
													<div class="my-lg-0 my-1">
														<a data-target="#modal_visualizar_acta" href="javascript:void(0)" data-toggle="modal" class="btn btn-light-warning font-weight-bold text-uppercase mr-2" onclick="visualizar_acta({{$acta->id}})">Visualizar acta</a>
{{--                                                         <a  data-target="#modal_visualizar_acta" class="navi-link" onclick="visualizar_acta({{$acta->id}})">
                                                            <i class="fa fa-search text-primary mr-5"></i>
                                                        </a> --}}
                                                        {{-- <a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Hire</a> --}}
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Title-->
												<!--begin::Content-->
												<div class="d-flex align-items-center flex-wrap justify-content-between">
													<!--begin::Description-->
													<div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">{{-- I distinguish three main text objectives could be merely to inform people. 
													<br>A second could be persuade people.You want people to bay objective --}}</div>
													<!--end::Description-->
													<!--begin::Progress-->
													<div class="d-flex mt-4 mt-sm-0">
														<span class="font-weight-bold mr-4">Progreso</span>
														<div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$porcentajeValidas}}%;" aria-valuenow="{{$porcentajeValidas}}" aria-valuemin="0" aria-valuemax="100"></div>
{{--                                                             <div class="progress-bar" role="progressbar" style="width: {{$porcentajeValidas}}%;" aria-valuenow="{{$porcentajeValidas}}" aria-valuemin="0" aria-valuemax="100"><h6>{{$porcentajeValidas > 0 ?round($porcentajeValidas):'<b>0</b>'}}%</h6> </div>
 --}}														</div>
														<span class="font-weight-bolder text-dark ml-4">{{$porcentajeValidas > 0 ?round($porcentajeValidas):'0'}}%</span>
													</div>
													<!--end::Progress-->
												</div>
												<!--end::Content-->
											</div>
											<!--end::Info-->
										</div>
										<!--end::Top-->
										<!--begin::Separator-->
										<div class="separator separator-solid my-7"></div>
										<!--end::Separator-->
										<!--begin::Bottom-->
										<div class="d-flex align-items-center flex-wrap">
{{-- 											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="d-flex flex-column text-dark-75">
													<span class="font-weight-bolder font-size-sm">Earnings</span>
													<span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">$</span>349,900</span>
												</div>
											</div>
											<!--end: Item-->
											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="d-flex flex-column text-dark-75">
													<span class="font-weight-bolder font-size-sm">Expenses</span>
													<span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">$</span>654,200</span>
												</div>
											</div>
											<!--end: Item-->
											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="d-flex flex-column text-dark-75">
													<span class="font-weight-bolder font-size-sm">Net</span>
													<span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">$</span>876,323</span>
												</div>
											</div>
											<!--end: Item-->
											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="d-flex flex-column flex-lg-fill">
													<span class="text-dark-75 font-weight-bolder font-size-sm">54 Tasks</span>
													<a href="#" class="text-primary font-weight-bolder">View</a>
												</div>
											</div>
											<!--end: Item-->
											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="d-flex flex-column">
													<span class="text-dark-75 font-weight-bolder font-size-sm">583 Comments</span>
													<a href="#" class="text-primary font-weight-bolder">View</a>
												</div>
											</div>
											<!--end: Item--> --}}
											<!--begin: Item-->
											<div class="d-flex align-items-center flex-lg-fill my-1">
												<span class="mr-4">
													<i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
												</span>
												<div class="symbol-group symbol-hover">

													<div class="symbol symbol-30 symbol-circle symbol-light" data-toggle="tooltip" title="" data-original-title="Testigos">
                                                        <span class="symbol-label font-weight-bold">5+</span>
                                                        {{-- <a type="button" class="text-primary font-weight-bolder" id="visualizar_testigos">Ver</a> --}}
                                                        <button type="button" class="btn btn-text-primary btn-hover-light-primary font-weight-bold mr-2" id="visualizar_testigos">Ver</button>
													</div>
												</div>
											</div>
											<!--end: Item-->
										</div>
										<!--end::Bottom-->
									</div>
								</div>
                                <!-- Fin datos de acta-->
                                <!--begin::Profile Account Information-->
                                <div class="d-flex flex-row">
                                    <!--begin::Aside-->
                                    <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                                        <!--begin::Profile Card-->
                                        <div class="card card-custom card-stretch">
                                            <!--begin::Body-->
                                            <div class="card-body pt-4">

                                                <div class="alert alert-custom alert-notice alert-light-primary fade show" role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text">
                                                        <p class="font-weight-bolder"><span class="label label-xl label-dot label-warning"></span> Sección sin validar </p>                                                    
                                                        <p class="font-weight-bolder"><span class="label label-xl label-dot label-success"></span> Sección validada</p>
                                                        <p class="font-weight-bolder"><span class="label label-xl label-dot label-danger"></span> Sección rechazada</p>
                                                    </div>
{{--                                                     <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div> --}}
                                                </div>
                                                {{-- <h4>Avance de validación</h4>
                                                <div class="progress mb-4"  style="height: 30px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{$porcentajeValidas}}%;" aria-valuenow="{{$porcentajeValidas}}" aria-valuemin="0" aria-valuemax="100"><h6>{{$porcentajeValidas > 0 ?round($porcentajeValidas):'<b>0</b>'}}%</h6> </div>
                                                </div> --}}

{{--                                                 <div class="mb-2">

                                                </div> --}}





                                                {{-- {{dump($porcentajeValidas)}} --}}


                                                <!--begin::Nav-->
{{--                                                 <div class="navi navi-bold navi-hover navi-active navi-link-rounded">


                                                    @foreach($seccionesActas  as $seccion_value)
                                                    <div class="navi-item mb-2">
                                                        <div class="row">
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6"></div>
                                                        </div>
                                                        
                                                        @if ($tipoParticipante == 'OIC')
                                                        <a href="{{route('solicitudes.validar.secciones',[$acta->id,$seccion_value->id])}}" class="navi-link py-4 seccion">
                                                            <span class="navi-icon mr-2">
                                                                <span class="svg-icon">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                                            <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                                            <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </span>
                                                            <span class="navi-text font-size-lg">{{$seccion_value->seccion_template->titulo}}</span>
                                                            @if ($seccion_value->comentarios_seccion > 0)
                                                            <span class="">
                                                            
                                                                <i class="flaticon2-chat-1"></i>
                                                                <span class="pulse-ring"></span>
                                                                {{$seccion_value->comentarios_seccion}}
                                                            </span>
  
                                                        @endif                                                          
                                                        </a>    
                                                        @else
                                                        <a href="{{route('solicitudes.validar.secciones.entregante',[$acta->id,$seccion_value->id])}}" class="navi-link py-4 seccion">
                                                            <span class="navi-icon mr-2">
                                                                <span class="svg-icon">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                                            <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                                            <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                            </span>
                                                            <span class="navi-text font-size-lg">{{$seccion_value->seccion_template->titulo}}</span>
                                                            @if ($seccion_value->comentarios_seccion > 0)
                                                            <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                            
                                                                <i class="flaticon2-chat-1"></i>
                                                                <span class="pulse-ring"></span>
                                                                {{$seccion_value->comentarios_seccion}}
                                                            </span>
  
                                                            @endif                                                             
                                                        </a>    
                                                        @endif   
                                                    </div>
                                                    @endforeach
                                                    
                                                </div> --}}
                                                <!--end::Nav-->
                                                {{-- Inicio Nav --}}
                                                {{-- <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside"> --}}
                                                    <!--begin::Brand-->
{{--                                                     <div class="brand flex-column-auto" id="kt_brand" style="" kt-hidden-height="65">
                                                        <!--begin::Logo-->
                                                        <a href="/metronic/demo1/index.html" class="brand-logo">
                                                            <img alt="Logo" src="/metronic/theme/html/demo1/dist/assets/media/logos/logo-light.png">
                                                        </a>
                                                        <!--end::Logo-->
                                                        <!--begin::Toggle-->
                                                        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                                                            <span class="svg-icon svg-icon svg-icon-xl">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                                                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </button>
                                                        <!--end::Toolbar-->
                                                    </div> --}}
                                                    <!--end::Brand-->
                                                    <!--begin::Aside Menu-->
                                                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                                                        <!--begin::Menu Container-->
                                                        <div id="kt_aside_menu" class="aside-menu my-4 scroll ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="height: 100%px; overflow: hidden;">
                                                            <!--begin::Menu Nav-->
                                                            <ul class="menu-nav">
                                                                
                                                                @foreach($actasSecciones  as $seccion_value)
                                                                
                                                                    
                                                                    @if ($tipoParticipante == 'OIC')
                                                                        @if ($seccion_value->id_tipo_seccion == 'N')
                                                                            <li class="menu-item" aria-haspopup="true">
                                                                                <a href="{{route('solicitudes.validar.secciones',[$acta->id,$seccion_value->seccion_id])}}" class="menu-link">
                                                                                    @if ($seccion_value->subSeccionesValidas)
                                                                                        <span class="label label-xl label-dot label-warning mr-2"></span>    
                                                                                    @else
                                                                                        <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                    @endif
                                                                                    
                                                                                    <span class="svg-icon menu-icon">
                                                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                                                            </g>
                                                                                        </svg>
                                                                                        <!--end::Svg Icon-->
                                                                                    </span>
                                                                                    <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                    @if ($seccion_value->comentarios_seccion > 0)
                                                                                    <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                    
                                                                                        <i class="flaticon2-chat-1"></i>
                                                                                        <span class="pulse-ring"></span>
                                                                                        {{$seccion_value->comentarios_seccion}}
                                                                                    </span>
                          
                                                                                    @endif
                                                                                </a>
                                                                            </li>
                                                                        @endif
                                                                        @if ($seccion_value->id_tipo_seccion == 'P')

                                                                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                                                <a href="javascript:;" class="menu-link menu-toggle">
                                                                                    @if ($seccion_value->subSeccionesValidas)
                                                                                        <span class="label label-xl label-dot label-warning mr-2"></span>    
                                                                                    @else
                                                                                        <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                    @endif
                                                                                    <span class="svg-icon menu-icon">
                                                                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                                                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                                                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                                                            </g>
                                                                                        </svg>
                                                                                        <!--end::Svg Icon-->
                                                                                    </span>
                                                                                    <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                    @if ($seccion_value->comentarios_seccion > 0)
                                                                                    <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                    
                                                                                        <i class="flaticon2-chat-1"></i>
                                                                                        <span class="pulse-ring"></span>
                                                                                        {{$seccion_value->comentarios_seccion}}
                                                                                    </span>
                      
                                                                                @endif
                                                                                    <i class="menu-arrow"></i>
                                                                                </a>
                                                                                <div class="menu-submenu">
                                                                                    <i class="menu-arrow"></i>
                                                                                    <ul class="menu-subnav">
                                                                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                                                            <span class="menu-link">
                                                                                                <span class="menu-text">General</span>
                                                                                            </span>
                                                                                        </li>

                                                                                        <li class="menu-item" aria-haspopup="true">
                                                                                            <a href="{{route('solicitudes.validar.secciones',[$acta->id,$seccion_value->seccion_id])}}" class="menu-link">
                                                                                                @if ($seccion_value->vobo == null)
                                                                                                    <span class="label label-xl label-dot label-warning mr-2"></span>    
                                                                                                @elseif (!$seccion_value->vobo)
                                                                                                <span class="label label-xl label-dot label-danger mr-2"></span>   
                                                                                                @else
                                                                                                    <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                                @endif
                                                                                                <i class="menu-bullet menu-bullet-dot">
                                                                                                    <span></span>
                                                                                                </i>
                                                                                                <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                                {{-- {{dump($seccion_value->comentarios_seccion)}} --}}
                                                                                                @if ($seccion_value->comentarios_seccion > 0)
                                                                                                    <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                                    
                                                                                                        <i class="flaticon2-chat-1"></i>
                                                                                                        <span class="pulse-ring"></span>
                                                                                                        {{$seccion_value->comentarios_seccion}}
                                                                                                    </span>
                                      
                                                                                                @endif
                                                                                            </a>
                                                                                        </li> 
                                                                                        @foreach ($seccion_value->subsecciones as $subSecciones)
                                                                                            <li class="menu-item" aria-haspopup="true">
                                                                                                <a href="{{route('solicitudes.validar.secciones',[$acta->id,$subSecciones->seccion_id])}}" class="menu-link">
                                                                                                    @if ($subSecciones->vobo == null)
                                                                                                        <span class="label label-xl label-dot label-warning mr-2"></span>    
                                                                                                    @else
                                                                                                        <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                                    @endif
                                                                                                    <i class="menu-bullet menu-bullet-dot">
                                                                                                        <span></span>
                                                                                                    </i>
                                                                                                    <span class="menu-text">{{$subSecciones->titulo}}</span>
                                                                                                    @if ($subSecciones->comentariossubseccion > 0)
                                                                                                    <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                                    
                                                                                                        <i class="flaticon2-chat-1"></i>
                                                                                                        <span class="pulse-ring"></span>
                                                                                                        {{$subSecciones->comentariossubseccion}}
                                                                                                    </span>
                                          
                                                                                                    @endif
                                                                                                </a>
                                                                                            </li>   
                                                                                        @endforeach

                                                                                    </ul>
                                                                                </div>
                                                                            </li>
                                                                        @endif    
                                                                    @else
                                                                        @if ($seccion_value->id_tipo_seccion == 'N')
                                                                        <li class="menu-item" aria-haspopup="true">
                                                                            <a href="{{route('solicitudes.validar.secciones.entregante',[$acta->id,$seccion_value->seccion_id])}}" class="menu-link">
                                                                                    @if (!$seccion_value->vobo)
                                                                                        <span class="label label-xl label-dot label-danger mr-2"></span>    
                                                                                    @else
                                                                                        <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                    @endif
                                                                                <span class="svg-icon menu-icon">
                                                                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                                                        </g>
                                                                                    </svg>
                                                                                    <!--end::Svg Icon-->
                                                                                </span>
                                                                                <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                @if ($seccion_value->comentarios_seccion > 0)
                                                                                <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                
                                                                                    <i class="flaticon2-chat-1"></i>
                                                                                    <span class="pulse-ring"></span>
                                                                                    {{$seccion_value->comentarios_seccion}}
                                                                                </span>
                      
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                        @endif
                                                                        @if ($seccion_value->id_tipo_seccion == 'P')

                                                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                                                @if (!$seccion_value->vobo)
                                                                                    <span class="label label-xl label-dot label-danger mr-2"></span>    
                                                                                 @else
                                                                                    <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                @endif
                                                                                <span class="svg-icon menu-icon">
                                                                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                                                            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                                                                                            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                                                                                        </g>
                                                                                    </svg>
                                                                                    <!--end::Svg Icon-->
                                                                                </span>
                                                                                <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                @if ($seccion_value->comentarios_seccion > 0)
                                                                                <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                
                                                                                    <i class="flaticon2-chat-1"></i>
                                                                                    <span class="pulse-ring"></span>
                                                                                    {{$seccion_value->comentarios_seccion}}
                                                                                </span>
                      
                                                                                @endif
                                                                                <i class="menu-arrow"></i>
                                                                            </a>
                                                                            <div class="menu-submenu">
                                                                                <i class="menu-arrow"></i>
                                                                                <ul class="menu-subnav">
                                                                                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                                                                                        <span class="menu-link">
                                                                                            <span class="menu-text">General</span>
                                                                                        </span>
                                                                                    </li>
                                                                                    <li class="menu-item" aria-haspopup="true">
                                                                                        <a href="{{route('solicitudes.validar.secciones.entregante',[$acta->id,$seccion_value->seccion_id])}}" class="menu-link">
                                                                                            @if (!$seccion_value->vobo)
                                                                                                <span class="label label-xl label-dot label-danger mr-2"></span>    
                                                                                            @else
                                                                                                <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                            @endif
                                                                                            <i class="menu-bullet menu-bullet-dot">
                                                                                                <span></span>
                                                                                            </i>
                                                                                            <span class="menu-text">{{$seccion_value->titulo}}</span>
                                                                                            {{-- {{dump($seccion_value->comentarios_seccion)}} --}}
                                                                                            @if ($seccion_value->comentarios_seccion > 0)
                                                                                                <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                                
                                                                                                    <i class="flaticon2-chat-1"></i>
                                                                                                    <span class="pulse-ring"></span>
                                                                                                    {{$seccion_value->comentarios_seccion}}
                                                                                                </span>
                                  
                                                                                            @endif
                                                                                        </a>
                                                                                    </li> 
                                                                                    @foreach ($seccion_value->subsecciones as $subSecciones)
                                                                                        <li class="menu-item" aria-haspopup="true">
                                                                                            <a href="{{route('solicitudes.validar.secciones.entregante',[$acta->id,$subSecciones->seccion_id])}}" class="menu-link">
                                                                                                @if (!$subSecciones->vobo)
                                                                                                    <span class="label label-xl label-dot label-danger mr-2"></span>    
                                                                                                @else
                                                                                                    <span class="label label-xl label-dot label-success mr-2"></span>
                                                                                                @endif
                                                                                                <i class="menu-bullet menu-bullet-dot">
                                                                                                    <span></span>
                                                                                                </i>
                                                                                                <span class="menu-text">{{$subSecciones->titulo}}</span>
                                                                                                @if ($subSecciones->comentariossubseccion > 0)
                                                                                                <span class="btn btn-icon btn-light-warning pulse pulse-warning">
                                                                                                
                                                                                                    <i class="flaticon2-chat-1"></i>
                                                                                                    <span class="pulse-ring"></span>
                                                                                                    {{$subSecciones->comentariossubseccion}}
                                                                                                </span>
                                      
                                                                                                @endif
                                                                                            </a>
                                                                                        </li>   
                                                                                    @endforeach

                                                                                </ul>
                                                                            </div>
                                                                        </li>
                                                                        @endif
                                                                    @endif   
                                                                
                                                                @endforeach

{{--                                                                 <li class="menu-item" aria-haspopup="true">
                                                                    <a href="/metronic/demo1/builder.html" class="menu-link">
                                                                        <span class="svg-icon menu-icon">
                                                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                                    <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                                                                    <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                        <span class="menu-text">Builder</span>
                                                                    </a>
                                                                </li> --}}
                                                                                                           
                                                            </ul>
                                                            <!--end::Menu Nav-->
                                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 583px; right: 4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 244px;"></div></div></div>
                                                        <!--end::Menu Container-->
                                                    </div>
                                                    <!--end::Aside Menu-->
                                                {{-- </div> --}}
                                                {{-- Fin Nav --}}
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Profile Card-->
                                    </div>
                                    <!--end::Aside-->
                                    
                                   
                                    
                                    <!--begin::Content-->
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom mb-6">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{$seccion->seccion_template->titulo}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">-----</span>
            </div>
            <div class="card-toolbar">
                {{-- <label for="">La seccion es correcta </label> 
                
                <input data-switch="true" type="checkbox"  checked="checked" data-on-color="success" data-off-color="danger"/>
                 --}}
                 {{-- <a href="#" class="btn btn-light-primary font-weight-bold  mr-2 " id="kt_demo_panel_toggle" data-toggle="tooltip" title="Numerales de esta sección" data-placement="bottom">Numerales</a> --}}

                {{-- <button type="reset" class="btn btn-success mr-2">Guardar</button> --}}
                {{-- <button type="reset" class="btn btn-success mr-2">Validacion</button> --}}
{{--                 <div class="form-group row">
                    <label class="col-form-label text-right col-lg-6 col-sm-12">La seccion es correcta</label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                     <input id="validar" data-switch="true" type="checkbox"  checked="checked" data-on-color="success" data-off-color="warning" data-on-text="Sí" data-off-text="No"/>
                    </div>
                </div> --}}
                @if ($tipoParticipante == 'OIC')
{{--                 <div class="row mx-2">
                    <label  class="mx-2"><b>La sección es correcta </b></label>
                    <div class="">
                     <span class="switch switch-success">
                      <label>
                       <input id="validar" type="checkbox" name="select" {{isset($seccionValidada->vobo)?$seccionValidada->vobo && $seccionValidada->vobo != null?'checked':'':''}}/>
                       <span></span>
                      </label>
                     </span>
                    </div>     
                



            </div> --}}
            


            

<form class="form mx-4">
    @csrf
    <div class="form-group row">
        {{-- <label class="col-md-3 col-form-label">La sección es correcta</label> --}}
        <div class="col-md-12 col-form-label">
            <div class="radio-inline">
                <label class="radio radio-accent radio-success">
                    <input type="radio" name="validar" id="validar_aceptar" {{$seccionValidada->vobo?"checked":''}}/>
                    <span></span>
                    Aceptar
                </label>
                <label class="radio radio-accent radio-danger">
                    <input type="radio" name="validar" {{-- checked="checked"  --}} id="validar_rechazar" {{!$seccionValidada->vobo?"checked":''}}/>
                    <span></span>
                    Rechazar
                </label>
{{--                 <label class="radio radio-accent radio-success radio-disabled">
                    <input type="radio" name="radios18" disabled="disabled"/>
                    <span></span>
                    Disabled
                </label> --}}
            </div>
            <span class="form-text font-weight-bolder{{-- text-muted --}}">La sección es correcta</span>
        </div>
    </div>
{{--     <div class="form-group row">
        <label class="col-3 col-form-label">Danger</label>
        <div class="col-9 col-form-label">
            <div class="radio-inline">
                <label class="radio radio-accent radio-danger">
                    <input type="radio" name="radios19"/>
                    <span></span>
                    Default
                </label>
                <label class="radio radio-accent radio-danger">
                    <input type="radio" name="radios19" checked="checked" />
                    <span></span>
                    Checked
                </label>
                <label class="radio radio-accent radio-danger radio-disabled">
                    <input type="radio" name="radios19" disabled="disabled"/>
                    <span></span>
                    Disabled
                </label>
            </div>
            <span class="form-text text-muted">Some help text goes here</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-3 col-form-label">Primary</label>
        <div class="col-9 col-form-label">
            <div class="radio-inline">
                <label class="radio radio-accent radio-primary">
                    <input type="radio" name="radios20"/>
                    <span></span>
                    Default
                </label>
                <label class="radio radio-accent radio-primary">
                    <input type="radio" name="radios20" checked="checked" />
                    <span></span>
                    Checked
                </label>
                <label class="radio radio-accent radio-primary radio-disabled">
                    <input type="radio" name="radios20" disabled="disabled"/>
                    <span></span>
                    Disabled
                </label>
            </div>
            <span class="form-text text-muted">Some help text goes here</span>
        </div>
    </div> --}}
</form>




            @endif
            <div id="escribir_comentarios" class="my-2">
                {{-- <a href="#" class="btn btn-block btn-sm btn-light-warning font-weight-bolder text-uppercase py-4" data-toggle="modal" data-target="#kt_chat_modal">Escribe un Comentario</a> --}}
                <a href="#" class="{{-- btn btn-sm btn-light-primary --}}btn btn-sm btn-bg-light btn-text-success btn-hover-success" data-toggle="modal" data-target="#kt_chat_modal_secciones">
                    <i class="flaticon-chat"></i>
                </a>
                {{-- <a href="#" class="btn btn-light-danger font-weight-bold mr-2">
                    <i class="flaticon2-open-box"></i> Button example 2
                </a> --}}
            </div>
        </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <div class="card-body">


            <p class="text-wrap">{{$textoDinamicosSec}}</p>
            <div class="separator separator-dashed my-5"></div>

            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-2 col-lg-2 col-form-label">Texto adicional:</label>
                <div class="col-lg-10 col-xl-10">
                    <div class="form-group">
                        <textarea class="form-control form-control-lg form-control-solid" id="exampleTextarea" rows="5" placeholder="" value="{{$seccion->texto_adicional}}">{{$seccion->texto_adicional}}</textarea>
                    </div>
                </div>
            </div>
            <!--begin::Form Group-->
            
{{--             <div class="form-group row">
                <label class="col-form-label text-right col-lg-4 col-sm-12">La seccion es correcta</label>
                <div class="col-lg-8 col-md-9 col-sm-12">
                 <input id="validar" data-switch="true" type="checkbox"  checked="checked" data-on-color="success" data-off-color="warning" data-on-text="Sí" data-off-text="No"/>
                </div>
            </div>
            <div id="escribir_comentarios" class="d-none">
                
                <a href="#" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4" data-toggle="modal" data-target="#kt_chat_modal_secciones">Escribe un Comentario</a>
            </div> --}}
            
        </div>
        <!--end::Form-->
    </div>
    <!--end::Card-->
    <div class="row" id="seccion_document_container">

        @foreach($seccion->documentos()->noBorrados()->get() as $documento)

            @include("seccionesDocumentos._single_file",['documento'=>$documento,'extencion'=>strtoupper(substr($documento->filename, -3))])

        @endforeach


    </div>

</div>
<!--end::Content-->



                                </div>
                                <!--end::Profile Account Information-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
                    <!--end::Content-->
                    
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->
        
        <!--begin::Quick Cart-->
        <div id="kt_quick_cart" class="offcanvas offcanvas-right p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
                <h4 class="font-weight-bold m-0">Shopping Cart</h4>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_cart_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content">
                <!--begin::Wrapper-->
                <div class="offcanvas-wrapper mb-5 scroll-pull">
                    <!--begin::Item-->
                    <div class="d-flex align-items-center justify-content-between py-8">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">iBlender</a>
                            <span class="text-muted">The best kitchen gadget in 2020</span>
                            <div class="d-flex align-items-center mt-2">
                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 350</span>
                                <span class="text-muted mr-1">for</span>
                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">5</span>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                    <i class="ki ki-minus icon-xs"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                    <i class="ki ki-plus icon-xs"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                            <img src="assets/media/stock-600x400/img-1.jpg" title="" alt="" />
                        </a>
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-solid"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center justify-content-between py-8">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">SmartCleaner</a>
                            <span class="text-muted">Smart tool for cooking</span>
                            <div class="d-flex align-items-center mt-2">
                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 650</span>
                                <span class="text-muted mr-1">for</span>
                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">4</span>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                    <i class="ki ki-minus icon-xs"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                    <i class="ki ki-plus icon-xs"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                            <img src="assets/media/stock-600x400/img-2.jpg" title="" alt="" />
                        </a>
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-solid"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center justify-content-between py-8">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="font-weight-bold text-dark-75 font-size-lg text-hover-primary">CameraMax</a>
                            <span class="text-muted">Professional camera for edge cutting shots</span>
                            <div class="d-flex align-items-center mt-2">
                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 150</span>
                                <span class="text-muted mr-1">for</span>
                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">3</span>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                    <i class="ki ki-minus icon-xs"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                    <i class="ki ki-plus icon-xs"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                            <img src="assets/media/stock-600x400/img-3.jpg" title="" alt="" />
                        </a>
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-solid"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center justify-content-between py-8">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="font-weight-bold text-dark text-hover-primary">4D Printer</a>
                            <span class="text-muted">Manufactoring unique objects</span>
                            <div class="d-flex align-items-center mt-2">
                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 1450</span>
                                <span class="text-muted mr-1">for</span>
                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">7</span>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                    <i class="ki ki-minus icon-xs"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                    <i class="ki ki-plus icon-xs"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                            <img src="assets/media/stock-600x400/img-4.jpg" title="" alt="" />
                        </a>
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-solid"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center justify-content-between py-8">
                        <div class="d-flex flex-column mr-2">
                            <a href="#" class="font-weight-bold text-dark text-hover-primary">MotionWire</a>
                            <span class="text-muted">Perfect animation tool</span>
                            <div class="d-flex align-items-center mt-2">
                                <span class="font-weight-bold mr-1 text-dark-75 font-size-lg">$ 650</span>
                                <span class="text-muted mr-1">for</span>
                                <span class="font-weight-bold mr-2 text-dark-75 font-size-lg">7</span>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon mr-2">
                                    <i class="ki ki-minus icon-xs"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-light-success btn-icon">
                                    <i class="ki ki-plus icon-xs"></i>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="symbol symbol-70 flex-shrink-0">
                            <img src="assets/media/stock-600x400/img-8.jpg" title="" alt="" />
                        </a>
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Purchase-->
                <div class="offcanvas-footer">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="font-weight-bold text-muted font-size-sm mr-2">Total</span>
                        <span class="font-weight-bolder text-dark-50 text-right">$1840.00</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-7">
                        <span class="font-weight-bold text-muted font-size-sm mr-2">Sub total</span>
                        <span class="font-weight-bolder text-primary text-right">$5640.00</span>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary text-weight-bold">Place Order</button>
                    </div>
                </div>
                <!--end::Purchase-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Quick Cart-->
        <!--begin::Quick Panel-->
        <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
            <!--begin::Header-->
            <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_logs">Audit Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_settings">Settings</a>
                    </li>
                </ul>
                <div class="offcanvas-close mt-n1 pr-5">
                    <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content px-10">
                <div class="tab-content">
                    <!--begin::Tabpane-->
                    <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_logs" role="tabpanel">
                        <!--begin::Section-->
                        <div class="mb-15">
                            <h5 class="font-weight-bold mb-5">System Messages</h5>
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-wrap mb-5">
                                <div class="symbol symbol-50 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/006-plurk.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Top Authors</a>
                                    <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                                </div>
                                <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">+82$</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-wrap mb-5">
                                <div class="symbol symbol-50 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/015-telegram.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Popular Authors</a>
                                    <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                                </div>
                                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+280$</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-wrap mb-5">
                                <div class="symbol symbol-50 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/003-puzzle.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">New Users</a>
                                    <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                                </div>
                                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-wrap mb-5">
                                <div class="symbol symbol-50 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/005-bebo.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Active Customers</a>
                                    <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                                </div>
                                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="symbol symbol-50 symbol-light mr-5">
                                    <span class="symbol-label">
                                        <img src="assets/media/svg/misc/014-kickstarter.svg" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">Bestseller Theme</a>
                                    <span class="text-muted font-weight-bold">Most Successful Fellas</span>
                                </div>
                                <span class="btn btn-sm btn-light font-weight-bolder my-lg-0 my-2 py-1 text-dark-50">+4500$</span>
                            </div>
                            <!--end: Item-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Section-->
                        <div class="mb-5">
                            <h5 class="font-weight-bold mb-5">Notifications</h5>
                            <!--begin: Item-->
                            <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
                                <span class="svg-icon svg-icon-warning mr-5">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another purpose persuade</a>
                                    <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center bg-light-success rounded p-5 mb-5">
                                <span class="svg-icon svg-icon-success mr-5">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would be to people</a>
                                    <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-5">
                                <span class="svg-icon svg-icon-danger mr-5">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                                                <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">Purpose would be to persuade</a>
                                    <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-danger py-1 font-size-lg">-27%</span>
                            </div>
                            <!--end: Item-->
                            <!--begin: Item-->
                            <div class="d-flex align-items-center bg-light-info rounded p-5">
                                <span class="svg-icon svg-icon-info mr-5">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Attachment2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="#000000" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)" />
                                                <path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="#000000" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)" />
                                                <path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="#000000" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)" />
                                                <path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="#000000" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">The best product</a>
                                    <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-info py-1 font-size-lg">+8%</span>
                            </div>
                            <!--end: Item-->
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Tabpane-->
                    <!--begin::Tabpane-->
                    <div class="tab-pane fade pt-2 pr-5 mr-n5" id="kt_quick_panel_notifications" role="tabpanel">
                        <!--begin::Nav-->
                        <div class="navi navi-icon-circle navi-spacer-x-0">
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-bell text-success icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">5 new user generated report</div>
                                        <div class="text-muted">Reports based on sales</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon2-box text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">2 new items submited</div>
                                        <div class="text-muted">by Grog John</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-psd text-primary icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">79 PSD files generated</div>
                                        <div class="text-muted">Reports based on sales</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon2-supermarket text-warning icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                                        <div class="text-muted">Total 234 items</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                                        <div class="text-muted">Fostest is Barry</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-safe-shield-protection text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">3 Defence alerts</div>
                                        <div class="text-muted">40% less alerts thar last week</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-notepad text-primary icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">Avarage 4 blog posts per author</div>
                                        <div class="text-muted">Most posted 12 time</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-users-1 text-warning icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">16 authors joined last week</div>
                                        <div class="text-muted">9 photodrapehrs, 7 designer</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon2-box text-info icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">2 new items have been submited</div>
                                        <div class="text-muted">by Grog John</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon2-download text-success icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">2.8 GB-total downloads size</div>
                                        <div class="text-muted">Mostly PSD end AL concepts</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon2-supermarket text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                                        <div class="text-muted">Total 234 items</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-bell text-primary icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">7 new user generated report</div>
                                        <div class="text-muted">Reports based on sales</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <a href="#" class="navi-item">
                                <div class="navi-link rounded">
                                    <div class="symbol symbol-50 mr-3">
                                        <div class="symbol-label">
                                            <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                                        </div>
                                    </div>
                                    <div class="navi-text">
                                        <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                                        <div class="text-muted">Fostest is Barry</div>
                                    </div>
                                </div>
                            </a>
                            <!--end::Item-->
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Tabpane-->
                    <!--begin::Tabpane-->
                    <div class="tab-pane fade pt-3 pr-5 mr-n5" id="kt_quick_panel_settings" role="tabpanel">
                        <form class="form">
                            <!--begin::Section-->
                            <div>
                                <h5 class="font-weight-bold mb-3">Customer Care</h5>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Enable Notifications:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-success switch-sm">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Enable Case Tracking:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-success switch-sm">
                                            <label>
                                                <input type="checkbox" name="quick_panel_notifications_2" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Support Portal:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-success switch-sm">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--begin::Section-->
                            <div class="pt-2">
                                <h5 class="font-weight-bold mb-3">Reports</h5>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Generate Reports:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-danger">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Enable Report Export:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-danger">
                                            <label>
                                                <input type="checkbox" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Allow Data Collection:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-danger">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                            <div class="separator separator-dashed my-6"></div>
                            <!--begin::Section-->
                            <div class="pt-2">
                                <h5 class="font-weight-bold mb-3">Memebers</h5>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Enable Member singup:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-primary">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-primary">
                                            <label>
                                                <input type="checkbox" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-0 row">
                                    <label class="col-8 col-form-label">Enable Customer Portal:</label>
                                    <div class="col-4 text-right">
                                        <span class="switch switch-sm switch-primary">
                                            <label>
                                                <input type="checkbox" checked="checked" name="select" />
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Section-->
                        </form>
                    </div>
                    <!--end::Tabpane-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Quick Panel-->
        
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <!--end::Scrolltop-->
        
        

        <!--begin::Demo Panel-->
        <div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
                <h4 class="font-weight-bold m-0">Numerales de Acta entrega</h4>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content">
                <form name="dynamicData_form" id="dynamicData_form">
                     @csrf
                    <!--begin::Wrapper-->
                    <div class="offcanvas-wrapper mb-5 scroll-pull">
                        @foreach($seccion->seccion_dynamicdata as $sec_dyn_data)
                            <div class="form-group">
                                <label>{{$sec_dyn_data->dynamicdata->dynamicdata_template->clave_dynamicdata}} {{$sec_dyn_data->dynamicdata->dynamicdata_template->dynamicdata}}</label>
                                <input type="hidden" name="dynamicdata[]" value="{{$sec_dyn_data->dynamicdata->id}}">
                                <input type="text" class="form-control" placeholder="" name="valor[]" value="{{$sec_dyn_data->dynamicdata->valor}}">
                                <span class="form-text text-muted" style="display: none">mensaje de error o informacion</span>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Purchase-->
                    <div class="offcanvas-footer">
                        <button class="btn btn-block btn-primary btn-shadow font-weight-bolder text-uppercase">Guardar</button>
                    </div>
                    <!--end::Purchase-->
                </form>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Demo Panel-->



        

        @include('secciones/modal_chat')
        @include('secciones/modal_testigos')
        @include('actas.modal_visualizar')
@endsection


@section('scripts')
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    var urlGuardarValidacionSecciones = "{{route('solicitudes.validar.guardar')}}";
    var urlGuardarComentarios = "{{route('solicitudes.validar.guardar.comentarios')}}";
    
    var abrirChatValidacion = "{{isset($seccionValidada->vobo)?$seccionValidada->vobo?'cerrar_modal':'abrir_modal':'cerrar_modal'}}"
    var KTAppOptions = {"colors":{"state":{"brand":"#5d78ff","dark":"#282a3c","light":"#ffffff","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
    var urlGuardarValidacionActas = "{{route('solicitudes.validar.guardar.validacion.acta')}}";
    
    var urlListarActas = "{{route('solicitudes.listar.actas')}}"
</script>
    <script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
    
    <script src="{{ asset('js/chat/chat.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/seguimiento_actas/validar_seccion.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/entregas/visualizar_acta.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('js/chat/scripts.bundle.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('js/util.js') }}" type="text/javascript"></script> --}}
    <script>
    </script> 
    <script>
    </script>
    @if (session('message'))
    <script>
        setTimeout(function() {
            swal.fire('¡Aviso!', "{{session('message')}}", 'success');
        }, 500);
    </script>
    @endif
{{-- 
    <script type="text/javascript">
        "use strict";


        // Class definition
        var KTProfile = function () {
            // Elements
            var avatar;
            var offcanvas;

            // Private functions
            var _initAside = function () {
                // Mobile offcanvas for mobile mode
                offcanvas = new KTOffcanvas('kt_profile_aside', {
                    overlay: true,
                    baseClass: 'offcanvas-mobile',
                    //closeBy: 'kt_user_profile_aside_close',
                    toggleBy: 'kt_subheader_mobile_toggle'
                });
            }

            return {
                // public functions
                init: function() {
                    _initAside();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTProfile.init();
        });

    </script>
    <script src="{{ asset('js/entregas/quienrecibe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/entregas/testigos.js') }}" type="text/javascript"></script>

    
    

    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var seccionId  = $("#seccionId").val();
        var maxFiles = 1; //solo se pueden subir de dos en dos

        var myDropzone = new Dropzone("#archivos", {
            url: url+'seccion/'+seccionId+'/documentos',
            method: "POST",
            paramName: "file", // The name that will be used to transfer the file
            acceptedFiles: "application/pdf,.xls,.xlsx ",
            autoProcessQueue: false,
            uploadMultiple: true,
            addRemoveLinks: true,
            maxFiles: maxFiles,
            maxFilesize: 10, // MB
            dictInvalidFileType: "Por favor seleccione el archivo correcto",
            sending: function (file, xhr, formData) {
                //formData.append("_token", $('#_token').val());
                formData.append("_token", "{{ csrf_token() }}");
                //$('#buttonEntrar').attr("disabled", true);
                //$("#buttonEntrar").addClass("spinner spinner-white spinner-right");
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });

        myDropzone.on("addedfile", function(file, data) {
            /* Maybe display some more file information on your page */
            //$('#buttonEntrar').show();
            if (this.files.length > maxFiles) {
                this.removeFile(this.files[0]);
            }
        });

        myDropzone.on("maxfilesexceeded", function(file, data) {
            alert("No more files please!");
            this.removeFile(file);
        });

        myDropzone.on("error", function(file, message) { 
                swal.fire('Ups!', message, 'error');
                this.removeFile(file); 
        });

        myDropzone.on("success", function(archivo, response){
            if(response.success){
                //$('#buttonEntrar').attr("disabled", false);
                //$("#buttonEntrar").removeClass("spinner spinner-white spinner-right");

                this.removeFile(this.files[0]);
                $.each(response.data, function (ind, elem) { 
                    $("#seccion_document_container").append('<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6" id="">'+elem+'</div>');
                }); 

                swal.fire({
                    title: 'Exito',
                    text: "Se cargaron los documetos exitosamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "{{ url('entidad') }}";
                    }
                });
            } else {
                //$('#buttonEntrar').attr("disabled", false);
                //$("#buttonEntrar").removeClass("spinner spinner-white spinner-right");
                swal.fire('Error', response.mensaje, 'error');
                $('#password').val('');
                //this.removeAllFiles();
                this.removeFile(this.files[0]);
            }
        });

        $("#bnt_enviar_archivo").click(function(e){
            myDropzone.processQueue();
        });

    </script>
    <script type="text/javascript">
        
        $("#dynamicData_form").submit(function(e){
            e.preventDefault();
            e.stopPropagation()
            console.log("enviando");
            
            var formulario = $(this);

            
            $.ajax({
                url: url+ 'dynamicdata',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                data: formulario.serialize(),
            }).done(function (response) {
                
                if(response.success)
                {
                   swal.fire('Exito', 'se guardaron los datos correctamente', 'success');
                } else {
                    swal.fire('Algo ocurrio al guardar', response.mensaje, 'error');
                }
            }).fail(function (response_error) {
                console.log("error");
                console.log(response_error);
            });
        });

       
        //el siguiente es un metodo que con la clase se puede hacer un descargar muy nice
        $('.seccion').click(function(e){
            
            e.preventDefault();
            //preloaderShow("Cargando Sección ...");
            

            pageloader_in('fast','Cargando seccion');


            window.location.href = $(this).attr('href');
            
        });



        var KTBootstrapSwitch = function() {


            // Private functions
                var demos = function() {
                // minimum setup
                $('[data-switch=true]').bootstrapSwitch();
                };

                return {
                // public functions
                init: function() {
                demos();
                },
                };
                }();

                jQuery(document).ready(function() {
                KTBootstrapSwitch.init();
                });
        
    </script> --}}
@endsection