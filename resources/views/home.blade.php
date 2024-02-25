@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- @section('plugins.Sweetalert2', true) -->

@section('content_header')
<!-- <h1>Dashboard</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="HTMLVentaRealizadas"></h3>
                <p>Ventas Realizadas</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-handshake"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="HTMLComprasRealizadas"></h3>
                <p>Compras Realizadas</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-cart-plus"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="HTMLTotalCliente"></h3>
                <p>Clientes Registrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="HTMLTotalProductos"></h3>
                <p>Total de Productos</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-capsules"></i>
            </div>
            <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">INGRESO POR SEMANA (S/.)</h3>
            </div>
            <div class="box-body">
                <canvas id="barChartSumVentaSemana"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">VENTAS POR SEMANA</h3>
            </div>
            <div class="box-body">
                <canvas id="barChartTotalVentaSemana"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">INGRESO POR MES (S/.)</h3>
            </div>
            <div class="box-body">
                <canvas id="barChartSumVentaMensual"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">VENTAS POR MES</h3>
            </div>
            <div class="box-body">
                <canvas id="barChartTotalVentaMensual"></canvas>
            </div>
        </div>
    </div>
</div>



<!-- <div class="row mt-4">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Presentaciones</h3>
                </div>
                <div class="box-body">
                    <canvas id="pieChart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Laboratorios</h3>
                </div>
                <div class="box-body">
                    <canvas id="barColumnChart1"></canvas>
                </div>
            </div>
        </div>
    </div> -->


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/dashboard.js') }}"></script>
@stop