<?php

use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\MenuController;
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


Route::controller(MovimientosController::class)->group(function () {
    Route::get('/movimientos/compras', 'index_compras')->name('compras');
    Route::get('/movimientos/ventas', 'index_ventas')->name('ventas');
    Route::get('/movimientos/caja', 'index_caja')->name('caja');

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

Route::controller(MantenimientoController::class)->group(function () {
    Route::get('/mantenimiento/productos', 'index_productos')->name('productos');
    Route::get('/mantenimiento/clientes', 'index_clientes')->name('clientes');
    Route::get('/mantenimiento/empleados', 'index_empleados')->name('empleados');
    Route::get('/mantenimiento/proveedores', 'index_proveedores')->name('proveedores');
    Route::get('/mantenimiento/presentacion', 'index_presentaciones')->name('presentacion');
    Route::get('/mantenimiento/laboratorios', 'index_laboratorios')->name('laboratorios');
    Route::get('/mantenimiento/comprobantes', 'index_comprobantes')->name('comprobantes');
});

Route::controller(AdministradorController::class)->group(function () {
    Route::get('/administrador/usuarios', 'index_usuarios')->name('usuarios');
    Route::get('/administrador/roles', 'index_roles')->name('roles');
    Route::get('/administrador/permisos', 'index_permisos')->name('permisos');

    // ROUTES USUARIOS
    Route::get('/list/usuarios', 'list_usuarios')->name('/list/usuarios');

    // ROUTES ROLES
    Route::get('/list/roles', 'list_roles')->name('/list/roles');
    Route::post('/save/usuario', 'save_usuario')->name('/save/usuario');
    Route::post('/edit/usuario', 'edit_usuario')->name('/edit/usuario');

    // ROUTES PERMISOS
    Route::get('/list/permisos', 'list_permisos')->name('/list/permisos');

    // ROUTES COMPARTIDAS
    Route::get('/list/empleados', 'list_empleados')->name('/list/empleados');
  
   
});
