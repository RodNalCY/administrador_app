<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\APIExternoController;
use App\Http\Controllers\GestionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MovimientosController;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/dashboard/resumen', 'dashboard_resumen')->name('/dashboard/resumen');

    Route::get('/dashboard/total/ventas/mensuales', 'dashboard_total_ventas_mensuales')->name('/dashboard/total/ventas/mensuales');
    Route::get('/dashboard/suma/ventas/mensuales', 'dashboard_suma_ventas_mensuales')->name('/dashboard/suma/ventas/mensuales');
    Route::get('/dashboard/total/presentaciones', 'dashboard_total_presentaciones')->name('/dashboard/total/presentaciones');
    Route::get('/dashboard/total/laboratorios', 'dashboard_total_laboratorios')->name('/dashboard/total/laboratorios');

    Route::get('/dashboard/suma/ventas/semana', 'dashboard_suma_ventas_semana')->name('/dashboard/suma/ventas/semana');
    Route::get('/dashboard/total/ventas/semana', 'dashboard_total_ventas_semana')->name('/dashboard/total/ventas/semana');
});


Route::controller(MovimientosController::class)->group(function () {
    Route::get('/movimientos/compras', 'index_compras')->name('compras');
    Route::get('/movimientos/ventas', 'index_ventas')->name('ventas');
    Route::get('/movimientos/caja', 'index_caja')->name('caja');

    // ROUTES CAJA
    Route::post('/list/resumen/diario', 'listResumenDiario')->name('/list/resumen/diario');
    Route::post('/list/resumen/detalle', 'listResumenDetalle')->name('/list/resumen/detalle');

    // ROUTES COMPARTIDAS
    Route::get('/list/activo/clientes', 'list_activo_clientes')->name('/list/activo/clientes');
    Route::get('/list/activo/comprobantes', 'list_activo_comprobantes')->name('/list/activo/comprobantes');
    Route::get('/list/activo/productos', 'list_activo_productos')->name('/list/activo/productos');

    // ROUTES VENTAS
    Route::get('/number/ticket/venta', 'number_ticket_venta')->name('/number/ticket/venta');
    Route::post('/save/venta/productos', 'save_venta_productos')->name('/save/venta/productos');
    Route::post('/generar/pdf/voucher', 'generar_pdf_voucher')->name('/generar/pdf/voucher');

    // ROUTES COMPRAS
    Route::get('/number/ticket/compra', 'number_ticket_compra')->name('/number/ticket/compra');
    Route::post('/save/compra/productos', 'save_compra_productos')->name('/save/compra/productos');
});

Route::controller(MantenimientoController::class)->group(function () {
    Route::get('/mantenimiento/productos', 'index_productos')->name('productos');
    Route::get('/mantenimiento/clientes', 'index_clientes')->name('clientes');
    Route::get('/mantenimiento/proveedores', 'index_proveedores')->name('proveedores');
    Route::get('/mantenimiento/presentacion', 'index_presentaciones')->name('presentacion');
    Route::get('/mantenimiento/laboratorios', 'index_laboratorios')->name('laboratorios');
    Route::get('/mantenimiento/comprobantes', 'index_comprobantes')->name('comprobantes');

    // ROUTES COMPROBANTES
    Route::get('/list/comprobantes', 'list_comprobantes')->name('/list/comprobantes');
    Route::post('/edit/comprobante', 'edit_comprobante')->name('/edit/comprobante');
    Route::post('/delete/comprobante', 'delete_comprobante')->name('/delete/comprobante');

    // ROUTES LABORATORIOS
    Route::get('/list/laboratorios', 'list_laboratorios')->name('/list/laboratorios');
    Route::post('/save/laboratorio', 'save_laboratorio')->name('/save/laboratorio');
    Route::post('/delete/laboratorio', 'delete_laboratorio')->name('/delete/laboratorio');
    Route::post('/edit/laboratorio', 'edit_laboratorio')->name('/edit/laboratorio');

    // ROUTES PRESENTACION
    Route::get('/list/presentaciones', 'list_presentaciones')->name('/list/presentaciones');
    Route::post('/save/presentacion', 'save_presentacion')->name('/save/presentacion');
    Route::post('/edit/presentacion', 'edit_presentacion')->name('/edit/presentacion');
    Route::post('/delete/presentacion', 'delete_presentacion')->name('/delete/presentacion');

    // ROUTES PROVEEDORES
    Route::get('/list/proveedores', 'list_proveedores')->name('/list/proveedores');
    Route::post('/save/proveedor', 'save_proveedor')->name('/save/proveedor');
    Route::post('/edit/proveedor', 'edit_proveedor')->name('/edit/proveedor');
    Route::post('/delete/proveedor', 'delete_proveedor')->name('/delete/proveedor');    

    // ROUTES PROVEEDORES
    Route::get('/list/clientes', 'list_clientes')->name('/list/clientes');
    Route::post('/save/cliente', 'save_cliente')->name('/save/cliente');
    Route::post('/edit/cliente', 'edit_cliente')->name('/edit/cliente');
    Route::post('/delete/cliente', 'delete_cliente')->name('/delete/cliente');

    // ROUTES PRODUCTOS
    Route::get('/list/productos', 'list_productos')->name('/list/productos');
    Route::post('/save/producto', 'save_producto')->name('/save/producto');
    Route::post('/edit/producto', 'edit_producto')->name('/edit/producto');
    Route::post('/delete/producto', 'delete_producto')->name('/delete/producto');

    // ROUTES COMPARTIDOS
    Route::get('/list/activo/presentaciones', 'list_activo_presentaciones')->name('/list/activo/presentaciones');
    Route::get('/list/activo/laboratorios', 'list_activo_laboratorios')->name('/list/activo/laboratorios');
    Route::get('/list/activo/empleados', 'list_activo_empleados')->name('/list/activo/empleados');

    Route::get('/session/activo/empleado', 'session_activo_empleado')->name('/session/activo/empleados');

    // Exportar Excel
    Route::get('/exportar/excel/producto', 'exportar_excel_producto')->name('/exportar/excel/producto');
    Route::get('/exportar/excel/clientes', 'exportar_excel_clientes')->name('/exportar/excel/clientes');
    Route::get('/exportar/excel/presentacion', 'exportar_excel_presentacion')->name('/exportar/excel/presentacion');
    Route::get('/exportar/excel/laboratorios', 'exportar_excel_laboratorios')->name('/exportar/excel/laboratorios');
    Route::get('/exportar/excel/proveedores', 'exportar_excel_proveedores')->name('/exportar/excel/proveedores');
});

Route::controller(AdministradorController::class)->group(function () {
    Route::get('/administrador/usuarios', 'index_usuarios')->name('usuarios');
    Route::get('/administrador/roles', 'index_roles')->name('roles');
    Route::get('/administrador/permisos', 'index_permisos')->name('permisos');    
    Route::get('/administrador/empleados', 'index_empleados')->name('empleados');

    // ROUTES USUARIOS
    Route::get('/list/usuarios', 'list_usuarios')->name('/list/usuarios');
    Route::post('/save/usuario', 'save_usuario')->name('/save/usuario');
    Route::post('/edit/usuario', 'edit_usuario')->name('/edit/usuario');
    Route::post('/delete/usuario', 'delete_usuario')->name('/delete/usuario');

    // ROUTES ROLES
    Route::get('/list/roles', 'list_roles')->name('/list/roles');
    Route::post('/save/role', 'save_role')->name('/save/role');
    Route::post('/delete/role', 'delete_role')->name('/delete/role');
    Route::post('/list/permisos/role', 'list_permisos_role')->name('/list/permisos/role');
    Route::post('/edit/role/permisos', 'edit_role_permisos')->name('/edit/role/permisos');

    // ROUTES PERMISOS
    Route::get('/list/permisos', 'list_permisos')->name('/list/permisos');
    Route::post('/save/permiso', 'save_permiso')->name('/save/permiso');
    Route::post('/edit/permiso', 'edit_permiso')->name('/edit/permiso');
    Route::post('/delete/permiso', 'delete_permiso')->name('/delete/permiso');

    // ROUTES PROVEEDORES
    Route::get('/list/empleados', 'list_empleados')->name('/list/empleados');
    Route::post('/save/empleado', 'save_empleado')->name('/save/empleado');
    Route::post('/edit/empleado', 'edit_empleado')->name('/edit/empleado');
    Route::post('/delete/empleado', 'delete_empleado')->name('/delete/empleado');
});

Route::controller(GestionController::class)->group(function () {
    Route::get('/gestion/ventas', 'index_gestion_ventas')->name('/gestion/ventas');
    // ROUTES CONSULTAR VENTAS
    Route::get('/list/gestion/ventas', 'list_gestion_ventas')->name('/list/gestion/ventas');
});

Route::controller(APIExternoController::class)->group(function () {
    Route::post('/reniec/dni/api', 'reniec_dni_api')->name('/reniec/dni/api');
});

