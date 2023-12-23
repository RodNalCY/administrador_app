<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\MovimientosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});


Route::controller(MantenimientoController::class)->group(function () {
    Route::get('/producto', 'list_productos')->name('producto');
    Route::get('/cliente', 'list_clientes')->name('cliente');
    Route::get('/empleado', 'list_empleados')->name('empleado');
    Route::get('/proveedor', 'list_proveedores')->name('proveedor');
    Route::get('/presentacion', 'list_presentaciones')->name('presentacion');
    Route::get('/laboratorio', 'list_laboratorios')->name('laboratorio');
    Route::get('/comprobante', 'list_comprobantes')->name('comprobante');
});

Route::controller(MovimientosController::class)->group(function () {
    Route::get('/compras', 'index_compras')->name('compras');
    Route::get('/ventas', 'index_ventas')->name('ventas');
    Route::get('/caja', 'index_caja')->name('caja');

    // ROUTES VENTAS
    Route::get('/list/clientes', 'listClientes')->name('/list/clientes'); 
    
    // ROUTES COMPRAS
    Route::get('/list/proveedores', 'listProveedores')->name('/list/proveedores');

    // ROUTES COMPARTIDAS
    Route::get('/list/productos', 'listProductos')->name('/list/productos');
    Route::get('/list/comprobantes', 'listComprobantes')->name('/list/comprobantes');

    // ROUTES CAJA
    Route::post('/list/resumen/diario', 'listResumenDiario')->name('/list/resumen/diario');
    Route::post('/list/resumen/detalle', 'listResumenDetalle')->name('/list/resumen/detalle');
});
