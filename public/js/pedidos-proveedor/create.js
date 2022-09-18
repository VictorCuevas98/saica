var proveedor;
var resultProveedor;
var proveedorValido = false;
var selectedProveedor;
var contrato;
var adquisicion = null;
var proveedorManual = false;
const seleccionaProveedor = () =>{
    if(proveedorValido){
        proveedor = resultProveedor;
        switch (proveedor.tipo_persona.toLowerCase()) {
            case 'fisica':
                $('#proveedorInput').val(`${proveedor.nombre} ${proveedor.paterno} ${proveedor.materno}`);
                break;
            case 'moral':
                $('#proveedorInput').val(proveedor.razon_social);
                break;
            default:
                break;
        }
        $('#busca-proveedor-modal').modal('hide');
    }else
        swal.fire("Mensaje!","Debes seleccionar un proveedor existente","warning");
}

//Para buscar la existencia del contrato
const buscaContrato = () =>{
    $.ajax({
        type: 'GET',
        url: url + `/pedidos-proveedor/valida-contrato?contrato=${$('#contratoInput').val()}&oficio_adjudicacion=${$('#adjudicacionInput').val()}`,
        beforeSend: function () {
            swal.fire({
                title: 'Espere...',
                html: 'Validando datos',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });
        },
        success: function (response) {
            handleContratoValidResponse(response);
            swal.close();
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
            $('#proveedor').hide();
        }
    });
};

const handleContratoValidResponse = (response) =>{
    disabledProveedorFields();
    clearProveedorFields();
    selectedProveedor = response.proveedor;
    proveedorValido = selectedProveedor != null;
    contrato = response.contrato;
    adquisicion = response.adquisicion;
    document.getElementById("rfc_del_proveedor").disabled = selectedProveedor != null
    if(selectedProveedor == null){
        $('#btn-proveedor-search').show();
        $('#rfc_del_proveedor').val('');
    }else{
        $('#rfc_del_proveedor').val(selectedProveedor.rfc)
        switch (selectedProveedor.tipo_persona.toLowerCase()) {
            case 'f':
                $('#razon_social_del_proveedor').val("--");
                $('#nombres').val(selectedProveedor.nombre);
                $('#primer_apellido').val(selectedProveedor.paterno);
                $('#segundo_apellido').val(res.data.materno);
                $('#tipo_de_persona option[value=M]').prop('selected',null);
                $('#tipo_de_persona option[value=F]').prop('selected','selected');
                $('#representante_del_proveedor').val('--');
                $(".persona_fisica_content").show();
                break;
            case 'm':
                $('#razon_social_del_proveedor').val(selectedProveedor.razon_social);
                $('#nombres').val('--');
                $('#primer_apellido').val('--');
                $('#segundo_apellido').val('--');
                $('#tipo_de_persona option[value=F]').prop('selected',null);
                $('#tipo_de_persona option[value=M]').prop('selected','selected');
                $('#representante_del_proveedor').val('--');
                $(".persona_fisica_content").hide();
                break;
            default:
                //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                break;
            }
        $('#btn-proveedor-search').hide();
    }
    goNext();
};

const actualizaProveedor = () => {
    if(proveedorManual){
        var data = {
            rfc: $('#rfc_del_proveedor').val(),
            tipo_persona: $('#tipo_de_persona').val(),
            representante_legal: $('#representante_del_proveedor').val(),
            nombres: $('#nombres').val(),
            primer_apellido: $('#primer_apellido').val(),
            segundo_apellido: $('#segundo_apellido').val(),
            razon_social_del_proveedor: $('#razon_social_del_proveedor').val()
        };
        actualizaProveedorRequest(data,'manual');
    }else
        if(adquisicion != null){
            if(adquisicion.id_proveedor == null){
                actualizaProveedorRequest(null,'service');
            }else{
                if(selectedProveedor != (null || undefined) && resultProveedor != (null || undefined))
                    if(resultProveedor.rfc != selectedProveedor.rfc){
                        actualizaProveedorRequest(null,'service');
                    }else{
                        goNext();
                    }
                else
                    goNext();
            }
        }else{
            console.log('adquisicion= ' + adquisicion);
            console.log(selectedProveedor)
            console.log(resultProveedor)
            if(resultProveedor != (null || undefined))
                actualizaProveedorRequest(null,'service');
        }
};

const actualizaProveedorRequest = (data,tipo) =>{
    var finalUrl;
    if(contrato != null && data == null){
        finalUrl = url + `/pedidos-proveedor/contrato/${contrato.id}/update-proveedor`;
        data = {
            proveedor: $('#rfc_del_proveedor').val(),
            tipo: tipo,
            datos: data
        }
    }else{
        finalUrl = url + `/pedidos-proveedor/contrato/update-proveedor`
        data = {
            proveedor: $('#rfc_del_proveedor').val(),
            tipo: tipo,
            datos: data,
            contrato : $('#contratoInput').val(),
            oficio_adjudicacion : $('#adjudicacionInput').val()
        }
    }
    $.ajax({
        type: 'PUT',
        url: finalUrl,
        data:{
            proveedor: $('#rfc_del_proveedor').val(),
            tipo: tipo,
            datos: data
        },
        beforeSend: function () {
            swal.fire({
                title: 'Espere...',
                html: 'Procesando',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });
        },
        success: function (response) {
            swal.close();
            if(response.contrato != (null || undefined) && response.adquisicion != (null || undefined)){
                adquisicion = response.adquisicion;
                contrato = response.contrato;
            }
            goNext();
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
        }
    });
};

const buscaProveedor = () => {
    var rfc_proveedor = $("#rfc_del_proveedor").val();
    ws_proveedorBuscar(rfc_proveedor,buscaProveedorCallback);
};

const buscaProveedorCallback = (res) => {
    if(res.error.code ==0){
        if(typeof(res.data) =='undefined'){
            swal.fire("Lo lamento!","El proveedor no fue encontrado capture sus datos <strong>Manualmente</strong>","warning");
            clearProveedorFields();
            enableProveedorFields();
            proveedorValido = false;
            resultProveedor = null;
            proveedorManual = true;
        }else{
            //TODO::SE ENCONTRÓ LLENAR LOS CAMPOS
            proveedorManual = false;
            proveedorValido = true;
            resultProveedor = res.data;
            swal.fire("Exito","Proveedor encontrado","success");
            //disabledProveedorFields();
            switch (resultProveedor.tipo_persona.toLowerCase()) {
            case 'fisica':
                $('#razon_social_del_proveedor').val("--");
                $('#nombres').val(resultProveedor.nombre);
                $('#primer_apellido').val(resultProveedor.paterno);
                $('#segundo_apellido').val(resultProveedor.materno);
                $('#tipo_de_persona option[value=M]').prop('selected',null);
                $('#tipo_de_persona option[value=F]').prop('selected','selected');
                $('#representante_del_proveedor').val('--');
                $(".persona_fisica_content").show();
                break;
            case 'moral':
                //console.log(res.data.tipo_persona.toLowerCase());
                $('#razon_social_del_proveedor').val(resultProveedor.razon_social);
                $('#nombres').val('--');
                $('#primer_apellido').val('--');
                $('#segundo_apellido').val('--');
                $('#tipo_de_persona option[value=F]').prop('selected',null);
                $('#tipo_de_persona option[value=M]').prop('selected','selected');
                $('#representante_del_proveedor').val('--');
                $(".persona_fisica_content").hide();
                break;
            default:
                //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                break;
            }
        }
    }else{//ERROR AL CONSUMIR EL WS
        //TODO::si existe un error entonces abrir los campos para captura
        swal.fire("Lo lamento!","El servicio de busqueda del proveedor no esta habilitado, así que deberás agregar los datos del proveedor <strong>Manualmente</strong>","warning");
        proveedorManual = true;
        clearProveedorFields();
        enableProveedorFields();
        proveedorValido = false;
        resultProveedor = null;
    }
};



const selectTipoPersona = document.getElementById('tipo_de_persona');

selectTipoPersona.addEventListener('change', (event) => {
    switch (event.target.value) {
        case 'F':
          $(".persona_fisica_content").show();
          break;
        case 'M':
          $(".persona_fisica_content").hide();
          $('#nombres').val("");
          $('#primer_apellido').val("");
          $('#segundo_apellido').val("");
          break;
        default:
          //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
          break;
      }
});


$("#s").on('change', () => { 
    //console.log($(this).val());
    /*
    switch ($(this).val()) {
      case 'F':
        $(".persona_fisica_content").show();
        break;
      case 'M':
        $(".persona_fisica_content").hide();
        $('#nombres').val("");
        $('#primer_apellido').val("");
        $('#segundo_apellido').val("");
        break;
      default:
        //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
        break;
    }
    */
    //_validations[1].revalidateField("razon_social_del_proveedor");
    //_validations[1].revalidateField("nombres");
    //_validations[1].revalidateField("primer_apellido");
    //_validations[1].revalidateField("segundo_apellido");
});

const clearProveedorFields = () => {
    $('#razon_social_del_proveedor').val("");
    $('#nombres').val("");
    $('#primer_apellido').val("");
    $('#segundo_apellido').val("");
    $('#tipo_de_persona option[value=M]').prop('selected',null);
    $('#tipo_de_persona option[value=F]').prop('selected',null);
    $(".persona_fisica_content").hide();
    $('#representante_del_proveedor').val("");
    
};

const  enableProveedorFields = () => {
    $('#razon_social_del_proveedor').attr('disabled', false);
    $('#nombres').attr('disabled', false);
    $('#primer_apellido').attr('disabled', false);
    $('#segundo_apellido').attr('disabled', false);
    $('#tipo_de_persona').attr('disabled', false);
    $("#representante_del_proveedor").attr('disabled', false);
};

const disabledProveedorFields = () => {
    $('#razon_social_del_proveedor').attr('disabled', true);
    $('#nombres').attr('disabled', true);
    $('#primer_apellido').attr('disabled', true);
    $('#segundo_apellido').attr('disabled', true);
    $('#tipo_de_persona').attr('disabled', true);
    $("#representante_del_proveedor").attr('disabled', true);
};

const generaPedido = () =>{
    var request = {
        solicitudInput: $('#solicitudInput').val(),
        entregaInput: $('#entregaInput').val(),
        folio: $('#folio').val(),
        contratoInput: $('#contratoInput').val()
    }
    if(request.solicitudInput.length <= 0 || request.entregaInput.length <= 0  || request.folio.length <= 0){
        var err = `${request.solicitudInput.length <= 0 ? '"Fecha de solicitud"' : ''} ${request.entregaInput.length <= 0 ? '"Fecha de entrega"' : ''} ${request.folio.length <= 0 ? '"Folio de pedido"' : ''}`
        swal.fire('Campos requeridos', `${err}`);
        return
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        type: 'POST',
        url: `${url}/pedidos-proveedor/create`,
        data: request,
        beforeSend: function () {
            swal.fire({
                title: 'Espere...',
                html: 'Generando',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });
        },
        success: function (response) {
            swal.close();
            swal.fire('Mensaje', response.message);
            location.href = `${url}/pedidos-proveedor/${response.id}/articles-edit`
            
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
        }
    });
};

