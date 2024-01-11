<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AdministradorController extends Controller
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
    
    public function index_usuarios()
    {
        return view('pages.administrador.usuarios');
    }
    
    public function index_roles()
    {
        return view('pages.administrador.roles');
    }

    public function index_permisos()
    {
        return view('pages.administrador.permisos');
    }

   
}