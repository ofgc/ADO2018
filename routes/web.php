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

Route::get('/registrarRoles','RoleController@create');

//Datatable functions 

//Datatable User

	Route::get('/gestionUsers', 'UserController@show');

		//ajax Datatable functions

		Route::get('/datatablesUserData', 'UserController@getDatosUser' );

		Route::post('/eliminarUsuario', 'UserController@deleteUser');

//Datatable Rol
	
	Route::get('/gestionRoles', 'RoleController@show');

		Route::get('/datatablesRolesData', 'RoleController@getDatosRoles');

		Route::get('/eliminarRoles', 'RoleController@eliminarRoles');