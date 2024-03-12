<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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

    public function index_empleados()
    {
        return view('pages.administrador.empleados');
    }

    public function list_usuarios()
    {
        try {
            $users = User::selectRaw('users.id, users.name, users.email, DATE_FORMAT(users.created_at, "%d-%m-%Y %H:%i:%s") as fecha, model_has_roles.role_id,roles.name AS role, empleado.idEmpleado')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('empleado', 'users.id', '=', 'empleado.idUsuario')
                ->get();

            return response()->json([
                'message' => 'lista de usuarios',
                'status' => true,
                'data' => $users
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_roles()
    {
        try {
            $roles = Role::selectRaw('id, name, guard_name, DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as fecha')->get();

            return response()->json([
                'message' => 'lista de roles',
                'status' => true,
                'data' => $roles
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_permisos()
    {
        try {
            $permisos = Permission::selectRaw('id, name, guard_name, DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as fecha')->get();

            return response()->json([
                'message' => 'lista de permisos',
                'status' => true,
                'data' => $permisos
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_usuario(Request $request)
    {
        try {

            $role = Role::find($request->_roleId);
            $empleado = Empleado::find($request->_employeeId);
            $exist = User::where('email', $empleado->Email)->first();

            $status = false;

            if ($exist) {
                $update = User::find($exist->id);
                $update->password = Hash::make($request->_userPassword);
                if ($update->save()) {
                    $empleado->idUsuario = $exist->id;
                    if ($empleado->save()) {
                        $update->assignRole($role);
                        $status = true;
                    }
                }
            } else {
                $user = new User;
                $user->name = $request->_userName;
                $user->email = $request->_userEmail;
                $user->password = Hash::make($request->_userPassword);

                if ($user->save()) {
                    $empleado->idUsuario = $user->id;
                    if ($empleado->save()) {
                        $user->assignRole($role);
                        $status = true;
                    }
                }
            }

            return response()->json([
                'message' => 'Usuario registrado',
                'status' =>   $status,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
    public function edit_usuario(Request $request)
    {
        try {
            $user = User::find($request->_userId);
            $status = false;

            if ($request->_password != null) {
                $user->password = Hash::make($request->_password);
                if ($user->save()) {
                    $user->syncRoles([intval($request->_roleId)]);
                    $status = true;
                }
            } else {
                $user->syncRoles([intval($request->_roleId)]);
                $status = true;
            }

            return response()->json([
                'message' => 'Usuario registrado',
                'status' => $status,
                'data' => $user
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_usuario(Request $request)
    {
        try {
            $user = User::find($request->_userId);
            $employe = Empleado::find($request->_employeId);
            $role = Role::find($request->_roleId);

            $status = false;

            $employe->idUsuario = 0;
            if ($employe->save()) {
                $user->password = "";
                if ($user->save()) {
                    $user->removeRole($role);
                    $status = true;
                }
            }

            return response()->json([
                'message' => 'Usuario fue Eliminado',
                'status' => $status,
                'data' => $user
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_role(Request $request)
    {
        try {
            // Verificar si el role ya existe
            $roleExistente = Role::where('name', $request->_roleName)->first();
            if ($roleExistente) {
                return response()->json([
                    'status' => false,
                    'message' => "El role '$request->_roleName' ya existe.",
                ]);
            }

            // Crear un nuevo role
            $role = Role::create(['name' => $request->_roleName]);

            return response()->json([
                'status' => true,
                'message' => 'Role creado correctamente!',
                'data' => $role
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_role(Request $request)
    {
        try {
            $role = Role::find($request->_roleId);
            $permisos = Role::selectRaw('roles.id')
                ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
                ->where('roles.id', $request->_roleId)
                ->get();

            $status = false;
            $message = "Upps, algo paso con el servidor!";
            if (count($permisos) > 0) {
                $status = false;
                $message = "Upps, este role tiene permisos no se puede eliminar!";
            } else {
                $status = true;
                $message = "El role se elimino correctamente!";
                $role->delete();
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function list_permisos_role(Request $request)
    {
        try {

            $data = Permission::leftJoin('role_has_permissions', function ($join) use ($request) {
                $join->on('permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where('role_has_permissions.role_id', '=', $request->input('_roleId'));
            })
                ->select('role_has_permissions.permission_id', 'permissions.id', 'permissions.name')
                ->orderBy('permissions.name', 'asc')
                ->get();

            $status = true;

            return response()->json([
                'status' => $status,
                'message' => "Lista de permisos segun el role!",
                'roleId' => $request->_roleId,
                'data' => $data

            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_role_permisos(Request $request)
    {
        try {

            $rol = Role::find($request->_roleId);
            // Transformar los datos de permisos
            $permisosIds = [];
            if (!empty($request->_permisos)) {
                foreach ($request->_permisos as $permiso) {
                    $permisosIds[] = intval($permiso['id']);
                }
            }

            if (count($permisosIds) > 0) {
                // Sincronizar los permisos del rol con los nuevos permisos
                $rol->syncPermissions($permisosIds);
                $message = "Permisos actualizados correctamente para el role asignado";
            } else {
                $message = "Upps algo paso !!";
            }

            return response()->json([
                'status' => true,
                'message' => $message,

            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function save_permiso(Request $request)
    {
        try {
            // Verificar si el permiso ya existe
            $permisoExistente = Permission::where('name', $request->_permisoName)->first();

            if ($permisoExistente) {
                return response()->json([
                    'status' => false,
                    'message' => "El permiso '$request->_permisoName' ya existe.",
                ]);
            }

            // Crear un nuevo permiso
            $permiso = Permission::create(['name' =>  $request->_permisoName]);

            return response()->json([
                'status' => true,
                'message' => 'Permiso creado correctamente!',
                'data' => $permiso
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function edit_permiso(Request $request)
    {
        try {
            // Buscar el permiso por su ID
            $permiso = Permission::find($request->_permisoEditId);

            // Verificar si el permiso existe
            if (!$permiso) {
                return response()->json([
                    'status' => false,
                    'message' =>  "No se encontró el permiso con ID '$request->_permisoEditId'.",
                ]);
            }

            // Verificar si ya existe un permiso con el nuevo nombre
            $permisoExistente = Permission::where('name', $request->_permisoEditName)->first();
            if ($permisoExistente) {

                return response()->json([
                    'status' => false,
                    'message' => "Ya existe un permiso con el nombre '$request->_permisoEditName'.",
                ]);
            }

            // Actualizar el nombre del permiso
            $permiso->name = $request->_permisoEditName;
            if ($permiso->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Permiso creado correctamente!',
                    'data' => $request->_permisoEditName
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function delete_permiso(Request $request)
    {
        try {

            $role_permisos = Permission::selectRaw('role_has_permissions.permission_id, permissions.name, roles.name as role_name')
                ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
                ->where('permissions.id', $request->_permisoId)
                ->get();



            if (count($role_permisos) > 0) {
                $rolesNames = $role_permisos->pluck('role_name')->toArray();
                $roles_name = implode(', ', $rolesNames);

                return response()->json([
                    'message' => 'Este permiso esta siendo utilizado por : ' . $roles_name,
                    'status' => false,
                ]);
            }

            // Buscar el permiso por su ID
            $permiso = Permission::find($request->_permisoId);
            // Eliminar el permiso
            if ($permiso->delete()) {
                return response()->json([
                    'message' => 'Permiso fue Eliminado',
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
            $create->Especialidad = $request->_empEspecial ?? "-";
            $create->Sexo = $request->_empSexo ?? "-";
            $create->Dni = $request->_empDNI ?? "-";
            $create->Email = $request->_empEmail ?? "-";
            $create->Telefono = $request->_empTelef ?? "-";
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
            $edit->Especialidad = $request->_empEspecial ?? "-";
            $edit->Sexo = $request->_empSexo ?? "-";
            $edit->Dni = $request->_empDNI ?? "-";
            $edit->Email = $request->_empEmail ?? "-";
            $edit->Telefono = $request->_empTelef ?? "-";
            $edit->Direccion = $request->_empDirec ?? "-";
            $edit->HoraIngreso = $request->_empHIngreso ?? "-";
            $edit->HoraSalida = $request->_empHSalida ?? "-";
            $edit->Sueldo = $request->_empSueldo ?? 0;
            $edit->Estado = $request->_empEstado ?? "-";

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
            if ($request->_estado == "1") {
                $delete->Estado = "Activo";
            } else {
                $delete->Estado = "Inactivo";
            }

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
