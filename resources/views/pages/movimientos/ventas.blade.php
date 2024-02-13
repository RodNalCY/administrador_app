@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<!-- <div class="card">
    <div class="card-body">
        <h2 id="text-alignment">Movimientos de Ventas <a href="#" style="text-decoration: none;"><strong>#</strong></a></h2>
        <div class="badge bg-secondary text-wrap">
            Vendedor
        </div>
    </div>
</div> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

<div class="row">
    <div class="col-md-12 d-flex justify-content-end">
        <p class="mr-2"> </i><strong> <span id="fechaHora"></span></strong> <i class="fas fa-fw fa-calendar"></i></p>
    </div>
    <div class="col-md-6">
        <div class="card">
            <!-- <h5 class="card-header bg-white header-card-custom"> <strong>DATOS DE LA CLIENTE</strong></h5> -->
            <div class="card-header bg-header-purple">
                DATOS DE LA CLIENTE
                <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">CLIENTE: </label>
                        <input type="hidden" id="txtIdCliente" readonly>
                        <input type="text" class="form-control form-control-sm" id="txtCliente" readonly>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DNI/CARNET: </label>
                        <input type="text" class="form-control form-control-sm" id="txtDNI" readonly>
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">RUC: </label>
                        <input type="text" class="form-control form-control-sm" id="txtClienteRUC" readonly>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-info mr-2 btn-sm" id="btnBuscarClientes"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-header-purple">
                COMPROBANTE
                <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">TIPO : </label>
                        <input type="hidden" id="txtIdTipoComprobante" readonly>
                        <input type="text" class="form-control form-control-sm" id="txtTipoComprobante" readonly>
                    </div>

                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">N° VENTA : </label>
                        <input type="text" class="form-control form-control-sm" id="txtNumComprobante" readonly>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <label class="col-form-label"><br></label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-info btn-sm mr-2" id="btnBuscarComprobante"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-header-purple">
                DATOS DEL PRODUCTO
                <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRODUCTO: </label>
                        <input type="hidden" id="txtIdProducto" readonly>
                        <input type="text" class="form-control" id="txtNombreProducto" readonly>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2" style="display: none;">
                        <label class="col-form-label">Presentación: </label>
                        <input type="text" class="form-control" id="txtPresentacion" readonly>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">CONCETRACIÓN: </label>
                        <input type="text" class="form-control" id="txtConcentracion" readonly>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">STOCK: </label>
                        <input type="text" class="form-control" id="txtStock" readonly>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">PRECIO: </label>
                        <input type="hidden" id="txtCosto" readonly>
                        <input type="text" class="form-control" id="txtPrecio" readonly>
                    </div>

                    <div class="col-sm-6 col-md-12">
                        <div class="d-flex ">
                            <button type="button" class="btn btn-info btn-sm" id="btnBuscarProducto"><i class="fas fa-fw fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-header-purple">
                CALCULAR
                <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4 mb-2">
                        <label class="col-form-label">CANTIDAD: </label>
                        <input type="number" class="form-control" id="txtCantidad" min="1">
                    </div>

                    <div class="col-sm-12 col-md-4 mb-2">
                        <label class="col-form-label">TOTAL : </label>
                        <input type="text" class="form-control" id="txtTotal" style="background-color: lightyellow;" readonly>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary btn-sm" id="btnAgregarVenta"><i class="fas fa-fw fa-plus"></i> Agregar </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card mt-4">
    <div class="card-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableCompras">
                    <thead class="header-table text-center">
                        <tr class='text-center'>
                            <th scope="col">OPCIONES</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">CATEGORÍA</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="tableListVentas">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row d-flex justify-content-end">
            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">VALOR DE VENTA: </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;" id="txtValorVenta" readonly>
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">DESCUENTO : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;" id="txtValorDescuento" readonly>
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">SUB TOTAL: </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;" id="txtValorSubtotal" readonly>
            </div>

            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">I.G.V (18 %) : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: lightyellow;" id="txtValorIGV" readonly>
            </div>
            <div class="col-sm-6 col-md-2 mb-2">
                <label class="col-form-label">TOTAL A PAGAR : </label>
                <input type="text" class="form-control form-control-lg" style="background-color: cyan;" id="txtTotalPagar" readonly>
            </div>

            <div class="col-sm-12 col-md-12 mt-4 text-right">
                <button type="button" class="btn btn-primary btn-lg" id="btnRegistrarVenta"><i class="fas fa-fw fa-plus"></i> Registrar Venta</button>
                <!-- <button type="button" class="btn btn-success btn-lg" id="btnDEMO"><i class="fas fa-fw fa-plus"></i> DEMO </button> -->
                <!-- <button type="button" class="btn btn-success btn-lg" id="btnGenerarVoucher"><i class="fas fa-fw fa-plus"></i> Generar Voucher </button> -->
            </div>
        </div>


    </div>
</div>
<br>
<br>

<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdListClientes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListClientesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListClientesLabel">Mis de Clientes</h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm" id="tableClientes">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">DNI/CARNET</th>
                                    <th scope="col">RUC</th>
                                    <th scope="col">NOMBRES</th>
                                    <th scope="col">APELLIDOS</th>
                                    <th scope="col">SEXO</th>
                                    <th scope="col">TELÉFONO</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_clientes">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnAgregarCliente"><i class="fas fa-plus"></i> Añadir</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm" id="tableComprobantes">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">DESCRIPCIÓN</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_comprobantes">
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
<div class="modal fade" id="mdListProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdListProductoLabel">Mis Productos</h5>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="alert alert-light" role="alert" style="padding: 15px 0px 0px 10px;">
                        <sup style="top: 0;">
                            <p><strong>NOTA:</strong> Los siguientes colores en la lista de productos tienen el siguiente significado:</p>
                            <p style="color:#ff5454; font-weight: bold;">ROJO : El producto esta agotado y no puede ser seleccionado.</p>
                            <p style="color:#cccc00; font-weight: bold;">AMARILLO : El producto esta por agotarse pronto.</p>
                        </sup>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm" id="tableProductos">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">DESCRIPCIÓN</th>
                                    <th scope="col">LABORATORIO</th>
                                    <th scope="col">PRESENTACIÓN</th>
                                    <th scope="col">CONCENTRACIÓN</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_row_productos">
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
<div class="modal fade" id="mdAgragarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Cliente</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <sup style="top: 0;"><strong>NOTA:</strong> Por favor, asegúrate de ingresar los siguientes datos para el nuevo cliente: <strong>DNI, NOMBRES, APELLIDOS, TELÉFONO Y SEXO</strong>.</sup>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DNI/CARNET : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtClienteDNI" min="0">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">NOMBRES : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtClienteNombres">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">APELLIDOS : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="text" class="form-control" id="txtClienteApellidos">
                    </div>

                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">RUC : </label>
                        <input type="number" class="form-control" id="txtClienteRUC" min="0">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">EMAIL : </label>
                        <input type="email" class="form-control" id="txtClienteEmail">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">TELEFONO : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtClienteTelefono" min="0">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">DIRECCIÓN : </label>
                        <input type="text" class="form-control" id="txtClienteDireccion">
                    </div>
                    <div class="col-sm-6 col-md-3 mb-2">
                        <label class="col-form-label">SEXO : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <div id="selectHTMLSexo"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnRegistrarCliente"><i class="fas fa-plus"></i> Añadir</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
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
                <button type="button" class="btn btn-success" id="btnAbrirMdWhatsapp"><i class="fab fa-whatsapp fa-lg"></i> Enviar x Whatsapp </button>
                <button type="button" class="btn btn-danger" id="btnFinalizarVenta"><i class="fas fa-times"></i> Finalizar / Cerrar </button>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------------->
<div class="modal fade" id="mdEnviarWhatsapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProductoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">INGRESE O VERIFIQUE EL NÚMERO DE WHATSAPP</h5>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-12 mb-2">
                        <label class="col-form-label">NUMERO: <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                        <input type="number" class="form-control" id="txtTelefonoCliente">
                        <div class="form-text"><sup><code>Por favor, no olvide verificar el número de teléfono con el cliente</code></sup></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnEnviarPDFWhatsapp"><i class="fab fa-whatsapp fa-lg"></i> Enviar </button>
                <button type="button" class="btn btn-danger" id="btnCerrarPDFWhatsapp""><i class=" fas fa-times"></i> Cerrar </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/ventas.js') }}"></script>

@stop