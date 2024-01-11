<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Usuario']);
        $role3 = Role::create(['name' => 'Empleado']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'dashboard.view'])->syncRoles([$role1, $role2, $role3]);

        Permission::create(['name' => 'administrador'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.usuarios.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.usuarios.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.usuarios.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.usuarios.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'administrador.roles'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.roles.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.roles.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.roles.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.roles.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'administrador.permisos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.permisos.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.permisos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.permisos.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'administrador.permisos.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'movimientos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.compras'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.compras.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.compras.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.compras.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.compras.delete'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'movimientos.ventas'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'movimientos.ventas.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'movimientos.ventas.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'movimientos.ventas.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'movimientos.ventas.delete'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'movimientos.caja'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.caja.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.caja.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.caja.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'movimientos.caja.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'mantenimiento'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.productos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.productos.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.productos.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.productos.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.productos.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'mantenimiento.clientes'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.clientes.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.clientes.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.clientes.edit'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.clientes.delete'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'mantenimiento.empleados'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.empleados.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.empleados.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.empleados.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.empleados.delete'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'mantenimiento.proveedores'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.proveedores.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.proveedores.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.proveedores.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.proveedores.delete'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'mantenimiento.presentacion'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.presentacion.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.presentacion.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.presentacion.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.presentacion.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'mantenimiento.laboratorios'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.laboratorios.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.laboratorios.create'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'mantenimiento.laboratorios.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.laboratorios.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'mantenimiento.comprobantes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.comprobantes.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.comprobantes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.comprobantes.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'mantenimiento.comprobantes.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'gestion'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'gestion.consultar'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'gestion.consultar.view'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'datos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'datos.reportes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'datos.reportes.view'])->syncRoles([$role1, $role2]);
    }
}
