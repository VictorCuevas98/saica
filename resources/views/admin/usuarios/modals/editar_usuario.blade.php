<div class="modal fade" id="mod_edit_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Editar Usuario: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>X
                </button>
            </div>
            <div class="modal-body" id="modal_content">
                <div id="message_usuario_edit"></div>

                <form class="form" id="editarUsuarioEnte">
                    @csrf
                    <input type="hidden" id="hashidE" name="hashidE">
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <div class="my-5">
                                <h3 class="text-dark font-weight-bold mb-10">Información personal:</h3>
                                <div class="form-group row">
                                    <label for="curpE" class="col-3">CURP</label>
                                    <div class="col-9">
                                        <input readonly class="form-control form-control-solid" type="text" id="curpE" name="curpE" maxlength="18">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rfcE" class="col-3">RFC</label>
                                    <div class="col-9">
                                        <input readonly class="form-control form-control-solid" type="text" id="rfcE" name="rfcE" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="homoclaveE" class="col-3">Homoclave</label>
                                    <div class="col-9">
                                        <input readonly class="form-control form-control-solid" type="text" id="homoclaveE" name="homoclaveE" maxlength="3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nombreE" class="col-3">Nombre(s)</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="nombreE" name="nombreE" maxlength="60">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="paternoE" class="col-3">Apellido Paterno</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="paternoE" name="paternoE" maxlength="60">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="maternoE" class="col-3">Apellido Materno</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="maternoE" name="maternoE" maxlength="60">
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="my-5">
                                <h3 class="text-dark font-weight-bold mb-10">Contacto:</h3>
                                <div class="form-group row">
                                    <label for="correoE" class="col-3">Correo electrónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="correoE" name="correoE">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmacorreoE" class="col-3">Confirmar correo electrónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="confirmacorreoE" name="confirmacorreoE">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefonoE" class="col-3">Número telefónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="telefonoE" name="telefonoE" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmatelefonoE" class="col-3">Confirmar número telefónico</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-solid" type="text" id="confirmatelefonoE" name="confirmatelefonoE" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="my-52" style="display: none">
                                <h3 class="text-dark font-weight-bold mb-10">Permisos:</h3>
                                <div class="form-group row">
                                    <label for="perfilE" class="col-3">Tipo de Perfil</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-solid" id="perfilE" name="perfilE">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-10"></div>
                            <div class="my-52">
                                <h3 class="text-dark font-weight-bold mb-10">Datos laborales:</h3>
                                <div class="form-group row">
                                    <label for="dependenciaE" class="col-3">Dependencia</label>
                                    <div class="col-9">
                                        <input readonly class="form-control form-control-solid" type="text" id="dependenciaE" name="dependenciaE" maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionAreaAdscripcionE">
                                    <label for="areaE" class="col-3">Área</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid"  id="areaE" name="areaE">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionTipoContratacionE">
                                    <label for="contratacionE" class="col-3">Tipo de contratación</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid"  id="contratacionE" name="contratacionE" onchange="buscarPuestosE(this.value)">
                                            <option disabled selected>Selecciona el tipo de contratación</option>
                                            <option value="0">DESCONOCIDO</option>
                                            <option value="B">BASE</option>
                                            <option value="H">HONORARIOS</option>
                                            <option value="E">ESTRUCTURA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="seccionCargoE">
                                    <label for="cargoE" class="col-3">Cargo</label>
                                    <div class="col-9">
                                        <select class="select2 form-control form-control-solid" id="cargoE" name="cargoE">
                                        </select>
                                        <label><a href="javascript:void(0)" onclick="agregarPuestoE()">¿No Encuentras el puesto? ¡Click Aqui!</a></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" id="editarUsuario">
                            Editar
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
