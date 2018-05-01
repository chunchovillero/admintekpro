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


// API Group Routes
Route::group(array('prefix' => 'api/v1', 'middleware' => []), function () {
	// Custom route added to standard Resource
	Route::get('example/foo', 'UsuarioController@index');
	// Standard Resource route
	Route::resource('example', 'RoleController');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => '/', 'middleware' => ['auth']), function () {

	Route::get('/', function () {
		return view('home');
	});


	Route::get('perfil/{id}', 'UsuarioController@perfil')->name('perfil.index');

	Route::get('asignar/{id}', 'UsuarioController@asignar')->name('asignar.index');

	Route::post('asignar/{id}', 'UsuarioController@asignarstore')->name('asignar.store');

	//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')
	->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
	->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
	->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
	->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
	->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
	->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
	->middleware('permission:roles.edit');


	//Permisos
	Route::post('permisos/store', 'PermisosController@store')->name('permisos.store')
	->middleware('permission:roles.create');

	Route::get('permisos', 'PermisosController@index')->name('permisos.index')
	->middleware('permission:roles.index');

	Route::get('permisos/create', 'PermisosController@create')->name('permisos.create')
	->middleware('permission:roles.create');

	Route::put('permisos/{role}', 'PermisosController@update')->name('permisos.update')
	->middleware('permission:roles.edit');

	Route::get('permisos/{role}', 'PermisosController@show')->name('permisos.show')
	->middleware('permission:roles.show');

	Route::delete('permisos/{role}', 'PermisosController@destroy')->name('permisos.destroy')
	->middleware('permission:roles.destroy');

	Route::get('permisos/{role}/edit', 'PermisosController@edit')->name('permisos.edit')
	->middleware('permission:roles.edit');


	//Users
	Route::get('users', 'UsuarioController@index')->name('users.index')
	->middleware('permission:users.index');

	Route::get('users', 'UsuarioController@index')->name('users.index');
	
	Route::put('users/{user}', 'UsuarioController@update')->name('users.update');

	Route::get('users/{user}', 'UsuarioController@show')->name('users.show')
	->middleware('permission:users.show');

	Route::delete('users/{user}', 'UsuarioController@destroy')->name('users.destroy')
	->middleware('permission:users.destroy');

	Route::get('users/{user}/edit', 'UsuarioController@edit')->name('users.edit')
	->middleware('permission:users.edit');

	Route::resource('/usuarios', 'UsuarioController')->middleware('permission:users.edit');	


	//Products
	Route::post('products/store', 'ProductController@store')->name('products.store')
	->middleware('permission:products.create');
	
	Route::get('products', 'ProductController@index')->name('products.index')
	->middleware('permission:products.index');
	
	Route::get('products/create', 'ProductController@create')->name('products.create')
	->middleware('permission:products.create');
	
	Route::put('products/{product}', 'ProductController@update')->name('products.update')
	->middleware('permission:products.edit');
	
	Route::get('products/{product}', 'ProductController@show')->name('products.show')
	->middleware('permission:products.show');
	
	Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy')
	->middleware('permission:products.destroy');
	
	Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit')
	->middleware('permission:products.edit');


	//Empresa
	Route::post('empresas/store', 'EmpresaController@store')->name('empresas.store')
	->middleware('permission:empresas.create');
	
	Route::get('empresas', 'EmpresaController@index')->name('empresas.index')
	->middleware('permission:empresas.index');
	
	Route::get('empresas/create', 'EmpresaController@create')->name('empresas.create')
	->middleware('permission:empresas.create');
	
	Route::put('empresas/{product}', 'EmpresaController@update')->name('empresas.update')
	->middleware('permission:empresas.edit');
	
	Route::get('empresas/{product}', 'EmpresaController@show')->name('empresas.show')
	->middleware('permission:empresas.show');
	
	Route::delete('empresas/{product}', 'EmpresaController@destroy')->name('empresas.destroy')
	->middleware('permission:empresas.destroy');
	
	Route::get('empresas/{product}/edit', 'EmpresaController@edit')->name('empresas.edit')
	->middleware('permission:empresas.edit');

	//Servicios
	Route::post('servicios/store', 'ServicioController@store')->name('servicios.store')
	->middleware('permission:servicios.create');
	
	Route::get('servicios', 'ServicioController@index')->name('servicios.index')
	->middleware('permission:servicios.index');
	
	Route::get('servicios/create', 'ServicioController@create')->name('servicios.create')
	->middleware('permission:servicios.create');
	
	Route::put('servicios/{product}', 'ServicioController@update')->name('servicios.update')
	->middleware('permission:servicios.edit');
	
	Route::get('servicios/{product}', 'ServicioController@show')->name('servicios.show')
	->middleware('permission:servicios.show');
	
	Route::delete('servicios/{product}', 'ServicioController@destroy')->name('servicios.destroy')
	->middleware('permission:servicios.destroy');
	
	Route::get('servicios/{product}/edit', 'ServicioController@edit')->name('servicios.edit')
	->middleware('permission:servicios.edit');


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
