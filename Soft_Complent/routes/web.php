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
    return view('Login');
});
Route::post('/', 'LoginController@Login');
Route::get('/logout', 'LoginController@Logout');

Route::group(['prefix' => '/usuarios'], function(){
    Route::get('/registrarusuario', 'UsuariosController@CargarDatos')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::post('/registrarusuario', 'UsuariosController@RegistrarUsuario')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::get('/listar', 'UsuariosController@ListarUsuarios')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::post('/cambiarestado', 'UsuariosController@CambiarEstado')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::post('/cambiarrol', 'UsuariosController@CambiarRol')->middleware('LoginMiddleware', 'AdministradorMiddleware');
});

Route::group(['prefix' => '/tarifas'], function(){
    Route::get('/registrartarifa', 'TarifasController@CargarDatos')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::post('/registrartarifa', 'TarifasController@RegistrarTarifa')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::get('/listar', 'TarifasController@ListarTarifas')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    Route::post('/cambiarestado', 'TarifasController@DeshabilitarTarifa')->middleware('LoginMiddleware', 'AdministradorMiddleware');
    

});

Route::group(['prefix' => '/ingresos'], function(){
    Route::get('/registraringreso', 'IngresosController@CargarDatos')->middleware('LoginMiddleware');
    Route::post('/registraringreso', 'IngresosController@RegistrarIngreso')->middleware('LoginMiddleware');
    Route::get('/listar', 'IngresosController@ListarVigentes')->middleware('LoginMiddleware');
    Route::get('/listarfinalizados', 'IngresosController@ListarFinalizados')->middleware('LoginMiddleware');
    Route::get('/listarhistorial', 'IngresosController@ListarTodos')->middleware('LoginMiddleware');
    Route::post('/consultarniveles', 'IngresosController@ConsultarNivelesServicio')->middleware('LoginMiddleware');
    Route::post('/finalizaringreso', 'IngresosController@FinalizarIngreso')->middleware('LoginMiddleware');

});
