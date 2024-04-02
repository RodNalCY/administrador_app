@extends('adminlte::page')

@section('title', 'Caja')

@section('content_header')
<!-- <div class="card">
    <div class="card-body">
        <h2 id="text-alignment">Movimientos de Caja <a href="#" style="text-decoration: none;"><strong>#</strong></a></h2>
        <div class="badge bg-primary text-wrap">
            Administrador
        </div>
    </div>
</div> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body d-flex justify-content-start">
                <div class="row">
                    <div class="col-md-5">
                        <div class="text-center">
                            <img src="{{ asset('img/icons/caja-icono.jpg') }}" class="img-fluid" alt="..." width="100%">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h4> <i class="fas fa-fw fa-sun"></i> Resumen diario</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">FECHA :</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control form-control-sm" id="txtFechaDiario">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">INGRESOS POR VENTA :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="txtIngresoVenta" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">CANT. DE PRODUCTOS :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="txtCantProducto" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">GANANCIAS :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="txtGanancia" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">
                                <h3>TOTAL EN CAJA (S/) :</h3>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-lg" id="txtTotalCaja" style="background-color: lightyellow;" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row text-right">

                            <div class="col-sm-12 col-md-12">
                                <button class="btn btn-primary btn-sm" type="button" id="btnCalcularIngresos"> <i class="fas fa-hand-holding-usd"></i> Generar Resumen de Ventas &nbsp;</button>
                            </div>

                            <div class="col-sm-12 col-md-12 mt-3">
                                <button class="btn btn-secondary btn-sm" type="button" id="btnVisualizarVentas"><i class="fas fa-fw fa-cash-register"></i> Visualizar Historial de Ventas</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="button" class="btn btn-success" id="btnExportarExcelResumenDiario"> <i class="fas fa-fw fa-table"></i> EXPORTAR EXCEL</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="header-table text-center">
                        <tr>
                            <th scope="col">NOMBRE / CONCET. / PREST.</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">GANANCIA</th>
                            <th scope="col">FECHA - HORA</th>
                        </tr>
                    </thead>
                    <tbody id="tableResumenDiario">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListResumen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListResumenLabel">Lista de Ventas</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">

                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">DESDE: </label>
                        <input type="date" class="form-control form-control-sm" id="txtFechaDesde">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">HASTA: </label>
                        <input type="date" class="form-control form-control-sm" id="txtFechaHasta">
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <br>
                        <button type="button" class="btn btn-primary btn-sm" id="btnVentasDetalle" style="margin-top: 13px;"><i class="fas fa-fw fa-search"></i> Buscar </button>
                        <button type="button" class="btn btn-success btn-sm" id="btnExportarExcelHistorial" style="margin-top: 13px; float: inline-end;"> <i class="fas fa-fw fa-table"></i> EXPORTAR EXCEL</button>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">CÓDIGO PRODUCTO</th>
                                    <th scope="col">NOMBRE PRODUCTO</th>
                                    <th scope="col">PRESENTACIÓN</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">CANTIDAD</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">GANANCIAS</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_ventas_detalle">

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

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/caja.js') }}"></script>
@stop