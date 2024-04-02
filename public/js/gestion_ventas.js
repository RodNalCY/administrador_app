var globalDominioBase = "";

$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    globalDominioBase = window.location.origin;
    console.log("globalDominioBase > ", globalDominioBase);
    $("#tableListGestionVentas").html(
        "<tr><td colspan='10' class='text-center'>No hay registros de ventas </td></tr>"
    );
    listGestionVentas();
});

function listGestionVentas() {
    $.ajax({
        type: "GET",
        url: "/list/gestion/ventas",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_gestion_ventas = "";

            response.data.forEach(function (gv) {
                html_tabla_gestion_ventas =
                    html_tabla_gestion_ventas +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    gv.id +
                    "</th>" +
                    "<td>" +
                    gv.Numero +
                    "</td>" +
                    "<td>" +
                    gv.comp_name +
                    "</td>" +
                    "<td>" +
                    gv.empleado +
                    "</td>" +
                    "<td>" +
                    gv.cliente +
                    "</td>" +
                    "<td>" +
                    gv.valor_total +
                    "</td>" +
                    "<td>" +
                    gv.texto_valor_total +
                    "</td>" +
                    "<td>"+
                    "<a href='#'>" +
                    "../"+gv.ruta_comprobante +
                    "</a>"+
                    "</td>" +
                    "<td>" +
                    gv.fecha_venta +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-view-pdf'" +
                    " data-id='" +
                    gv.id +
                    "' data-pdf='" +
                    gv.ruta_comprobante +
                    "'><i class='fas fa-eye'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListGestionVentas").html(html_tabla_gestion_ventas);
            $("#tableGestionVentas").DataTable({
                order: [[0, "desc"]],
                language: {
                    url: globalDominioBase+"/js/local/Spanish.json",
                },
            });
        },
        complete: function () {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$(document).on("click", ".btn-view-pdf", function () {
    var gvId = $(this).data("id");
    var gvPDF = $(this).data("pdf");
    console.log(" > " + gvId + " gvPDF >" + gvPDF);
    
    var urlPdf = gvPDF;
    // Obtener el dominio base de la página actual
    var dominioBase = window.location.origin;
    // Convertir la URL relativa a una URL absoluta
    var urlAbsoluta = new URL(urlPdf, dominioBase).href;
    // Establecer la URL absoluta como el atributo src del elemento
    $("#docVoucherPDF").attr("src", urlAbsoluta);
    $("#mdPDFVoucher").modal("show");
});
