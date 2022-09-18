<div class="form-group">
    <h3 class="mb-10 font-weight-bold text-dark">Domicilio Fiscal</h3>
</div>
<div class="row">
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Código postal</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" name="cpostal_fiscal" id="cpostal_fiscal" required onchange="buscar_cp();">
            <span class="form-text text-muted">Este campo es obligatorio.</span>

        </div>
        <!--end::Input-->
    </div>
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Entidad federativa</label>
            <select name="id_entidad_fiscal" id="id_entidad_fiscal" required class="form-control form-control-solid form-control-lg">
                <option value="">Selecciona</option>
            </select>
            <span class="form-text text-muted">Este campo es obligatorio.</span>

        </div>
        <!--end::Input-->
    </div>
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Alcaldía o Municipio</label>
            <select name="id_alcaldia_fiscal" id="id_alcaldia_fiscal" class="form-control form-control-solid form-control-lg" required>
                <option value="">Selecciona</option>
            </select>
            <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
    </div>
</div>

<div class="row">
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Colonia</label>
            <select name="id_colonia_fiscal" id="id_colonia_fiscal" class="form-control form-control-solid form-control-lg" required>
                <option value="">Selecciona</option>
            </select>
            <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
    </div>
    <div class="col-xl-8">
        <!--begin::Input-->
        <div class="form-group">
            <label>Calle</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="calle_fiscal" id="calle_fiscal" required>
            <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
    </div>
</div>
<div class="row">
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Número exterior</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="nexterior_fiscal" id="nexterior_fiscal" required>
            <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
    </div>
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Número interior</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" id="ninterior_fiscal" name="ninterior_fiscal">
        </div>
        <!--end::Input-->
    </div>
</div>
<div class="form-group">
    <h3 class="mb-10 font-weight-bold text-dark">Representante Legal</h3>
</div>
<div class="row">
    <div class="col-xl-4">
        <div class="form-group">
            <label>Nombre(s)</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="nombre_representante_legal" id="nombre_representante_legal">
        </div>
    </div>
    <div class="col-xl-4">
        <div class="form-group">
            <label>Apellido paterno</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="paterno_representante_legal" id="paterno_representante_legal">
        </div>
    </div>
    <div class="col-xl-4">
        <div class="form-group">
            <label>Apellido materno</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="200" name="materno_representante_legal" id="materno_representante_legal">
        </div>
    </div>
</div>
<div class="form-group">
    <h3 class="mb-10 font-weight-bold text-dark">Domicilio para recibir notificaciones</h3>
</div>

<div class="form-group">
    <label class="checkbox checkbox-success">
        <input type="checkbox" id="check_domicilio_notificaciones" value="1" name="check_domicilio_notificaciones">
        <div style="text-align:justify">
            Mi domicilio para recibir notificaciones es el mismo que el domicilio Fiscal.
        </div>
        <span></span>
    </label>
</div>
<div id="cont_domicilio_notificacion">
    <div class="row">
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Código postal</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" name="cpostal_notificaciones" id="cpostal_notificaciones" onchange="buscar_cp_notificaciones();" required>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Entidad federativa</label>
                <select name="id_entidad_notificaciones" id="id_entidad_notificaciones" class="form-control form-control-solid form-control-lg" required>
                    <option value="">Selecciona</option>
                </select>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Alcaldía o Municipio</label>
                <select name="id_alcaldia_notificaciones" id="id_alcaldia_notificaciones" class="form-control form-control-solid form-control-lg" required>
                    <option value="">Selecciona</option>
                </select>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Colonia</label>
                <select name="id_colonia_notificaciones" id="id_colonia_notificaciones" class="form-control form-control-solid form-control-lg" required>
                    <option value="">Selecciona</option>
                </select>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
        <div class="col-xl-8">
            <!--begin::Input-->
            <div class="form-group">
                <label>Calle</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="400" name="calle_notificaciones" id="calle_notificaciones" required>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Número exterior</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" name="nexterior_notificaciones" id="nexterior_notificaciones" required>
                <span class="form-text text-muted">Este campo es obligatorio.</span>
            </div>
            <!--end::Input-->
        </div>
        <div class="col-xl-4">
            <!--begin::Input-->
            <div class="form-group">
                <label>Número interior</label>
                <input type="text" class="form-control form-control-solid form-control-lg" maxlength="100" id="ninterior_notificaciones" name="ninterior_notificaciones">
            </div>
            <!--end::Input-->
        </div>
    </div>
</div>
<div class="form-group">
    <h3 class="mb-10 font-weight-bold text-dark">Datos de Contacto</h3>
</div>
<div class="row">
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Teléfonos</label>
            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="11" value="{{$telefono}}" name="ntelefono1" id="ntelefono1" required>
            <span class="form-text text-muted">Este campo es obligatorio.</span>
        </div>
        <!--end::Input-->
    </div>
    <div class="col-xl-4">
        <!--begin::Input-->
        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$email}}" maxlength="100" name="email" id="email">
        </div>
        <!--end::Input-->
    </div>
</div>