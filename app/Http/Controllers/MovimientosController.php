<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Proveedor;
use Exception;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:movimientos.caja')->only('index_caja');
    }
    /**
     * Display a listing of the resource.
     */
    public function index_compras()
    {
        return view('pages.movimientos.compras');
    }

    public function index_ventas()
    {
        return view('pages.movimientos.ventas');
    }

    public function index_caja()
    {
        return view('pages.movimientos.caja');
    }

    public function list_activo_clientes()
    {
        try {
            $clientes = Cliente::orderBy("idCliente", "DESC")->where('Estado', 'Activo')->get();

            return response()->json([
                'message' => 'lista de clientes activos',
                'status' => true,
                'data' => $clientes
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_activo_comprobantes()
    {
        try {
            $comprobantes = Comprobante::where('Estado', 'Activo')->get();

            return response()->json([
                'message' => 'lista de comprobantes activos',
                'status' => true,
                'data' => $comprobantes
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_activo_productos()
    {
        try {
            $productos = Producto::with(['presentacion', 'laboratorio'])->where('Estado', 'Activo')->get();

            return response()->json([
                'message' => 'lista de productos activos',
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


    public function listResumenDiario(Request $request)
    {

        try {
            $ventas = DetalleVenta::selectRaw('producto.idProducto, producto.Descripcion, SUM(detalleventa.Cantidad) AS cantidades, detalleventa.Costo, detalleventa.Precio, SUM(detalleventa.Importe) AS importe, (SUM(detalleventa.Cantidad)* detalleventa.Costo) AS costo_total, SUM( detalleventa.Importe) - (SUM( detalleventa.Cantidad) * detalleventa.Costo) AS ganancias, ventas.Fecha')
                ->join('ventas', 'detalleventa.IdVenta', '=', 'ventas.IdVenta')
                ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
                ->where('ventas.Fecha', $request->fecha)
                ->groupBy('producto.idProducto', 'producto.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio', 'ventas.Fecha')
                ->get();

            return response()->json([
                'message' => 'lista de proveedores',
                'status' => true,
                'data' => $ventas
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function listResumenDetalle(Request $request)
    {

        try {
            $ventas_general = DetalleVenta::selectRaw('producto.idProducto, producto.Descripcion, presentacion.Descripcion AS presentacion, detalleventa.Precio,
            SUM( detalleventa.Cantidad ) AS cantidades, detalleventa.Costo,  SUM( detalleventa.Importe ) AS importe, ( SUM( detalleventa.Cantidad )* detalleventa.Costo ) AS costo_total, SUM( detalleventa.Importe ) - ( SUM( detalleventa.Cantidad )* detalleventa.Costo ) AS ganancias')
                ->join('ventas', 'detalleventa.IdVenta', '=', 'ventas.IdVenta')
                ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
                ->join('presentacion', 'producto.idPresentacion', '=', 'presentacion.idPresentacion')
                ->where('ventas.Fecha', ">=", $request->fecha_init)
                ->where('ventas.Fecha', "<=", $request->fecha_end)
                ->groupBy('producto.idProducto', 'producto.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio')
                ->orderBy('producto.idProducto', 'ASC')
                ->get();

            return response()->json([
                'message' => 'lista de proveedores',
                'status' => true,
                'data' => $ventas_general
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
