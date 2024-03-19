<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compras;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\User;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function index_perfil()
    {
        return view('pages.configuracion.perfil');
    }

    public function dashboard_user_details()
    {
        try {

            $user = User::with('empleado')
                ->where('id', Auth::user()->id)
                ->first();

            if ($user) {
                return response()->json([
                    'message' => 'GET - User',
                    'status' => true,
                    'data' => $user
                ]);
            } else {
                // Usuario no encontrado
                return response()->json([
                    'message' => 'ERROR GET - User',
                    'status' => false,
                ], 404);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    private function get_semana()
    {
        try {
            // Obtener la fecha actual
            $currentDate = Carbon::now();
            // Formatear la fecha en el formato deseado
            $formattedDate = $currentDate->format('Y-m-d');
            // Definir la fecha actual o cualquier otra fecha de referencia
            $fecha_referencia = $formattedDate; // Puedes usar date('Y-m-d') para la fecha actual
            // Obtener el número de la semana
            $numero_semana = date('W', strtotime($fecha_referencia));
            // Obtener el primer día de la semana (Lunes)
            $primer_dia_semana = date('Y-m-d', strtotime($fecha_referencia . " -" . (date('N', strtotime($fecha_referencia)) - 1) . " days"));
            // Obtener el último día de la semana (Domingo)
            $ultimo_dia_semana = date('Y-m-d', strtotime($fecha_referencia . " +" . (7 - date('N', strtotime($fecha_referencia))) . " days"));

            return [$primer_dia_semana,  $ultimo_dia_semana];
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_total_ventas_mensuales()
    {

        try {
            $data = [];
            $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            // Obtener todos los meses del año
            $mesesDelAno = [];
            for ($i = 1; $i <= 12; $i++) {
                $mesesDelAno[] = date('Y-m', mktime(0, 0, 0, $i, 1));
            }

            // Obtener ventas por mes
            $ventasPorMes = Ventas::selectRaw('DATE_FORMAT(Fecha, "%Y-%m") AS mes, COUNT(*) AS total')
                ->whereBetween('Fecha', ['2024-01-01', '2024-12-31'])
                ->groupBy('mes')
                ->orderBy('mes', 'ASC')
                ->pluck('total', 'mes') // Utiliza pluck para obtener un array asociativo con el mes como clave y el total como valor
                ->toArray();

            // Combinar todos los meses con los datos de ventas
            foreach ($mesesDelAno as $mes) {
                $data[] = isset($ventasPorMes[$mes]) ? $ventasPorMes[$mes] : 0;
            }

            return response()->json([
                'message' => 'dashboard Total ventas mensuales',
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
            $data = [];
            $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            // Obtener todos los meses del año
            $mesesDelAno = [];
            for ($i = 1; $i <= 12; $i++) {
                $mesesDelAno[] = date('Y-m', mktime(0, 0, 0, $i, 1));
            }

            // Obtener la suma de ventas por mes
            $sumaVentaMes = Ventas::selectRaw('DATE_FORMAT(Fecha, "%Y-%m") AS mes, SUM(ventas.VentaTotal) AS suma')
                ->whereBetween('Fecha', ['2024-01-01', '2024-12-31'])
                ->groupBy('mes')
                ->orderBy('mes', 'ASC')
                ->pluck('suma', 'mes') // Utiliza pluck para obtener un array asociativo con el mes como clave y la suma como valor
                ->toArray();

            // Combinar todos los meses con los datos de ventas
            foreach ($mesesDelAno as $mes) {
                $data[] = isset($sumaVentaMes[$mes]) ? $sumaVentaMes[$mes] : 0;
            }

            return response()->json([
                'message' => 'dashboard Ingreso mensual',
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

    public function dashboard_suma_ventas_semana()
    {
        try {
            $data = [];
            $labels = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];



            $sumaVentaDia = Ventas::selectRaw('ventas_log.dia_venta as day, SUM(ventas.VentaTotal) as suma, ventas.Fecha')
                ->join('ventas_log', 'ventas.IdVenta', '=', 'ventas_log.venta_id')
                ->whereBetween('ventas.Fecha', $this->get_semana())
                ->groupBy('ventas_log.dia_venta', 'ventas.Fecha')
                ->orderBy('day', 'ASC')
                ->pluck('suma', 'day') // Utiliza pluck para obtener un array asociativo con el mes como clave y la suma como valor
                ->toArray();

            // Combinar todos los meses con los datos de ventas
            foreach ($labels as $day) {
                $data[] = isset($sumaVentaDia[$day]) ? $sumaVentaDia[$day] : 0;
            }


            return response()->json([
                'message' => 'dashboard Ingresos por Semana',
                'status' => true,
                'labels' => $labels,
                'data' => $data,
                'semana' => $this->get_semana()
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_total_ventas_semana()
    {
        try {
            $data = [];
            $labels = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];


            $totalVentaDia = Ventas::selectRaw('ventas_log.dia_venta as day, COUNT(*) as total, ventas.Fecha')
                ->join('ventas_log', 'ventas.IdVenta', '=', 'ventas_log.venta_id')
                ->whereBetween('ventas.Fecha', $this->get_semana())
                ->groupBy('ventas_log.dia_venta', 'ventas.Fecha')
                ->orderBy('day', 'ASC')
                ->pluck('total', 'day') // Utiliza pluck para obtener un array asociativo con el mes como clave y la suma como valor
                ->toArray();

            // Combinar todos los meses con los datos de ventas
            foreach ($labels as $day) {
                $data[] = isset($totalVentaDia[$day]) ? $totalVentaDia[$day] : 0;
            }


            return response()->json([
                'message' => 'dashboard Total venta por Semana',
                'status' => true,
                'labels' => $labels,
                'data' => $data,
                'semana' => $this->get_semana()
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_verificar_password(Request $request)
    {
        try {
            $getEmail = Auth::user()->email;
            $getPassw = $request->_password;
            // Intentar autenticar al usuario con las credenciales proporcionadas
            $status = false;
            if (Auth::attempt(['email' => $getEmail, 'password' => $getPassw])) {
                // Si la autenticación es exitosa, redirigir a la página de inicio o donde sea necesario
                $status = true;
            }

            return response()->json([
                'message' => 'Verificar Contraseña!',
                'status' => $status,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_update_password(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->_neo_password);
            $status = false;
            if ($user->update()) {
                $status = true;
            }

            return response()->json([
                'message' => 'Actualizar Contraseña!',
                'status' => $status,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
