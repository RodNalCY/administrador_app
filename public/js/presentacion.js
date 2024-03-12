$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
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
            _token: _global_token_crf,
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
            _token: _global_token_crf,
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
            _token: _global_token_crf,
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
                if (pre.Estado == "Inactivo") {
                    html_tabla_presentaciones =
                        html_tabla_presentaciones +
                        "<tr style='background-color: #ff22221f;'>" +
                        "<th class='text-center' scope='row'>" +
                        pre.idPresentacion +
                        "</th>" +
                        "<td>" +
                        pre.Descripcion +
                        "</td>" +
                        "<td class='text-center'>" +
                        "<button type='button' class='btn btn-danger btn-sm btn-estado-size'>"+ pre.Estado+"</button>"+
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
                        " <button type='button' class='btn btn-success btn-sm btn-estado-presentacion'" +
                        " data-id='" +
                        pre.idPresentacion +
                        "' data-name='" +
                        pre.Descripcion +
                        "' data-active='1'><i class='fas fa-unlock'></i></button>" +
                        "</center>" +
                        "</td>" +
                        "</tr>";
                } else {
                    html_tabla_presentaciones =
                        html_tabla_presentaciones +
                        "<tr>" +
                        "<th class='text-center' scope='row'>" +
                        pre.idPresentacion +
                        "</th>" +
                        "<td>" +
                        pre.Descripcion +
                        "</td>" +
                        "<td class='text-center'>" +
                        "<button type='button' class='btn btn-success btn-sm btn-estado-size'>"+ pre.Estado+"</button>"+
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
                        " <button type='button' class='btn btn-danger btn-sm btn-estado-presentacion'" +
                        " data-id='" +
                        pre.idPresentacion +
                        "' data-name='" +
                        pre.Descripcion +
                        "' data-active='0'><i class='fas fa-lock'></i></button>" +
                        "</center>" +
                        "</td>" +
                        "</tr>";
                }
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

            $("#btnBuscarListPresentacion").on("input", function () {
                var searchText = $(this).val().toLowerCase(); // Obtener el texto ingresado en minúsculas
                // Obtener instancia de DataTables de la tabla
                var table = $("#tablePresentacion").DataTable();
                // Realizar la búsqueda en la tabla utilizando el texto ingresado
                table.search(searchText).draw();
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
                    title: "Actualizado!",
                    text: "El estado de la presentación fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el estado de la presentación !",
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

$(document).on("click", ".btn-estado-presentacion", function () {
    var dataId = $(this).data("id");
    var dataName = $(this).data("name");
    var dataActive = $(this).data("active");

    console.log("dataId > "+ dataId+ " dataName > "+ dataName+ " dataActive > "+dataActive);
    var message = "Desea desactivar el comprobante: ";
    var btnText = "Si, desactivar!";
    var infoTitle = "Desactivar!";

    if (dataActive == 1) {
        message = "Desea activar el comprobante: ";
        btnText = "Si, Activar!";
        infoTitle = "Activar!";
    }

    Swal.fire({
        title: infoTitle,
        html:
            "<p>"+message+"<strong>" +
            dataName +
            "</strong></p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: btnText,
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            var data = {
                _token: _global_token_crf,
                _dataId: dataId,
                _estado: dataActive,
            };

            deletePresentacion(data);
        }
    });
});

$("#btnExportarExcelPresentacion").click(function () {
    Swal.fire({
        title: "Exportar (.xlsx)",
        html: "<p>¿Desea exportar las presentaciones en un archivo Excel?</p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, exportar!",
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "/exportar/excel/presentacion",
                data: {
                    _token: _global_token_crf,
                },
                dataType: "json",
                beforeSend: function () {},
                success: function (response) {
                    console.log("RDX> ", response);
                    // Obtener el dominio base de la página actual
                    var dominioBase = window.location.origin;
                    // Obtener la ruta del archivo Excel desde la respuesta
                    var filePath = dominioBase + "/" + response.data;
                    // Redireccionar a la ruta del archivo Excel para descargarlo
                    window.location.href = filePath;
                },
                complete: function () {},
                error: function (response) {
                    console.log("Error", response);
                },
            });
        }
    });
});
