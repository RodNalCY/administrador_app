<?php

namespace App\Http\Controllers;

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
    }
    /**
     * Display a listing of the resource.
     */
    public function list_compras()
    {
        return view('pages.compras');
    }

    public function list_ventas()
    {
        return view('pages.ventas');
    }

    public function list_caja()
    {
        return view('pages.caja');
    }
}
