var _globa_token_crf = "";

$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);

    setInterval(fechaAndHora, 1000);
    listProveedores();
    listComprobantes();
    listProductos();

    $("#tableListCompras").html(
        "<tr><td colspan='7' class='text-center'>Por favor, ingrese las compras</td></tr>"
    );
});

function fechaAndHora() {
    // Obtener la fecha y hora actual
    const fechaHoraActual = new Date();

    // Formatear la fecha y hora sin el indicador de la zona horaria
    const opciones = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
    };
    const fechaHoraFormateada = fechaHoraActual.toLocaleDateString(
        "es-ES",
        opciones
    );

    // Mostrar la fecha y hora en el elemento de span
    const spanFechaHora = document.getElementById("fechaHora");
    spanFechaHora.textContent = fechaHoraFormateada;
}

$("#btnBuscarProveedores").click(function () {
    $("#mdListProveedores").modal("show");
});

$("#btnBuscarComprobante").click(function () {
    $("#mdListComprobante").modal("show");
});

$("#btnBuscarProducto").click(function () {
    $("#mdListProducto").modal("show");
});

function listProveedores() {
    $.ajax({
        type: "GET",
        url: "/list/proveedores",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);

            // Construir el contenido de la tabla
            var html_tabla_clientes = "";
            response.data.forEach(function (proveedor) {
                // console.log(cliente.Email);
                html_tabla_clientes +=
                    "<tr " +
                    "data-id='" +
                    proveedor.IdProveedor +
                    "' data-name='" +
                    proveedor.Nombre +
                    "' data-dni='" +
                    proveedor.Ruc +
                    "'>" +
                    "<th scope='row'>" +
                    proveedor.IdProveedor +
                    "</th>" +
                    "<td>" +
                    proveedor.Nombre +
                    "</td>" +
                    "<td>" +
                    proveedor.Ruc +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    "<button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            // Actualizar el contenido de la tabla
            $("#tbl_row_proveedores").html(html_tabla_clientes);

            // Reinicializar DataTables
            $("#tableProveedores").DataTable({
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

function listComprobantes() {
    $.ajax({
        type: "GET",
        url: "/list/comprobantes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
            // $("#tableComprobantes").DataTable().destroy();
        },
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_comprobantes = "";

            response.data.forEach(function (comprobante) {
                html_tabla_comprobantes =
                    html_tabla_comprobantes +
                    "<tr data-id='" +
                    comprobante.idTipoComprobante +
                    "' data-name='" +
                    comprobante.Descripcion +
                    "'>" +
                    "<th scope='row'>" +
                    comprobante.idTipoComprobante +
                    "</th>" +
                    "<td>" +
                    comprobante.Descripcion +
                    "</td>" +
                    "<td>" +
                    comprobante.Estado +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_comprobantes").html(html_tabla_comprobantes);
            // Reinicializar DataTables
            $("#tableComprobantes").DataTable({
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
function listProductos() {
    $.ajax({
        type: "GET",
        url: "/list/productos",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            // Construir el contenido de la tabla
            var html_tabla_productos = "";

            response.data.forEach(function (producto) {
                html_tabla_productos =
                    html_tabla_productos +
                    "<tr " +
                    "data-id='" +
                    producto.idProducto +
                    "' data-name='" +
                    producto.Descripcion +
                    "' data-stock='" +
                    producto.Stock +
                    "' data-precio='" +
                    producto.Costo +
                    "' data-concent='" +
                    producto.Concentracion +
                    "' data-present='" +
                    producto.presentacion.Descripcion +
                    "'>" +
                    "<th scope='row'>" +
                    producto.idProducto +
                    "</th>" +
                    "<td>" +
                    producto.Descripcion +
                    "</td>" +
                    "<td>" +
                    producto.laboratorio.Nombre +
                    "</td>" +
                    "<td>" +
                    producto.presentacion.Descripcion +
                    "</td>" +
                    "<td>" +
                    producto.Concentracion +
                    "</td>" +
                    "<td>" +
                    producto.Stock +
                    "</td>" +
                    "<td>" +
                    producto.Costo +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_productos").html(html_tabla_productos);
            // Reinicializar DataTables
            $("#tableProductos").DataTable({
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
