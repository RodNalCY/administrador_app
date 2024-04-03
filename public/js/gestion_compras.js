var globalDominioBase = "";

$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    globalDominioBase = window.location.origin;
    console.log("globalDominioBase > ", globalDominioBase);

    listGestionCompras();
});

function listGestionCompras() {
    $.ajax({
        type: "GET",
        url: "/list/gestion/compras",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_gestion_compras = "";

            response.data.forEach(function (gc) {
                html_tabla_gestion_compras =
                    html_tabla_gestion_compras +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    gc.id +
                    "</th>" +
                    "<td>" +
                    gc.comp_name +
                    "</td>" +
                    "<td>" +
                    gc.Numero +
                    "</td>" +
                    "<td>" +
                    gc.empleado +
                    "</td>" +
                    "<td>" +
                    gc.proveedor_name +
                    "</td>" +
                    "<td>" +
                    gc.valor_total +
                    "</td>" +
                    "<td>" +
                    gc.texto_valor_total +
                    "</td>" +
                    "<td>" +
                    gc.fecha_compra_formateada +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-view-details'" +
                    " data-id='" +
                    gc.idCompra +
                    "'><i class='fas fa-eye'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListGestionCompras").html(html_tabla_gestion_compras);
            $("#tableGestionCompras").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: globalDominioBase + "/js/local/Spanish.json",
                },
            });
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$(document).on("click", ".btn-view-details", function () {
    var gcId = $(this).data("id");
    console.log(" > " + gcId);
    listGestionComprasDetalle(gcId);
    $("#mdViewDetailCompra").modal("show");
});

function listGestionComprasDetalle(id) {
    $.ajax({
        type: "GET",
        url: "/list/gestion/details/compras",
        data: {
            _token: _global_token_crf,
            _id: id,
        },
        dataType: "json",
        beforeSend: function () {
            $("#tableGestionDetalleCompras").DataTable().destroy();
        },
        success: function (response) {
            console.log("RDX> ", response);
            let status = response.status;
            if (status) {
                $("#txtComprobante").val(response.data_compra[0].comp_name);
                $("#txtNumero").val(response.data_compra[0].Numero);
                $("#txtEmpleado").val(response.data_compra[0].empleado);
                $("#txtProveedor").val(response.data_compra[0].proveedor_name);
                $("#txtValor").val(response.data_compra[0].texto_valor_total);
                $("#txtFecha").val(response.data_compra[0].fecha_compra_formateada);

                var html_tabla_detalle = "";
                var cantidad_suma = 0;
                response.data_detalle.forEach(function (dc) {
                    cantidad_suma += dc.Cantidad;
                    html_tabla_detalle =
                        html_tabla_detalle +
                        "<tr>" +
                        "<th class='text-center' scope='row'>" +
                        dc.idProducto +
                        "</th>" +
                        "<td>" +
                        dc.producto_name +
                        "</td>" +
                        "<td class='text-center'>" +
                        dc.Costo +
                        "</td>" +
                        "<td class='text-center'>" +
                        dc.Cantidad +
                        "</td>" +                    
                        "<td class='text-center' style='background: lightyellow;'>" +
                        dc.Importe +
                        "</td>" +
                        "</tr>";
                });             
                $("#txtCantidadTotal").text(cantidad_suma);
                $("#txtImporteTotal").text("S/ "+response.data_compra[0].valor_total);

                $("#tableListGestionDetalleCompras").html(html_tabla_detalle);
                $("#tableGestionDetalleCompras").DataTable({
                    order: [[0, "desc"]],
                    language: {
                        url: globalDominioBase + "/js/local/Spanish.json",
                    },
                });
            }
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}
