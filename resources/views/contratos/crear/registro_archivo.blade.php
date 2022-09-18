@extends('contratos.crear.registro_layout')
@section('contrato')
<!--
            <div class="fallback">
                <input type="file" name="file" multiple/>
            </div>

-->
    <div class="content-wizard" id="tk_tab_wiz_4">
        <div class="mb-7" id="opcion-firma">
            <input type="button" class="btn btn-primary mr-4" value="Firma Electrónica">
            <input type="button" class="btn btn-primary " value="Firma Autógrafa" id="btn-firma-autografa">
        </div>
        <div style="display: none" id="firma-autografa">
            <input type="text" id="id_contrato_archivo" value="{{$id ?? ''}}" hidden>
            <input type="text" id="documento_seccion_contrato" data-filename="{{$documento->filename ?? ''}}" data-real-path="{{$documento->real_path ?? ''}}" data-download-path="{{$documento->download_path ?? ''}}" hidden>
            <form action="{{route('contratos.store.file', $id)}}" class="dropzone" id="dropzone-contratos-firma" method="post">
                @csrf
                <div class="dz-message" style="height:200px;">
                    Suelta tu archivo aquí
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a id="btn-wiz-4-back" class="btn btn-default backBtnW">Regresar</a>
            <input type="button" id="btn-wiz-4" class="btn btn-success nextBtnW"
                   value="Terminar">
        </div>
    </div>

@endsection
