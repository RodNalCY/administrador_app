$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListProductos").html(
        "<tr><td colspan='12' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listVentasResumenDetalle();
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
