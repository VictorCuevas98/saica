<div class="row">
    @foreach($catTiposRevision as $catTipoRev)
        <div class="col-md-6">
            <h4>{{$catTipoRev->tipo_revision}}</h4>
            @include('entradas.fondoOficina.checklist._show_revisionDinamica',['catTipoRev'=>$catTipoRev,'entrada'=>$entrada])
        </div>
    @endforeach
</div>