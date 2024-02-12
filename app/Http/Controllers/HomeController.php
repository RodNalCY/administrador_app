<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compras;
use App\Models\Producto;
use App\Models\Ventas;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard_total_ventas_mensuales()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)

            $data = [];
            $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'];

            $ventasPorMes = Ventas::selectRaw('DATE_FORMAT(Fecha, "%Y-%m") AS mes, COUNT(*) AS total')
                ->whereBetween('Fecha', ['2024-01-01', '2024-12-31'])
                ->groupBy('mes')
                ->orderBy('mes', 'ASC')
                ->get();

            if (count($ventasPorMes) > 0) {
                foreach ($ventasPorMes as $venta) {
                    array_push($data, $venta['total']);
                }
            }

            return response()->json([
                'message' => 'dashboard ingreso mensuales',
                'status' => true,
                'labels' => $labels,
                'data' => $data,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_suma_ventas_mensuales()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)

            $data = [];
            $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'];

            $sumaVentaMes = Ventas::selectRaw('	DATE_FORMAT( Fecha, "%Y-%m" ) AS mes, SUM(ventas.VentaTotal) AS suma')
                ->whereBetween('Fecha', ['2024-01-01', '2024-12-31'])
                ->groupBy('mes')
                ->orderBy('mes', 'ASC')
                ->get();

            if (count($sumaVentaMes) > 0) {
                foreach ($sumaVentaMes as $venta) {
                    array_push($data, $venta['suma']);
                }
            }

            return response()->json([
                'message' => 'dashboard ingreso semanales',
                'status' => true,
                'labels' => $labels,
                'data' => $data,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_total_presentaciones()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)
            $labels3 = ['Inyectable', 'Pildoras', 'Jarabes', 'Gasas', 'Otros'];
            $data3 = ['25', '15', '60', '16', '12'];

            return response()->json([
                'message' => 'dashboard total de presentaciones',
                'status' => true,
                'labels' => $labels3,
                'data' => $data3,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_total_laboratorios()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)
            $labels4 = ['Categoría 1', 'Categoría 2', 'Categoría 3'];
            $data4 = [10, 15, 0.5];


            return response()->json([
                'message' => 'dashboard total de laboratorios',
                'status' => true,
                'labels' => $labels4,
                'data' => $data4,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_resumen()
    {

        try {
            $total_ventas = Ventas::whereBetween('Fecha', ['2024-01-01', '2024-12-31'])->get();
            $total_compras = Compras::whereBetween('Fecha', ['2024-01-01', '2024-12-31'])->get();
            $total_clientes = Cliente::all();
            $total_productos = Producto::all();


            return response()->json([
                'message' => 'dashboard resumen',
                'status' => true,
                'total_ventas' => count($total_ventas),
                'total_compras' => count($total_compras),
                'total_clientes' => count($total_clientes),
                'total_productos' => count($total_productos),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
