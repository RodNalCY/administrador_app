$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListLaboratorios").html(
        "<tr><td colspan='6' class='text-center'>No hay laboratorios disponibles.</td></tr>"
    );
    listaLaboratorios();
});

$("#btnRegistrarLabs").click(function () {
    var labsNombre = $("#txtLabNombre").val().trim().toUpperCase();
    var labsDireccion = $("#txtLabDireccion").val().trim().toUpperCase();
    var labsTelefono = $("#txtLabTelefono").val().trim();
    if (labsNombre != "") {
        console.log(
            "labsNombre > " +
                labsNombre +
                " labsDireccion > " +
                labsDireccion +
                " labsTelefono > " +
                labsTelefono
        );
        var data = {
            _token: _globa_token_crf,
            _labsNombre: labsNombre,
            _labsDireccion: labsDireccion,
            _labsTelefono: labsTelefono,
        };

        registrarLaboratorio(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar el nombre del laboratorio !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnActualizarLaboratorio").click(function () {
    var labsId = $("#txtEditIdLab").val().trim();
    var labsName = $("#txtEditNameLab").val().trim().toUpperCase();
    var labsDireccion = $("#txtEditDirecLab").val().trim().toUpperCase();
    var labsTelefono = $("#txtEditTelefLab").val().trim();
    var labsEstado = $("#selectEstadoLabs").val().trim();

    if (labsName != "") {
        console.log("labsEstado > ", labsEstado);
        var data = {
            _token: _globa_token_crf,
            _labsId: labsId,
            _labsName: labsName,
            _labsDireccion: labsDireccion,
            _labsTelefono: labsTelefono,
            _labsEstado: labsEstado,
        };

        editarLaboratorio(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar el nombre del laboratorio !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function listaLaboratorios() {
    $.ajax({
        type: "GET",
        url: "/list/laboratorios",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_laboratorios = "";
            var html_select_options =
                "<select class='form-control' id='selectEstadoLabs'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (labs) {
                html_tabla_laboratorios =
                    html_tabla_laboratorios +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    labs.idLaboratorio +
                    "</th>" +
                    "<td>" +
                    labs.Nombre +
                    "</td>" +
                    "<td>" +
                    labs.Direccion +
                    "</td>" +
                    "<td>" +
                    labs.Telefono +
                    "</td>" +
                    "<td>" +
                    labs.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-laboratorio'" +
                    " data-id='" +
                    labs.idLaboratorio +
                    "' data-state='" +
                    labs.Estado +
                    "' data-direccion='" +
                    labs.Direccion +
                    "' data-telefono='" +
                    labs.Telefono +
                    "' data-name='" +
                    labs.Nombre +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-laboratorio'" +
                    " data-id='" +
                    labs.idLaboratorio +
                    "' data-state='" +
                    labs.Estado +
                    "' data-name='" +
                    labs.Nombre +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListLaboratorios").html(html_tabla_laboratorios);
            $("#selectHTMLEstado").html(html_select_options);
            // Reinicializar DataTables
            $("#tableLaboratorios").DataTable({
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

function registrarLaboratorio(data) {
    $.ajax({
        type: "POST",
        url: "/save/laboratorio",
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
                    text: "El laboratorio fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro el laboratorio !",
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

function deleteLaboratorio(data) {
    $.ajax({
        type: "POST",
        url: "/delete/laboratorio",
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
                    text: "El laboratorio fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el laboratorio !",
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

function editarLaboratorio(data) {
    $.ajax({
        type: "POST",
        url: "/edit/laboratorio",
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
                    text: "El laboratorio fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el laboratorio !",
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

$(document).on("click", ".btn-edit-laboratorio", function () {
    var laboratorioId = $(this).data("id");
    var laboratorioName = $(this).data("name");
    var laboratorioEstado = $(this).data("state");
    var laboratorioDireccion = $(this).data("direccion");
    var laboratorioTelefono = $(this).data("telefono");

    $("#txtEditIdLab").val(laboratorioId);
    $("#txtEditNameLab").val(laboratorioName);
    $("#txtEditDirecLab").val(laboratorioDireccion);
    $("#txtEditTelefLab").val(laboratorioTelefono);
    $("#selectEstadoLabs").val(laboratorioEstado);

    $("#txtTitleEditarLab").html(
        "<strong><i class='fas fa-fw fa-flask'></i> " +
            laboratorioName +
            "</strong>"
    );

    $("#mdEditLaboratorio").modal("show");
});

$(document).on("click", ".btn-delete-laboratorio", function () {
    var laboratorioId = $(this).data("id");
    var laboratorioName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el laboratorio: <strong>" +
            laboratorioName +
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
                _laboratorioId: laboratorioId,
            };

            deleteLaboratorio(data);
        }
    });
});
