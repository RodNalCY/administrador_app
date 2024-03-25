@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<!-- <h1>Clientes</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR CLIENTES
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <sup style="top: 0;"><strong>NOTA:</strong> Por favor, asegúrate de ingresar los siguientes datos para el nuevo cliente: <strong>DNI, NOMBRES, APELLIDOS, TELÉFONO Y SEXO</strong>.</sup>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">DNI/CARNET :<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control form-control-sm" id="txtClienteDNI" min="0">
                        <div id="loading" style="display: none;">
                            <div class="progress mt-2" style="border-radius: 3px !important;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">CONSULTADO DATOS A LA RENIEC</div>
                            </div>
                        </div>
                        <div class="form-text">
                            <sup><code>El botón de búsqueda solo se aplica para <strong>DNI's</strong></code></sup>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-info mr-2 btn-sm" id="btnGetAPIDNI"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">RUC :</label>
                        <input type="number" class="form-control form-control-sm" id="txtClienteRUC" min="0">
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-info mr-2 btn-sm" disabled><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>

                </div>


                <div class="row mb-2">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">NOMBRES / RAZÓN SOCIAL :<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtClienteNombres">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">APELLIDOS: </label>
                        <input type="text" class="form-control" id="txtClienteApellidos">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">SEXO:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <div id="selectHTMLSexo"></div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control" id="txtClienteDireccion">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">TELÉFONO :</label>
                        <input type="number" class="form-control" id="txtClienteTelefono" min="0">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">EMAIL : </label>
                        <input type="email" class="form-control" id="txtClienteEmail">
                    </div>                  
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="btnRegistrarCliente"> <i class="fas fa-fw fa-plus"></i> REGISTRAR </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="input-group">
                    <div class="input-group-text" style="background-color: #4a3fff; color:white; "> <i class="fas fa-fw fa-search"></i> </div>
                    <input type="search" class="form-control" id="btnBuscarListCliente" placeholder="Ingrese el nombre del cliente" style="background-color: azure;">
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                <button type="button" class="btn btn-success" id="btnExportarExcelClientes"> <i class="fas fa-fw fa-table"></i> EXPORTAR EXCEL</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableClientes">
                    <thead class="header-table text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRES / RAZÓN SOCIAL </th>
                            <th scope="col">APELLIDOS</th>
                            <th scope="col">SEXO</th>
                            <th scope="col">DNI/CARNET</th>
                            <th scope="col">TELÉFONO</th>
                            <th scope="col">RUC</th>
                            <th scope="col">DIRECCIÓN</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tableListClientes">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarCliente"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DNI/CARNET :<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="hidden" id="txtEditCliId">
                        <input type="number" class="form-control" id="txtEditCliDNI" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">RUC : </label>
                        <input type="number" class="form-control" id="txtEditCliRUC" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRES / RAZÓN SOCIAL :<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtEditCliName">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">APELLIDOS : </label>
                        <input type="text" class="form-control" id="txtEditCliApellidos">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">SEXO : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <div id="selectEditHTMLSexo"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control" id="txtEditCliDireccion">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">TELÉFONO : </label>
                        <input type="number" class="form-control" id="txtEditCliTelef" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">EMAIL : </label>
                        <input type="email" class="form-control" id="txtEditCliEmail">
                    </div>
                   
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESTADO : </label>
                        <div id="selectEditHTMLEstado"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnActualizarCliente"><i class="fas fa-pen"></i> Editar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>

    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script src="{{ asset('js/clientes.js') }}"></script>
    @stop