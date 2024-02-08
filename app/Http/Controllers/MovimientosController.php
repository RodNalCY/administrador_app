<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Ventas;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Dompdf\Dompdf;
use Dompdf\Options;
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
                'message' => 'GET - Voucher',
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

    public function generar_pdf_voucher(Request $request)
    {
        try {

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);

            // Crear instancia de dompdf con las opciones
            $dompdf = new Dompdf($options);

            // Puedes pasar valores a la vista usando el método with()      
            $datos = ['nombre' => 'Juan', 'monto' => 100];

            // Renderiza la vista con los datos proporcionados
            $html = view('pages.pdf.voucher')->with($datos)->render();

            // Cargar HTML en dompdf
            $dompdf->loadHtml($html);

            // Establecer tamaño de hoja como boleta (tamaño estándar)
            //x inicio, y inicio, ancho final, alto final
            $dompdf->setPaper([0, 0, 250,  800]);

            // Renderizar PDF
            $dompdf->render();

            // Obtener el contenido del PDF
            $pdfContent = $dompdf->output();

            // Nombre de archivo para el PDF

            $fileName = 'voucher_impreso_' . $request->_time . '.pdf';

            // Guardar el contenido del PDF en el disco 'public2'
            $path = 'downloads/pdf/' . $fileName;
            $resultado = Storage::disk('public2')->put($fileName, $pdfContent);

            if ($resultado) {
                return response()->json([
                    'status' => true,
                    'ruta_pdf' => $path,
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
