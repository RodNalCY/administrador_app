<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use App\Models\Empleado;
use App\Models\Laboratorio;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Proveedor;
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

    public function list_comprobantes()
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

    public function edit_comprobante(Request $request)
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

    public function delete_comprobante(Request $request)
    {
        try {
            $delete = Comprobante::find($request->_dataId);
            $delete->Estado = "Inactivo";

            if ($delete->update()) {
                return response()->json([
                    'message' => 'Se desactivo el Comprobante correctamente',
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

    public function list_laboratorios()
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

    public function delete_presentacion(Request $request)
    {
        try {
            $delete = Presentacion::find($request->_dataId);
            $delete->Estado = "Inactivo";

            if ($delete->update()) {
                return response()->json([
                    'message' => 'Se desactivo el Presentación correctamente',
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


    public function list_proveedores()
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

    public function save_proveedor(Request $request)
    {
        try {
            $prov = new Proveedor;
            $prov->Nombre = $request->_provNombre;
            $prov->Dni = $request->_provDNI ?? "-";
            $prov->Ruc = $request->_provRuc ?? "-";
            $prov->Direccion = $request->_provDir ?? "-";
            $prov->Email = $request->_provEmail ?? "-";
            $prov->Telefono = $request->_provTelef ?? "-";
            $prov->Banco = $request->_provBanco ?? "-";
            $prov->Cuenta = $request->_provCuenta ?? "-";
            $prov->Estado = 'Activo';

            if ($prov->save()) {
                return response()->json([
                    'message' => 'Se creo el proveedor correctamente',
                    'status' => true,
                    'data' => $prov
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_proveedor(Request $request)
    {
        try {
            $prov = Proveedor::find($request->_provId);
            $prov->Nombre = $request->_provNombre;
            $prov->Dni = $request->_provDNI ?? "-";
            $prov->Ruc = $request->_provRuc ?? "-";
            $prov->Direccion = $request->_provDir ?? "-";
            $prov->Email = $request->_provEmail ?? "-";
            $prov->Telefono = $request->_provTelef ?? "-";
            $prov->Banco = $request->_provBanco ?? "-";
            $prov->Cuenta = $request->_provCuenta ?? "-";
            $prov->Estado = $request->_provEstado ?? "-";

            if ($prov->update()) {
                return response()->json([
                    'message' => 'Se actulizo el proveedor correctamente',
                    'status' => true,
                    'data' => $prov
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_proveedor(Request $request)
    {
        try {
            $prov = Proveedor::find($request->_proveedorId);
            $prov->Estado = "Inactivo";

            if ($prov->update()) {
                return response()->json([
                    'message' => 'Se desactivo el proveedor correctamente',
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

    public function list_empleados()
    {
        try {
            $lista = Empleado::all();

            return response()->json([
                'message' => 'lista de empleados',
                'status' => true,
                'data' => $lista
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_empleado(Request $request)
    {
        try {
            $create = new Empleado;
            $create->Nombres = $request->_empNombre;
            $create->Apellidos = $request->_empApellidos ?? "-";
            $create->Especialidad = $request->_empEspecial?? "-";
            $create->Sexo = $request->_empSexo ?? "-";
            $create->Dni = $request->_empDNI ?? 0;
            $create->Email = $request->_empEmail ?? "-";
            $create->Telefono = $request->_empTelef ?? 0;
            $create->Direccion = $request->_empDirec ?? "-";
            $create->HoraIngreso = $request->_empHIngreso ?? "-";
            $create->HoraSalida = $request->_empHSalida ?? "-";
            $create->Sueldo = $request->_empSueldo ?? 0;
            $create->Estado = 'Activo';
            $create->idUsuario = 0;

            if ($create->save()) {
                return response()->json([
                    'message' => 'Se creo el empleado correctamente',
                    'status' => true,
                    'data' => $create
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_empleado(Request $request)
    {
        try {
            $edit = Empleado::find($request->_empId);
            $edit->Nombres = $request->_empNombre;
            $edit->Apellidos = $request->_empApellidos ?? "-";
            $edit->Especialidad = $request->_empEspecial?? "-";
            $edit->Sexo = $request->_empSexo ?? "-";
            $edit->Dni = $request->_empDNI ?? 0;
            $edit->Email = $request->_empEmail ?? "-";
            $edit->Telefono = $request->_empTelef ?? 0;
            $edit->Direccion = $request->_empDirec ?? "-";
            $edit->HoraIngreso = $request->_empHIngreso ?? "-";
            $edit->HoraSalida = $request->_empHSalida ?? "-";
            $edit->Sueldo = $request->_empSueldo ?? 0;
            $edit->Estado = $request->_empEstado ?? "-";
            $edit->idUsuario = 0;

            if ($edit->update()) {
                return response()->json([
                    'message' => 'Se edito el empleado correctamente',
                    'status' => true,
                    'data' => $edit
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_empleado(Request $request)
    {
        try {
            $delete = Empleado::find($request->_empleadoId);
            $delete->Estado = "Inactivo";

            if ($delete->update()) {
                return response()->json([
                    'message' => 'Se desactivo el empleado correctamente',
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
