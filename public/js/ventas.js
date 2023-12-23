var _globa_token_crf = "";
var global_ventas_lista = [];
var global_index_ventas = 0;

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

    $("#tableListVentas").html(
        "<tr><td colspan='7' class='text-center'>Por favor, ingrese las ventas</td></tr>"
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
                    "' data-dni='" +
                    cliente.Dni +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
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
                    "</tr>";
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
                    "' data-precioventa='" +
                    producto.Precio_Venta +
                    "' data-concent='" +
                    producto.Concentracion +
                    "' data-present='" +
                    producto.presentacion.Descripcion +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
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
                    producto.Precio_Venta +
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
                    "<th class='text-center' scope='row'>" +
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
    var dni = $(this).data("dni");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name + " dni > " + dni);
    // Pintar en los inputs
    $("#txtCliente").val(name);
    $("#txtDNI").val(dni);
    // Cerrar Modal
    $("#mdListClientes").modal("hide");
});

$("#tableProductos tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var stock = $(this).data("stock");
    var precio_venta = $(this).data("precioventa");
    var concent = $(this).data("concent");
    var present = $(this).data("present");
    // Ver los detalles en consola
    console.log(
        "id > " +
            id +
            " name > " +
            name +
            " stock > " +
            stock +
            " precio_venta > " +
            precio_venta +
            " concent > " +
            concent
    );
    // Pintar en los inputs
    $("#txtNombreProducto").val(name);
    $("#txtStock").val(stock);
    $("#txtPrecio").val(precio_venta);
    $("#txtConcentracion").val(concent);
    $("#txtPresentacion").val(present);

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
    var producto = $("#txtNombreProducto").val().trim();
    var descripcion = $("#txtConcentracion").val().trim();
    var categoria = $("#txtPresentacion").val().trim();
    var cantidad = $("#txtCantidad").val().trim();
    var precio = $("#txtPrecio").val().trim();
    var total = $("#txtTotal").val().trim();
    // Validar si los campos tienen texto
    if (
        producto === "" ||
        descripcion === "" ||
        categoria === "" ||
        cantidad === "" ||
        precio === "" ||
        total === ""
    ) {
        // Al menos uno de los campos está vacío, realiza la lógica de manejo de errores
        Swal.fire({
            icon: "warning",
            title: "Advertencia!",
            text: "Por favor, complete todos los campos!",
            showConfirmButton: false,
            timer: 1500,
        });
    } else {
        // Todos los campos tienen texto, puedes continuar con la lógica principal
        var miLista = {};
        global_index_ventas = global_index_ventas + 1;

        miLista["id"] = global_index_ventas;
        miLista["producto"] = producto;
        miLista["descripcion"] = descripcion;
        miLista["categoria"] = categoria;
        miLista["cantidad"] = cantidad;
        miLista["precio"] = precio;
        miLista["total"] = total;

        global_ventas_lista.push(miLista);
        global_sumatoria_total = global_sumatoria_total + parseFloat(total);
        listaVentas();
    }
});

function listaVentas() {
    var html_tabla_ventas = "";
    global_ventas_lista.forEach(function (venta) {
        html_tabla_ventas =
            html_tabla_ventas +
            "<tr>" +
            "<td>" +
            "<button class='btn btn-danger btn-sm delete-btn' data-id='" +
            venta.id +
            "'><i class='fas fa-fw fa-trash'></i></button>" +
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
    console.log("global_ventas_lista > ", global_ventas_lista);
}
// Agrega el evento de clic para la clase .delete-btn
$(document).on("click", ".delete-btn", function () {
    var ventaId = $(this).data("id");
    // Encontrar el índice del objeto en la lista con el ID correspondiente
    var index = global_ventas_lista.findIndex(function (venta) {
        // console.log("costo > ", venta.total);
        if (venta.id === ventaId) {
            global_sumatoria_total =
                global_sumatoria_total - parseFloat(venta.total);
        }
        return venta.id === ventaId;
    });
    // Eliminar el objeto de la lista usando el índice
    if (index !== -1) {
        global_ventas_lista.splice(index, 1);
    }
    // Volver a renderizar la tabla con la lista actualizada
    listaVentas();
});

function clearForm() {
    $("#txtNombreProducto").val("");
    $("#txtStock").val("");
    $("#txtPrecio").val("");
    $("#txtPresentacion").val("");
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
