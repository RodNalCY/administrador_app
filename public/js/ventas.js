var _global_token_crf = "";
var _global_id_employed = "";

var global_ventas_productos_lista = [];
var global_ventas_details_lista = [];
var global_index_ventas = 0;

var global_sumatoria_total = 0;
var global_valor_ventas = "";
var global_valor_descuento = "";
var global_valor_sub_total = "";
var global_valor_igv = "";
var global_valor_total = "";
var globalListaDetails = {};
var global_url_voucher_pdf = "";
var global_dia_venta = "";

$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    setInterval(fechaAndHora, 1000);

    getIdEmpleado();
    getIdVoucher();

    listComprobantes();
    listClientes();
    listProductos();

    $("#tableListVentas").html(
        "<tr><td colspan='7' class='text-center'>Por favor, ingrese las ventas</td></tr>"
    );

    // Ejemplo de uso
    global_dia_venta = obtenerDiaSemana();
    console.log("Hoy es: " + global_dia_venta);
});

function obtenerDiaSemana() {
    // Crear una nueva instancia de Date
    const fechaActual = new Date();

    // Obtener el número del día de la semana (0 para Domingo, 1 para Lunes, ..., 6 para Sábado)
    const diaDeLaSemana = fechaActual.getDay();
    // Crear un array con los nombres de los días de la semana
    const diasSemana = [
        "Domingo",
        "Lunes",
        "Martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado",
    ];

    // Obtener el nombre del día de la semana utilizando el número obtenido anteriormente
    const nombreDia = diasSemana[diaDeLaSemana];

    // Retornar el nombre del día de la semana
    return nombreDia;
}

function fechaAndHora() {
    // Obtener la fecha y hora actual
    var fechaHoraActual = new Date();

    // Formatear la fecha y hora sin el indicador de la zona horaria
    var opciones = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
    };
    var fechaHoraFormateada = fechaHoraActual.toLocaleDateString(
        "es-ES",
        opciones
    );

    // Mostrar la fecha y hora en el elemento de span
    var spanFechaHora = document.getElementById("fechaHora");
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

$("#btnAgregarCliente").click(function () {
    $("#mdListClientes").modal("hide");
    $("#mdAgragarCliente").modal("show");
});

$("#btnFinalizarVenta").click(function () {
    location.reload();
});

$("#btnCerrarPDFWhatsapp").click(function () {
    location.reload();
});

$("#btnRegistrarCliente").click(function () {
    var cliDNI = $("#txtClienteDNI").val().trim();
    var cliNombres = $("#txtClienteNombres").val().trim().toUpperCase();
    var cliApellidos = $("#txtClienteApellidos").val().trim().toUpperCase();
    var cliSexo = $("#selectSexoCliente").val().trim().toUpperCase();
    var cliEmail = $("#txtClienteEmail").val().trim();
    var cliTelef = $("#txtClienteTelefono").val().trim();
    var cliDirec = $("#txtClienteDireccion").val().trim().toUpperCase();
    var cliRUC = $("#txtClienteRUC").val().trim();

    if (cliNombres != "" && cliApellidos != "" && cliDNI != "") {
        console.log(
            " cliDNI > " +
                cliDNI +
                "cliNombre > " +
                cliNombres +
                "cliApellidos > " +
                cliApellidos +
                " cliSexo > " +
                cliSexo +
                " cliEmail > " +
                cliEmail +
                " cliTelef > " +
                cliTelef +
                " cliDirec > " +
                cliDirec +
                " cliRUC > " +
                cliRUC
        );
        var data = {
            _token: _global_token_crf,
            _cliDNI: cliDNI,
            _cliNombre: cliNombres,
            _cliApellidos: cliApellidos,
            _cliSexo: cliSexo,
            _cliEmail: cliEmail,
            _cliTelef: cliTelef,
            _cliDirec: cliDirec,
            _cliRUC: cliRUC,
        };

        registrarCliente(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar los datos del cliente !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function listClientes() {
    $.ajax({
        type: "GET",
        url: "/list/activo/clientes",
        data: {
            _token: _global_token_crf,
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

            var html_select_sexo_options =
                "<select class='form-control' id='selectSexoCliente'>" +
                "<option value='M'>Masculino</option>" +
                "<option value='F'>Femenino</option>" +
                "</select>";

            response.data.forEach(function (cliente) {
                // console.log(cliente.Email);
                html_tabla_clientes +=
                    "<tr " +
                    "data-id='" +
                    cliente.idCliente +
                    "' data-name='" +
                    cliente.Nombres +
                    "' data-apellidos='" +
                    cliente.Apellidos +
                    "' data-dni='" +
                    cliente.Dni +
                    "' data-ruc='" +
                    cliente.Ruc +
                    "' data-telefono='" +
                    cliente.Telefono +
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
                    "<td class='text-center'>" +
                    cliente.Dni +
                    "</td>" +
                    "<td class='text-center'>" +
                    cliente.Ruc +
                    "</td>" +
                    "<td class='text-center'>" +
                    cliente.Sexo +
                    "</td>" +
                    "<td class='text-center'>" +
                    cliente.Telefono +
                    "</td>" +
                    "<td><center><button type='button' class='btn btn-info btn-sm'><i class='fas fa-check'></i></button></center></td>" +
                    "</tr>";
            });

            // Actualizar el contenido de la tabla
            $("#tbl_row_clientes").html(html_tabla_clientes);
            $("#selectHTMLSexo").html(html_select_sexo_options);
            // Reinicializar DataTables
            $("#tableClientes").DataTable({
                order: [[1, "desc"]],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
            });

            $("#btnBuscarListCliente").on("input", function () {
                var searchText = $(this).val().toLowerCase(); // Obtener el texto ingresado en minúsculas
                // Obtener instancia de DataTables de la tabla
                var table = $("#tableClientes").DataTable();
                // Realizar la búsqueda en la tabla utilizando el texto ingresado
                table.search(searchText).draw();
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
                if (producto.Stock == 0 || producto.Stock <= 0) {
                    html_tabla_productos =
                        html_tabla_productos +
                        "<tr style='background-color: #ff22221f;'>" +
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
                        "<td class='text-center'>" +
                        "<button type='button' class='btn btn-danger btn-sm btn-price-size'>"+  producto.Stock+"</button>"+
                        "</td>" +
                        "<td class='text-center' style='display:grid;'>" +
                        "<button type='button' class='btn btn-secondary btn-sm btn-price-size'>S/ "+  producto.Precio_Venta+"</button>"+
                        "</td>" +
                        "<td>" +
                        "   <center>" +
                        "      <button type='button' class='btn btn-danger btn-sm'><i class='fas fa-times'></i></button>" +
                        "    </center>" +
                        "</td>" +
                        "</tr>";
                } else if (producto.Stock <= 5) {
                    html_tabla_productos =
                        html_tabla_productos +
                        "<tr  style='background-color: #ffff6f47;'" +
                        " data-id='" +
                        producto.idProducto +
                        "' data-name='" +
                        producto.Descripcion +
                        "' data-stock='" +
                        producto.Stock +
                        "' data-precioventa='" +
                        producto.Precio_Venta +
                        "' data-costo='" +
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
                        "<td class='text-center'>" +
                        "<button type='button' class='btn btn-warning btn-sm btn-price-size'>"+  producto.Stock+"</button>"+
                        "</td>" +
                        "<td class='text-center' style='display:grid;'>" +
                        "<button type='button' class='btn btn-secondary btn-sm btn-price-size'>S/ "+  producto.Precio_Venta+"</button>"+
                        "</td>" +
                        "<td>" +
                        "   <center>" +
                        "      <button type='button' class='btn btn-warning btn-sm'><i class='fas fa-check'></i></button>" +
                        "    </center>" +
                        "</td>" +
                        "</tr>";
                } else {
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
                        "' data-costo='" +
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
                        "<td class='text-center'>" +
                        "<button type='button' class='btn btn-success btn-sm btn-price-size'>"+  producto.Stock+"</button>"+
                        "</td>" +
                        "<td class='text-center' style='display:grid;'>" +
                        "<button type='button' class='btn btn-secondary btn-sm btn-price-size'>S/ "+  producto.Precio_Venta+"</button>"+
                        "</td>" +
                        "<td>" +
                        "   <center>" +
                        "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                        "    </center>" +
                        "</td>" +
                        "</tr>";
                }
            });

            $("#tbl_row_productos").html(html_tabla_productos);

            // Reinicializar DataTables
            $("#tableProductos").DataTable({
                order: [[1, "asc"]],
                // lengthMenu: [ [15, 25, 50, -1], [15, 25, 50, "Todos"] ],
                // searching: false,
                search: "Buscar productos:",
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                    search: "Buscar productos:",
                },
            });

            $("#btnBuscarListProducto").on("input", function () {
                var searchText = $(this).val().toLowerCase(); // Obtener el texto ingresado en minúsculas
                // Obtener instancia de DataTables de la tabla
                var table = $("#tableProductos").DataTable();
                // Realizar la búsqueda en la tabla utilizando el texto ingresado
                table.search(searchText).draw();
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
                    "<td class='text-center'>" +
                    comprobante.Descripcion +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-info btn-sm'><i class='fas fa-check'></i></button>" +
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

function getIdVoucher() {
    $.ajax({
        type: "GET",
        url: "/number/ticket/venta",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#txtNumComprobante").val(response.data);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function saveVentaProductos(data) {
    console.log("saveVentaProductos() > ", data);
    $.ajax({
        type: "POST",
        url: "/save/venta/productos",
        data: data,
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("success()");
            var response_id_venta = 0;
            let status = response.status;

            if (status) {
                response_id_venta = response.data.IdVenta;
                globalListaDetails["ventaId"] = response_id_venta;

                generaVoucherPDF(data, response_id_venta);
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se pudo realizar la venta !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
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
    $("#txtIdTipoComprobante").val(id);
    $("#txtTipoComprobante").val(name);
    // Cerrar Modal
    $("#mdListComprobante").modal("hide");
});

$("#tableClientes tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var apellidos = $(this).data("apellidos");
    var dni = $(this).data("dni");
    var ruc = $(this).data("ruc");
    var tel = $(this).data("telefono") == "-" ? "" : $(this).data("telefono");
    // Ver los detalles en consola
    console.log(
        "id > " +
            id +
            " name > " +
            name +
            " " +
            apellidos +
            "  dni > " +
            dni +
            " ruc > " +
            ruc +
            " tel > " +
            tel
    );
    // Pintar en los inputs
    var cliente = name + " " + apellidos;
    $("#txtIdCliente").val(id);
    $("#txtCliente").val(cliente);
    $("#txtDNI").val(dni);
    $("#txtClienteRUC").val(ruc);
    $("#txtTelefonoCliente").val(tel);
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
    var costo = $(this).data("costo");

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
    $("#txtIdProducto").val(id);
    $("#txtNombreProducto").val(name);
    $("#txtStock").val(stock);
    $("#txtPrecio").val(precio_venta);
    $("#txtCosto").val(costo);
    $("#txtConcentracion").val(concent);
    $("#txtPresentacion").val(present);

    $("#txtCantidad").val("");
    $("#txtTotal").val("");
    // Cerrar Modal
    $("#mdListProducto").modal("hide");
});

$("#txtCantidad").on("change", function () {
    var cantidad = $("#txtCantidad").val().trim();
    var precio = $("#txtPrecio").val().trim();

    var calcular = cantidad * precio;
    $("#txtTotal").val(calcular.toFixed(2));

    console.log("cantidad > ", cantidad);
});

$("#btnAgregarVenta").on("click", function () {
    var productoId = $("#txtIdProducto").val().trim();
    var producto = $("#txtNombreProducto").val().trim();
    var descripcion = $("#txtConcentracion").val().trim();
    var categoria = $("#txtPresentacion").val().trim();
    var cantidad = $("#txtCantidad").val().trim();
    var precio = $("#txtPrecio").val().trim();
    var costo = $("#txtCosto").val().trim();
    var total = $("#txtTotal").val().trim();
    var stock = $("#txtStock").val().trim();

    // Validar si los campos tienen texto
    if (
        productoId === "" ||
        producto === "" ||
        descripcion === "" ||
        categoria === "" ||
        cantidad === "" ||
        precio === "" ||
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
        console.log("productoId:", productoId);
        console.log("producto:", producto);
        // console.log("descripcion:", descripcion);
        // console.log("categoria:", categoria);
        // console.log("cantidad:", cantidad);
        // console.log("precio:", precio);
        // console.log("costo:", costo);
        // console.log("total:", total);
        // Verificar si el producto ya está en la lista
        var encontrarProductoId = global_ventas_productos_lista.find(function (
            producto
        ) {
            return producto.productoId === productoId;
        });

        // Si el producto no está en la lista, agregarlo
        if (encontrarProductoId === undefined) {
            var iquals = parseInt(cantidad) > parseInt(stock) ? true : false;
            if (iquals) {
                Swal.fire({
                    icon: "warning",
                    title: "Stock Limitado!",
                    html:
                        "<p>El producto <strong>" +
                        producto +
                        "</strong> tiene un limite de : <strong>" +
                        stock +
                        " uds.</strong></p>",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else if (parseInt(cantidad) == 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Advertencia!",
                    html: "<p>Ingrese como mínimo: <strong> 1 unidad</strong> del producto.</p>",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                global_index_ventas++;

                var nuevoProducto = {
                    id: global_index_ventas,
                    productoId: productoId,
                    producto: producto,
                    descripcion: descripcion,
                    categoria: categoria,
                    cantidad: cantidad,
                    precio: precio,
                    costo: costo,
                    total: total,
                };

                global_ventas_productos_lista.push(nuevoProducto);
                global_sumatoria_total += parseFloat(total);
                listaVentas();
            }
        } else {
            Swal.fire({
                icon: "warning",
                title: "Advertencia!",
                html:
                    "<p>El producto: <strong>" +
                    producto +
                    "</strong>, ya fue añadido !</p>",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    }
});

function listaVentas() {
    var html_tabla_ventas = "";
    global_ventas_productos_lista.forEach(function (venta) {
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
    console.log(
        "global_ventas_productos_lista > ",
        global_ventas_productos_lista
    );
}
// Agrega el evento de clic para la clase .delete-btn
$(document).on("click", ".delete-btn", function () {
    var ventaId = $(this).data("id");
    // Encontrar el índice del objeto en la lista con el ID correspondiente
    var index = global_ventas_productos_lista.findIndex(function (venta) {
        // console.log("costo > ", venta.total);
        if (venta.id === ventaId) {
            global_sumatoria_total =
                global_sumatoria_total - parseFloat(venta.total);
        }
        return venta.id === ventaId;
    });
    // Eliminar el objeto de la lista usando el índice
    if (index !== -1) {
        global_ventas_productos_lista.splice(index, 1);
    }
    // Volver a renderizar la tabla con la lista actualizada
    listaVentas();
});

function clearForm() {
    $("#txtNombreProducto").val("");
    $("#txtStock").val("");
    $("#txtPrecio").val("");
    $("#txtCosto").val("");
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
    console.log("btnRegistrarVenta()");
    global_ventas_details_lista = [];
    var total_pagar_texto = "";

    var comprobanteId = $("#txtIdTipoComprobante").val().trim();
    var comprobanteName = $("#txtTipoComprobante").val().trim().toUpperCase();
    var clienteId = $("#txtIdCliente").val().trim();
    var clienteDNI = $("#txtDNI").val().trim();
    var clienteRUC = $("#txtClienteRUC").val().trim();
    var clienteName = $("#txtCliente").val().trim().toUpperCase();
    var valorVenta = $("#txtValorVenta").val().trim();
    var descuento = $("#txtValorDescuento").val().trim();
    var subtotal = $("#txtValorSubtotal").val().trim();
    var valorIGV = $("#txtValorIGV").val().trim();
    var valorTotal = $("#txtTotalPagar").val().trim();
    var ticket = $("#txtNumComprobante").val().trim();

    var camposVacios = [];
    // Verificar si algún campo está vacío
    if (comprobanteId === "") {
        camposVacios.push("Tipo de Comprobante");
    }
    if (clienteId === "") {
        camposVacios.push("Cliente");
    }
    if (valorVenta === "") {
        camposVacios.push("Valor de Venta");
    }
    if (descuento === "") {
        camposVacios.push("Descuento");
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
    if (global_ventas_productos_lista.length == 0) {
        camposVacios.push("No hay productos añadidos");
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
            title: "Realizar Venta !",
            text: "Estas segur@ de realizar la venta !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, vender",
            cancelButtonText: "No, cancelar",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                total_pagar_texto = convertirNumeroATexto(valorTotal);
                const fechaFormateada = obtenerFechaHoraFormateada(1);
                const fechaHoraFormateada = obtenerFechaHoraFormateada(2);

                globalListaDetails = {};
                globalListaDetails["clienteId"] = clienteId;
                globalListaDetails["clienteDNI"] = clienteDNI;
                globalListaDetails["clienteRUC"] = clienteRUC;
                globalListaDetails["clienteName"] = clienteName;
                globalListaDetails["empleadoId"] = _global_id_employed;
                globalListaDetails["comprobanteId"] = comprobanteId;
                globalListaDetails["comprobanteName"] = comprobanteName;
                globalListaDetails["comprobanteNumero"] = ticket;
                globalListaDetails["fechaVenta"] = fechaFormateada;
                globalListaDetails["ventaTotal"] = valorVenta;
                globalListaDetails["descuento"] = descuento;
                globalListaDetails["subtotal"] = subtotal;
                globalListaDetails["valorIGV"] = valorIGV;
                globalListaDetails["valorTotal"] = valorTotal;
                globalListaDetails["estado"] = "EMITIDO";

                global_ventas_details_lista.push(globalListaDetails);

                console.log(
                    "global_ventas_productos_lista  > ",
                    global_ventas_productos_lista
                );
                console.log(
                    "global_ventas_details_lista  > ",
                    global_ventas_details_lista
                );

                const total_productos = global_ventas_productos_lista.length;
                var data = {
                    _token: _global_token_crf,
                    _list_ventas_productos: global_ventas_productos_lista,
                    _list_details_productos: global_ventas_details_lista,
                    _time: fechaHoraFormateada,
                    _total_productos: total_productos,
                    _total_pagar_texto: total_pagar_texto,
                    _global_dia_venta: global_dia_venta,
                };

                saveVentaProductos(data);
            }
        });
    }
});

function obtenerFechaHoraFormateada(option) {
    const fechaHoraActual = new Date();

    // Obtener los componentes de la fecha y hora
    const dia = String(fechaHoraActual.getDate()).padStart(2, "0");
    const mes = String(fechaHoraActual.getMonth() + 1).padStart(2, "0"); // Sumar 1 porque enero es 0
    const anio = fechaHoraActual.getFullYear();
    const horas = String(fechaHoraActual.getHours()).padStart(2, "0");
    const minutos = String(fechaHoraActual.getMinutes()).padStart(2, "0");
    const segundos = String(fechaHoraActual.getSeconds()).padStart(2, "0");

    // Construir la cadena de fecha y hora
    var fechaHoraFormateada = "";
    switch (option) {
        case 1:
            fechaHoraFormateada = `${anio}-${mes}-${dia}`;
            break;
        case 2:
            fechaHoraFormateada = `${dia}/${mes}/${anio} ${horas}:${minutos}:${segundos}`;
            break;
    }

    return fechaHoraFormateada;
}

function generaVoucherPDF(data) {
    console.log("generaVoucherPDF()");
    var _numberComprobante = $("#txtTipoComprobante")
        .val()
        .trim()
        .toUpperCase();
    $.ajax({
        type: "POST",
        url: "/generar/pdf/voucher",
        data: data,
        dataType: "json",
        beforeSend: function (response) {
            let timerInterval;
            Swal.fire({
                title: "Generando: " + _numberComprobante + " DE VENTA",
                html: "Procesando en : <b></b> segundos.",
                timer: 20000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    let totalTime = 0;
                    timerInterval = setInterval(() => {
                        totalTime += 1;
                        timer.textContent = `${totalTime}`;
                    }, 1000);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log("I was closed by the timer");
                }
            });
        },
        success: function (response) {
            console.log("pdf > ", response);
            global_url_voucher_pdf = "";

            if (response.status) {
                var urlPdf = response.ruta_pdf;
                // Obtener el dominio base de la página actual
                var dominioBase = window.location.origin;
                // Convertir la URL relativa a una URL absoluta
                var urlAbsoluta = new URL(urlPdf, dominioBase).href;
                // Establecer la URL absoluta como el atributo src del elemento
                global_url_voucher_pdf = urlAbsoluta;

                $("#docVoucherPDF").attr("src", urlAbsoluta);
                $("#mdPDFVoucher").modal("show");
                Swal.close();
            } else {
                Swal.fire({
                    title: "Upps!",
                    html: "<strong>Error del servidor al generar el voucher !</strong>",
                    icon: "warning",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Swal.close();
            }
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function convertirNumeroATexto(numero) {
    var unidades = [
        "CERO",
        "UNO",
        "DOS",
        "TRES",
        "CUATRO",
        "CINCO",
        "SEIS",
        "SIETE",
        "OCHO",
        "NUEVE",
    ];
    var decenas = [
        "DIEZ",
        "ONCE",
        "DOCE",
        "TRECE",
        "CATORCE",
        "QUINCE",
        "DIECISÉIS",
        "DIECISIETE",
        "DIECIOCHO",
        "DIECINUEVE",
    ];
    var decenasX = [
        "VEINTE",
        "TREINTA",
        "CUARENTA",
        "CINCUENTA",
        "SESENTA",
        "SETENTA",
        "OCHENTA",
        "NOVENTA",
    ];
    var centenas = [
        "CIENTO",
        "DOSCIENTOS",
        "TRESCIENTOS",
        "CUATROCIENTOS",
        "QUINIENTOS",
        "SEISCIENTOS",
        "SETECIENTOS",
        "OCHOCIENTOS",
        "NOVECIENTOS",
    ];
    var miles = ["MIL", "MILLÓN", "MILLONES"];

    function convertirNumeroMenorCien(numero) {
        if (numero < 10) return unidades[numero];
        else if (numero < 20) return decenas[numero - 10];
        else {
            var decena = Math.floor(numero / 10);
            var unidad = numero % 10;
            return (
                decenasX[decena - 2] +
                (unidad > 0 ? " Y " + unidades[unidad] : "")
            );
        }
    }

    function convertirNumero(numero) {
        if (numero === 0) return "";
        if (numero < 10) return unidades[numero];
        if (numero < 100) return convertirNumeroMenorCien(numero);

        var resultado = "";
        if (numero >= 100) {
            var centena = Math.floor(numero / 100);
            numero %= 100;
            if (centena === 1 && numero === 0) resultado = "CIEN";
            else resultado = centenas[centena - 1];
        }

        if (numero > 0) {
            if (resultado !== "") resultado += " ";
            resultado += convertirNumeroMenorCien(numero);
        }

        return resultado;
    }

    function convertirNumeroEntero(numero) {
        if (numero === 0) return "CERO";

        var resultado = "";
        var contador = 0;

        while (numero > 0) {
            var fragmento = numero % 1000;
            if (fragmento > 0) {
                var textoFragmento = convertirNumero(fragmento);
                resultado =
                    textoFragmento +
                    (contador > 0 ? " " + miles[contador - 1] : "") +
                    (resultado ? " " + resultado : "");
            }
            numero = Math.floor(numero / 1000);
            contador++;
        }

        return resultado;
    }

    function convertirDecimales(numero) {
        var centavo = Math.round(numero * 100);
        if (centavo === 0) return "";
        return centavo + "/100";
    }

    var parteEntera = Math.floor(numero);
    var parteDecimal = numero - parteEntera;

    var textoEntero = convertirNumeroEntero(parteEntera);
    var textoDecimal = convertirDecimales(parteDecimal);

    var resultado = textoEntero + (textoDecimal ? " CON " + textoDecimal : "");
    return resultado.toUpperCase();
}

function registrarCliente(data) {
    $.ajax({
        type: "POST",
        url: "/save/cliente",
        data: data,
        dataType: "json",
        beforeSend: function () {
            $("#tableClientes").DataTable().destroy();
        },
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Registrado!",
                    text: "El cliente fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro el cliente !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                listClientes();
                $("#mdListClientes").modal("show");
                $("#mdAgragarCliente").modal("hide");
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Upps!",
                text: "Algo paso, no se registro el cliente !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

$("#btnAbrirMdWhatsapp").click(function () {
    $("#mdPDFVoucher").modal("hide");
    $("#mdEnviarWhatsapp").modal("show");
});

$("#btnEnviarPDFWhatsapp").click(function () {
    var numeroTel = $("#txtTelefonoCliente").val();
    var mensaje =
        "Holi :) ! Gracias por tu visita a DALIFHAR y vuelva pronto, descargue su comprobante desde este enlace : \n\n" +
        global_url_voucher_pdf;
    console.log("global_url_voucher_pdf > ", global_url_voucher_pdf);
    console.log("numeroTel > ", numeroTel);

    var numeroCodificado = encodeURIComponent(numeroTel);
    var mensajeCodificado = encodeURIComponent(mensaje);
    // Insertar un salto de línea después de los dos puntos en el mensaje
    mensajeCodificado = mensajeCodificado.replace(/:/g, ":\n");

    // Construir la URL del esquema de WhatsApp
    var url =
        "https://wa.me/51" + numeroCodificado + "?text=" + mensajeCodificado;

    // Abrir la URL en una nueva pestaña o ventana
    window.open(url, "_blank");
});

$("#btnGetAPIDNI").click(function () {
    var setDNI = $("#txtClienteDNI").val().trim();
    if (setDNI != "") {
        var data = {
            _token: _global_token_crf,
            _DNI: setDNI,
        };

        getDataAPIReniecDNI(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Por favor, Ingrese el número de DNI !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function getDataAPIReniecDNI(data) {
    $.ajax({
        type: "POST",
        url: "/reniec/dni/api",
        data: data,
        dataType: "json",
        beforeSend: function () {
            $(document).ready(function () {
                // Ocultar el div con clase "row"
                $("#loading").css("display", "block");
            });
        },
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            if (status) {
                $("#txtClienteNombres").val(response.data.nombres);
                $("#txtClienteApellidos").val(
                    response.data.apellidoPaterno +
                        " " +
                        response.data.apellidoMaterno
                );
            } else {
                Swal.fire({
                    title: "Upps !",
                    text: "Algo paso, no se registro el cliente, ingrese manualmente !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            $(document).ready(function () {
                // Ocultar el div con clase "row"
                $("#loading").css("display", "none");
            });
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Upps !",
                text: "Algo paso, no se registro el cliente !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

$("#btnTestingHora").click(function () {
    console.log("btnTestingHora");

    const fecha1 = obtenerFechaHoraFormateada(1);
    const fecha2 = obtenerFechaHoraFormateada(2);

    console.log("fecha1 > ", fecha1);
    console.log("fecha2 > ", fecha2);
    console.log("obtenerDiaSemana() > ", obtenerDiaSemana());
    // console.log("fechaAndHora() > ",fechaAndHora());
});
