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


        // Datos del gráfico (puedes cambiar esto según tus necesidades)
        $labels1 = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre'];
        $data1 = [10, 25, 35, 30, 45, 25, 15, 10, 5, 45, 60,];

        $labels2 = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
        $data2 = ['25','25','35','20','35','40','50'];

        $labels3 = ['Inyectable', 'Pildoras', 'Jarabes', 'Gasas', 'Otros'];
        $data3 = ['25','15','35','16','12'];

        $labels4 = ['Categoría 1', 'Categoría 2', 'Categoría 3'];
        $data4 = [10, 15, 0.5];


        return view('home', compact('labels1','labels2','labels3','labels4', 'data1', 'data2', 'data3', 'data4'));
    }
}
