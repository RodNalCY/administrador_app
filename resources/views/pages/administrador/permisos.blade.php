@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
<!-- <h1>Permisos</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR PERMISOS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">NOMBRE : </label>
                        <input type="text" class="form-control form-control-sm" id="txtNombrePermiso">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">TIPO: </label>
                        <input type="text" class="form-control form-control-sm" id="txtTipoPermiso" value="web" readonly>
                    </div>                
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="btnRegistrarPermiso"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
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
                <table class="table table-hover table-bordered" id="tablePermisos">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Permiso</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListPermisos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/permisos.js') }}"></script>
@stop