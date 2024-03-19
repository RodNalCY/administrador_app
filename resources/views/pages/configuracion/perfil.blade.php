@extends('adminlte::page')

@section('title', 'Configuracion')

<!-- @section('plugins.Sweetalert2', true) -->

@section('content_header')
<!-- <h1>Dashboard</h1> -->
@stop

@section('content')
<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

<div class="row ">
    <div class="col-md-12">
        <div class="background-particle w-100 position-absolute top-0 left-0" id="particlebackground" data-config="{{ asset('js/pj-config.json') }}"></div>
        <div class="d-flex justify-content-center">
            <div class="col-lg-5 col-md-12 mt-3">
                <div class="card card-user bg-dark">
                    <div class="card-header card-header-user text-center">🥼 Mi Info 🧬</div>
                    <div class="card-body card-body-user">

                        <center id="http_loading">
                            <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden"></span>
                            </div>
                        </center>
                        <div id="http_content">
                            <img src="" class="user-image-icon" alt="User Image" id="icon-logo">
                            <div class="user-info-details">

                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">NOMBRE(S) :</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtNombres">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">DNI/CARNET:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtDNI">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">EMAIL:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtEmail">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">ESPECIALIDAD:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtEspecialidad">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">GÉNERO:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtSexo">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">TELÉFONO:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtTelefono">
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-sm-4 user-label">DIRECCIÓN:</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" style="color: #fff;" id="txtDireccion">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <center>
                                <button type="button" class="btn btn-dark mt-2" id="btnActualizarContraseña">🔐Actualizar Contraseña🔑</button>
                            </center>
                        </div>


                    </div>
                    <div class="card-footer card-footer-user text-center">
                        💊 My <a href="#" class="text-white"></a> user details, by <a href="#" class="text-white">DALIFHAR🏣</a>.
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="mdActualizarContrasenia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mdListProveedoresLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-modal-color">
                <h5 class="modal-title">🔐Actualizar Contraseña🔑</h5>
            </div>
            <div class="modal-body bg-dark">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <sup style="top: 0;">Por motivos de seguridad, te recomendamos no compartir y actualizar tu contraseña periódicamente para proteger tu cuenta.</sup>
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-4 user-label">Contraseña Actual : </label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-sm" id="txtContraseniaActual" placeholder="Ingrese la contraseña actual">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-info btn-sm" id="btnVerificarPassword"><i class="fa fa-lock"></i> Verificar</button>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-4 user-label">Nueva Contraseña : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="txtNuevaContrasenia" placeholder="Ingrese la nueva contraseña" disabled style="background: slategray;">
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-4 user-label">Repetir la Contraseña : <sup class="icon_obligatorio"><i class="fas fa-asterisk fa-xs"></i></sup></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="txtRepNuevaContrasenia" placeholder="Repetir la nueva contraseña" disabled style="background: slategray;">
                    </div>
                </div>
                <!-- <div class="mb-2 row"> -->
                <br>
                <center id="http_loading_change">
                    <div class="progress" style="border-radius: 7px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </center>
                <!-- </div> -->


            </div>
            <div class="modal-footer footer-modal-color">
                <button type="button" class="btn btn-primary" id="btnActualizarPassword" disabled><i class="fa fa-cloud"></i> Actualizar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ asset('js/perfil.js') }}"></script>
@stop