<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\Laboratorio;
use App\Models\Presentacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
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


    public function index_productos()
    {
        return view('pages.mantenimiento.productos');
    }

    public function index_clientes()
    {
        return view('pages.mantenimiento.clientes');
    }

    public function index_empleados()
    {
        return view('pages.mantenimiento.empleados');
    }

    public function index_proveedores()
    {
        return view('pages.mantenimiento.proveedores');
    }

    public function index_presentaciones()
    {
        return view('pages.mantenimiento.presentaciones');
    }

    public function index_laboratorios()
    {
        return view('pages.mantenimiento.laboratorios');
    }

    public function index_comprobantes()
    {
        return view('pages.mantenimiento.comprobantes');
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

    public function editComprobante(Request $request)
    {
        try {
            $comprobante = Comprobante::find($request->_comprobanteId);
            $comprobante->Estado = $request->_comprobanteState;

            if ($comprobante->update()) {
                return response()->json([
                    'message' => 'Comprobante editado correctamente',
                    'status' => true,
                    'data' => $comprobante
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function listLaboratorios()
    {
        try {
            $laboratorios = Laboratorio::all();

            return response()->json([
                'message' => 'lista de laboratorios',
                'status' => true,
                'data' => $laboratorios
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_laboratorio(Request $request)
    {
        try {
            $lab = new Laboratorio;
            $lab->Nombre = $request->_labsNombre;
            $lab->Direccion = $request->_labsDireccion;
            $lab->Telefono = $request->_labsTelefono;
            $lab->Estado = 'Activo';

            if ($lab->save()) {
                return response()->json([
                    'message' => 'Se creo el laboratorio correctamente',
                    'status' => true,
                    'data' => $lab
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_laboratorio(Request $request)
    {
        try {
            $labs = Laboratorio::find($request->_laboratorioId);
            $labs->Estado = "Inactivo";

            if ($labs->update()) {
                return response()->json([
                    'message' => 'Se elimino el laboratorio correctamente',
                    'status' => true,
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_laboratorio(Request $request)
    {
        try {
            $labs = Laboratorio::find($request->_labsId);
            $labs->Nombre = $request->_labsName;
            $labs->Direccion = $request->_labsDireccion;
            $labs->Telefono = $request->_labsTelefono;
            $labs->Estado = $request->_labsEstado;

            if ($labs->update()) {
                return response()->json([
                    'message' => 'Se edito el laboratorio correctamente',
                    'status' => true,
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_presentaciones()
    {
        try {
            $presentaciones = Presentacion::all();

            return response()->json([
                'message' => 'lista de presentaciones',
                'status' => true,
                'data' => $presentaciones
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_presentacion(Request $request)
    {
        try {
            $pre = new Presentacion;
            $pre->Descripcion = $request->_preNombre;
            $pre->Estado = 'Activo';

            if ($pre->save()) {
                return response()->json([
                    'message' => 'Se creo el laboratorio correctamente',
                    'status' => true,
                    'data' => $pre
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_presentacion(Request $request)
    {
        try {
            $pre = Presentacion::find($request->_preId);
            $pre->Descripcion = $request->_preName;
            $pre->Estado = $request->_preState;

            if ($pre->update()) {
                return response()->json([
                    'message' => 'Se edito la presentacion correctamente!',
                    'status' => true,
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
