@extends('adminlte::page')

@section('title', 'Comprobante')

@section('content_header')
<!-- <h1>Comprobante</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  bg-header-purple">
                REGISTRAR COMPROBANTE
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mb-2">
                        <label class="col-form-label">NOMBRE : </label>
                        <input type="text" class="form-control" id="txtNombreComprobante">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="btnRegistrarComprobante"> <i class="fas fa-fw fa-plus"></i> REGISTRAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-header-purple">
                MANTENIMIENTO DE COMPROBANTES
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableComprobantes">
                            <thead class="header-table text-center">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">DESCRIPCIÓN</th>
                                    <th scope="col">ESTADO</th>
                                    <th scope="col">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tableListComprobantes">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------>
<div class="modal fade" id="mdEditComprobante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="txtTitleEditarComprobante"> </span> </h5>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">NOMBRE : </label>
                        <input type="hidden" id="txtEditIdComprobante">
                        <input type="text" class="form-control" id="txtEditNombreComprobante" readonly>
                    </div>
                    <div class="col-sm-6 col-md-12 mb-2">
                        <label class="col-form-label">ESTADO: </label>
                        <div id="selectHTMLComprobante"></div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnActualizarComprobante"><i class="fas fa-pen"></i> Editar</button>
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
<script src="{{ asset('js/comprobantes.js') }}"></script>
@stop