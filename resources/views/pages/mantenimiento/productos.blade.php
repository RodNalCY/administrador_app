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
                        <label class="col-form-label">NOMBRE:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtProductoNombre">
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtProductoConcentracion">
                    </div>


                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">STOCK<code>(cantidad)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtProductoStock" min="0" max="1000">
                        <div class="form-text"><sup><code><strong>
                                        Ingrese cuantos productos tiene disponible
                                    </strong></code></sup></div>
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">COSTO<code>(compra)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtProductoCosto" min="0" max="1000">
                        <div class="form-text"><sup><code><strong>Si el costo es un valor decimal no olvide colocar el punto(.) Ejemplo: 5.40</strong></code></sup></div>
                    </div>

                    <div class="col-sm-6 col-md-2 mb-2">
                        <label class="col-form-label">PRECIO<code>(venta)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtProductoPrecio" min="0" max="10000">
                        <div class="form-text"><sup><code><strong>
                                        Si el precio es un valor decimal no olvide colocar el punto(.) Ejemplo: 2.90
                                    </strong></code></sup></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRESENTACIÓN: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="hidden" id="txtProductoIdPresentacion" readonly>
                        <input type="text" class="form-control" id="txtProductoPresentacion" readonly>
                        <button type="button" class="btn btn-info btn-sm mt-2" id="btnBuscarPresentacion"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">LABORATORIO: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="hidden" id="txtProductoIdLaboratorio" readonly>
                        <input type="text" class="form-control" id="txtProductoLaboratorio" readonly>
                        <button type="button" class="btn btn-info  btn-sm mt-2" id="btnBuscarLaboratorio"><i class="fas fa-fw fa-search"></i> Buscar</button>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">REGISTRO SANITARIO: </label>
                        <input type="text" class="form-control" id="txtProductoRegistroSanitario">
                    </div>


                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">VENCIMIENTO: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="date" class="form-control" id="txtProductoVencimiento">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="btnRegistrarProducto"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="input-group">
                    <div class="input-group-text" style="background-color: #4a3fff; color:white; "> <i class="fas fa-fw fa-search"></i> </div>
                    <input type="search" class="form-control" id="btnBuscarListProducto" placeholder="Ingrese el nombre del producto" style="background-color: azure;">
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                <button type="button" class="btn btn-success" id="btnExportarExcelProductos"> <i class="fas fa-fw fa-table"></i> Exportar Excel</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableProductos">
                    <thead class="header-table text-center">
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
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <sup style="top: 0;"><strong>NOTA:</strong> Si no encuentra la presentación del producto, por favor diríjase al menú <strong>Mantenimiento > Presentaciones</strong> para crearla.</sup>
                    </div>
                </div>
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
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <sup style="top: 0;"><strong>NOTA:</strong> Si no encuentra el laboratorio del producto, por favor diríjase al menú <strong>Mantenimiento > Laboratorios</strong> para crearla.</sup>
                        </div>
                    </div>
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
                        <label class="col-form-label">NOMBRES:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="hidden" id="txtEditProdId">
                        <input type="text" class="form-control" id="txtEditProdName">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">CONCENTRACIÓN:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtEditProdConcentracion">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">LABORATORIO:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <div id="selectEditHTMLLaboratorio"></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">PRESENTACIÓN:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup> </label>
                        <div id="selectEditHTMLPresentaciones"></div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">STOCK<code>(cantidad)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtEditProdStock" min="0" max="1000">
                        <div class="form-text"><sup><code>Inventario:<span id="txtDescripcionStock"></span> productos registrados</code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">COSTO<code>(compra)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtEditProdCosto" min="0" max="10000">
                        <div class="form-text"><sup><code>El costo actual del producto: <span id="txtDescripcionCosto"></span></code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">PRECIO<code>(venta)</code>:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtEditProdVenta" min="0" max="10000">
                        <div class="form-text"><sup><code>El precio actual de venta: <span id="txtDescripcionPrecio"></span></code></sup></div>
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">REGISTRO SANITARIO : </label>
                        <input type="text" class="form-control" id="txtEditProdRegistroSanitario">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">VENCIMIENTO:<sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="date" class="form-control" id="txtEditProdVencimiento">
                    </div>
                    <div class="col-sm-6 col-md-6 mb-2">
                        <label class="col-form-label">ESTADO : </label>
                        <div id="selectEditHTMLEstado"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnActualizarProducto"><i class="fas fa-pen"></i> Editar</button>
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