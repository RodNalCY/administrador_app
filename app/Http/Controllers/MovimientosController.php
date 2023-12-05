<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Proveedor;
use Exception;
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
    public function index_compras()
    {
        return view('pages.compras');
    }

    public function index_ventas()
    {
        return view('pages.ventas');
    }

    public function index_caja()
    {
        return view('pages.caja');
    }

    public function listClientes()
    {
        try {
            $clientes = Cliente::orderBy("idCliente", "DESC")->get();

            return response()->json([
                'message' => 'lista de clientes',
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

    public function listProductos()
    {
        try {
            
            $productos = Producto::with(['presentacion', 'laboratorio'])->get();

            return response()->json([
                'message' => 'lista de productos',
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
    public function listComprobantes()
    {
        try {
            $comprobantes = Comprobante::all();

            return response()->json([
                'message' => 'lista de comprobantes',
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

    public function listProveedores()
    {
        try {
            $proveedores = Proveedor::all();

            return response()->json([
                'message' => 'lista de proveedores',
                'status' => true,
                'data' => $proveedores
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}
