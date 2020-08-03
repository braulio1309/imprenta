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

Route::get('/home', function() {
    return redirect()->route('clientes.mostrar');
})->name('home')->middleware('auth');

//Clientes
Route::get('/clientes/mostrar', 'ClientesController@AllClientes')->name('clientes.mostrar');
Route::get('/clientes/registro', 'ClientesController@registro_vista')->name('clientes.registro.vista');
Route::post('/clientes/registro', 'ClientesController@registro')->name('clientes.registro');
Route::get('/clientes/actualizar/{id}', 'ClientesController@actualizar_vista')->name('clientes.actualizar.vista');
Route::post('/clientes/actualizar/{id}', 'ClientesController@actualizar')->name('clientes.actualizar');
Route::post('/clientes/mostrar', 'ClientesController@buscador')->name('clientes.buscador');
Route::post('/clientes/actualizar/{id}', 'ClientesController@actualizar')->name('clientes.actualizar');
Route::post('/clientes/buscar', 'ClientesController@buscador')->name('clientes.buscador');

//Materiales
Route::get('/materiales/mostrar',         'MaterialesController@AllMateriales')     ->name('materiales.mostrar');
Route::get('/materiales/registro',        'MaterialesController@registro_vista')    ->name('materiales.registro.vista');
Route::post('/materiales/registro',       'MaterialesController@registro')          ->name('materiales.registro');
Route::get('/materiales/actualizar/{id}', 'MaterialesController@actualizar_vista')  ->name('materiales.actualizar.vista');
Route::post('/materiales/actualizar/{id}','MaterialesController@actualizar')        ->name('materiales.actualizar');

//Cuentas
Route::get( '/pedidos/mostrar',         'CuentasController@AllCuentas')        ->name('pedidos.mostrar');

//Pedidos
Route::get( '/pedidos/mostrar/{id}',         'PedidosController@pedidos')        ->name('pedidos.pedidos.mostrar');
Route::get( '/pedidos/registro/{cuenta_id}',              'PedidosController@registro')        ->name('pedidos.pedidos.registro');
Route::post( '/pedidos/registro/{cuenta_id}',             'PedidosController@new_registro')        ->name('pedidos.nuevo.registro');
Route::name('pedidos.pdf')->get('/pedidos/imprimir/{id}', 'PedidosController@imprimir');

//Detalle pedidos
Route::get( '/pedidos/detalle/{id}',         'DetallePedidosController@Detalle')        ->name('pedidos.detalle.mostrar');

//Pagos
Route::get('/pagos/mostrar',              'PagosController@AllPagos')            ->name('pagos.mostrar');
Route::get('/pagos/reportar/{id}',        'PagosController@registro_vista')      ->name('pagos.reportar.vista');
Route::post('/pagos/registro',            'PagosController@registro')            ->name('pagos.registro');
Route::get('/pagos/pagar/{pedido_id}',            'PagosController@pagar')            ->name('pagos.pagar.pedido');
Route::post('/pagos/reporte',            'PagosController@pagos')            ->name('pagos.reporte');
Route::get('/pagos/reporte/fecha',            'PagosController@pagosFecha')            ->name('pagos');
Route::get('/pagos/reporte/excel/{fecha_inicio}/{fecha_fin}',            'PagosController@pagosExcel')            ->name('pagos.reporte.excel');


//Reporte
Route::get('/reporte/material/fechas','DetallePedidosController@ReporteMaterialVista')->name('reporte.material.vista');
Route::post('/reporte/material', 'DetallePedidosController@ReporteMaterial')->name('reporte.material');
Route::get('/reporte/material/precio/{fecha_inicio}/{fecha_fin}','DetallePedidosController@ReporteMaterialPrecio')->name('reporte.material.precio');
Route::get('/reporte/material/cantidad/{fecha_inicio}/{fecha_fin}','DetallePedidosController@ReporteMaterialCantidad')->name('reporte.material.cantidad');
Route::get('/reportes/deudores', 'CuentasController@deudores')->name('reporte.deudores');
Route::get('/reporte/ingreso', 'PedidosController@PedidosFecha')->name('pedidos.fechas');
Route::post('/reportes/ingreso', 'PedidosController@PedidosFechaReporte')->name('pedidos.fechas.reporte');




