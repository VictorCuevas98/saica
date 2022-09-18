var currentArticulo;
var currentEditId;
const buscaModalArtmed = () =>{
    currentArticulo = null;
    currentEditId = null;
    document.getElementById("cantidadInput").value = 0;
    document.getElementById("almacenInput").value = 0;
    getSearchModal(function(articulo){
        var current = articulos.find(element => element.clave_artmed == articulo.clave);
        if(current == undefined || current == null){
            $('#botonModalRow').show();
            currentArticulo = articulo;
            currentArticulo.clave_artmed = articulo.clave;
            $('#modalTitle').html('Agregar articulo');
            $('#articuloLabel').html(articulo.artmed);
            consultaContratoAbiertoDetalle();
        }else
            swal.fire('Mensaje','El artículo ya se encuentra agregado, puedes editar cantidad o eliminarlo del pedido','warning');
    });
};

const buscaModalArtmed2 = () => {
    $('#btn-close-cantidad-precio').trigger('click');
    buscaModalArtmed();
};

const consultaContratoAbiertoDetalle = () => {
    var articuloId;
    if(currentEditId == null)
        articuloId = currentArticulo.id;
    else
        articuloId = currentEditId;
    $.ajax({
        type: 'GET',
        url: url + `/pedidos-proveedor/${$('#pedidoId').val()}/${articuloId}`,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            /*swal.fire({
                title: 'Espere...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });*/
        },
        success: function (response) {
            //swal.close();
            abreModalCantidadPrecio(response);
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
        }
    });
};

const closeCantidadPrecioModal = () => {
    $('#cantidad-precio-modal').modal('hide');
}

const abreModalCantidadPrecio = (pedidoDetalle) => {
    currentArticulo = pedidoDetalle.articulo;
    $('#btn-open-modal').trigger('click');
};

const agregarArticulo = () => {
    var cantidad = parseInt(document.getElementById("cantidadInput").value);
    var idAlmacen = parseInt(document.getElementById("almacenInput").value);
    //var precio = parseFloat(document.getElementById("precioInput").value);
    if(!Number.isInteger(cantidad) || idAlmacen == 0){
        swal.fire('Mensaje',`Debes seleccionar una cantidar y almacen validos!`,'warning');
    }else{
        var current = articulos.find(element => element.clave_artmed == currentArticulo.clave_artmed);
        var action = "add";
        if(current != null || current != undefined){
            action = "update";
            current.cantidad = cantidad;
            current.id_almacen = idAlmacen;
            //current.precio = precio;
        }else
            current = {
                "artmed": currentArticulo.artmed,
                "clave_artmed": currentArticulo.clave_artmed,
                "id": currentArticulo.id,
                "unidad_medida": currentArticulo.unidad_medida,
                "cantidad": cantidad,
                "id_almacen": idAlmacen
                //"precio": precio
            };
        updateDetailRequest(current,action);
    }
};

const updateDetailRequest = (articulo,action) =>{
    $.ajax({
        type: 'POST',
        url: url + `/pedidos-proveedor/${$('#pedidoId').val()}/update-detail`,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            'action': action,
            'articulo':articulo
        },
        beforeSend: function () {
            swal.fire({
                title: 'Espere...',
                html:  action == 'delete' ? 'Quitando' : 'Agregando',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });
        },
        success: function (response) {
            swal.close();
            closeCantidadPrecioModal();
            if(action == 'add' || action == 'update'){
                //articulo.id = action == 'update' ? currentEditId : articulo.id;
                addRowToTable(articulo);
            }else
                deleteRowTable(articulo.clave_artmed);
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
        }
    });
};

const addRowToTable = (articulo) => {
    var current = articulos.find(element => element.clave_artmed == articulo.clave_artmed);
    var currentAlmacen = almacenes.find(element => element.id == articulo.id_almacen);
    var row = "";
    if(current != null || current != undefined){
        document.getElementById(`articulo-${articulo.clave_artmed}-cantidad`).innerHTML = articulo.cantidad;
        document.getElementById(`articulo-${articulo.clave_artmed}-almacen`).innerHTML = currentAlmacen.almacen;
        //document.getElementById(`articulo-${articulo.clave_artmed}-precio`).innerHTML = articulo.precio;
        articulos.splice(articulos.indexOf(current),1);
    }else{
        row = '<tr id="articulo-'+articulo.clave_artmed+'">'+
            '<td class="text-center">'+articulo.clave_artmed+'</td>'+
            '<td class="text-center">'+articulo.artmed+'</td>'+
            `<td id="articulo-${articulo.clave_artmed}-cantidad" class="text-center">${articulo.cantidad}</td>`+
            `<td id="articulo-${articulo.clave_artmed}-almacen" class="text-center">${currentAlmacen.almacen}</td>`+
            //`<td id="articulo-${articulo.clave_artmed}-precio" class="text-center">${articulo.precio}</td>`+
            '<td class="text-center">'+
            '<button title="editar" class="btn btn-sm btn-clean btn-icon" onclick="editArticle(\''+articulo.id+'\',\''+articulo.cantidad+'\',\''+articulo.clave_artmed+'\')"><i class="fas fa-edit"></i></button>\
            <button title="eliminar" type="submit" class="btn btn-sm btn-clean btn-icon" onclick="deleteRow(\''+articulo.clave_artmed+'\')"><i class="far fa-trash-alt"></i></button>'
            //'<a class="btn btn-icon btn-light-warning" onclick="editArticle(\''+articulo.id+'\',\''+articulo.cantidad+'\')"><i class="fa fa-edit"></i></a>'+
            //'<a class="btn btn-icon btn-light-danger" onclick="deleteRow(\''+articulo.clave_artmed+'\')"><i class="fa fa-trash"></i></a>'+
            '</td>'+
        '</tr>';
        $('#tbody-productos').append(row);
    }
    articulos.push(articulo);
};

const editArticle = (id,cantidad,clave_artmed) => {
    $('#botonModalRow').hide();
    currentEditId = id;
    //document.getElementById("cantidadInput").value = cantidad
    $('#modalTitle').html('Editar articulo');
    var current = articulos.find(element => element.clave_artmed == clave_artmed);
    $("#cantidadInput").val(cantidad);
    $("#almacenInput").val(`${current.id_almacen}`);
    //document.getElementById("almacenInput").value = `${current.id_almacen}`
    $('#articuloLabel').html(current.artmed);
    consultaContratoAbiertoDetalle();
};

const deleteRow = (clave) => {
    var current = articulos.find(element => element.clave_artmed == clave);
    if(current != null || current != undefined){
        updateDetailRequest(current,'delete');
    }
};

const deleteRowTable = (clave) => {
    var current = articulos.find(element => element.clave_artmed == clave);
    if(current != null || current != undefined){
        articulos.splice(articulos.indexOf(current),1);
        var id ='articulo-'+clave;
        var elem = document.getElementById(id);
        elem.remove();
    }
}

const finalizaPedido = () =>{
    if(articulos.length == 0){
        swal.fire('Mensaje', 'No puedes finalizar un pedido sin artículos.');
        return 
    }
    $.ajax({
        type: 'POST',
        url: url + `/pedidos-proveedor/${$('#pedidoId').val()}/finish`,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            swal.fire({
                title: 'Espere...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    swal.showLoading()
                },
            });
        },
        success: function (response) {
            swal.close();
            swal.fire('Mensaje', response.message);
            location.reload();
            $('#footerDiv').html('')
            $('#buscaDiv').html('')
        },
        error: function (error) {
            swal.fire('Mensaje', error.responseJSON?.message == null ? 'Algo salio mal!' : error.responseJSON?.message);
        }
    });
};