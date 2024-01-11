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
                        <input type="text" class="form-control form-control-sm" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarClientes"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">EMAIL: </label>
                        <input type="text" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">CONTRASEÑA: </label>
                        <input type="password" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">VERIFICAR CONTRASEÑA: </label>
                        <input type="password" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">ROLE: </label>
                        <input type="text" class="form-control form-control-sm" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarClientes"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
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
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/usuarios.js') }}"></script>
@stop