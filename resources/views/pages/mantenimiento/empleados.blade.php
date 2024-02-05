@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
<!-- <h1>Empleado</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR EMPLEADOS
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">DNI: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEmpleadoDNI" min="0">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">NOMBRE: </label>
                        <input type="text" class="form-control form-control-sm" id="txtEmpleadoNombre">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">APELLIDOS: </label>
                        <input type="text" class="form-control form-control-sm" id="txtEmpleadoApellidos">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">SEXO: </label>
                        <div id="selectHTMLSexo"></div>
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">ESPECIALIDAD: </label>
                        <div id="selectHTMLEspecialidad"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">EMAIL: </label>
                        <input type="email" class="form-control form-control-sm" id="txtEmpleadoEmail">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">TELEFONO: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEmpleadoTelefono" min="0">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">DIRECCIÓN: </label>
                        <input type="text" class="form-control form-control-sm" id="txtEmpleadoDireccion">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">HORA INGRESO: </label>
                        <input type="time" class="form-control form-control-sm" id="txtEmpleadoHIngreso">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">HORA SALIDA: </label>
                        <input type="time" class="form-control form-control-sm" id="txtEmpleadoHSalida">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">SUELDO: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEmpleadoSueldo" min="0">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="btnRegistrarEmpleado"> <i class="fas fa-fw fa-plus"></i> REGISTRAR </button>
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
                <table class="table table-hover table-bordered" id="tableEmpleados">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">APELLIDOS</th>
                            <th scope="col">ESPECIALIDAD</th>
                            <th scope="col">SEXO</th>
                            <th scope="col">DNI/CARNET</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">TELÉFONO</th>
                            <th scope="col">DIRECCIÓN</th>
                            <th scope="col">Hora Ingreso</th>
                            <th scope="col">Hora Ingreso</th>
                            <th scope="col">SUELDO</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListEmpleados">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditEmpleado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarEmpleado"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DNI : </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditEmpDNI" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRES : </label>
                        <input type="hidden" id="txtEditEmpId">
                        <input type="text" class="form-control form-control-sm" id="txtEditEmpName">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">APELLIDOS : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditEmpApellidos">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">SEXO : </label>
                        <div id="selectEditHTMLSexo"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESPECIALIDAD : </label>
                        <div id="selectEditHTMLEspecialidad"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">EMAIL : </label>
                        <input type="email" class="form-control form-control-sm" id="txtEditEmpEmail">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">TELÉFONO : </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditEmpTelef" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditEmpDireccion">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">HORA INGRESO : </label>
                        <input type="time" class="form-control form-control-sm" id="txtEditEmpHIngreso">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">HORA SALIDA : </label>
                        <input type="time" class="form-control form-control-sm" id="txtEditEmpHSalida">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">SUELDO : </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditEmpSueldo" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESTADO: </label>
                        <div id="selectEditHTMLEstado"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnActualizarEmpleado"><i class="fas fa-pen"></i> Editar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>

    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script src="{{ asset('js/empleados.js') }}"></script>
    @stop