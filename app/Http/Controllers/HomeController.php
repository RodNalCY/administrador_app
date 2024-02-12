<?php

namespace App\Http\Controllers;

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

    public function dashboard_ingreso_mensuales()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)
            $labels1 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'];
            $data1 = [2, 25, 35, 30, 11, 25, 15, 10, 5, 45, 60,];

            return response()->json([
                'message' => 'dashboard ingreso mensuales',
                'status' => true,
                'labels' => $labels1,
                'data' => $data1,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function dashboard_ingreso_semanales()
    {

        try {
            // Datos del gráfico (puedes cambiar esto según tus necesidades)

            $labels2 = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
            $data2 = ['2', '25', '35', '20', '35', '40', '30'];

            return response()->json([
                'message' => 'dashboard ingreso semanales',
                'status' => true,
                'labels' => $labels2,
                'data' => $data2,
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
}
