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
	return view('auth/login');
});

//Route::get('ventas/cliente/report','ClienteController@report');
Route::get('almacen/articulo/create/grafico/{codigo}','ArticuloController@generarCodigo');

Route::get('compras/ingreso/report_1','IngresoController@reportExcelIngresos');
Route::get('compras/ingreso/report_2','IngresoController@reportPdfIngresos');
Route::get('compras/ingreso/report_3','IngresoController@reportWordIngresos');

Route::get('compras/proveedor/report_1','ProveedorController@reportExcelProveedores');
Route::get('compras/proveedor/report_2','ProveedorController@reportPdfProveedores');
Route::get('compras/proveedor/report_3','ProveedorController@reportWordProveedores');

Route::get('almacen/categoria/report_1','CategoriaController@reportExcelCategorias');
Route::get('almacen/categoria/report_2','CategoriaController@reportPdfCategorias');
Route::get('almacen/categoria/report_3','CategoriaController@reportWordCategorias');

Route::get('almacen/articulo/report_1','ArticuloController@reportExcelArticulos');
Route::get('almacen/articulo/report_2','ArticuloController@reportPdfArticulos');
Route::get('almacen/articulo/report_3','ArticuloController@reportWordArticulos');

Route::get('ventas/cliente/report_1','ClienteController@reportExcelClientes');
Route::get('ventas/cliente/report_2','ClienteController@reportPdfClientes');
Route::get('ventas/cliente/report_3','ClienteController@reportWordClientes');

Route::get('ventas/venta/report_1','VentaController@reportExcelVentas');
Route::get('ventas/venta/report_2','VentaController@reportPdfVentas');
Route::get('ventas/venta/report_3','VentaController@reportWordVentas');


Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('seguridad/usuario','UsuarioController');

Auth::routes();

Route::auth();

Route::get('/home', 'HomeController@home');

Route::get('graficos/graficos', 'HomeController@resumen');
Route::get('graficos/resumen', 'HomeController@home');
Route::get('graficos/tablas', 'HomeController@tabla');

Route::get('/{slug?}', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');

// Route::get('cliente/{cliente}', 'ClienteController@index');
