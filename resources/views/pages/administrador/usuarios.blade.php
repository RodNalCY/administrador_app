@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<!-- <h1>Usuarios</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR USUARIO
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">NOMBRES APELLIDOS: </label>
                        <input type="hidden" id="txtEmployeeId" readonly>
                        <input type="text" class="form-control" id="txtNombresApellidos" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarEmpleados"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">EMAIL: </label>
                        <input type="text" class="form-control" id="txtEmail" readonly>
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">CONTRASEÑA: </label>
                        <input type="password" class="form-control" id="txtPassword">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">VERIFICAR CONTRASEÑA: </label>
                        <input type="password" class="form-control" id="txtPasswordVerified">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">ROLE: </label>
                        <input type="hidden" id="txtRoleId" readonly>
                        <input type="text" class="form-control" id="txtRole" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarRoles"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="btnRegistrarUsuario"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableUsuarios">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre & Apellidos</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListUsuarios">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdUserEmpleados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdUserEmpleadosLabel">Lista de Empleados</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="tableEmpleados">
                            <thead class="header-table">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombres & Apellidos</th>
                                    <th scope="col">Especialidad</th>
                                    <th scope="col">Sexo</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_empleados">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdUserRoles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdUserRolesLabel">Lista de Roles</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="tableRoles">
                            <thead class="header-table">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_roles">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdEditUserLabel">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRES APELLIDOS: </label>
                        <input type="hidden" id="txtEditUserId" readonly>
                        <input type="text" class="form-control" id="txtEditNombresApellidos" readonly>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label class="col-form-label">EMAIL: </label>
                        <input type="text" class="form-control" id="txtEditEmail" readonly>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label class="col-form-label">CONTRASEÑA: </label>
                        <input type="password" class="form-control" id="txtEditPassword">
                    </div>
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label class="col-form-label">VERIFICAR CONTRASEÑA: </label>
                        <input type="password" class="form-control" id="txtEditVerificarPassword">
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label" style="float: inline-end;"> ROLE (EDITAR)</label>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2" id="selectRoles">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnEditarUsuario"><i class="fas fa-pen"></i> Editar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/usuarios.js') }}"></script>
@stop