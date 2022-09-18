$('#solicita').select2();
$(document).ready(function() {
    $('#tablePedidosRealizados').DataTable( {
        "language": {
            "url": url + "/js/dataTable/Spanish.json",
        }
    } );
} );

$(document).ready(function() {
    $('#tablePedidosRecibidos').DataTable( {
        "language": {
            "url": url + "/js/dataTable/Spanish.json",
        }
    } );
} );

$(document).ready(function() {
    $('#tableSeguimientoPedidoRecibido').DataTable( {
        "language": {
            "url": url + "/js/dataTable/Spanish.json",
        }
    } );
} );

$(document).ready(function() {
    $('#tablePedidosSeguimientoRealizado').DataTable( {
        "language": {
            "url": url + "/js/dataTable/Spanish.json",
        }
    } );
} );

$(document).ready(function() {
    $("#busqueda_fecha").click(function() {
      $("#div-1").hide();
      $("#div-2").show();

    });

    $("#busqueda_pedido").click(function() {
      $("#div-1").show();
      $("#div-2").hide();

    });
});


$(document).ready(function() {
    $("#botonBuscar").click(function(){
        $('#tablaPedidosRealizados').toggle(1000,function() {

        });
        $('#tablaPedidosRecibidos').toggle(1000,function() {

        });
    });
});

$(document).ready(function() {
    $("#botonBuscar_").click(function(){
        $('#tablaPedidosRealizados').toggle(1000,function() {

        });
        $('#tablaPedidosRecibidos').toggle(1000,function() {

        });
    });
});