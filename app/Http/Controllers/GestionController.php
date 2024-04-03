<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Ventas;
use DateTime;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */

    public function index_gestion_ventas()
    {
        return view('pages.gestion.gestion_ventas');
    }

    public function index_gestion_compras()
    {
        return view('pages.gestion.gestion_compras');
    }

    public function index_gestion_productos()
    {
        return view('pages.gestion.gestion_productos');
    }

    public function list_gestion_ventas()
    {
        try {

            $ventas_log = Ventas::selectRaw('ventas_log.id, ventas.Numero, CONCAT( empleado.Nombres, " ", empleado.Apellidos ) AS empleado,
            CONCAT( cliente.Nombres, " ", cliente.Apellidos ) AS cliente, ventas_log.comp_name, ventas_log.valor_total,
            ventas_log.texto_valor_total, ventas_log.ruta_comprobante, ventas_log.fecha_venta')
                ->join('empleado', 'ventas.idEmpleado', '=', 'empleado.idEmpleado')
                ->join('cliente', 'ventas.idCliente', '=', 'cliente.idCliente')
                ->join('ventas_log', 'ventas.IdVenta', '=', 'ventas_log.venta_id')
                ->orderBy('ventas_log.id', 'DESC')
                ->get();

            return response()->json([
                'message' => 'lista de gestión de ventas',
                'status' => true,
                'data' => $ventas_log
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_gestion_compras()
    {
        try {

            $compras_log = Compras::selectRaw('
            compra.idCompra,
            compras_log.id, 
            compra.Numero, CONCAT( empleado.Nombres, " ", empleado.Apellidos ) AS empleado,
            proveedor.Nombre as proveedor_name, 
            compras_log.comp_name, 
            compras_log.valor_total, 
            compras_log.texto_valor_total, 
            compras_log.fecha_compra,
            DATE_FORMAT(compras_log.fecha_compra, "%H:%i:%s %d-%m-%Y") AS fecha_compra_formateada
            ')
                ->join('empleado', 'compra.idEmpleado', '=', 'empleado.idEmpleado')
                ->join('proveedor', 'compra.idProveedor', '=', 'proveedor.idProveedor')
                ->join('compras_log', 'compra.idCompra', '=', 'compras_log.compra_id')
                ->orderBy('compras_log.id', 'DESC')
                ->get();

            return response()->json([
                'message' => 'lista de gestión de compras',
                'status' => true,
                'data' => $compras_log
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_gestion_details_compras(Request $request)
    {
        try {

            $compras_log = Compras::selectRaw('
            compra.idCompra,
            compras_log.id, 
            compra.Numero, 
            CONCAT( empleado.Nombres, " ", empleado.Apellidos ) AS empleado,
            proveedor.Nombre as proveedor_name, 
            compras_log.comp_name, 
            compras_log.valor_total, 
            compras_log.texto_valor_total, 
            compras_log.fecha_compra,
            DATE_FORMAT(compras_log.fecha_compra, "%H:%i:%s %d-%m-%Y") AS fecha_compra_formateada
            ')
                ->join('empleado', 'compra.idEmpleado', '=', 'empleado.idEmpleado')
                ->join('proveedor', 'compra.idProveedor', '=', 'proveedor.idProveedor')
                ->join('compras_log', 'compra.idCompra', '=', 'compras_log.compra_id')
                ->where('compra.idCompra', $request->_id)
                ->orderBy('compras_log.id', 'DESC')
                ->get();

            $compras_detalle = DetalleCompra::selectRaw('
            detallecompra.idCompra, 
            detallecompra.idProducto, 
            detallecompra.Cantidad, 
            detallecompra.Costo, 
            detallecompra.Importe,
            CONCAT(producto.Descripcion, " ", producto.Concentracion) AS producto_name')
                ->join('producto', 'detallecompra.idProducto', '=', 'producto.idProducto')
                ->where('detallecompra.idCompra', $request->_id)
                ->get();;

            return response()->json([
                'message' => 'lista de gestión de compras detalle',
                'status' => true,
                'data_detalle' => $compras_detalle,
                'data_compra' => $compras_log,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_gestion_productos()
    {
        try {

            $productos = Producto::with(['presentacion', 'laboratorio'])->limit(10)->get();
            foreach ($productos as $key) {
                $fechaOriginal = $key->updated_at;
                $fecha = new DateTime($fechaOriginal);
                $fechaFormateada = $fecha->format('H:i:s d/m/Y');
                $key->fechita = $fechaFormateada; 
            }


            return response()->json([
                'message' => 'lista de productos gestion',
                'status' => true,
                'data' => $productos
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
