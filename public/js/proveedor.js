$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListProveedores").html(
        "<tr><td colspan='11' class='text-center'>No hay proveedores disponibles.</td></tr>"
    );

    listaProveedores();
});

$("#btnRegistrarProveedor").click(function () {
    var provNombre = $("#txtProvNombre").val().trim().toUpperCase();
    var provDNI = $("#txtProvDNI").val().trim();
    var provRuc = $("#txtProvRUC").val().trim();
    var provDir = $("#txtProvDireccion").val().trim().toUpperCase();
    var provEmail = $("#txtProvEmail").val().trim();
    var provTelef = $("#txtProvTelefono").val().trim();
    var provBanco = $("#txtProvBanco").val().trim();
    var provCuenta = $("#txtProvCuenta").val().trim();

    if (provNombre != "") {
        console.log(
            "provNombre > " +
                provNombre +
                " provDNI > " +
                provDNI +
                " provRuc > " +
                provRuc +
                " provDir > " +
                provDir +
                " provEmail > " +
                provEmail +
                " provTelef > " +
                provTelef +
                " provBanco > " +
                provBanco +
                " provCuenta > " +
                provCuenta
        );
        var data = {
            _token: _globa_token_crf,
            _provNombre: provNombre,
            _provDNI: provDNI,
            _provRuc: provRuc,
            _provDir: provDir,
            _provEmail: provEmail,
            _provTelef: provTelef,
            _provBanco: provBanco,
            _provCuenta: provCuenta,
        };

        registrarProveedor(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar el nombre de la presentación !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnActualizarProveedor").click(function () {
    var provId = $("#txtEditProvId").val().trim();
    var provNombre = $("#txtEditProvName").val().trim().toUpperCase();
    var provDNI = $("#txtEditProvDNI").val().trim();
    var provRuc = $("#txtEditProvRUC").val().trim();
    var provDir = $("#txtEditProvDirc").val().trim().toUpperCase();
    var provEmail = $("#txtEditProvEmail").val().trim();
    var provTelef = $("#txtEditProvTele").val().trim();
    var provBanco = $("#txtEditProvBanco").val().trim();
    var provCuenta = $("#txtEditProvCuenta").val().trim();
    var provEstado = $("#selectEstadoProveedor").val().trim();

    if (provId != "" && provNombre != "") {
        console.log(
            "provId > " +
                provId +
                "provNombre > " +
                provNombre +
                " provDNI > " +
                provDNI +
                " provRuc > " +
                provRuc +
                " provDir > " +
                provDir +
                " provEmail > " +
                provEmail +
                " provTelef > " +
                provTelef +
                " provBanco > " +
                provBanco +
                " provCuenta > " +
                provCuenta +
                " provEstado > " +
                provEstado
        );
        var data = {
            _token: _globa_token_crf,
            _provId: provId,
            _provNombre: provNombre,
            _provDNI: provDNI,
            _provRuc: provRuc,
            _provDir: provDir,
            _provEmail: provEmail,
            _provTelef: provTelef,
            _provBanco: provBanco,
            _provCuenta: provCuenta,
            _provEstado: provEstado,
        };

        editarProveedor(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar los campos del proveedor !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function listaProveedores() {
    $.ajax({
        type: "GET",
        url: "/list/proveedores",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_proveedores = "";
            var html_select_options =
                "<select class='form-control' id='selectEstadoProveedor'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (pro) {
                html_tabla_proveedores =
                    html_tabla_proveedores +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    pro.IdProveedor +
                    "</th>" +
                    "<td>" +
                    pro.Nombre +
                    "</td>" +
                    "<td>" +
                    pro.Dni +
                    "</td>" +
                    "<td>" +
                    pro.Ruc +
                    "</td>" +
                    "<td>" +
                    pro.Direccion +
                    "</td>" +
                    "<td>" +
                    pro.Email +
                    "</td>" +
                    "<td>" +
                    pro.Telefono +
                    "</td>" +
                    "<td>" +
                    pro.Banco +
                    "</td>" +
                    "<td>" +
                    pro.Cuenta +
                    "</td>" +
                    "<td>" +
                    pro.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-proveedor'" +
                    " data-id='" +
                    pro.IdProveedor +
                    "' data-name='" +
                    pro.Nombre +
                    "' data-dni='" +
                    pro.Dni +
                    "' data-ruc='" +
                    pro.Ruc +
                    "' data-dir='" +
                    pro.Direccion +
                    "' data-email='" +
                    pro.Email +
                    "' data-tel='" +
                    pro.Telefono +
                    "' data-banco='" +
                    pro.Banco +
                    "' data-cuenta='" +
                    pro.Cuenta +
                    "' data-state='" +
                    pro.Estado +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-proveedor'" +
                    " data-id='" +
                    pro.IdProveedor +
                    "' data-name='" +
                    pro.Nombre +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListProveedores").html(html_tabla_proveedores);
            $("#selectHTMLEstado").html(html_select_options);
            // Reinicializar DataTables
            $("#tableProveedores").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function registrarProveedor(data) {
    $.ajax({
        type: "POST",
        url: "/save/proveedor",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Registrado!",
                    text: "El proveedor fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro el proveedor !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Upps!",
                text: "Algo paso, no se registro el proveedor !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function editarProveedor(data) {
    $.ajax({
        type: "POST",
        url: "/edit/proveedor",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Actualizado!",
                    text: "El proveedor fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el proveedor !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Error!",
                text: "Algo paso, no se actualizo el proveedor !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function deleteProveedor(data) {
    $.ajax({
        type: "POST",
        url: "/delete/proveedor",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Desactivado!",
                    text: "El proveedor fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el proveedor !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$(document).on("click", ".btn-edit-proveedor", function () {
    var provId = $(this).data("id");
    var provName = $(this).data("name");
    var provDNI = $(this).data("dni");
    var provRUC = $(this).data("ruc");
    var provDirec = $(this).data("dir");
    var provEmail = $(this).data("email");
    var provTelf = $(this).data("tel");
    var provBanco = $(this).data("banco");
    var provCuenta = $(this).data("cuenta");
    var provEstado = $(this).data("state");

    $("#txtEditProvId").val(provId);
    $("#txtEditProvName").val(provName);
    $("#txtEditProvDNI").val(provDNI);
    $("#txtEditProvRUC").val(provRUC);
    $("#txtEditProvDirc").val(provDirec);
    $("#txtEditProvEmail").val(provEmail);
    $("#txtEditProvTele").val(provTelf);
    $("#txtEditProvBanco").val(provBanco);
    $("#txtEditProvCuenta").val(provCuenta);
    $("#selectEstadoProveedor").val(provEstado);

    $("#txtTitleEditarProveedor").html(
        "<strong><i class='fas fa-fw fa-capsules'></i> " +
            provName +
            "</strong>"
    );

    $("#mdEditProveedor").modal("show");
});

$(document).on("click", ".btn-delete-proveedor", function () {
    var provId = $(this).data("id");
    var provName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el Proveedor: <strong>" +
            provName +
            "</strong></p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, desactivar!",
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            var data = {
                _token: _globa_token_crf,
                _proveedorId: provId,
            };

            deleteProveedor(data);
        }
    });
});
