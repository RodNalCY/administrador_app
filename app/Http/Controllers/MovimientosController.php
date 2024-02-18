<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compras;
use App\Models\Comprobante;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Ventas;
use App\Models\VentasLog;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

// use Dompdf\Dompdf;
// use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
            $ventas = Ventas::selectRaw('producto.idProducto, producto.Descripcion, detalleventa.Costo, detalleventa.Precio, SUM( detalleventa.Cantidad ) AS cantidades, SUM( detalleventa.Importe ) AS importe, SUM( detalleventa.Cantidad * detalleventa.Costo ) AS costo_total,
            SUM( detalleventa.Importe ) - SUM( detalleventa.Cantidad * detalleventa.Costo ) AS ganancias, ventas.Fecha, ventas_log.fecha_venta')
                ->join('detalleventa', 'ventas.IdVenta', '=', 'detalleventa.IdVenta')
                ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
                ->join('ventas_log', 'detalleventa.IdVenta', '=', 'ventas_log.venta_id')
                ->where('ventas.Fecha', $request->fecha)
                ->groupBy('producto.idProducto', 'producto.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio', 'detalleventa.Importe', 'ventas.Fecha', 'ventas_log.fecha_venta')
                ->orderBy('ventas_log.fecha_venta', 'DESC')
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
            $ventas_general = DetalleVenta::selectRaw('producto.idProducto, producto.Descripcion, presentacion.Descripcion AS presentacion, detalleventa.Costo, detalleventa.Precio, SUM( detalleventa.Cantidad ) AS cantidades, SUM( detalleventa.Importe ) AS importe, SUM( detalleventa.Cantidad * detalleventa.Costo ) AS costo_total, SUM( detalleventa.Importe ) - SUM( detalleventa.Cantidad * detalleventa.Costo ) AS ganancias')
                ->join('ventas', 'detalleventa.IdVenta', '=', 'ventas.IdVenta')
                ->join('producto', 'detalleventa.idProducto', '=', 'producto.idProducto')
                ->join('presentacion', 'producto.idPresentacion', '=', 'presentacion.idPresentacion')
                ->where('ventas.Fecha', ">=", $request->fecha_init)
                ->where('ventas.Fecha', "<=", $request->fecha_end)
                ->groupBy('producto.idProducto', 'producto.Descripcion', 'presentacion.Descripcion', 'detalleventa.Costo', 'detalleventa.Precio', 'detalleventa.Cantidad', 'detalleventa.Importe')
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

    public function number_ticket_venta()
    {
        try {
            $ultimoId = Ventas::max('IdVenta');
            if ($ultimoId !== null) {
                $suma = $ultimoId + 1;
                $ticket = "FARMA000" . $suma;
            } else {
                $ticket = "FARMA0001";
            }

            return response()->json([
                'message' => 'GET - Voucher Venta',
                'status' => true,
                'data' =>  $ticket
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_venta_productos(Request $request)
    {
        try {

            $createVenta = new Ventas;
            $createVenta->Serie = "10001";
            $createVenta->Numero = $request->_list_details_productos[0]['comprobanteNumero'];
            $createVenta->Fecha = $request->_list_details_productos[0]['fechaVenta'];
            $createVenta->VentaTotal = $request->_list_details_productos[0]['ventaTotal'];
            $createVenta->Descuento = $request->_list_details_productos[0]['descuento'];
            $createVenta->SubTotal = $request->_list_details_productos[0]['subtotal'];
            $createVenta->Igv = $request->_list_details_productos[0]['valorIGV'];
            $createVenta->Total = $request->_list_details_productos[0]['valorTotal'];
            $createVenta->Estado = $request->_list_details_productos[0]['estado'];
            $createVenta->idCliente = intval($request->_list_details_productos[0]['clienteId']);
            $createVenta->idEmpleado = intval($request->_list_details_productos[0]['empleadoId']);
            $createVenta->idTipoComprobante = intval($request->_list_details_productos[0]['comprobanteId']);

            $status = false;
            $message = "upps, algo paso no se guardo !";
            if ($createVenta->save()) {
                $idVenta = $createVenta->IdVenta;

                foreach ($request->_list_ventas_productos as $dv) {
                    $detalle = new DetalleVenta;
                    $detalle->IdVenta = intval($idVenta);
                    $detalle->idProducto = intval($dv['productoId']);
                    $detalle->Cantidad = intval($dv['cantidad']);
                    $detalle->Costo = $dv['costo'];
                    $detalle->Precio = $dv['precio'];
                    $detalle->Importe = $dv['total'];
                    if ($detalle->save()) {
                        $producto = Producto::find(intval($dv['productoId']));
                        $updateStock = $producto->Stock - intval($dv['cantidad']);
                        $producto->Stock = intval($updateStock);
                        $producto->update();
                    }
                }
                $status = true;
                $message = "Se registro correctamente las ventas";
            }



            return response()->json([
                'message' => $message,
                'status' => $status,
                'data' => $createVenta,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function number_ticket_compra()
    {
        try {
            $ultimoId = Compras::max('IdCompra');
            if ($ultimoId !== null) {
                $suma = $ultimoId + 1;
                $ticket = "COMPRA000" . $suma;
            } else {
                $ticket = "COMPRA0001";
            }

            return response()->json([
                'message' => 'GET - Voucher Compra',
                'status' => true,
                'data' =>  $ticket
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_compra_productos(Request $request)
    {
        try {


            $createCompra = new Compras;
            $createCompra->Numero = $request->_compras_details_lista[0]['comprobanteNumero'];
            $createCompra->Fecha = $request->_compras_details_lista[0]['fechaCompra'];
            $createCompra->TipoPago = "-";
            $createCompra->SubTotal = $request->_compras_details_lista[0]['subtotal'];
            $createCompra->Total = $request->_compras_details_lista[0]['valorTotal'];
            $createCompra->Igv = $request->_compras_details_lista[0]['valorIGV'];
            $createCompra->Estado = $request->_compras_details_lista[0]['estado'];
            $createCompra->idProveedor = intval($request->_compras_details_lista[0]['provedorId']);
            $createCompra->idEmpleado = intval($request->_compras_details_lista[0]['empleadoId']);
            $createCompra->idTipoComprobante = intval($request->_compras_details_lista[0]['comprobanteId']);

            $status = false;
            $message = "upps, algo paso no se guardo !";
            if ($createCompra->save()) {
                $idCompra = $createCompra->idCompra;

                foreach ($request->_compras_productos_lista as $dc) {
                    $detalle = new DetalleCompra;
                    $detalle->idCompra = intval($idCompra);
                    $detalle->idProducto = intval($dc['productoId']);
                    $detalle->Cantidad = intval($dc['cantidad']);
                    $detalle->Costo = $dc['costo'];
                    $detalle->Importe = $dc['total'];
                    if ($detalle->save()) {
                        $producto = Producto::find(intval($dc['productoId']));
                        $updateStock = $producto->Stock + intval($dc['cantidad']);
                        $producto->Stock = intval($updateStock);
                        $producto->update();
                    }
                }
                $status = true;
                $message = "Se registro correctamente las ventas";
            }

            return response()->json([
                'message' => $message,
                'status' => $status,
                'data' => $createCompra,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function generar_pdf_voucher(Request $request)
    {
        try {
            // Generar el PDF x, y, width, heigth
            // 1 producto 
            $add_height = 20 * intval($request->_total_productos);
            $width = 250;
            $height = 700 + $add_height; //Dinamico - aumenta en 20 por cada producto
            $pdf = PDF::setPaper([0, 0, $width, $height])->loadView('pages.pdf.voucher', [
                'detalle' => $request->_list_details_productos[0],
                'productos' => $request->_list_ventas_productos,
                'fecha_hora' => $request->_time,
                'total_pagar_texto' => $request->_total_pagar_texto,
            ]);

            $pdfContent = $pdf->output();

            // Nombre del archivo y ubicación donde se guardará
            $replace_time = str_replace("/", "_", $request->_time);
            $replace_time = str_replace(":", "_", $replace_time);
            $replace_time = str_replace(" ", "_", $replace_time);

            $fileName = 'voucher_impreso_' . $replace_time . '.pdf';
            $filePath = 'downloads/pdf/' . $fileName;

            // Guardar el archivo en el disco
            $resultado =  Storage::disk('public2')->put($fileName, $pdfContent);

            if ($resultado) {

                $log_venta = new VentasLog;
                $log_venta->comp_id = $request->_list_details_productos[0]['comprobanteId'];
                $log_venta->comp_name = $request->_list_details_productos[0]['comprobanteName'];
                $log_venta->fecha_venta = $request->_time;
                $log_venta->vendedor_id = $request->_list_details_productos[0]['empleadoId'];
                $log_venta->cliente_id = $request->_list_details_productos[0]['clienteId'];
                $log_venta->valor_total = $request->_list_details_productos[0]['ventaTotal'];
                $log_venta->texto_valor_total = $request->_total_pagar_texto;
                $log_venta->ruta_comprobante = $filePath;
                $log_venta->venta_id = $request->_list_details_productos[0]['ventaId'];
                $log_venta->dia_venta = $request->_global_dia_venta;

                if ($log_venta->save()) {
                    return response()->json([
                        'status' => true,
                        'ruta_pdf' => $filePath,
                        'height_pdf' => $height,
                        'total_pagar' =>  $request->_total_pagar_texto,
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'ruta_pdf' => null,
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
