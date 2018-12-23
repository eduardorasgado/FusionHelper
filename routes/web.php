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
    Route::get('/empleado', 'EmpleadoController@index')->name('empleado');
});

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
    Route::get('/incidentes',
        'IncidenteController@index')->name('incidenteIndex');

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
});