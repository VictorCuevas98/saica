<!-- sample modal content -->
<div id="busca-proveedor-modal" class="modal animated bounceInDown " tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Busqueda de proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form>
                @method('POST')
                @csrf
                <div class="modal-body">
                        <!--begin::Input-->
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>RFC</label>
                                    <input type="text" class="form-control form-control-lg"
                                        aria-label="botón para buscar el rfc en el padrón de proveedores"
                                        name="rfc_del_proveedor" id="rfc_del_proveedor" value="CSI130326HD1" id="" />
                                    
                                        <button type="button" class="btn btn-primary" onclick="buscaProveedor()"
                                            id="btn-proveedor-search">
                                            Buscar RFC
                                        </button>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <!--end::Input-->
                        <div class="form-group row">

                            <div class="col-xl-6">
                                <!--begin::Select-->
                                <div class="form-group">
                                    <label>Tipo de persona</label>
                                    <select name="tipo_de_persona"
                                        class="form-control form-control-solid form-control-lg" disabled
                                        id="tipo_de_persona">
                                        <option value="">Selecionar...</option>
                                        <option value="F">Fisica</option>
                                        <option value="M">Moral</option>
                                    </select>
                                </div>
                                <!--end::Select-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Razón social</label>
                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                        name="razon_social_del_proveedor" id="razon_social_del_proveedor" placeholder=""
                                        value="" disabled />
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--begin::Input-->
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Representante legal:</label>
                                <input type="text" class="form-control form-control-solid form-control-lg"
                                    name="representante_del_proveedor" id="representante_del_proveedor" placeholder=""
                                    value="" disabled />
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <!--end::Input-->
                        <div class="form-group row persona_fisica_content" style="display: none;">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                        name="nombres" placeholder="" id="nombres" value="" disabled />
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Primer apellido</label>
                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                        name="primer_apellido" id="primer_apellido" placeholder="" value="" disabled />
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="form-group row persona_fisica_content" style="display: none;">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Segundo apellido</label>
                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                        name="segundo_apellido" id="segundo_apellido" placeholder="" value=""
                                        disabled />
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button id="add-btn" onclick="seleccionaProveedor()" type="button"
                        class="btn btn-success">Seleccionar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
