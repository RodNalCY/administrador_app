@extends('adminlte::page')

@section('title', 'Gestión Ventas')

@section('content_header')
<!-- <h1>Clientes</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-header-purple">
               GESTIÓN - CONSULTAR VENTAS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableGestionVentas">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">NUMERO</th>                                    
                                    <th scope="col">COMPROBANTE</th>
                                    <th scope="col">EMPLEADO</th>
                                    <th scope="col">CLIENTE</th>
                                    <th scope="col">VALOR TOTAL</th>
                                    <th scope="col">VALOR TOTAL TEXTO</th>
                                    <th scope="col">RUTA COMPROBANTE</th>
                                    <th scope="col" style="width: 120px;">FECHA</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tableListGestionVentas">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdPDFVoucher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">VOUCHER ELECTRÓNICO</h5>
            </div>
            <div class="modal-body">
                <embed id="docVoucherPDF" type="application/pdf" width="100%" height="800px" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i>  Cerrar  </button>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/gestion_ventas.js') }}"></script>
@stop