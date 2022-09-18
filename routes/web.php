<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    if (Auth::user()){
        if(Auth::user()->hasAnyRole(['ADMIN'])){
            $redirect = '/admin';
        } else {
            $redirect = '/home';
        }
        return redirect($redirect);
    }else{
        return redirect('/login');
    }
});

//RUTAS LOGIN
//Route::get('loginRfc', 'Auth\LoginController@loginRfc')->name('loginRfc');
Route::post('loginRFC', 'Auth\LoginController@customLogin')->name('loginRFC');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');

// Quick search dummy route to display html elements in search dropdown (header search)
//Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

// VISTAS PUBLICAS
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('consultaRfc', 'WsCapitalHController@buscaRfc')->name('consultaRfc');
Route::post('buscar_cp', 'UsuarioController@buscar_cp')->name('buscar_cp');
Route::post('guardarUsuario', 'UsuarioController@crear')->name('guardarUsuario');

Route::post('guardarUsuario-Manual', 'UsuarioController@crearManual')->name('guardarUsuario.manual');
Route::post('buscar_puestos', 'UsuarioController@buscar_puestos')->name('buscar_puestos');
Route::post('getCatTipoCont', 'UsuarioController@getCatTipoContratacion')->name('getCatTipoCont');

Route::get('activar/{id_usuario}', 'UsuarioController@activar')->name('activar');
Route::post('/activarUsuario', 'UsuarioController@activarUsuario')->name('activarUsuario');
Route::post('rememberPass', 'UsuarioController@sendPass')->name('rememberPass');
Route::post('envioRememberPass', 'UsuarioController@sendPassAdmin')->name('envioRememberPass');//ruta para envio de correo electronico de recuperación de contraseña
Route::post('envioReactivarUsuario', 'UsuarioController@sendReactivarUsuario')->name('envioReactivarUsuario');//ruta para envio de correo electronico para reactivar cuenta
Route::get('actualizaPwd/{id}', 'UsuarioController@actualizaPwd')->name('actualizaPwd');
Route::post('/changePwd', 'UsuarioController@saveRememberPwd')->name('changePwd');
Route::get('editPassword', 'UsuarioController@view')->name('editPassword');
Route::post('savePassword', 'UsuarioController@save')->name('savePassword');


Route::post('consulta-entidades', 'UsuarioController@buscarEntidades')->name('consulta.entidades');
Route::post('consulta-unidades', 'UsuarioController@buscarUnidadAdministrativa')->name('consulta.unidades.administrativas');

//rutas del admin
Route::group(['middleware' => ['role_or_permission:ADMIN|users.edit']], function(){
    Route::get('catalogo_acta', 'AdminEnteController@catalogo_acta')->name('catalogo_acta');
    //Route::post('editar_acta', 'ActaSeguimientoController@editar_acta')->name('editar_acta');
    Route::group(['prefix' => 'admin'], function (){
        Route::get('/', 'AdminController@inicio')->name('admin');
        /*Referente a ligas de eventos*/
        /*Termina ligas de eventos*/
        /*Referente a las asistencias y constancias*/

        Route::group(['prefix' => 'usuarios'], function (){
            Route::get('/', 'AdminController@usuarios')->name('admin_usuarios');
            //Route::get('/{enteId}', 'AdminController@usuarios_entes')->name('admin_usuarios_entes'); //choca con solicitudes
            Route::post('/buscar_curp', 'AdminController@buscar_curp');
            Route::post('/buscar_rfc', 'AdminController@buscar_rfc');
            Route::post('/obtener', 'AdminController@obtener_usuario');
            Route::post('/guardar', 'AdminController@guardar_usuario');
            Route::post('/editar', 'AdminController@editar_usuario');
            Route::post('/borrar', 'AdminController@borrar_usuario');
            Route::post('/cargos', 'AdminController@buscar_cargos');
            Route::post('/cargos/registro', 'AdminController@registrar_cargo');
            Route::get('/data_listar_usuarios', 'AdminController@data_listar_usuarios');

            Route::get('/usuarioSolicitudes','UsuarioSolicitudController@usuariosSolicitudes');

            Route::resource('solicitudes', 'UsuarioSolicitudController', array("as"=>"usuarios"))->except('create','edit','store','destroy');
        });
    });
});


Route::group(['middleware' => ['can:users.index']], function () {
    #USERS::BEGIN
    Route::resource('users', 'UsersController')->middleware('auth');
    Route::prefix('users')->group(function () {
        Route::get('/{user}/info','UsersController@info')->name('users.info');
        Route::put('/{user}/updateus','UsersController@updateUs')->name('users.updateus');
        Route::get('/{user}/config','UsersController@editUs')->name('users.config');
        /* Actualizar contraseña */
        Route::get('/{user}/password', 'UsersController@password')->name('users.password');
        Route::post('/{user}/updatepassword', 'UsersController@updatePassword')->name('users.updatepassword');
        /* Actualizar contraseña fin */
        Route::get('/{user}/delete', 'UsersController@delete')->name('users.delete')->middleware('auth');
        Route::post('/{user}/assignRole', 'UsersController@assignRole')->name('users.assignRole')->middleware('auth');
        Route::post('/{user}/removeFromRole', 'UsersController@removeFromRole')->name('users.removeFromRole')->middleware('auth');

        /* Desactivar usuario->desde admin*/
        Route::put('/{user}/inhabilitarUsuario','UsersController@InhabilitarUsuario')->name('users.inhabilitarusuario');
        Route::get('/{user}/informacionPersona','UsersController@ShowInformacionPersona')->name('users.showInformacionPersona');

        /* cambio de adscricpcion puesto no estructura*/
        Route::get('/{user}/informacionNoEstructura','UsersController@showNoEstructura')->name('users.showInformacionNoEstructura');
        Route::post('/{user}/informacionNoEstructura','AdscripcionController@camAdsNoEs')->name('users.cambioAdscripcionNoEstructura');

        /*cambio de adscricpcion puesto estructura*/
        Route::get('/{user}/informacionEstructura','UsersController@showEstructura')->name('users.showInformacionEstructura');
        Route::post('/{user}/informacionEstructura','AdscripcionController@camAdsEs')->name('users.cambioAdscripcionEstructura');

        //Route::resource('solicitudes', 'UsuarioSolicitudController', array("as"=>"users"))->except('create','edit','store','destroy');
        Route::post('consulta-unidades', 'UsersController@getUnidades')->name('consulta.unidades');
        


    });
    # USERS::END
    

});
Route::group(['middleware' => ['can:roles.index']], function () {
    /*PERMISSIONS::BEGIN*/
    Route::prefix('permissions')->group(function () {
        Route::post('{permission}/assignToRoles', 'PermissionsController@assignToRoles')->name('permissions.assignToRoles')->middleware('auth');
        Route::post('{permission}/revokePermissionFromRole', 'PermissionsController@revokePermissionFromRole')->name('permissions.revokePermissionFromRole')->middleware('auth');
    });
    Route::resource('permissions', 'PermissionsController')->middleware('auth');
    /*PERMISSIONS::END*/
});
Route::group(['middleware' => ['can:permissions.index']], function () {
    /*ROLES::BEGIN*/
    Route::prefix('roles')->group(function () {
        Route::post('{role}/editPermissions', 'RolesController@editPermissions')->name('roles.editPermissions');
    });
    Route::resource('/roles', 'RolesController')->except('create','delete');
    /*ROLES::END*/
});

Route::post('/buscar_curp', 'AdminController@buscar_curp_manual_registros');
//rutas del admin
Route::group(['middleware' => ['role:ADMIN']], function(){
    Route::group(['prefix' => 'admin'], function (){
        Route::post('/buscar_curp', 'AdminController@buscar_curp');
        Route::post('/buscar_rfc_oci', 'AdminController@buscar_rfc_oci');
        Route::post('/obtener', 'AdminController@obtener_usuario');
        Route::post('/guardar', 'AdminController@guardar_usuario');
        Route::post('/editar', 'AdminController@editar_usuario');
        Route::post('/borrar', 'AdminController@borrar_usuario');
        Route::post('/cargos', 'AdminController@buscar_cargos');
        Route::post('/cargos/registro', 'AdminController@registrar_cargo');
    });
});
//rutas del admin

//ESTE GRUPO TIENE RUTAS PARA CONSULTAR LA EXISTENCIA DE ADQUISICION, CONTRATO, REQUISICION
Route::group(['middleware' => ['role_or_permission:admin.contratos|entradas por contrato abierto']], function () {
    Route::post('contratos/checkContrato','Contratos\ContratosController@contratosHaveAny')->middleware('auth')->name('contratos.check_contrato');
    Route::get('adquisiciones/checkExistAdquisicion/requisicionHaveAny/{num_requisicion?}', 'AdquisicionController@AdquisicionesHaveAny')->middleware('auth')->name('adquisicion.check_requisicion');
    Route::post('adquisiciones/checkExistAdquisicion/adjudicacionHaveAny', 'AdquisicionController@AdjudicacionesHaveAny')->middleware('auth')->name('adquisicion.check_adjudicacion');
});

//rutas para administrativo
//aqui debe ir el rol de ADMINISTRATIVO
Route::group(['middleware' => ['role:ADMIN|admin.contratos']], function() {
    //BEGIN: CONTRATOS
    Route::group(['prefix' => 'contratos'], function () {
        Route::get('/', 'Contratos\ContratosController@index')->middleware('auth');
        Route::post('/showContratos', 'Contratos\ContratosController@showContratos')->middleware('auth');
        Route::get('/crear', 'Contratos\ContratosController@create')->middleware('auth');
        Route::post('/destroy', 'Contratos\ContratosController@destroy')->middleware('auth');

        Route::post('/store', 'Contratos\ContratosController@store')->middleware('auth');
        Route::post('/store/adquisicion', 'Contratos\ContratosController@storeAdquisicion')->middleware('auth')->name('contratos.store.adquisicion');
        Route::post('/storeArticulosContratos', 'Contratos\ContratosController@storeArticulo')->middleware('auth')->name('contratos.store.articulo');
        Route::post('/storeArticuloContratoCerrado', 'Contratos\ContratosCerradosController@storeContratoCerrado')->middleware('auth')->name('contratos.store.articulo.contrato_cerrado');
        Route::post('/storeArticulosContratosCerradosDetalle', 'Contratos\ContratosCerradosController@storeContratosCerradosDetalle')->middleware('auth')->name('contratos.store.articulo.contrato_cerrado_detalle');
        Route::post('/storeArticuloContratoAbierto', 'Contratos\ContratosAbiertosController@storeContratoAbierto')->middleware('auth')->name('contratos.store.articulo.contrato_abierto');
        Route::post('/storeArticulosContratosAbiertosDetalle', 'Contratos\ContratosAbiertosController@storeContratoAbiertoDetalle')->middleware('auth')->name('contratos.store.articulo.contrato_abierto_detalle');

        Route::post('/storeFiles/{id}', 'Contratos\ContratosController@validarArchivos')->middleware('auth')->name('contratos.store.file');
        Route::post('/storePrevisualizacion', 'Contratos\ContratosController@validarPrevisualizacion')->middleware('auth')->name('contratos.store.previsualizacion');

        Route::get('/showContratoArticulos/{id}','Contratos\ContratosController@createArticulo')->middleware('auth')->name('contratos.show.contrato_articulo');
        Route::get('/showContratoArchivos/{id}','Contratos\ContratosController@createArchivo')->middleware('auth')->name('contratos.show.contrato_archivo');
        Route::get('/showPrevisualizacion/{id}','Contratos\ContratosController@showPrevisualizacion')->middleware('auth')->name('contratos.show.previsualizacion');

        Route::get('/showContratoArtmed/{id_element}/{id_contrato}', 'Contratos\ContratosController@showContratoArtmed')->middleware('auth')->name('contratos.show.contrato_artmed');
        Route::get('/showCreateContratoArtmed/{id_element}/{id_contrato}', 'Contratos\ContratosController@showCreateContratoArtmed')->middleware('auth')->name('contratos.create.contrato_artmed');
        Route::get('/showEditContratoArtmed/{id}', 'Contratos\ContratosController@showEditContratoArtmed')->middleware('auth')->name('contratos.edit.contrato_artmed');

        Route::post('/showModalPDF', 'Contratos\ContratosArchivosController@showModalPDF')->middleware('auth')->name('contratos.show.pdf');

        Route::post('/destroyContratoArticulo', 'Contratos\ContratosController@destroyContratoArticulo')->middleware('auth')->name('contratos.destroy.contrato_articulo');
        Route::get('/destroyFile/{id}', 'Contratos\ContratosController@destroyArchivo')->middleware('auth')->name('contratos.destroy.file');
    });

    Route::resource('contratos', 'Contratos\ContratosController');
    Route::delete('contratos/advanceSearch', 'Contratos\ContratosController@advanceSearch')->middleware('auth')->name('contratos.advance_search');
    //END: CONTRATOS

});


//ROUTES::ADQUISICIONES::BEGIN
//ROUTES::ADQUISICIONES::END

    //BEGIN: Catalogos
    Route::group(['prefix' => 'proveedores'], function(){
        Route::get('/','ProveedoresController@catalogoProveedoresLista');
        Route::get('/catalogoProveedores','ProveedoresController@catalogoProveedores');
        Route::get('/crearProveedor','ProveedoresController@crearProveedor');
        Route::post('/guardarProveedor','ProveedoresController@guardarProveedor');
        Route::get('/editarProveedor','ProveedoresController@editarProveedor');
        Route::post('/guardarEdicionProveedor','ProveedoresController@guardarEdicionProveedor');

    });

    Route::group(['prefix' => 'almacenes'], function(){
        Route::get('/','Catalogos\AlmacenesController@catalogoAlmacenesLista');
        Route::get('/catalogoAlmacenes','Catalogos\AlmacenesController@catalogoAlmacenes');
        Route::get('/crearAlmacen','Catalogos\AlmacenesController@crearAlmacen');
        Route::get('/buscarColonia','Catalogos\AlmacenesController@buscarColonia');
        Route::get('/buscarColoniaEditar','Catalogos\AlmacenesController@buscarColoniaEditar');
        Route::post('/guardarAlmacen','Catalogos\AlmacenesController@guardarAlmacen');
        Route::get('/editarAlmacen','Catalogos\AlmacenesController@editarAlmacen');
        Route::post('/guardarEdicionAlmacen','Catalogos\AlmacenesController@guardarEdicionAlmacen');
    });

    Route::group(['prefix' => 'articulos'], function(){
        Route::get('/','Catalogos\ArticulosController@catalogoArticulosLista');
        Route::get('/catalogoArticulos','Catalogos\ArticulosController@catalogoArticulos');
        Route::get('/crearArticulo','Catalogos\ArticulosController@crearArticulo');
        Route::post('/guardarArticulo','Catalogos\ArticulosController@guardarArticulo');
        Route::get('/editarArticulo','Catalogos\ArticulosController@editarArticulo');
        Route::post('/guardarEdicionArticulo','Catalogos\ArticulosController@guardarEdicionArticulo');
    });

    Route::group(['prefix' => 'cabms'], function(){
        Route::get('/','Catalogos\CabmsController@catalogoCabmsLista');
        Route::get('/catalogoCabms','Catalogos\CabmsController@catalogoCabms');
        Route::get('/crearCabms','Catalogos\CabmsController@crearCabms');
        Route::post('/guardarCabms','Catalogos\CabmsController@guardarCabms');
        Route::get('/editarCabms','Catalogos\CabmsController@editarCabms');
        Route::post('/guardarEdicionCabms','Catalogos\CabmsController@guardarEdicionCabms');
    });

    Route::group(['prefix' => 'partidas'], function(){
        Route::get('/','Catalogos\PartidasEspecificasController@catalogoPartidasLista');
        Route::get('/catalogoPartidas','Catalogos\PartidasEspecificasController@catalogoPartidas');
        Route::get('/crearPartida','Catalogos\PartidasEspecificasController@crearPartida');
        Route::post('/guardarPartida','Catalogos\PartidasEspecificasController@guardarPartida');
        Route::get('/editarPartida','Catalogos\PartidasEspecificasController@editarPartida');
        Route::post('/guardarEdicionPartida','Catalogos\PartidasEspecificasController@guardarEdicionPartida');
    });

    Route::group(['prefix' => 'laboratorios'], function(){
        Route::get('/','Catalogos\LaboratoriosController@catalogoLaboratoriosLista');
        Route::get('/catalogoLaboratorios','Catalogos\LaboratoriosController@catalogoLaboratorios');
        Route::get('/crearLaboratorio','Catalogos\LaboratoriosController@crearLaboratorio');
        Route::post('/guardarLaboratorio','Catalogos\LaboratoriosController@guardarLaboratorio');
        Route::get('/editarLaboratorio','Catalogos\LaboratoriosController@editarLaboratorio');
        Route::post('/guardarEdicionLaboratorio','Catalogos\LaboratoriosController@guardarEdicionLaboratorio');
    });

    Route::group(['prefix' => 'preguntas'], function(){
        Route::get('/','Catalogos\PreguntasRevisionController@catalogoPreguntasLista');
        Route::get('/catalogoPreguntasRevision','Catalogos\PreguntasRevisionController@catalogoPreguntasRevision');
        Route::get('/crearPreguntasRevision','Catalogos\PreguntasRevisionController@crearPreguntasRevision');
        Route::post('/guardarPreguntasRevision','Catalogos\PreguntasRevisionController@guardarPreguntasRevision');
        Route::get('/editarPreguntasRevision','Catalogos\PreguntasRevisionController@editarPreguntasRevision');
        Route::post('/guardarEdicionPreguntasRevision','Catalogos\PreguntasRevisionController@guardarEdicionPreguntasRevision');
    });

    Route::group(['prefix' => 'unidades'], function(){
        Route::get('/','Catalogos\UnidadesConsolidadorasController@catalogoUnidadesLista');
        Route::get('/catalogoUnidadConsolidadora','Catalogos\UnidadesConsolidadorasController@catalogoUnidadConsolidadora');
        Route::get('/crearUnidadConsolidadora','Catalogos\UnidadesConsolidadorasController@crearUnidadConsolidadora');
        Route::post('/guardarUnidadConsolidadora','Catalogos\UnidadesConsolidadorasController@guardarUnidadConsolidadora');
        Route::get('/editarUnidadConsolidadora','Catalogos\UnidadesConsolidadorasController@editarUnidadConsolidadora');
        Route::post('/guardarEdicionUnidadConsolidadora','Catalogos\UnidadesConsolidadorasController@guardarEdicionUnidadConsolidadora');
    });

    Route::group(['prefix'=>'fundamentoLegal'], function(){
        Route::get('/','Catalogos\FudamentoLegalController@catalogoFundamentoLegal');
        Route::get('/catalogofundamento','Catalogos\FudamentoLegalController@catalogofundamento');
        Route::get('/crearFundamentoLegal','Catalogos\FudamentoLegalController@crearFundamentoLegal');
        Route::post('/guardarFundamentoLegal','Catalogos\FudamentoLegalController@guardarFundamentoLegal');
        Route::get('/editarFundamentoLegal','Catalogos\FudamentoLegalController@editarFundamentoLegal');
        Route::post('/guardarEdicionFundamentoLegal','Catalogos\FudamentoLegalController@guardarEdicionFundamentoLegal');

    });
    //END: Catalogos


//ROUTES::LICITACIONES::BEGIN
Route::get('licitaciones/checkExistId/idHaveAny/{id?}', 'LicitacionController@idHaveAny')->middleware('auth');
//ROUTES::LICITACIONES::END

//ROUTE::ORIGEN DE RECURSO::BEGIN
Route::get('origenRecurso/checkExistId/idHaveAny/{id?}', 'OrigenRecursoController@idHaveAny')->middleware('auth');
//ROUTE::ORIGEN DE RECURSO::END


//rutas para rol ALMACEN

Route::group(['middleware' => ['role:ADMIN|ALMACEN']], function(){
    Route::group(['prefix' => 'entradas'], function(){



    });
});

//INICIO::ENTRADAS POR CONTRATO ABIERTO
Route::resource('fondoOficinas', 'Entradas\EntradasFondoOficinasCentralesController', array("as"=>"entradas"))->middleware('auth');
Route::post('fondoOficinas/advanceSearch', 'Entradas\EntradasFondoOficinasCentralesController@advanceSearh',array("as"=>"entradas"))->name('entradas.fondoOficinas.advanceSearch')->middleware('auth');
Route::resource('fondoOficinas.documento', 'Entradas\EntradasFondoOficinasCentralesDocumentoController', array("as"=>"entradas"))->middleware('auth');
Route::resource('fondoOficinas.contratos', 'Entradas\EntradasFondoOficinasCentralesContratosController', array("as"=>"entradas"))->middleware('auth')->only('index','show');
Route::resource('fondoOficinas.checklist', 'Entradas\EntradasFondoOficinasCentralesChecklistController', array("as"=>"entradas"))->middleware('auth');
Route::resource('fondoOficinas.checklist.articulos', 'Entradas\EntradasFondoOficinasCentralesArticulosController', array("as"=>"entradas"))->middleware('auth');
Route::get('fondoOficinas/{fondoOficina}/checklist/{checklist}/articulos_datatable', 'Entradas\EntradasFondoOficinasCentralesArticulosController@articulosDatatable')->name('fondoOficinas.checklist.articulos.datatable')->middleware('auth');
Route::get('fondoOficinas/{fondoOficina}/checklist/{checklist}/epaDescarga', 'Entradas\EntradasFondoOficinasCentralesChecklistController@epaDescarga')->name('fondoOficinas.checklist.epa.descarga')->middleware('auth');
Route::get('fondoOficinas/{fondoOficina}/carpeta/edit','Entradas\EntradasFondoOficinasCentralesController@carpetaEdit')->name('entradas.fondoOficinas.carpeta.edit')->middleware('auth');;
Route::resource('fondoOficinas.apertura', 'Entradas\EntradasFondoOficinasCentralesAperturaController', array("as"=>"entradas"))->middleware('auth')->only('create','store');
//FIN::ENTRADAS POR CONTRATO ABIERTO

// INICIO::ENTRADAS POR CONTRATOS CERRADOS 
Route::resource('entradasContratosCerrados.checklist.articulos', 'Entradas\ContratosCerrados\EntradaContratoCerradoArticulosController', array("as"=>"entradas"))->middleware('auth');
Route::get('entradasContratosCerrados/{adquisicion}/checklist/{checklist}/articulos_datatable', 'Entradas\ContratosCerrados\EntradaContratoCerradoArticulosController@articulosDatatable')->name('entradasContratosCerrados.checklist.articulos.datatable')->middleware('auth');
//FIN::ENTRADAS POR CONTRATOS CERRADOS 

Route::post('catArtmed/advanceSearch', 'CatArtmedController@advanceSearch',array("as"=>"catArtmed"))->name('catArtmed.advanceSearch')->middleware('auth');
Route::post('catArtmed/getSearchModal', 'CatArtmedController@getSearchModal',array("as"=>"catArtmed"))->name('catArtmed.getSearchModal')->middleware('auth');
Route::post('proveedores/dataGeneral', 'ProveedoresController@ws_getDataGeneral',array("as"=>"proveedores"))->name('proveedores.dataGeneral')->middleware('auth');

//rutas para rol UNIDADMEDICA

 /*Route::group(['middleware' => ['role:ADMIN|UNIDADMEDICA']], function(){
    Route::group(['prefix' => 'pedidos'], function(){
        //BEGIN: Pedidos
       Route::get('/', 'PedidosController@pedidos');
        Route::post('/crear','PedidosController@guardar');
        //END: Pedidos

    });
});*/

//rutas para Pedidos
Route::group(['middleware' => ['role:ADMIN|PEDIDOS']], function(){
    Route::group(['prefix' => 'pedidosProgramacion'], function(){
        //BEGIN: Pedidos
        Route::get('/', 'PedidosController@pedidosProgramacion');

        Route::get('/{id}/cargo', 'PedidosController@cargoselect');
        Route::post('/guardar','PedidosController@guardarPedidosProgramacion');
        Route::get('/{id}/cargo', 'PedidosController@cargoselect');
        Route::get('/consultarPedidosRealizados', 'SolicitudesAbastecimiento\SolicitudesAbastecimientoRealizadasController@consultarPedidosRealizados');
        Route::get('/consultarPedidos', 'PedidosController@consultarPedidos');
        Route::get('/consultarPedidosRecibido', 'PedidosController@consultarPedidosRecibido');
        Route::get('/seguimientoPedidos', 'PedidosController@seguimientoPedidos');
        Route::get('/seguimientoPedidosRecibido', 'PedidosController@seguimientoPedidosRecibido');
        Route::get('/formatoPedido', 'PedidosController@formatoPedidoPDF');
        Route::get('/formato', 'PedidosController@formatoPedido');
        Route::get('/agregarArticulos', 'PedidosController@agregarArticulos');
        Route::post('/agregarArticulos/guardarArticulos', 'PedidosController@guardarArticulos');
        Route::get('/agregarArticulos/tabaArticulo','PedidosController@tabaArticulo');
        Route::put('/agregarArticulos/editarArticulo','PedidosController@editarArticulo');
        Route::post('/agregarArticulos/eliminar','PedidosController@eliminar');
        Route::get('/articulosAgregados','PedidosController@articulosAgregados');




        //END: Pedidos

    });
});

Route::group(['middleware' => ['role:ADMIN|pedidos proveedor']], function(){
    //BEGIN: Pedidor Proveedor
    Route::group(['prefix' => 'pedidos-proveedor'], function(){
        //Views
        Route::get('/', 'PedidosProveedorController@index')->name('pedidos-proveedor');
        Route::get('/create', 'PedidosProveedorController@createView');
        Route::get('/{pedidoId}/articles-edit', 'PedidosProveedorController@articlesView');

        Route::get('/{pedidoId}/pdf', 'PedidosProveedorController@descargaPedido');
        //Data
        Route::post('/create', 'PedidosProveedorController@create')->name('create-pedido-proveedor');
        Route::get('/valida-contrato', 'PedidosProveedorController@validaContrato');
        Route::get('/{pedidoId}/{claveArtmed}', 'PedidosProveedorController@consultaArticuloEnDetalle');
        Route::put('/contrato/{contratoId}/update-proveedor', 'PedidosProveedorController@actualizaProveedor');
        Route::put('/contrato/update-proveedor', 'PedidosProveedorController@creaPedidoConProveedor');
        Route::post('/{pedidoId}/update-detail','PedidosProveedorController@actualizaDetalle');
        Route::post('/{pedidoId}/finish','PedidosProveedorController@finalizaPedido');
        //Route::post('/{pedidoId}/pdf','PedidosProveedorController@test');
    });
    //END: Pedidos Proveedor
});

/**NAVEGADOR NO PERMITIDO */
Route::get('errorNavegador', 'Auth\LoginController@errorBrowser')->name('errorNavegador');

//para ver los logs en tiempo real
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//se ocupa el servicio de renapo
Route::get('getDatosCurp','WsRenapoController@getCurp');
