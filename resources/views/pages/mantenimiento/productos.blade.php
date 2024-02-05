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
                        <label class="col-form-label">NOMBRE: </label>
                        <input type="text" class="form-control form-control-sm" id="txtProductoNombre">
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN: </label>
                        <input type="text" class="form-control form-control-sm" id="txtProductoConcentracion">
                    </div>


                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">STOCK <code>(cantidad)</code>: </label>
                        <input type="number" class="form-control form-control-sm" id="txtProductoStock" min="0" max="1000">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">COSTO <code>(Compra)</code> :</label>
                        <input type="number" class="form-control form-control-sm" id="txtProductoCosto" min="0" max="1000">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">PRECIO <code>(Venta)</code> : </label>
                        <input type="number" class="form-control form-control-sm" id="txtProductoPrecio" min="0" max="10000">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRESENTACIÓN: </label>
                        <input type="hidden" id="txtProductoIdPresentacion" readonly>
                        <input type="text" class="form-control form-control-sm" id="txtProductoPresentacion" readonly>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="btnBuscarPresentacion"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">LABORATORIO: </label>
                        <input type="hidden" id="txtProductoIdLaboratorio" readonly>
                        <input type="text" class="form-control form-control-sm" id="txtProductoLaboratorio" readonly>
                        <button type="button" class="btn btn-primary  btn-sm mt-2" id="btnBuscarLaboratorio"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">REGISTRO SANITARIO: </label>
                        <input type="text" class="form-control form-control-sm" id="txtProductoRegistroSanitario">
                    </div>


                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">VENCIMIENTO: </label>
                        <input type="date" class="form-control form-control-sm" id="txtProductoVencimiento">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-success" id="btnRegistrarProducto"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
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
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">LABORATORIO</th>
                            <th scope="col">PRESENTACIÓN</th>
                            <th scope="col">CONCENTRACIÓN</th>
                            <th scope="col">STOCK</th>
                            <th scope="col">Costo (Compra)</th>
                            <th scope="col">Precio (Venta)</th>
                            <th scope="col">REGISTRO SANITARIO</th>
                            <th scope="col">VENCIMIENTO</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tableListProductos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListPresentaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de Presentaciones</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablePresentaciones">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_presentaciones">

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

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListLaboratorios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de Laboratorios</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableLaboratorios">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_laboratorios">

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
<div class="modal fade" id="mdEditProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarProducto"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRES : </label>
                        <input type="hidden" id="txtEditProdId">
                        <input type="text" class="form-control form-control-sm" id="txtEditProdName">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditProdConcentracion">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">LABORATORIO : </label>
                        <div id="selectEditHTMLLaboratorio"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">PRESENTACIÓN : </label>
                        <div id="selectEditHTMLPresentaciones"></div>
                    </div>                    
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">STOCK <code>(cantidad)</code>: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditProdStock" min="0" max="1000">                        
                        <div class="form-text"><sup><code>Inventario: <span id="txtDescripcionStock"></span> productos registrados</code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">COSTO <code>(compra)</code>: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditProdCosto" min="0" max="10000">
                        <div class="form-text"><sup><code>El costo actual del producto: <span id="txtDescripcionCosto"></span></code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">PRECIO <code>(venta)</code>: </label>
                        <input type="number" class="form-control form-control-sm" id="txtEditProdVenta" min="0" max="10000">
                        <div class="form-text"><sup><code>El precio actual de venta: <span id="txtDescripcionPrecio"></span></code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">REGISTRO SANITARIO : </label>
                        <input type="text" class="form-control form-control-sm" id="txtEditProdRegistroSanitario">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">VENCIMIENTO : </label>
                        <input type="date" class="form-control form-control-sm" id="txtEditProdVencimiento">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESTADO : </label>
                        <div id="selectEditHTMLEstado"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnActualizarProducto"><i class="fas fa-pen"></i> Editar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
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