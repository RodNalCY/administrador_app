<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
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
    public function index()
    {
        //
    }

    public function list_productos()
    {
        return view('pages.producto');
    }

    public function list_clientes()
    {
        return view('pages.cliente');
    }

    public function list_empleados()
    {
        return view('pages.empleado');
    }

    public function list_proveedores()
    {
        return view('pages.proveedor');
    }

    public function list_presentaciones()
    {
        return view('pages.presentacion');
    }

    public function list_laboratorios()
    {
        return view('pages.laboratorio');
    }

    public function list_comprobantes()
    {
        return view('pages.comprobante');
    }

    
}
