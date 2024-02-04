@extends('adminlte::page')

@section('title', 'Laboratorio')

@section('content_header')
<!-- <h1>Laboratorio</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR LABORATORIOS
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">NOMBRE: </label>
                        <input type="text" class="form-control form-control-sm" id="txtLabNombre">
                    </div>

                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">DIRECCIÓN: </label>
                        <input type="text" class="form-control form-control-sm" id="txtLabDireccion">
                    </div>

                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">TELEFONO: </label>
                        <input type="number" class="form-control form-control-sm" id="txtLabTelefono">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="btnRegistrarLabs"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
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
                <table class="table table-hover table-bordered" id="tableLaboratorios">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListLaboratorios">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditLaboratorio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarLab"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">NOMBRE : </label>
                        <input type="hidden" id="txtEditIdLab">
                        <input type="text" class="form-control form-control-sm" id="txtEditNameLab">
                    </div>
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditDirecLab">
                    </div>
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">TELÉFONO : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditTelefLab">
                    </div>
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">ESTADO: </label>
                        <div id="selectHTMLEstado"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnActualizarLaboratorio"><i class="fas fa-pen"></i> Editar</button>
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
<script src="{{ asset('js/laboratorios.js') }}"></script>
@stop