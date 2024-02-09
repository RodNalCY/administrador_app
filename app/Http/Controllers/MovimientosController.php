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
        try {            // Generar el PDF
            $pdf = PDF::setPaper([0, 0, 250,  800])->loadView('pages.pdf.voucher', ['titulo' => 'Rodnal']);
            $pdfContent = $pdf->output();

            // Nombre del archivo y ubicación donde se guardará
            $fileName = 'voucher_impreso_' . $request->_time . '.pdf';
            $filePath = 'downloads/pdf/' . $fileName;

            // Guardar el archivo en el disco
            $resultado =  Storage::disk('public2')->put($fileName, $pdfContent);

            if ($resultado) {
                return response()->json([
                    'status' => true,
                    'ruta_pdf' => $filePath,
                ]);
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
