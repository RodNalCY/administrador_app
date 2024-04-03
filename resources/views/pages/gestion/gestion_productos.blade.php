@extends('adminlte::page')

@section('title', 'Gestión Productos')

@section('content_header')
<!-- <h1>Clientes</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-header-purple">
                GESTIÓN - PRODUCTOS RECIENTEMENTE ACTUALIZADOS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableGestionProductos">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">LABORATORIO</th>
                                    <th scope="col">PRESENTACIÓN</th>
                                    <th scope="col">CONCENTRACIÓN</th>
                                    <th scope="col" style="width: 150px;">FECHA ACTUALIZACIÓN</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tableListGestionProductos">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdViewDetailProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETALLE DEL PRODUCTO</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRES:</label>                      
                        <input type="text" class="form-control" id="txtEditProdName" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN:</label>
                        <input type="text" class="form-control" id="txtEditProdConcentracion" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">LABORATORIO:</label>
                        <input type="text" class="form-control" id="txtLaboratorio" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">PRESENTACIÓN: </label>                     
                        <input type="text" class="form-control" id="txtPresentacion" disabled>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">STOCK<code>(cantidad)</code>:</label>
                        <input type="number" class="form-control" id="txtEditProdStock" min="0" max="1000" disabled>                      
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">COSTO<code>(compra)</code>:</label>
                        <input type="number" class="form-control" id="txtEditProdCosto" min="0" max="10000" disabled>                       
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">PRECIO<code>(venta)</code>:</label>
                        <input type="number" class="form-control" id="txtEditProdVenta" min="0" max="10000" disabled>                        
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">REGISTRO SANITARIO : </label>
                        <input type="text" class="form-control" id="txtEditProdRegistroSanitario" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">VENCIMIENTO:</label>
                        <input type="date" class="form-control" id="txtEditProdVencimiento" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESTADO : </label>
                        <input type="text" class="form-control" id="txtEstadoProducto" disabled>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">FECHA ACTUALIZADA : </label>
                        <input type="text" class="form-control" id="txtFechaActualizada" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar </button>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/gestion_productos.js') }}"></script>
@stop