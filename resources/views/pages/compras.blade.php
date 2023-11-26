@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
<!-- <h1>Compras</h1> -->
@stop

@section('content')

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header bg-white header-card-custom"> <strong>DATOS DE LA COMPRA</strong></h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">CLIENTE:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">RUC:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-secondary mr-2 btn-sm" id="btnBuscarProveedores"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">COMPROBANTE:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-secondary btn-sm mr-2" id="btnBuscarComprobante"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">FECHA:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header bg-white header-card-custom"> <strong>DATOS DEL PRODUCTO</strong></h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-2 mb-2">
                        <label class="col-form-label">CÓDIGO:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-secondary mr-2 btn-sm" id="btnBuscarProducto"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRODUCTO:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label"> PRESENTACIÓN:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">STOCK:</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">COSTO (C/U):</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CANTIDAD: </label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">TOTAL : </label>
                        <input type="text" class="form-control" style="background-color: lightyellow;">
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Agregar </button>
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
            <table class="table table-hover table-bordered">
                <thead class="header-table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Presentación</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">2</th>
                        <td>Panadol</td>
                        <td>Producto descripcion</td>
                        <td>Categoria </td>
                        <td>2</td>
                        <td>5</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Panadol</td>
                        <td>Producto descripcion</td>
                        <td>Categoria </td>
                        <td>2</td>
                        <td>5</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Panadol</td>
                        <td>Producto descripcion</td>
                        <td>Categoria </td>
                        <td>2</td>
                        <td>5</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Panadol</td>
                        <td>Producto descripcion</td>
                        <td>Categoria </td>
                        <td>2</td>
                        <td>5</td>
                        <td>10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row d-flex justify-content-end">
            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">VALOR DE VENTA: </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;">
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">DESCUENTO : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;">
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">SUB TOTAL: </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;">
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">I.G.V (18 %) : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;">
            </div>
            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">TOTAL A PAGAR : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: cyan;">
            </div>

            <div class="col-sm-12 col-md-12 mt-4 text-right">
                <button type="button" class="btn btn-primary btn-lg"><i class="fas fa-fw fa-plus"></i> Registrar Venta</button>
            </div>
        </div>


    </div>
</div>
<br>
<br>

<!----------------------------------------------------------------------------------------------->

<div class="modal fade" id="mdListProveedores" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListProveedoresLabel">Lista de sus Proveedores</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <table class="table table-hover table-bordered">
                        <thead class="header-table">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">RUC</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i> Añadir Proveedor</button>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListComprobante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListComprobanteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListComprobanteLabel">Lista de Comprobantes</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <table class="table table-hover table-bordered">
                        <thead class="header-table">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i> Añadir Comprobante</button>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListProductoLabel">Lista de Productos</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <table class="table table-hover table-bordered">
                        <thead class="header-table">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Presentación</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Concentración</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Panadol</td>
                                <td>Producto descripcion</td>
                                <td>Producto descripcion</td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>

                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-primary"><i class="fas fa-user-plus"></i> Añadir Comprobante</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/compras.js') }}"></script>
@stop