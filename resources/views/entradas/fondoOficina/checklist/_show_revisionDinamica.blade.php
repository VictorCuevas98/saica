<table class="table table-bordered table-striped">
    <thead>
        <th class="">Cumple:</th>
        <th class="" colspan="3">Revisión:</th>
    </thead>
    <tbody>
        @php
            $respuestas = $entrada->entradaAdquisicion->respuestasRevision()
            ->whereHas('pregunta', function ($query) use($catTipoRev){
                $query->where('id_tipo_revision', $catTipoRev->id);
            })->get();
        @endphp
        @foreach($respuestas as $respuesta)
        <tr>
            <td class="">
                
                @if($respuesta->respuesta)
                    <span class="label label-success label-pill label-inline mr-2">Si</span>
                @else
                    <span class="label label-danger label-pill label-inline mr-2">No</span>
                @endif
            </td>
            <td class="" colspan="3">{{$respuesta->pregunta->pregunta}}</td>
        </tr>
        @endforeach
    </tbody>
</table>