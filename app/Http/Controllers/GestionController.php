<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
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
}
