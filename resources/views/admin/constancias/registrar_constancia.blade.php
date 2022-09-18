{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
    <div class="d-flex flex-column-fluid">
        <br>
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">
                                    <span class="card-label font-weight-bolder text-dark">Registro de constancia</span>
                                    <span class="d-block text-muted pt-2 font-size-sm">registro de hora y aceptación de constancia por evento</span></h3>
                            </div>
                            <div>
                                <a href="{{url('admin/constancias')}}" class="btn btn-success btn-sm float-right">Regresar</a>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <div class="card-header">
                                <div class="float-right">
                                   <h3>DURACIÓN DEL EVENTO: {{$total}} Minutos</h3>
                                    <br>
                                </div>
                                <br>
                            </div>
                            <br>
                                <table class="table datatable-bordered datatable-head-custom">
                                    <thead>
                                    <tr>
                                        <th class="text-left p-0">#</th>
                                        <th class="text-left p-0">NOMBRE</th>
                                        <th class="text-center p-0">CODIGO DE ASISTENCIA</th>
                                        <th class="text-center p-0">INGRESO PLATAFORMA</th>
                                        <th class="text-center p-0">DURACIÓN (MIN)</th>
                                        <th class="text-center p-0">CONSTANCIA</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($asistencias as $key => $asistencia)
                                            <tr class="align-content-center">
                                                <td>{{$key+1}}</td>
                                                <td class="text-center p-0">{{$asistencia->participante->persona->nombre}} {{$asistencia->participante->persona->primer_ap}} {{$asistencia->participante->persona->segundo_ap}}</td>
                                                <td class="text-center p-0">
                                                    @if($asistencia->asistencia == true)
                                                        <strong>SI</strong>
                                                    @elseif($asistencia->asistencia == false)
                                                        NO
                                                    @else
                                                        S/D
                                                    @endif
                                                </td>
                                                <td class="text-center p-0">@if($asistencia->ingreso == true)
                                                        <strong>SI</strong>
                                                    @elseif($asistencia->ingreso == false)
                                                        NO
                                                    @else
                                                        S/D
                                                    @endif</td>
                                                <td class="text-center p-0"><input value="{{$asistencia->tiempo_asistencia}}" class="col-4" maxlength="3" max="999" onkeypress="return isNumber(event)" onkeyup="guardarValor({{$asistencia->id}}, this.value, {{$key}}, {{$asistencia->asistencia}})"></td>
                                                <td class="text-center p-0"><input id="checkbox_{{$asistencia->id}}" {{$asistencia->constancia? 'checked': ''}} {{$asistencia->tiempo_asistencia && $asistencia->asistencia? '':'disabled'}} type="checkbox" onchange="guardarCheck({{$asistencia->id}}, this.checked,  {{$key}})"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <!--end: Datatable-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
            <!--end::Row-->
            <!--begin::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
@section('scripts')
    <script type="application/javascript">
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function guardarValor(id, valor, registro, asistencia){
            var asis = typeof asistencia == "undefined"? false : true;
            //console.log(asis);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url + "admin/constancias/guardar/duracion",
                type: 'POST',
                data: {
                    asistenciaId: id,
                    duracion: valor
                },
                dataType: 'json',
                success: function(respuesta) {
                   // console.log(respuesta);
                    if(respuesta.codigo != 200){
                        swal.fire('¡ESPERA!', 'La duración del registro ['+registro+'] no se guardo. Intentalo de nuevo', 'error');
                    } else{
                        if(valor == ''){
                            $('#checkbox_'+id).attr('disabled', true);
                            $('#checkbox_'+id).prop('checked', false).change();
                        }else if(asis && valor != ''){
                            $('#checkbox_'+id).attr('disabled', false);
                        }
                    }
                },
                fail: function (error){
                    console.log(error)
                    if(error.codigo != 200){
                        swal.fire('¡ESPERA!', 'La duración del registro ['+registro+'] no se guardo. Intentalo de nuevo', 'error');
                    }
                }
            });
        }
        function guardarCheck(id, valor, registro){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url + "admin/constancias/guardar/check",
                type: 'POST',
                data: {
                    asistenciaId: id,
                    check: valor
                },
                dataType: 'json',
                success: function(respuesta) {
                    console.log(respuesta);
                    if(respuesta.codigo != 200){
                        swal.fire('¡ESPERA!', 'El check de la constancia del registro ['+registro+'] no se guardo. Intentalo de nuevo', 'error');
                    }
                },
                fail: function (error){
                    console.log(error)
                    if(error.codigo != 200){
                        swal.fire('¡ESPERA!', 'La duración del registro ['+registro+'] no se guardo. Intentalo de nuevo', 'error');
                    }
                }
            });
        }
    </script>
    <!--<script src="{{URL::asset('js/admin/usuarios/control_usuarios.js')}}" type="application/javascript"></script>-->
@endsection
