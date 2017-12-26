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

Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'AdminController@index')->middleware('auth');
	Route::get('/numeros', 'AdminController@numeros')->middleware('auth');
	Route::get('/controlLoteria', 'AdminController@controlLoteria')->middleware('auth');
	Route::get('/loteria', 'AdminController@loteria')->middleware('auth');
	Route::get('/loteriaSeleccionar', 'AdminController@loteriaSeleccionar')->middleware('auth');
	
	Route::get('/mostrartablaLoteria', 'AdminController@mostrartablaLoteria')->middleware('auth');
	Route::get('/mostrarTablaDeVerificacion', 'AdminController@mostrarTablaDeVerificacion')->middleware('auth');
	Route::get('/mostrarTablaSeleccionarLoteria', 'AdminController@mostrarTablaSeleccionarLoteria')->middleware('auth');
	Route::get('/mostrarTituloDeLoteria', 'AdminController@mostrarTituloDeLoteria')->middleware('auth');
	Route::get('/mostrarInformacionDelPago', 'AdminController@mostrarInformacionDelPago')->middleware('auth');
	Route::get('/mostrarLoteriaActiva', 'AdminController@mostrarLoteriaActiva')->middleware('auth');
	
	Route::get('/generarNumeros', 'AdminController@generarNumeros')->middleware('auth');
	Route::get('/seleccionarLoteria', 'AdminController@seleccionarLoteria')->middleware('auth');

	Route::post('/idLoteria', 'AdminController@idLoteria')->middleware('auth');
});

Route::group(['prefix' => 'user'], function(){
	Route::get('/', 'UserController@index')->middleware('auth');
	Route::get('/seleccionarNumeros', 'UserController@seleccionarNumeros')->middleware('auth');

	Route::post('/correo', 'UserController@correo')->middleware('auth');
	Route::post('/verificarLoteria', 'UserController@verificarLoteria')->middleware('auth');
	Route::post('/verificarNumeros', 'UserController@verificarNumeros')->middleware('auth');
	Route::post('/verificarUsuario', 'UserController@verificarUsuario')->middleware('auth');
	Route::post('/verificarPago', 'UserController@verificarPago')->middleware('auth');
	Route::post('/checkUser', 'UserController@checkUser')->middleware('auth');
});
