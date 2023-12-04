@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- @section('plugins.Sweetalert2', true) -->

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome to this beautiful admin panel.</p>


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
<script>
    // Datos del gráfico
    var labels = @json($labels1);
    var data = @json($data1);

    // Configuración del gráfico
    var ctx1 = document.getElementById('barChart1').getContext('2d');
    var barChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total',
                data: data,
                backgroundColor: 'rgba(0, 191, 255, 0.3)', // Azul claro
                borderColor: 'rgba(0, 191, 255, 1)', // Azul claro              
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var labels2 = @json($labels2);
    var data2 = @json($data2);

    var ctx2 = document.getElementById('barChart2').getContext('2d');
    var barChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels2,
            datasets: [{
                label: 'Total',
                data: data2,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var labels3 = @json($labels3);
    var data3 = @json($data3);

    var ctx3 = document.getElementById('pieChart1').getContext('2d');
    var barChart3 = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: labels3,
            datasets: [{
                data: data3,
                backgroundColor: [
                    'rgba(0, 123, 255, 0.7)', // Azul
                    'rgba(40, 167, 69, 0.7)', // Verde
                    'rgba(255, 193, 7, 0.7)', // Amarillo
                    'rgba(255, 150, 50, 0.7)' // Amarillo
                ]
            }]
        },

    });

    var labels4 = @json($labels4);
    var data4 = @json($data4);

    var ctx4 = document.getElementById('barColumnChart1').getContext('2d');
    var barChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: labels4,
            datasets: [{
                label: '',
                data: data4,
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)', // Verde
                    'rgba(255, 193, 7, 0.7)', // Amarillo
                    'rgba(0, 123, 255, 0.7)', // Azul
                ],

                borderSkipped: true,
                stack: 'combined',
            }],
        },

    });
</script>
@stop