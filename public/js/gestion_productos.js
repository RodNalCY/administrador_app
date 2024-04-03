var globalDominioBase = "";

$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    globalDominioBase = window.location.origin;
    console.log("globalDominioBase > ", globalDominioBase);
    $("#tableListGestionVentas").html(
        "<tr><td colspan='10' class='text-center'>No hay registros de ventas </td></tr>"
    );
    listUpdateProductos();
});

function listUpdateProductos() {
    $.ajax({
        type: "GET",
        url: "/list/gestion/productos",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_productos = "";

            response.data.forEach(function (pro) {
                html_tabla_productos =
                html_tabla_productos +
                "<tr>" +
                "<td scope='row' class='text-center'>" +
                pro.idProducto +
                "</td>" +
                "<th>" +
                pro.Descripcion +
                "</th>" +
                "<td>" +
                pro.laboratorio.Nombre +
                "</td>" +
                "<td>" +
                pro.presentacion.Descripcion +
                "</td>" +
                "<td class='text-center'>" +
                pro.Concentracion +
                "</td>" +                                         
                "<td class='text-center'> " +
                pro.fechita +
                "</td>" +
                
                "<td>" +
                "<center>" +
                " <button type='button' class='btn btn-warning btn-sm btn-edit-producto'" +
                " data-id='" +
                pro.idProducto +
                "' data-name='" +
                pro.Descripcion +
                "' data-idlaboratorio='" +
                pro.laboratorio.idLaboratorio +
                "' data-laboratorio='" +
                pro.laboratorio.Nombre +
                "' data-idpresentacion='" +
                pro.presentacion.idPresentacion +
                "' data-presentacion='" +
                pro.presentacion.Descripcion +
                "' data-concentracion='" +
                pro.Concentracion +
                "' data-stock='" +
                pro.Stock +
                "' data-costo='" +
                pro.Costo +
                "' data-venta='" +
                pro.Precio_Venta +
                "' data-sanitario='" +
                pro.RegistroSanitario +
                "' data-vencimiento='" +
                pro.FechaVencimiento +
                "' data-state='" +
                pro.Estado +
                "' data-fupdate='" +
                pro.fechita +
                "'><i class='fas fa-eye'></i></button>" +                
                "</center>" +
                "</td>" +
                "</tr>";
            });

            $("#tableListGestionProductos").html(html_tabla_productos);

            $("#tableGestionProductos").DataTable({
                order: [[5, "desc"]],
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

$(document).on("click", ".btn-edit-producto", function () {
    var prodId = $(this).data("id");
    var prodName = $(this).data("name");
    var prodNameLab = $(this).data("laboratorio");
    var prodNamePres = $(this).data("presentacion");
    var prodConcentracion = $(this).data("concentracion");
    var prodStock = $(this).data("stock");
    var prodCosto = $(this).data("costo");
    var prodVenta = $(this).data("venta");
    var prodSanitario = $(this).data("sanitario");
    var prodVencimiento = $(this).data("vencimiento");
    var prodEstado = $(this).data("state");
    var fecha_update = $(this).data("fupdate");

    $("#txtEditProdId").val(prodId);
    $("#txtEditProdName").val(prodName);
    $("#txtLaboratorio").val(prodNameLab);
    $("#txtPresentacion").val(prodNamePres);
    $("#txtEditProdConcentracion").val(prodConcentracion);
    $("#txtEditProdStock").val(prodStock);
    $("#txtEditProdCosto").val(prodCosto);
    $("#txtEditProdVenta").val(prodVenta);
    $("#txtEditProdRegistroSanitario").val(prodSanitario);
    $("#txtEditProdVencimiento").val(prodVencimiento);
    $("#txtEstadoProducto").val(prodEstado);
    $("#txtFechaActualizada").val(fecha_update);


    $("#mdViewDetailProducto").modal("show");
});
