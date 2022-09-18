function ws_proveedorBuscar(rfc,callback){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url+"/proveedores/dataGeneral",
        type: 'POST',
        data: 'rfc='+rfc,
        dataType: "json",
        success: function(respuesta) {
            callback(respuesta);
        },
        error: function() {
            swal.fire("Mensaje!", "Ocurrio un error al buscar al proveedor, verificalo con el administrador!", "error");
            return false;
        }
    });
}