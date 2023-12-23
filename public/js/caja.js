$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableResumenDiario").html(
        "<tr><td colspan='6' class='text-center'>Por favor, consulte el resumen diario </td></tr>"
    );
});

$("#btnCalcularIngresos").click(function () {
    var fechita = $("#txtFechaDiario").val().trim();
    console.log("fechita > ", fechita);
    listVentasResumenDiario(fechita);
});

$("#btnVisualizarVentas").click(function () {
    $("#mdListResumen").modal("show");
});

$("#btnVentasDetalle").click(function () {
    var fecha_init = $("#txtFechaDesde").val().trim();
    var fecha_end = $("#txtFechaHasta").val().trim();

    // Validación de las fechas
    if (fecha_init === "" || fecha_end === "") {
        Swal.fire({
            icon: "warning",
            title: "Upps!",
            text: "Por favor, completa ambas fechas.",
            showConfirmButton: false,
            timer: 1500
          });
    } else {
        console.log("fecha_init > " + fecha_init + " fecha_end > " + fecha_end);
        listVentasResumenDetalle(fecha_init, fecha_end);
    }
});

function listVentasResumenDiario(fechita) {
    var local_ingreso_venta = 0;
    var local_cantidad_producto = 0;
    var local_ganancias = 0;
    var html_tabla_resumen_diario = "";

    $.ajax({
        type: "POST",
        url: "/list/resumen/diario",
        data: {
            _token: _globa_token_crf,
            fecha: fechita,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);

            response.data.forEach(function (venta) {
                local_ingreso_venta += parseFloat(venta.importe);
                local_cantidad_producto += parseInt(venta.cantidades);
                local_ganancias += parseFloat(venta.ganancias);

                html_tabla_resumen_diario =
                    html_tabla_resumen_diario +
                    "<tr>" +
                    "<th scope='row'>" +
                    venta.Descripcion +
                    "</th>" +
                    "<td>" +
                    venta.cantidades +
                    "</td>" +
                    "<td>" +
                    venta.Precio +
                    "</td>" +
                    "<th>" +
                    venta.importe +
                    "</th>" +
                    "<td>" +
                    venta.ganancias +
                    "</td>" +
                    "<td>" +
                    venta.Fecha +
                    "</td>" +
                    "</tr>";
            });

            $("#txtIngresoVenta").val(local_ingreso_venta.toFixed(2));
            $("#txtCantProducto").val(local_cantidad_producto.toFixed(2));
            $("#txtGanancia").val(local_ganancias.toFixed(2));
            $("#txtTotalCaja").val(local_ingreso_venta.toFixed(2));

            $("#tableResumenDiario").html(html_tabla_resumen_diario);
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function listVentasResumenDetalle(f_init, f_end) {
    $.ajax({
        type: "POST",
        url: "/list/resumen/detalle",
        data: {
            _token: _globa_token_crf,
            fecha_init: f_init,
            fecha_end: f_end,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_resumen_detallado = "";

            response.data.forEach(function (venta) {
                html_tabla_resumen_detallado =
                    html_tabla_resumen_detallado +
                    "<tr>" +
                    "<td scope='row'>" +
                    venta.idProducto +
                    "</td>" +
                    "<th>" +
                    venta.Descripcion +
                    "</th>" +
                    "<td>" +
                    venta.presentacion +
                    "</td>" +
                    "<td>" +
                    venta.Precio +
                    "</td>" +
                    "<td>" +
                    venta.cantidades +
                    "</td>" +
                    "<th>" +
                    venta.importe +
                    "</th>" +
                    "<td> " +
                    venta.ganancias +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_ventas_detalle").html(html_tabla_resumen_detallado);
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}
