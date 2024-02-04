$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListLaboratorios").html(
        "<tr><td colspan='6' class='text-center'>No hay laboratorios disponibles.</td></tr>"
    );
    listaLaboratorios();
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
            // var html_select_options =
            // "<select class='form-control' id='selectEstadoComprobante'>" +
            // "<option value='Activo'>Activo</option>"+
            // "<option value='Inactivo'>Inactivo</option>"+
            // "</select>";

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
            // $("#selectHTMLComprobante").html(html_select_options);
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

$(document).on("click", ".btn-edit-laboratorio", function () {
    var laboratorioId = $(this).data("id");
    var laboratorioName = $(this).data("name");
    var laboratorioEstado = $(this).data("state");
    var laboratorioDireccion = $(this).data("direccion");
    var laboratorioTelefono = $(this).data("telefono");

    console.log(
        "laboratorioId > " +
            laboratorioId +
            " laboratorioName > " +
            laboratorioName +
            " laboratorioEstado > " +
            laboratorioEstado +
            " laboratorioDireccion > " +
            laboratorioDireccion +
            " laboratorioTelefono > " +
            laboratorioTelefono
    );

    // $("#txtTitleEditarComprobante").html(
    //     "<strong><i class='fas fa-fw fa-file'></i> " + comprobanteName + "</strong>"
    // );

    // $("#txtEditIdComprobante").val(comprobanteId);
    // $("#txtEditNombreComprobante").val(comprobanteName);
    // $("#selectEstadoComprobante").val(comprobanteEstado);

    // console.log("comprobanteId > " + comprobanteId + " comprobanteName > " + comprobanteName+ " comprobanteEstado > " + comprobanteEstado);

    // $("#mdEditComprobante").modal("show");
});

$(document).on("click", ".btn-delete-laboratorio", function () {
    var laboratorioId = $(this).data("id");
    var laboratorioName = $(this).data("name");

    console.log(
        "laboratorioId > " +
            laboratorioId +
            " laboratorioName > " +
            laboratorioName
    );
});
