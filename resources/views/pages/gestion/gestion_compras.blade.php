@extends('adminlte::page')

@section('title', 'Gestión Compras')

@section('content_header')
<!-- <h1>Clientes</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-header-purple">
                GESTIÓN - CONSULTAR COMPRAS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableGestionCompras">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">COMPROBANTE</th>
                                    <th scope="col">NUMERO</th>
                                    <th scope="col">EMPLEADO</th>
                                    <th scope="col">PROVEEDOR</th>
                                    <th scope="col">VALOR TOTAL</th>
                                    <th scope="col">VALOR TOTAL TEXTO</th>
                                    <th scope="col" style="width: 150px;">FECHA</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tableListGestionCompras">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdViewDetailCompra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETALLE DE COMPRAS</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">COMPROBANTE : </label>
                        <input type="text" class="form-control" id="txtComprobante" readonly>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">NUMERO : </label>
                        <input type="text" class="form-control" id="txtNumero" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">EMPLEADO : </label>
                        <input type="text" class="form-control" id="txtEmpleado" readonly>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">PROVEEDOR : </label>
                        <input type="text" class="form-control" id="txtProveedor" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">VALOR DE COMPRA : </label>
                        <input type="text" class="form-control" id="txtValor" readonly style="font-weight: bold; font-size: larger;">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">FECHA DE COMPRA : </label>
                        <input type="text" class="form-control" id="txtFecha" readonly style="font-weight: bold; font-size: larger;">
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableGestionDetalleCompras">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">CANTIDAD</th>
                                    <th scope="col">COSTO</th>
                                    <th scope="col">IMPORTE</th>
                                </tr>
                            </thead>
                            <tbody id="tableListGestionDetalleCompras">
                            </tbody>
                            <tfoot>
                                <tr class='text-center' style='background-color: lightyellow; color: black; font-weight: bold; border-top: solid; border-color: gold; font-size: large;'>
                                    <td colspan='3'>TOTAL</td>
                                    <td><span id="txtCantidadTotal"></span></td>
                                    <td><span id="txtImporteTotal"></span></td>
                                </tr>
                            </tfoot>
                        </table>
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
<script src="{{ asset('js/gestion_compras.js') }}"></script>
@stop