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

    public function list_usuarios()
    {
        try {
            $users = User::selectRaw('users.id, users.name, users.email, DATE_FORMAT(users.created_at, "%d-%m-%Y %H:%i:%s") as fecha, model_has_roles.role_id,roles.name AS role ')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
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

    public function list_empleados()
    {
        try {
            $empleados = Empleado::all();

            return response()->json([
                'message' => 'lista de empleados',
                'status' => true,
                'data' => $empleados
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
            $empleado = Empleado::where('idEmpleado', $request->_userId)->first();

            $user = new User;
            $user->name = $request->_userName;
            $user->email = $request->_userEmail;
            $user->password = Hash::make($request->_userPassword);

            $status = false;
            if ($user->save()) {
                $empleado->idUsuario = $user->id;
                if ($empleado->save()) {
                    $user->assignRole($role);
                    $status = true;
                }
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
}
