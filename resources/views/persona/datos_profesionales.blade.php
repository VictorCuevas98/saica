@extends('layout.default')
@section('content')

<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Mis Datos Profesionales</span>

        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-8">
        <form class="form" id="datosProf" action="{{url('firmante/guardaDatosProf')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <h3 class="mb-10 font-weight-bold text-dark">{{Auth::user()->persona->nombre}} {{Auth::user()->persona->primer_ap}} {{Auth::user()->persona->segundo_ap}}</h3>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Número de registro</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="30" name="nregistro" id="nregistro">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>

                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Número de cédula</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="20" name="cedula" id="cedula">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>

                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Formación profesional</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="120" name="fprof" id="fprof">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>

                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Vigencia</label>
                            <input type="date" class="form-control form-control-solid form-control-lg" name="vigencia" id="vigencia">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>

                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Tipo de identificación</label>
                            <div></div>
                            <select class="form-control" id="DOCOFICIAL" name="DOCOFICIAL">
                                <option value="">--Selecciona--</option>
                                @foreach($tipo_identificacion as $idoficial)
                                <option value="{{$idoficial->id}}">{{ $idoficial->masterdoc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Documento</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="DOCOF" name="DOCOF" accept="application/pdf">
                                <label class="custom-file-label" for="customFile">Elija archivo</label>
                                <span class="form-text text-muted">El formato del archivo debe ser (PDF) no mayor a 10 MegaBytes</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Carnet</label>
                            <div></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="CARNET" accept="application/pdf" name="CARNET">
                                <label class="custom-file-label" for="customFile">Elija archivo</label>
                                <span class="form-text text-muted">El formato del archivo debe ser (PDF) no mayor a 10 MegaBytes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label></label>
                            <label class="option">
                                <span class="option-control">
                                    <span class="radio">
                                        <input type="radio" name="manifiesto" value="1">
                                        <span></span>
                                    </span>
                                </span>
                                <span class="option-label">
                                    <span class="option-head">
                                        <span class="option-title">Acepta manifiesto.</span>
                                    </span>
                                    <span class="option-body">“Manifiesto bajo protesta de decir verdad que el documento que en este acto se envía de forma
                                        digital, es una copia fiel del original que se encuentra bajo mi exclusivo resguardo, por lo que en el
                                        momento en que me sea requerido lo exhibiere en original para su cotejo, en el entendido que, de
                                        no hacerlo, se tendrá por no exhibido oportunamente con las consecuencias legales que resulten
                                        de la normativa aplicable”.</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$tipo_prof->clave_tipo_prof}}" id="tipo_prof" name="tipo_prof">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <button type="submit" id="guardarProf" form="datosProf" name="guardarProf" class="btn btn-primary btn-lg btn-block">GUARDAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--end::Body-->
</div>

@endsection
@section('scripts')
@if (session('success'))
<script>
    setTimeout(function() {
        swal.fire('¡Aviso!', "{{session('success')}}", 'success');
    }, 1000);
</script>
@endif
@if (session('error'))
<script>
    setTimeout(function() {
        swal.fire('¡Alerta!', "{{session('error')}}", 'error');
    }, 1000);
</script>
@endif
<script src="{{ asset('js/persona/datos_prof.js') }}" type="text/javascript"></script>
@endsection