var _global_token_crf = "";
var global_compras_productos_lista = [];
var global_compras_details_lista = [];
var global_index_ventas = 0;
var _global_id_employed = "";
var global_sumatoria_total = 0;

$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);

    setInterval(fechaAndHora, 1000);
    getIdEmpleado();
    getIdVoucherCompra();
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
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);

            // Construir el contenido de la tabla
            var html_tabla_proveedores = "";
            response.data.forEach(function (proveedor) {
                // console.log(cliente.Email);
                html_tabla_proveedores +=
                    "<tr " +
                    "data-id='" +
                    proveedor.IdProveedor +
                    "' data-name='" +
                    proveedor.Nombre +
                    "' data-ruc='" +
                    proveedor.Ruc +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
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
            $("#tbl_row_proveedores").html(html_tabla_proveedores);

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
        url: "/list/activo/comprobantes",
        data: {
            _token: _global_token_crf,
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

function listProductos() {
    $.ajax({
        type: "GET",
        url: "/list/activo/productos",
        data: {
            _token: _global_token_crf,
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
                    "' data-preciocosto='" +
                    producto.Costo +
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

function getIdEmpleado() {
    $.ajax({
        type: "GET",
        url: "/session/activo/empleado",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            _global_id_employed = response.data[0].idEmpleado;
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function getIdVoucherCompra() {
    $.ajax({
        type: "GET",
        url: "/number/ticket/compra",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#txtNumCompra").val(response.data);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function saveCompraProductos(data) {
    $.ajax({
        type: "POST",
        url: "/save/compra/productos",
        data: data,
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            if (status) {
                Swal.fire({
                    title: "Registrado !",
                    text: "La compra se realizo correctamente !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se pudo realizar la compra !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        },
        complete: function (response) {
            setTimeout(() => {
                location.reload();
            }, 3000);
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}
// Agregar evento de clic a las filas
$("#tableProveedores tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var ruc = $(this).data("ruc");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name + " ruc > " + ruc);
    // Pintar en los inputs
    $("#txtIdProveedor").val(id);
    $("#txtProveedor").val(name);
    $("#txtRUC").val(ruc);

    // Cerrar Modal
    $("#mdListProveedores").modal("hide");
});

$("#tableComprobantes tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtIdTipoComprobante").val(id);
    $("#txtTipoComprobante").val(name);
    // Cerrar Modal
    $("#mdListComprobante").modal("hide");
});

$("#tableProductos tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var stock = $(this).data("stock");
    var precio_costo = $(this).data("preciocosto");
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
            " precio_costo > " +
            precio_costo +
            " concent > " +
            concent
    );
    // Pintar en los inputs
    $("#txtIdProducto").val(id);
    $("#txtNombreProducto").val(name);
    $("#txtStock").val(stock);
    $("#txtCosto").val(precio_costo);
    $("#txtConcentracion").val(concent);
    $("#txtPresentacion").val(present);

    $("#txtCantidad").val("");
    $("#txtTotal").val("");
    // Cerrar Modal
    $("#mdListProducto").modal("hide");
});

$("#txtCantidad").on("change", function () {
    var cantidad = $("#txtCantidad").val();
    var costo = $("#txtCosto").val();

    var calcular = cantidad * costo;
    $("#txtTotal").val(calcular.toFixed(2));
});

$("#btnAgregarVenta").on("click", function () {
    var productoId = $("#txtIdProducto").val().trim();
    var producto = $("#txtNombreProducto").val().trim();
    var descripcion = $("#txtConcentracion").val().trim();
    var categoria = $("#txtPresentacion").val().trim();
    var cantidad = $("#txtCantidad").val().trim();
    var costo = $("#txtCosto").val().trim();
    var total = $("#txtTotal").val().trim();
    // Validar si los campos tienen texto
    if (
        productoId === "" ||
        producto === "" ||
        descripcion === "" ||
        categoria === "" ||
        cantidad === "" ||
        costo === "" ||
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
        miLista["productoId"] = productoId;
        miLista["producto"] = producto;
        miLista["descripcion"] = descripcion;
        miLista["categoria"] = categoria;
        miLista["cantidad"] = cantidad;
        miLista["costo"] = costo;
        miLista["total"] = total;

        global_compras_productos_lista.push(miLista);
        global_sumatoria_total = global_sumatoria_total + parseFloat(total);
        listaVentas();
        // console.log("miLista > ", miLista);
        // console.log("global_sumatoria_total > ", global_sumatoria_total);
    }
});

function listaVentas() {
    var html_tabla_ventas = "";
    global_compras_productos_lista.forEach(function (venta) {
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
            venta.costo +
            "</td>" +
            "<td>" +
            venta.total +
            "</td>" +
            "</tr>";
    });
    $("#tableListCompras").html(html_tabla_ventas);
    setValores();
    clearForm();
    console.log(
        "global_compras_productos_lista > ",
        global_compras_productos_lista
    );
}

function clearForm() {
    $("#txtIdProducto").val("");
    $("#txtNombreProducto").val("");
    $("#txtStock").val("");
    $("#txtCosto").val("");
    $("#txtPresentacion").val("");
    $("#txtConcentracion").val("");
    $("#txtCantidad").val("");
    $("#txtTotal").val("");
}

function setValores() {
    console.log("global_sumatoria_total > ", global_sumatoria_total);

    var sub_total = global_sumatoria_total - global_sumatoria_total * 0.18;
    var igv = global_sumatoria_total * 0.18;
    var total = sub_total + igv;

    $("#txtValorSubtotal").val(sub_total.toFixed(2));
    $("#txtValorIGV").val(igv.toFixed(2));
    $("#txtTotalPagar").val(total.toFixed(2));
}

// Agrega el evento de clic para la clase .delete-btn
$(document).on("click", ".delete-btn", function () {
    var compraId = $(this).data("id");
    // Encontrar el índice del objeto en la lista con el ID correspondiente
    var index = global_compras_productos_lista.findIndex(function (compra) {
        // console.log("costo > ", venta.total);
        if (compra.id === compraId) {
            global_sumatoria_total =
                global_sumatoria_total - parseFloat(compra.total);
        }
        return compra.id === compraId;
    });
    // Eliminar el objeto de la lista usando el índice
    if (index !== -1) {
        global_compras_productos_lista.splice(index, 1);
    }
    // Volver a renderizar la tabla con la lista actualizada
    listaVentas();
});

$("#btnRegistrarCompra").click(function () {
    console.log("btnRegistrarCompra()");

    global_compras_details_lista = [];

    var fechaActual = new Date();
    var fechaFormateada = fechaActual.toISOString().split("T")[0];

    var provedorId = $("#txtIdProveedor").val().trim();
    var comprobanteId = $("#txtIdTipoComprobante").val().trim();
    var ticket = $("#txtNumCompra").val().trim();
    var subtotal = $("#txtValorSubtotal").val().trim();
    var valorTotal = $("#txtTotalPagar").val().trim();
    var valorIGV = $("#txtValorIGV").val().trim();

    var camposVacios = [];
    // Verificar si algún campo está vacío
    if (comprobanteId === "") {
        camposVacios.push("Tipo de Comprobante");
    }
    if (provedorId === "") {
        camposVacios.push("Proveedor");
    }
    if (subtotal === "") {
        camposVacios.push("Subtotal");
    }
    if (valorIGV === "") {
        camposVacios.push("Valor IGV");
    }
    if (valorTotal === "") {
        camposVacios.push("Valor Total");
    }
    if (ticket === "") {
        camposVacios.push("Número de Comprobante");
    }
    if (camposVacios.length > 0) {
        var mensaje =
            "<span>Debe completar los siguientes campos: </span><br><strong>" +
            camposVacios.join(",  ") +
            "</strong>";
        Swal.fire({
            title: "Upps!",
            html: mensaje,
            icon: "warning",
            showConfirmButton: false,
            timer: 3000,
        });
    } else {
        Swal.fire({
            title: "Realizar Compra !",
            text: "Estas segur@ de realizar la campra !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, vender",
            cancelButtonText: "No, cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                var miListaDetails = {};
                miListaDetails["provedorId"] = provedorId;
                miListaDetails["empleadoId"] = _global_id_employed;
                miListaDetails["comprobanteId"] = comprobanteId;
                miListaDetails["comprobanteNumero"] = ticket;
                miListaDetails["fechaCompra"] = fechaFormateada;
                miListaDetails["subtotal"] = subtotal;
                miListaDetails["valorTotal"] = valorTotal;
                miListaDetails["valorIGV"] = valorIGV;
                miListaDetails["estado"] = "NORMAL";

                global_compras_details_lista.push(miListaDetails);

                console.log(
                    "global_compras_productos_lista > ",
                    global_compras_productos_lista
                );

                console.log(
                    "global_compras_details_lista > ",
                    global_compras_details_lista
                );

                var data = {
                    _token: _global_token_crf,
                    _compras_productos_lista: global_compras_productos_lista,
                    _compras_details_lista: global_compras_details_lista,
                };

                saveCompraProductos(data);
            }
        });
    }
});
