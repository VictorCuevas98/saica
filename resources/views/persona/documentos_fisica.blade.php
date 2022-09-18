<div class="form-group">
    <h3 class="mb-10 font-weight-bold text-dark">Documentos</h3>
    <div class="form-group row">
        <label class="col-4 col-form-label">
            <h4>Subir en otro momento</h4>
        </label>
        <div class="col-4">
            <span class="switch switch-outline switch-icon switch-success">
                <label>
                    <input type="checkbox" name="uploadafter">
                    <span></span>
                </label>
            </span>
        </div>
    </div>
</div>
<div id="docs" style="display: block;">
    <div class="row">
        <div class="col-xl-4">
            <div class="form-group">
                <label>Tipo de Identificación</label>
                <div></div>
                <select class="form-control" id="DOCOFICIAL" name="DOCOFICIAL">
                    <option value="">--Selecciona--</option>
                    @foreach($tipo_identificacion as $idoficial)
                    <option value="{{$idoficial->id}}">{{ $idoficial->masterdoc}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="form-group">
                <label>Documento</label>
                <div></div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="DOCOF" name="DOCOF" accept="application/pdf" required>
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
                            <span class="option-title">Acepta Manifiesto.</span>
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

</div>