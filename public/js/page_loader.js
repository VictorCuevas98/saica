function preloaderShow(mensaje){
    $(".modal-body #modal_spinner_mesage").html(mensaje);
    $("#modal_spiner").modal("show"); 
}

function preloaderHide(){
    $("#modal_spiner").modal("hide"); 
}

function pageloader_in(speed,mensaje){
    $(".page-loader" ).fadeIn( speed, function() {
        $("#pageloader_spinner_mesage").html(mensaje);
    });
}

function pageloader_out(speed){
    $(".page-loader" ).fadeOut(speed);
}