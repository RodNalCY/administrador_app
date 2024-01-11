@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<!-- <h1>Productos</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR PRODUCTO
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DESCRIPCIÓN: </label>
                        <input type="text" class="form-control form-control-sm" id="">
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN: </label>
                        <input type="text" class="form-control form-control-sm" id="">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">R. SANITARIO: </label>
                        <input type="text" class="form-control form-control-sm" id="">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">STOCK: </label>
                        <input type="text" class="form-control form-control-sm" id="">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">VENCIMIENTO: </label>
                        <input type="date" class="form-control form-control-sm" id="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRESENTACIÓN: </label>
                        <input type="text" class="form-control form-control-sm" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarClientes"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">LABORATORIO: </label>
                        <input type="text" class="form-control form-control-sm" readonly>
                        <button type="button" class="btn btn-primary  btn-sm mt-2" id="btnBuscarClientes"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">COSTO: </label>
                        <input type="number" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">PRECIO: </label>
                        <input type="number" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">ESTADO: </label>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1"><code style="color: blue;">Activo / Inactivo</code></label>
                        </div>
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
                <table class="table table-hover table-bordered" id="tableProductos">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Laboratorio</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Concentración</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Costo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Registro Sanitario</th>
                            <th scope="col">Vencimiento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableListProductos">
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
<script src="{{ asset('js/productos.js') }}"></script>
@stop