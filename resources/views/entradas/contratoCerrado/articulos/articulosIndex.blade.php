@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">Articulos</span>
</li>
@endsection


@section('FOC_content')
<div class="row " >
    <div class="col-md-12">
        <div class="card card-custom">
         <div class="card-header">
          <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-chat-1 text-primary"></i>
                    </span>
           <h3 class="card-label">
            Mercancía relacionada
            <small>Articulos </small>
           </h3>
          </div>
                <div class="card-toolbar">
                    <a  href="#" id="btn-modal-search-artmed" class="btn btn-primary font-weight-bold btn-sm px-4 font-size-base ml-2" >Agregar Artículo</a>
                </div>
         </div>
         <div class="card-body">
            <table border="0" class="table table-bordered table-striped" id="table-FOC-articulos">
                    <thead>
                        <th class="">CLAVE</th>
                        <th class="" >UM</th>
                        <th class="" >LOTE</th>
                        <th class="" >CAN</th>
                        <th class="" >PU</th>
                        <th class="" >IVA</th>
                        <th class="" >SUBTOTAL</th>
                        <th class="" >TOTAL</th>
                        <th class="" >CADUCIDAD</th>
                        <th class="" >DESCRIPCIÓN</th>
                        <th class="" ></th>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <th class="text-right" colspan="3">TOTAL</th>
                        <th class="" >CAN</th>
                        <th class="" >-</th>
                        <th class="" >-</th>
                        <th class="" >-</th>
                        <th class="" >-</th>
                        <th class="" colspan="" ></th>
                    </tfoot>
                </table>
         </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="#" class="btn btn-secondary font-weight-bold">Cancelar</a>
                <a href="#" class="btn btn-primary font-weight-bold">Ingresar Mercancía</a>
         </div>
        </div>


    </div>
</div>


@endsection

@section('scripts')
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('js/cat_artmed/cat_artmed.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker/locales/bootstrap-datepicker.es.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/RobinHerbots-Inputmask-5.0.6-6/dist/jquery.inputmask.js')}}"></script>
<!--end::Page Scripts-->
<style type="text/css">
    .myClass{
            width: 50% !important;;
            height:700px;
        }
    .swal2-container .swal2-html-container {
        max-height: 100%;
    }
</style>
<script type="text/javascript">
// Class definition

var AddArticuloKTFormWidgetsValidation = function () {
    // Private functions
    var validator;

    var _initWidgets = function() {
        // Initialize Plugins
        
        // Select2
        /*
        $('#laboratorio').select2({
            placeholder: "Select a state",
        });
        */
        $("#cantidad").inputmask("integer");
        $("#precio_unitario").inputmask("currency");
        $("#iva").inputmask("currency");

        $('#laboratorio').on('change', function(){
            // Revalidate field
            validator.revalidateField('laboratorio');
            validator.revalidateField('cantidad');
        });



        $('.kt_datepicker').datepicker({
            todayHighlight: true,
            startDate: '-0m',
            minDate: 0,
            language: 'es',
            
            /*templates: {
                leftArrow: '<i class=\"la la-angle-left\"></i>',
                rightArrow: '<i class=\"la la-angle-right\"></i>'
            }*/
        }).on('changeDate', function(e) {
            // Revalidate field
            validator.revalidateField('caducidad');
        });

    }

    var _initValidation = function () {
        // Validation Rules
        validator = FormValidation.formValidation(
            document.getElementById('kt_form_articulo'),
            {
                fields: {
                    
                    cantidad: {
                        validators: {
                            notEmpty: {
                                message: 'Cantidad es requerida'
                            },
                            between: {
                                min: 1,
                                max: 2147483646,
                                message: 'La cantidad debe ser estar entre 1 y 2,147,483,646',
                            },
                        }
                    },
                    precio_unitario: {
                        validators: {
                            notEmpty: {
                                message: 'Precio unitario es requerido'
                            }
                        }
                    },
                    iva: {
                        validators: {
                            notEmpty: {
                                message: 'Iva es requerido'
                            }
                        }
                    },
                    laboratorio: {
                        validators: {
                            notEmpty: {
                                message: 'Laboratorio es requerido'
                            }
                        }
                    },
                    lote: {
                        validators: {
                            notEmpty: {
                                message: 'El lote es requerido'
                            }
                        }
                    },
                    laboratorio: {
                        validators: {
                            notEmpty: {
                                message: 'laboratorio es requerido'
                            }
                        }
                    },
                    caducidad: {
                        validators: {
                            notEmpty: {
                                message: 'La caducidad es requerida'
                            },

                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }

        ).on('core.form.valid', function(e) {
            
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            
            $.ajax({
                //url: "{{route('entradas.fondoOficinas.checklist.articulos.store',[$adquisicionId,$entradaId])}}",
                url : $("#kt_form_articulo").prop('action'),
                type: $('input:hidden[name="_method"]').val(),
                data: $("#kt_form_articulo").serialize(),
                dataType: "json",
                success: function(respuesta_success) {
                    datatablesDataSourceAjaxArticulos.reload();
                    closeOpenModals();
                    swal.fire("Mensaje!", "Articulo Guardado!", "success");
                },
                error: function(respuesta_error) {
                    swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!" +respuesta_error.responseText, "error");
                    return false;
                }
            });
        });
    }

    return {
        // public functions
        init: function() {
            _initWidgets();
            _initValidation();
        }
    };
}();

</script>
<script type="text/javascript">
     pageloader_in(1000,"Cargando....");
    const closeOpenModals = () =>{
        $( ".modal" ).each(function( index ) {
          $(this).modal('hide');
          //$(this).data('bs.modal', null);
        });
    };
    

    $(document).on('click', "#btn-modal-search-artmed", function() {
        closeOpenModals();
        agregarClave();
    });


    $(document).on('click', "#articulo-btn-delete", function() {
        let articuloArtmed = $(this).data('articuloArtmed')
        let articuloId = $(this).data('articuloId')
        articuloGetModalEliminar(articuloId,articuloArtmed);
    });



    function agregarClave(){
        getSearchModal(function(element){
            console.log(element);
            //AQUI VA EL CODIGO DE LA ACCION DESPUES DE DARLE CLIC A UN ARTICULO 
            //AQUI NOS REGRESA UN OBJETO QUE SE PEUDE OCUPAR
            
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                url: "{{route('entradas.fondoOficinas.checklist.articulos.create',[$adquisicionId,$entradaId])}}",
                type: 'GET',
                data: 'articulo='+JSON.stringify(element),
                dataType: "html",
                success: function(respuesta_html) {
                    var modalNuevoArticulo = respuesta_html;
                    $(modalNuevoArticulo).modal().on('shown.bs.modal', function() {
                        AddArticuloKTFormWidgetsValidation.init();
                    }).on('hidden.bs.modal', function (e) {
                        $(this).data('bs.modal', null);
                        $(this).remove();
                    });
                },
                error: function(respuesta_error) {
                    swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                    return false;
                }
            });
            var cantidad =0;
            


        });//end::getSearchModal
    
    }

    

    const articuloGetModalEliminar = (articuloId,articuloArtmed) =>{
        //pedir el modal de eliminar
        //mostrar el modal
        //ajax para eliminar 
        swal.fire({
          title: '¿Estás seguro?',
          text: "¡Estas apunto de eliminar el artículo: " + articuloArtmed +"!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: '¡Si, borralo!'
        }).then((result) => {
          if (result.value) {
            const callback = () => {
                datatablesDataSourceAjaxArticulos.reload();
                swal.fire(
                  'Eliminado!',
                  'El artículo ha sido eliminado.',
                  'success'
                );
                
            };
            articuloEliminar(articuloId,callback);
          }
        });//end swal
    }

    const articuloEliminar = (articuloId,callback) => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            url : url + "/fondoOficinas/{{$adquisicionId}}/checklist/{{$entradaId}}/articulos/"+articuloId+"", 
            type: 'DELETE',
            data: '',
            dataType: "json",
            success: function(respuesta_success) {
                callback();
            },
            error: function(respuesta_error) {
                swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                return false;
            }
        });
    }

    
    'use strict';
    var datatablesDataSourceAjaxArticulos = function() {
        var dataTableArticulos = $('#table-FOC-articulos');
       
        var initTable = function() {

            dataTableArticulos.DataTable( {
                language: {
                    url: url + '/js/dataTable/Spanish.json'
                },
                ajax : {
                    responsive: true,
                    url : url + '/fondoOficinas/{{$adquisicionId}}/checklist/{{$entradaId}}/articulos_datatable',
                    type: 'GET',
                },
                columnDefs: [
                    { targets: [3,4,5,6,7],
                        "render": function ( data, type, row, meta ) {
                          return  parseFloat(data).toLocaleString('es-MX');
                        }
                    },
                    
                    { targets: '_all', visible: true }
                ],
                columns: [
                    
                    { className: '' },
                    {  className: '' },
                    { className: ''  },
                    { className: 'sum bg-warning-o-30' },// 
                    { className: 'bg-warning-o-30'},//
                    { className: 'sum bg-success-o-10' },//
                    { className: 'sum bg-success-o-30' },//
                    { className: 'sum bg-success-o-50' },
                    { className: '' },
                    { className: '' },
                    { className: '' },

                ],

                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();
                    console.log("-------------------------------------------------------");

                    api.columns('.sum', {
                        page: 'current'
                    }).every(function() {
                    var sum = this
                        .data()
                        .reduce(function(a, b) {
                            var x = parseFloat(a) || 0;
                            var y = parseFloat(b) || 0;
                            return x + y;
                        }, 0);
                        console.log(sum); 
                        $(this.footer()).html(parseFloat(sum).toLocaleString('es-MX') );
                    });

                    
                    
                   
                }



            } );//end DataTable

            
            

        };
        var reloadTable = function(){
            dataTableArticulos.DataTable().ajax.reload();
        };
        return {
            //main function to initiate the module
            init: function() {
                initTable();
            },
            reload:function(){
                reloadTable();
            }
        };
    }();


    //funciones para editar **

    
    $(document).on('click', "#btn-modal-search-artmed-for-edit", function() {
        closeOpenModals();
    });

    $(document).on('click', "#articulo-btn-edit", function() {
        closeOpenModals();
        getModalEditarArticulo($(this).data('articuloId'));
    });

    const getModalEditarArticulo = (articulo) => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            url: url + '/fondoOficinas/{{$adquisicionId}}/checklist/{{$entradaId}}/articulos/'+articulo+'/edit',
            type: 'GET',
            data: 'articulo='+articulo,
            dataType: "html",
            success: function(respuesta_html) {
                var modalEditArticulo = respuesta_html;
                $(modalEditArticulo).modal().on('shown.bs.modal', function() {
                    AddArticuloKTFormWidgetsValidation.init();
                    console.log("cargados los validarios");
                }).on('hidden.bs.modal', function (e) {
                    $(this).data('bs.modal', null);
                    $(this).remove();
                });
            },
            error: function(respuesta_error) {
                swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                return false;
            }
        });

    };


    //fin de funciones para editar **


</script>
<script type="text/javascript">
    $( document ).ready(function() {
        console.log( "ready!" );
        datatablesDataSourceAjaxArticulos.init();
        
    });
</script>

@endsection