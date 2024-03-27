$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    $("#tableResumenDiario").html(
        "<tr><td colspan='6' class='text-center'>Por favor, consulte el resumen diario </td></tr>"
    );
});

$("#btnCalcularIngresos").click(function () {
    var fechita = $("#txtFechaDiario").val().trim();
    console.log("fechita > ", fechita);
    if (fechita != "") {
        listVentasResumenDiario(fechita);
    } else {
        Swal.fire({
            icon: "warning",
            title: "Upps!",
            text: "Por favor, ingrese la fecha de consulta !.",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnVisualizarVentas").click(function () {
    $("#mdListResumen").modal("show");
});

$("#btnVentasDetalle").click(function () {
    var fecha_init = $("#txtFechaDesde").val().trim();
    var fecha_end = $("#txtFechaHasta").val().trim();

    // Validación de las fechas
    if (fecha_init != "" || fecha_end != "") {
        console.log("fecha_init > " + fecha_init + " fecha_end > " + fecha_end);
        listVentasResumenDetalle(fecha_init, fecha_end);
    } else {
        Swal.fire({
            icon: "warning",
            title: "Upps!",
            text: "Por favor, completa las fechas de Inicio - Fin a consultar.",
            showConfirmButton: false,
            timer: 1500,
        });
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
            _token: _global_token_crf,
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
                    "<td style='text-align:center;'>" +
                    venta.Precio +
                    "</td>" +
                    "<td style='text-align:center;'>" +
                    venta.cantidades +
                    "</td>" +
                    "<th style='text-align:center;'>" +
                    venta.importe +
                    "</th>" +
                    "<td style='text-align:center;'>" +
                    venta.ganancias +
                    "</td>" +
                    "<td style='text-align:center;'>" +
                    venta.fecha_venta +
                    "</td>" +
                    "</tr>";
            });

            html_tabla_resumen_diario +=
                "<tr class='text-center' style='background-color: lightyellow; color: black; font-weight: bold; border-top: solid; border-color: gold; font-size: x-large;'>" +
                "<td colspan='2'>TOTAL: </td>" +
                "<td>" +
                local_cantidad_producto +
                "</td>" +
                "<td>" +
                local_ingreso_venta.toFixed(2) +
                "</td>" +
                "<td>" +
                local_ganancias.toFixed(2) +
                "</td>" +
                "<td>&nbsp;</td>" +
                "</tr>";

            $("#txtIngresoVenta").val(local_ingreso_venta.toFixed(2));
            $("#txtCantProducto").val(local_cantidad_producto);
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
    var local_detalle_cantidad_producto = 0;
    var local_detalle_total = 0;
    var local_detalle_ganancias = 0;

    $.ajax({
        type: "POST",
        url: "/list/resumen/detalle",
        data: {
            _token: _global_token_crf,
            fecha_init: f_init,
            fecha_end: f_end,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_resumen_detallado = "";

            response.data.forEach(function (venta) {
                local_detalle_cantidad_producto += parseInt(venta.cantidades);
                local_detalle_total += parseFloat(venta.importe);
                local_detalle_ganancias += parseFloat(venta.ganancias);

                html_tabla_resumen_detallado =
                    html_tabla_resumen_detallado +
                    "<tr>" +
                    "<td scope='row' style='text-align:center;'>" +
                    venta.idProducto +
                    "</td>" +
                    "<th>" +
                    venta.Descripcion +
                    "</th>" +
                    "<td>" +
                    venta.presentacion +
                    "</td>" +
                    "<td style='text-align:center;'>" +
                    venta.Precio +
                    "</td>" +
                    "<td style='text-align:center;'>" +
                    venta.cantidades +
                    "</td>" +
                    "<th style='text-align:center;'>" +
                    venta.importe +
                    "</th>" +
                    "<td style='text-align:center;'> " +
                    venta.ganancias +
                    "</td>" +
                    "</tr>";
            });

            html_tabla_resumen_detallado +=
                "<tr class='text-center' style='background-color: lightyellow; color: black; font-weight: bold; border-top: solid; border-color: gold; font-size: x-large;'>" +
                "<td colspan='4'>TOTAL: </td>" +
                "<td>" +
                local_detalle_cantidad_producto +
                "</td>" +
                "<td>" +
                local_detalle_total.toFixed(2) +
                "</td>" +
                "<td>" +
                local_detalle_ganancias.toFixed(2) +
                "</td>" +
                "</tr>";

            $("#tbl_row_ventas_detalle").html(html_tabla_resumen_detallado);
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$("#btnExportarExcelResumenDiario").click(function () {
    var fechita = $("#txtFechaDiario").val().trim();
    var totalCantidad = $("#txtCantProducto").val().trim();
    console.log("fechita > ", fechita);

    if (fechita == "") {
        Swal.fire({
            icon: "warning",
            title: "Upps!",
            text: "Por favor, ingrese la fecha de consulta !.",
            showConfirmButton: false,
            timer: 2000,
        });
    } else if (totalCantidad == 0) {
        Swal.fire({
            icon: "warning",
            title: "Upps!",
            text: "No hay ventas registradas para exportar!.",
            showConfirmButton: false,
            timer: 2000,
        });
    } else {
        Swal.fire({
            title: "Exportar (.xlsx)",
            html: "<p>¿Desea exportar el resumen de ventas en un archivo Excel?</p>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, exportar!",
            cancelButtonText: "No, cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/exportar/excel/rdiario",
                    data: {
                        _token: _global_token_crf,
                        _fechita: fechita,
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
    }
});
