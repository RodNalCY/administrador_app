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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body d-flex justify-content-start">
                <div class="row">
                    <div class="col-md-5">
                        <div class="text-center">
                            <img src="https://www.controligestio-tpv.com/wp-content/uploads/2017/11/CASIO-SE-C3500-500.jpg" class="img-fluid" alt="..." width="100%">
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
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">INGRESOS POR VENTA :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">CANT. DE PRODUCTOS :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">GANANCIAS :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 row">
                            <label class="col-sm-6 col-form-label text-right">
                                <h3>TOTAL EN CAJA (S/) :</h3>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-primary" type="button"> <i class="fas fa-fw fa-cash-register "></i> Ventas realizadas</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="car-body">
        <div class="row m-2">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="header-table">
                        <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Ganancia</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Panadol</td>
                            <td>2.20</td>
                            <td>16.00</td>
                            <td>2.20</td>
                            <td>2023-11-12</td>
                        </tr>
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
<script>
    console.log('Hi!');
</script>
@stop