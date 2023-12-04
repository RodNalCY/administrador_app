var _globa_token_crf = "";
var global_ventas_lista = [];

var global_sumatoria_total = 0;
var global_valor_ventas = "";
var global_valor_descuento = "";
var global_valor_sub_total = "";
var global_valor_igv = "";
var global_valor_total = "";

$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    setInterval(fechaAndHora, 1000);
 
    listComprobantes();
    listClientes();
    listProductos();

    $("#tableListVentas").html("<tr><td colspan='7' class='text-center'>Por favor, ingrese las ventas</td></tr>");

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

$("#btnBuscarClientes").click(function () {
    $("#mdListClientes").modal("show");
});

$("#btnBuscarComprobante").click(function () {
    $("#mdListComprobante").modal("show");
});

$("#btnBuscarProducto").click(function () {
    $("#mdListProducto").modal("show");
});

function listClientes() {
    $.ajax({
        type: "GET",
        url: "/list/clientes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {
            // Antes de la solicitud, destruir la instancia DataTables existente (si existe)
            // $("#tableClientes").DataTable().destroy();
        },
        success: function (response) {
            console.log("RDX> ", response);

            // Construir el contenido de la tabla
            var html_tabla_clientes = "";
            response.data.forEach(function (cliente) {
                // console.log(cliente.Email);
                html_tabla_clientes +=
                    "<tr " +
                    "data-id='" +
                    cliente.idCliente +
                    "' data-name='" +
                    cliente.Nombres +
                    "' data-ruc='" +
                    cliente.Ruc +
                    "'>" +
                    "<th scope='row'>" +
                    cliente.idCliente +
                    "</th>" +
                    "<td>" +
                    cliente.Nombres +
                    "</td>" +
                    "<td>" +
                    cliente.Apellidos +
                    "</td>" +
                    "<td>" +
                    cliente.Dni +
                    "</td>" +
                    "<td>" +
                    cliente.Ruc +
                    "</td>" +
                    "<td>" +
                    cliente.Direccion +
                    "</td>" +
                    "<td><center><button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button></center></td>" +
                    "</trdata-id=>";
            });

            // Actualizar el contenido de la tabla
            $("#tbl_row_clientes").html(html_tabla_clientes);

            // Reinicializar DataTables
            $("#tableClientes").DataTable({
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
// Agregar evento de clic a las filas
$("#tableComprobantes tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtTipoComprobante").val(name);
    $("#txtNumComprobante").val("G000010");
    // Cerrar Modal
    $("#mdListComprobante").modal("hide");
});

$("#tableClientes tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var ruc = $(this).data("ruc");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name + " ruc > " + ruc);
    // Pintar en los inputs
    $("#txtCliente").val(name);
    $("#txtRUC").val(ruc);
    // Cerrar Modal
    $("#mdListClientes").modal("hide");
});

$("#tableProductos tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var stock = $(this).data("stock");
    var precio = $(this).data("precio");
    var concent = $(this).data("concent");
    // Ver los detalles en consola
    console.log(
        "id > " +
            id +
            " name > " +
            name +
            " stock > " +
            stock +
            " precio > " +
            precio +
            " concent > " +
            concent
    );
    // Pintar en los inputs
    $("#txtNombreProducto").val(name);
    $("#txtStock").val(stock);
    $("#txtPrecio").val(precio);
    $("#txtConcentracion").val(concent);

    $("#txtCantidad").val("");
    $("#txtTotal").val("");
    // Cerrar Modal
    $("#mdListProducto").modal("hide");
});

$("#txtCantidad").on("change", function () {
    var cantidad = $("#txtCantidad").val();
    var precio = $("#txtPrecio").val();

    var calcular = cantidad * precio;
    $("#txtTotal").val(calcular.toFixed(2));
});

$("#btnAgregarVenta").on("click", function () {
    var miLista = {};
    var id = global_ventas_lista.length + 1;
    var producto = $("#txtNombreProducto").val();
    var decripcion = "-";
    var categoria = "-";
    var cantidad = $("#txtCantidad").val();
    var precio = $("#txtPrecio").val();
    var total = $("#txtTotal").val();

    miLista["id"] = id;
    miLista["producto"] = producto;
    miLista["descripcion"] = decripcion;
    miLista["categoria"] = categoria;
    miLista["cantidad"] = cantidad;
    miLista["precio"] = precio;
    miLista["total"] = total;

    global_ventas_lista.push(miLista);
    global_sumatoria_total = global_sumatoria_total + parseFloat(total);
    listaVentas();
});

function listaVentas() {
    var html_tabla_ventas = "";
    global_ventas_lista.forEach(function (venta) {
        html_tabla_ventas =
            html_tabla_ventas +
            "<tr>" +
            "<td>" +
            venta.id +
            "</td>" +
            "<td>" +
            venta.producto +
            "</td>" +
            "<td>" +
            venta.descripcion +
            "</td>" +
            "<td>" +
            venta.categoria +
            "</td>" +
            "<td>" +
            venta.cantidad +
            "</td>" +
            "<td>" +
            venta.precio +
            "</td>" +
            "<td>" +
            venta.total +
            "</td>" +
            "</tr>";
    });
    $("#tableListVentas").html(html_tabla_ventas);
 
    setValores();
    clearForm();
}

function clearForm() {
    $("#txtNombreProducto").val("");
    $("#txtStock").val("");
    $("#txtPrecio").val("");
    $("#txtConcentracion").val("");
    $("#txtCantidad").val("");
    $("#txtTotal").val("");
}

function setValores() {
    console.log("global_sumatoria_total > ", global_sumatoria_total);
    var descuento = 0;
    var sub_total = global_sumatoria_total - global_sumatoria_total * 0.18;
    var igv = global_sumatoria_total * 0.18;
    var total = sub_total + igv;

    $("#txtValorVenta").val(global_sumatoria_total.toFixed(2));
    $("#txtValorDescuento").val(descuento);
    $("#txtValorSubtotal").val(sub_total.toFixed(2));
    $("#txtValorIGV").val(igv.toFixed(2));
    $("#txtTotalPagar").val(total.toFixed(2));
}
$("#btnRegistrarVenta").on("click", function () {
    Swal.fire({
        title: "Procesar Venta !",
        text: "Estas segur@ de finalizar la venta !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, vender",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Venta realizada",
                text: "La venta de realizo correctamente!",
                icon: "success",
                showConfirmButton: false,
                timer: 1500,
            });

            location.reload();
        }
    });
});
