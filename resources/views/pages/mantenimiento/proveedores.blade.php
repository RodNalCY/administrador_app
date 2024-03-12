@extends('adminlte::page')

@section('title', 'Proveedor')

@section('content_header')
    <!-- <h1>Proveedor</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR PROVEEDORES
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">NOMBRE: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtProvNombre">
                    </div>   
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DNI/CARNET: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtProvDNI" min="0">
                    </div> 
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">RUC: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtProvRUC" min="0">
                    </div> 
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DIRECCIÓN: </label>
                        <input type="text" class="form-control" id="txtProvDireccion">
                    </div>                                    
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">EMAIL: </label>
                        <input type="email" class="form-control" id="txtProvEmail">
                    </div>   
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">TELÉFONO: </label>
                        <input type="number" class="form-control" id="txtProvTelefono" min="0">
                    </div> 
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">BANCO: </label>
                        <input type="text" class="form-control" id="txtProvBanco">
                    </div> 
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CUENTA: </label>
                        <input type="number" class="form-control" id="txtProvCuenta" min="0">
                    </div>                                    
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="btnRegistrarProveedor"> <i class="fas fa-fw fa-plus"></i> REGISTRAR </button>
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
                <table class="table table-hover table-bordered" id="tableProveedores">
                    <thead class="header-table text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">DNI/CARNET</th>
                            <th scope="col">RUC</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Banco</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListProveedores">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditProveedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarProveedor"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRE : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="hidden" id="txtEditProvId">
                        <input type="text" class="form-control" id="txtEditProvName">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DNI/CARNET : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtEditProvDNI" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">RUC : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtEditProvRUC" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control" id="txtEditProvDirc">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">EMAIL : </label>
                        <input type="email" class="form-control" id="txtEditProvEmail">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">TELÉFONO : </label>
                        <input type="number" class="form-control" id="txtEditProvTele" min="0">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">BANCO : </label>
                        <input type="text" class="form-control" id="txtEditProvBanco">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">CUENTA (N°/CCI) : </label>
                        <input type="number" class="form-control" id="txtEditProvCuenta" min="0">
                    </div>
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">ESTADO: </label>
                        <div id="selectHTMLEstado"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnActualizarProveedor"><i class="fas fa-pen"></i> Editar</button>
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
<script src="{{ asset('js/proveedor.js') }}"></script>
@stop