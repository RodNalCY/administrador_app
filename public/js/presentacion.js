$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListPresentacion").html(
        "<tr><td colspan='4' class='text-center'>No hay presentaciones disponibles.</td></tr>"
    );
    listaPresentaciones();
});

$("#btnRegistrarPresentacion").click(function () {
    var preNombre = $("#txtPresentacionNombre").val().trim().toUpperCase();

    if (preNombre != "") {
        console.log("preNombre > " + preNombre);
        var data = {
            _token: _globa_token_crf,
            _preNombre: preNombre,
        };

        registrarPresentacion(data);
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

$("#btnActualizarPresentacion").click(function () {
    var preId = $("#txtEditIdPre").val().trim();
    var preName = $("#txtEditNamePre").val().trim().toUpperCase();
    var preState = $("#selectEstadoPre").val().trim();

    if (preName != "") {
        console.log("preName > " + preName);
        var data = {
            _token: _globa_token_crf,
            _preId: preId,
            _preName: preName,
            _preState: preState,
        };

        editarPresentacion(data);
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

function listaPresentaciones() {
    $.ajax({
        type: "GET",
        url: "/list/presentaciones",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_presentaciones = "";
            var html_select_options =
                "<select class='form-control' id='selectEstadoPre'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (pre) {
                html_tabla_presentaciones =
                    html_tabla_presentaciones +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    pre.idPresentacion +
                    "</th>" +
                    "<td>" +
                    pre.Descripcion +
                    "</td>" +
                    "<td>" +
                    pre.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-presentacion'" +
                    " data-id='" +
                    pre.idPresentacion +
                    "' data-state='" +
                    pre.Estado +
                    "' data-name='" +
                    pre.Descripcion +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-presentacion'" +
                    " data-id='" +
                    pre.idPresentacion +
                    "' data-name='" +
                    pre.Descripcion +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListPresentacion").html(html_tabla_presentaciones);
            $("#selectHTMLEstado").html(html_select_options);
            // Reinicializar DataTables
            $("#tablePresentacion").DataTable({
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

function registrarPresentacion(data) {
    $.ajax({
        type: "POST",
        url: "/save/presentacion",
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
                    text: "La presentación fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro la presentación !",
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

function editarPresentacion(data) {
    $.ajax({
        type: "POST",
        url: "/edit/presentacion",
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
                    text: "La presentación fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo la presentación !",
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


function deletePresentacion(data) {
    $.ajax({
        type: "POST",
        url: "/delete/presentacion",
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
                    text: "El presentación fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el presentación !",
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

$(document).on("click", ".btn-edit-presentacion", function () {
    var presentacionId = $(this).data("id");
    var presentacionName = $(this).data("name");
    var presentacionEstado = $(this).data("state");

    $("#txtEditIdPre").val(presentacionId);
    $("#txtEditNamePre").val(presentacionName);
    $("#selectEstadoPre").val(presentacionEstado);

    $("#txtTitleEditarPre").html(
        "<strong><i class='fas fa-fw fa-capsules'></i> " +
            presentacionName +
            "</strong>"
    );

    $("#mdEditPresentacion").modal("show");
});

$(document).on("click", ".btn-delete-presentacion", function () {
    var dataId = $(this).data("id");
    var dataName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar la Presentación : <strong>" +
            dataName +
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
                _dataId: dataId,
            };

            deletePresentacion(data);
        }
    });
});
