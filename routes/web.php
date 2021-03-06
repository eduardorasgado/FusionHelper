<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    // rutas para el usuario debidamente regustrado
    Route::get('/empleado', 'EmpleadoController@index')
        ->name('empleado');
    // RUTAS PARA EL EMPLEADO O TECNICO
    // reporte de incidente
    Route::get('/incidente/empleado/registro',
        'IncidenteController@getRegistro')
        ->name('incidenteEmpleadoRegistro');
    // manejando la peticion post del registro de incidente
    Route::post('/incidente/empleado/registro',
        'IncidenteController@postRegistro')
        ->name('incidenteEmpleadoRegistro');
    // Todos los registros de incidentes
    Route::get('/empleado/incidentes',
        'EmpleadoController@getIncidentes')
        ->name('incidentesEmpleadoIndex');

    // rutas para el registro de resguardo | solicitud de activo
    Route::get('/empleado/resguardos/all',
        'ResguardoController@index')
        ->name('allResguardosIndividual');

    // crear una solicitud para resguardo, por parte del empleado
    Route::get('/empleado/resguardos/create',
        'ResguardoController@getRegistroEmpleado')
        ->name('resguardoEmpleadoRegistro');

    // gurdar el preresguardo
    Route::post('/empleado/resguardos/create',
        'PreresguardoController@postRegistroPreresguardo')
        ->name('PreresguardoEmpleadoRegistro');

    // listar todos los preresguardos del empleado
    Route::get('empleado/preresguardos/all',
        'PreresguardoController@index')
        ->name("preresguardosAllEmpleado");
});

// RUTAS PARA EL ADMINISTRADOR
// este middleware se agrego en kernel tambien
Route::group(['middleware' => ['is_admin']], function()
{
    // TODAS LAS RUTAS PARA EL ADMINISTRADOS
    // Rutas para el registro de empleados
    Route::get('/admin', 'AdministradorController@index')->name('admin');
    Route::get('/admin/empleados/noregistrados',
        'AdministradorController@getEmpleadosNoRegistrados')
        ->name('empleadosNoRegistrados');
    Route::get('admin/empleados/registrados',
        'AdministradorController@getEmpleadosRegistrados')
        ->name('empleadosRegistrado');
    // activacion de usuarios nuevos, lo llama adminEmpleados/noregistrados.blade
    Route::get('/admin/empleados/noregistrados/aceptar/{id}',
        'AdministradorController@getEmpleadoActivation')
        ->name('aceptarEmpleado');
    // Denegacion de nuevo usuario
    Route::get('/admin/empleados/noregistrados/denegar/{id}',
        'AdministradorController@getEmpleadoDenegated')
        ->name('denegarEmpleado');
    // Actualizar un empleado
    Route::get('/admin/empleados/update/{id}',
        'AdministradorController@GetUpdateEmpleado')
        ->name('getUpdateEmpleado');

    Route::post('admin/empleados/update/{id}',
        'AdministradorController@PostUpdateEmpleado')
        ->name('postUpdateEmpleado');
    // borrando a un empleado
    Route::get('admin/empleados/delete/{id}',
        'AdministradorController@deleteEmpleado')
        ->name('deleteEmpleado');

    // INCIDENTES Y TICKETS
    // INCIDENTES
    Route::get('/admin/incidentes',
        'AdministradorController@getIncidentes')
        ->name('incidentesAdminIndex');
    // TICKETS
    Route::get('/admin/ticket/create/{id}',
        'TicketController@getRegistro')
        ->name('getTicketRegistro');
    // generacion del ticket de cierto incidente
    Route::post('/admin/ticket/create/{id}',
        'TicketController@postRegistro')
        ->name('postTicketRegistroAceptado');
    // vista individual de ticket para administrador
    Route::get('/admin/ticket/{id}',
        'TicketController@getTicketIndividual')
        ->name('ticketIndividual');
    // ir a todos los tickets
    Route::get('/admin/tickets/all',
        'TicketController@getAllTickets')
        ->name('getAllTickets');

    // AREAS
    // mostrar todas las existentes
    Route::get('/area',
        'AreaController@index')->name('areaIndex');
    // get del registro de area
    Route::get('/area/registro',
        'AreaController@getRegistro')->name('areaRegistro');
    // post del registro de nueva area
    Route::post('/area/registro',
        'AreaController@postRegistro')->name('areaRegistroPost');
    // Eliminamos un area
    Route::get('/area/delete/{id}',
        'AreaController@deleteArea')->name('deleteArea');

    // TIPO DE INCIDENTES
    Route::get('/tipoincidente',
        'TipoIncidenteController@index')
        ->name('tiposIncidente');
    // formulario del tipo de incidente
    Route::get('/tipoincidente/registro',
        'TipoIncidenteController@getRegistro')
        ->name('tiposIncidenteRegistro');
    // Resolucion post del formulario completado
    Route::post('/tipoincidente/registro',
        'TipoIncidenteController@postRegistro')
        ->name('tiposIncidenteRegistroPost');
    // Eliminar un tipo de incidente
    Route::get('/tipoincidente/delete/{id}',
        'TipoIncidenteController@delete')
        ->name('deleteTipoIncidente');
    // Modificar el tipo de incidente
    Route::get('/tipoincidente/update/{id}',
        'TipoIncidenteController@update')
        ->name('updateTipoIncidente');
    Route::post('/tipoincidente/update/{id}',
        'TipoIncidenteController@updatePost')
        ->name('updateTipoIncidentePost');

    // ALMACEN
    Route::get('/almacen/registros',
        'AlmacenController@index')
        ->name('registros');

    // tablas de activos, accesorios y proveedores
    Route::get('/almacen/listas',
        'AlmacenController@getListarAlmacen')
        ->name('listarAlmacen');

    // PROVEEDORES
    Route::get('/almacen/proveedor/create',
        function(){ return redirect('/');})
        ->name('postProveedorRegistro');
    // registro del proveedor
    Route::post('/almacen/proveedor/create',
        'ProveedorController@postProveedor')
        ->name('postProveedorRegistro');
    // actualizar
    Route::get('/almacen/proveedor/update/{id}',
        'ProveedorController@update')
        ->name('updateProveedor');
    // actualizar proveedor post
    Route::post('/almacen/proveedor/update/{id}',
        'ProveedorController@postUpdate')
        ->name('postUpdateProveedor');
    // eliminar
    Route::get('/almacen/proveedor/delete/{id}',
        'ProveedorController@delete')
        ->name('deleteProveedor');

    // ACTIVOS
    Route::get('/almacen/activo/create',
        function(){ return redirect('/');})
        ->name('postActivoRegistro');

    Route::post('/almacen/activo/create',
        'ActivoController@postRegistro')
        ->name('postActivoRegistro');

    Route::get('/almacen/activo/update/{id}',
        'ActivoController@update')
        ->name('updateActivo');

    Route::post('/almacen/activo/update/{id}',
        'ActivoController@postUpdate')
        ->name('postUpdateActivo');

    Route::get('/almacen/activo/delete/{id}',
        'ActivoController@delete')
        ->name('deleteActivo');

    // ACCESORIOS
    Route::get('/almacen/accesorio/create',
        function(){ return redirect('/');})
        ->name('postAccesorioRegistro');

    Route::post('/almacen/accesorio/create',
        'AccesorioController@postRegistro')
        ->name('postAccesorioRegistro');

    Route::get('/almacen/accesorio/update/{id}',
        'AccesorioController@update')
        ->name('updateAccesorio');

    Route::post('/almacen/accesorio/update/{id}',
        'AccesorioController@postUpdate')
        ->name('postUpdateAccesorio');

    Route::get('/almacen/accesorio/delete/{id}',
        'AccesorioController@delete')
        ->name('deleteAccesorio');

    // RESGUARDOS: LISTADO Y APROBACION
    // vistas de preresguardos
    // listar todos los preresguardos del empleado
    Route::get('admin/preresguardos/all',
        'PreresguardoController@indexAdmin')
        ->name("preresguardosAllAdmin");

    Route::get('admin/preresguardo/procesar/{id}',
        'PreresguardoController@createResguardo')
        ->name("procesarPreresguardo");

    // guardar el resguardo por el admin
    Route::post('/admin/resguardo/{id}',
        'ResguardoController@postRegistroResguardo')
        ->name('resguardoRegistro');

    // mostrar la lista de los rsguardos ya generados
    Route::get('/admin/resguardos/all',
        'ResguardoController@adminListAll')
        ->name('listarReguardosAdmin');

    // PDFS
    // generar pdf
    Route::get('/admin/resguardos/pdf/generate/{id}',
        'ResguardoController@generateResguardoPDF')
        ->name('generateResguardoPDF');
    // ver pdf
    Route::get('/admin/resguardos/pdf/download/{id}',
        'ResguardoController@downloadResguardoPDF')
        ->name('downloadResguardoPDF');

    // Generacion del reporte mensual
    Route::get('/admin/reporte/pdf',
        'AdministradorController@generarReporte')
        ->name('generarReporteMensual');

    Route::get('/admin/reporte/general',
        'AdministradorController@analisisReporte')
        ->name('analisisReporte');

    // RUTAS PARA LOS ACTIVOS Y ACCESORIOS GENERALES
    Route::get("/admin/generales/create",
        "ActivoGeneralController@createActivoAndAccesorio")
        ->name("registroGenerales");

    Route::post("/admin/generales/activo/create",
        "ActivoGeneralController@create")
        ->name("postActivoGeneralRegistro");

    Route::post("/admin/generales/accesorio/create",
        "AccesorioGeneralController@create")
        ->name("postAccesorioGeneralRegistro");

    // listar todos los activos y accesorios generales
    Route::get("/admin/generales/all",
        "ActivoGeneralController@listGenerales")
        ->name("allGenerales");
});