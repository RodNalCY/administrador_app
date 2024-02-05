$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListProductos").html(
        "<tr><td colspan='12' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listVentasResumenDetalle();
    listPresentacionesActivos();
    listLaboratoriosActivos();
});

$("#btnBuscarPresentacion").click(function () {
    $("#mdListPresentaciones").modal("show");
});

$("#btnBuscarLaboratorio").click(function () {
    $("#mdListLaboratorios").modal("show");
});

function listVentasResumenDetalle() {
    $.ajax({
        type: "GET",
        url: "/list/productos",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_productos = "";

            response.data.forEach(function (venta) {
                html_tabla_productos =
                    html_tabla_productos +
                    "<tr>" +
                    "<td class='text-center' scope='row'>" +
                    venta.idProducto +
                    "</td>" +
                    "<th>" +
                    venta.Descripcion +
                    "</th>" +
                    "<td>" +
                    venta.laboratorio.Nombre +
                    "</td>" +
                    "<td>" +
                    venta.presentacion.Descripcion +
                    "</td>" +
                    "<td>" +
                    venta.Concentracion +
                    "</td>" +
                    "<th>" +
                    venta.Stock +
                    "</th>" +
                    "<td> " +
                    venta.Costo +
                    "</td>" +
                    "<td> " +
                    venta.Precio_Venta +
                    "</td>" +
                    "<td> " +
                    venta.RegistroSanitario +
                    "</td>" +
                    "<td> " +
                    venta.FechaVencimiento +
                    "</td>" +
                    "<td> " +
                    venta.Estado +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-primary btn-sm'><i class='fas fa-eye'></i></button>" +
                    "      <button type='button' class='btn btn-warning btn-sm'><i class='fas fa-pen'></i></button>" +
                    "      <button type='button' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListProductos").html(html_tabla_productos);
            $("#tableProductos").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function listPresentacionesActivos() {
    $.ajax({
        type: "GET",
        url: "/list/activo/presentaciones",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_presentaciones_activos = "";

            response.data.forEach(function (presentacion) {
                html_tabla_presentaciones_activos =
                    html_tabla_presentaciones_activos +
                    "<tr data-id='" +
                    presentacion.idPresentacion +
                    "' data-name='" +
                    presentacion.Descripcion +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
                    presentacion.idPresentacion +
                    "</th>" +
                    "<td>" +
                    presentacion.Descripcion +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_presentaciones").html(html_tabla_presentaciones_activos);
            $("#tablePresentaciones").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function listLaboratoriosActivos() {
    $.ajax({
        type: "GET",
        url: "/list/activo/laboratorios",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            var html_tabla_laboratorios_activos = "";

            response.data.forEach(function (laboratorio) {
                html_tabla_laboratorios_activos =
                    html_tabla_laboratorios_activos +
                    "<tr data-id='" +
                    laboratorio.idLaboratorio  +
                    "' data-name='" +
                    laboratorio.Nombre +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
                    laboratorio.idLaboratorio  +
                    "</th>" +
                    "<td>" +
                    laboratorio.Nombre +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_laboratorios").html(html_tabla_laboratorios_activos);
            $("#tableLaboratorios").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$("#tablePresentaciones tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtProductoIdPresentacion").val(id);
    $("#txtProductoPresentacion").val(name);
    // Cerrar Modal
    $("#mdListPresentaciones").modal("hide");
});

$("#tableLaboratorios tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtProductoIdLaboratorio").val(id);
    $("#txtProductoLaboratorio").val(name);
    // Cerrar Modal
    $("#mdListLaboratorios").modal("hide");
});
