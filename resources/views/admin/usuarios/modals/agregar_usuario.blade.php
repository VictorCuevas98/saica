<div class="modal fade" id="modal_agregar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo usuario: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>X
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="error_usuario_add"></div>
                <form class="form" id="guardaUsuarioEnte">
                    @csrf
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">
                                <h3 class="text-dark font-weight-bold mb-10">Información personal:</h3>
                                <div class="form-group row noMostrar">
                                    <label for="curp" class="col-3">CURP</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="curp" name="curp" maxlength="18" onchange="this.value=this.value.toUpperCase()" onkeyup="this.value=this.value.toUpperCase()">
                                    </div>
                                    <span id="spinerCurp" style="display: none" class="spinner spinner-success"></span>
                                </div>
                                <div class="form-group row">
                                    <label for="rfc" class="col-3">RFC</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="rfc" name="rfc" maxlength="10" onchange="this.value=this.value.toUpperCase()" onkeyup="this.value=this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="homoclave" class="col-3">Homoclave</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="homoclave" name="homoclave" maxlength="3" onchange="this.value=this.value.toUpperCase()" onkeyup="this.value=this.value.toUpperCase()">
                                    </div>
                                    <span id="spinerRFC" style="display: none" class="spinner spinner-success"></span>
                                </div>
                                <div class="form-group row noMostrar">
                                    <label for="nombre" class="col-3">Nombre(s)</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="nombre" name="nombre" maxlength="60">
                                    </div>
                                </div>
                                <div class="form-group row noMostrar">
                                    <label for="paterno" class="col-3">Apellido Paterno</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="paterno" name="paterno" maxlength="60">
                                    </div>
                                </div>
                                <div class="form-group row noMostrar">
                                    <label for="materno" class="col-3">Apellido Materno</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="materno" name="materno" maxlength="60">
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="my-5 noMostrar">
                                <h3 class="text-dark font-weight-bold mb-10">Contacto:</h3>
                                <div class="form-group row ">
                                    <label for="correo" class="col-3">Correo electrónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="correo" name="correo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmacorreo" class="col-3">Confirmar correo electrónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="confirmacorreo" name="confirmacorreo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefono" class="col-3">Número telefónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="telefono" name="telefono" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmatelefono" class="col-3">Confirmar número telefónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="confirmatelefono" name="confirmatelefono" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div id="seccionPermisos" class="my-52">
                                <h3 class="text-dark font-weight-bold mb-10">Permisos:</h3>
                                <div class="form-group row">
                                    <label for="perfil" class="col-3">Tipo de Perfil</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-solid" id="perfil" name="perfil">
                                            <option value="">--Selecciona--</option>

                                            @foreach($cat_roles as $roles)

                                                <option value="{{$roles->id}}">{{$roles->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-10 noMostrar"></div>
                            <div class="my-52 noMostrar">
                                <h3 class="text-dark font-weight-bold mb-10">Datos laborales:</h3>
                                <div class="form-group row">
                                    <label for="dependencia" class="col-3">Dependencia</label>
                                    <div class="col-9">
                                        <input readonly class="form-control form-control-solid" type="text" id="dependencia" name="dependencia" maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionAreaAdscripcion" style="display: none;">
                                    <label for="area" class="col-3">Área</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid"  id="area" name="area">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionTipoContratacion">
                                    <label for="contratacion" class="col-3">Tipo de contratación</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid"  id="contratacion" name="contratacion" onchange="buscarPuestos(this.value)">
                                            <option disabled selected>Selecciona el tipo de contratación</option>
                                            <option value="0">DESCONOCIDO</option>
                                            <option value="B">BASE</option>
                                            <option value="H">HONORARIOS</option>
                                            <option value="E">ESTRUCTURA</option>
                                        </select>
                                        <span id="spinerContratacion" style="display: none" class="spinner spinner-success"></span>
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionCargo" style="display: none;">
                                    <label for="cargo" class="col-3">Cargo</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid" id="cargo" name="cargo">
                                        </select>
                                        <label><a href="javascript:void(0)" onclick="agregarPuesto()">¿No Encuentras el puesto? ¡Click Aqui!</a></label>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="botonContinuar" onclick="continuarRegistro()">
                            Continuar
                        </button>
                        <button type="submit" class="btn btn-primary" id="botonSubmit">
                            Agregar
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
