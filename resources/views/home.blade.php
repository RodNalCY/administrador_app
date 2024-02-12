@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- @section('plugins.Sweetalert2', true) -->

@section('content_header')
<!-- <h1>Dashboard</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Ventas Realizadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-handshake"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Compras Realizadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-cart-plus"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>Clientes Registrados</p>
                </div>
                <div class="icon">
                <i class="fas fa-fw fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Stock de Productos</p>
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
                    <h3 class="box-title">Ingresos Mensuales (S/.)</h3>
                </div>
                <div class="box-body">
                    <canvas id="barChart1" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Ingresos Semanales (S/.)</h3>
                </div>
                <div class="box-body">
                    <canvas id="barChart2" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
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
    </div>


</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/dashboard.js') }}"></script>
@stop