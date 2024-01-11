<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
}
