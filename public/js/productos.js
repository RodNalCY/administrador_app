$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListProductos").html(
        "<tr><td colspan='12' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listVentasResumenDetalle();
    listPresentacionesActivos();
    listLaboratoriosActivos();
});

$("#btnBuscarPresentacion").click(function () {
    $("#mdListPresentaciones").modal("show");
});

$("#btnBuscarLaboratorio").click(function () {
    $("#mdListLaboratorios").modal("show");
});
$("#btnRegistrarProducto").click(function () {
    var prodNombre = $("#txtProductoNombre").val().trim().toUpperCase();
    var prodConcentacion = $("#txtProductoConcentracion").val().trim();
    var prodStock = $("#txtProductoStock").val().trim();
    var prodCosto = $("#txtProductoCosto").val().trim();
    var prodPrecio = $("#txtProductoPrecio").val().trim();
    var prodIdPresentacion = $("#txtProductoIdPresentacion").val().trim();
    var prodIdLaboratorio = $("#txtProductoIdLaboratorio").val().trim();
    var prodRegistroSanitario = $("#txtProductoRegistroSanitario").val().trim().toUpperCase();
    var prodVencimiento = $("#txtProductoVencimiento").val().trim();

    console.log(
        "Nombre:",
        prodNombre,
        "Concentración:",
        prodConcentacion,
        "Stock:",
        prodStock,
        "Costo:",
        prodCosto,
        "Precio:",
        prodPrecio,
        "prodIdPresentacion:",
        prodIdPresentacion,
        "prodIdLaboratorio:",
        prodIdLaboratorio,
        "Registro Sanitario:",
        prodRegistroSanitario,
        "Vencimiento:",
        prodVencimiento
    );

    if (
        prodNombre != "" &&
        prodStock != "" &&
        prodCosto != "" &&
        prodPrecio != ""
    ) {
        var data = {
            _token: _globa_token_crf,
            _prodNombre: prodNombre,
            _prodConcentacion: prodConcentacion,
            _prodStock: prodStock,
            _prodCosto: prodCosto,
            _prodPrecio: prodPrecio,
            _prodIdPresentacion: prodIdPresentacion,
            _prodIdLaboratorio: prodIdLaboratorio,
            _prodRegistroSanitario: prodRegistroSanitario,
            _prodVencimiento: prodVencimiento,
        };

        registrarProducto(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar los datos del producto !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnActualizarProducto").click(function () {
    var prodId = $("#txtEditProdId").val().trim();
    var prodNombre = $("#txtEditProdName").val().trim().toUpperCase();
    var prodConcentacion = $("#txtEditProdConcentracion").val().trim();
    var prodStock = $("#txtEditProdStock").val().trim();
    var prodCosto = $("#txtEditProdCosto").val().trim();
    var prodPrecio = $("#txtEditProdVenta").val().trim();
    var prodIdPresentacion = $("#selectEditPresentacion").val().trim();
    var prodIdLaboratorio = $("#selectEditLaboratorio").val().trim();
    var prodRegistroSanitario = $("#txtEditProdRegistroSanitario").val().trim().toUpperCase();
    var prodVencimiento = $("#txtEditProdVencimiento").val().trim();
    var prodEstado = $("#selectEditEstadoProducto").val().trim();

    console.log(
        "prodId:",
        prodId,
        "Nombre:",
        prodNombre,
        "Concentración:",
        prodConcentacion,
        "Stock:",
        prodStock,
        "Costo:",
        prodCosto,
        "Precio:",
        prodPrecio,
        "prodIdPresentacion:",
        prodIdPresentacion,
        "prodIdLaboratorio:",
        prodIdLaboratorio,
        "Registro Sanitario:",
        prodRegistroSanitario,
        "Vencimiento:",
        prodVencimiento,
        "prodEstado:",
        prodEstado
    );

    if (
        prodNombre != "" &&
        prodStock != "" &&
        prodCosto != "" &&
        prodPrecio != ""
    ) {
        var data = {
            _token: _globa_token_crf,
            _prodId: prodId,
            _prodNombre: prodNombre,
            _prodConcentacion: prodConcentacion,
            _prodStock: prodStock,
            _prodCosto: prodCosto,
            _prodPrecio: prodPrecio,
            _prodIdPresentacion: prodIdPresentacion,
            _prodIdLaboratorio: prodIdLaboratorio,
            _prodRegistroSanitario: prodRegistroSanitario,
            _prodVencimiento: prodVencimiento,
            _prodEstado: prodEstado,
        };

        editarProducto(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar los datos del producto !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function listVentasResumenDetalle() {
    $.ajax({
        type: "GET",
        url: "/list/productos",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_productos = "";

            var html_select_edit_options =
                "<select class='form-control' id='selectEditEstadoProducto'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (venta) {
                html_tabla_productos =
                    html_tabla_productos +
                    "<tr>" +
                    "<td class='text-center' scope='row'>" +
                    venta.idProducto +
                    "</td>" +
                    "<th>" +
                    venta.Descripcion +
                    "</th>" +
                    "<td>" +
                    venta.laboratorio.Nombre +
                    "</td>" +
                    "<td>" +
                    venta.presentacion.Descripcion +
                    "</td>" +
                    "<td>" +
                    venta.Concentracion +
                    "</td>" +
                    "<th>" +
                    venta.Stock +
                    "</th>" +
                    "<td> " +
                    venta.Costo +
                    "</td>" +
                    "<td> " +
                    venta.Precio_Venta +
                    "</td>" +
                    "<td> " +
                    venta.RegistroSanitario +
                    "</td>" +
                    "<td> " +
                    venta.FechaVencimiento +
                    "</td>" +
                    "<td> " +
                    venta.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-producto'" +
                    " data-id='" +
                    venta.idProducto +
                    "' data-name='" +
                    venta.Descripcion +
                    "' data-idlaboratorio='" +
                    venta.laboratorio.idLaboratorio +
                    "' data-laboratorio='" +
                    venta.laboratorio.Nombre +
                    "' data-idpresentacion='" +
                    venta.presentacion.idPresentacion +
                    "' data-presentacion='" +
                    venta.presentacion.Descripcion +
                    "' data-concentracion='" +
                    venta.Concentracion +
                    "' data-stock='" +
                    venta.Stock +
                    "' data-costo='" +
                    venta.Costo +
                    "' data-venta='" +
                    venta.Precio_Venta +
                    "' data-sanitario='" +
                    venta.RegistroSanitario +
                    "' data-vencimiento='" +
                    venta.FechaVencimiento +
                    "' data-state='" +
                    venta.Estado +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-producto'" +
                    " data-id='" +
                    venta.idProducto +
                    "' data-name='" +
                    venta.Descripcion +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListProductos").html(html_tabla_productos);
            $("#selectEditHTMLEstado").html(html_select_edit_options);

            $("#tableProductos").DataTable({
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

function listPresentacionesActivos() {
    $.ajax({
        type: "GET",
        url: "/list/activo/presentaciones",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_presentaciones_activos = "";
            var html_select_presentacion_options = "<select class='form-control' id='selectEditPresentacion'>";

            response.data.forEach(function (presentacion) {
                html_tabla_presentaciones_activos =
                    html_tabla_presentaciones_activos +
                    "<tr data-id='" +
                    presentacion.idPresentacion +
                    "' data-name='" +
                    presentacion.Descripcion +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
                    presentacion.idPresentacion +
                    "</th>" +
                    "<td>" +
                    presentacion.Descripcion +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
                
                html_select_presentacion_options = html_select_presentacion_options +
                    "<option value='"+presentacion.idPresentacion+"'>"+presentacion.Descripcion+"</option>";
            });

            html_select_presentacion_options = html_select_presentacion_options + "</select>";
            $("#selectEditHTMLPresentaciones").html(html_select_presentacion_options);

            $("#tbl_row_presentaciones").html(html_tabla_presentaciones_activos);
            $("#tablePresentaciones").DataTable({
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

function listLaboratoriosActivos() {
    $.ajax({
        type: "GET",
        url: "/list/activo/laboratorios",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            var html_tabla_laboratorios_activos = "";
            var html_select_laboratorio_options = "<select class='form-control' id='selectEditLaboratorio'>";

            response.data.forEach(function (laboratorio) {                
                html_tabla_laboratorios_activos =
                    html_tabla_laboratorios_activos +
                    "<tr data-id='" +
                    laboratorio.idLaboratorio +
                    "' data-name='" +
                    laboratorio.Nombre +
                    "'>" +
                    "<th class='text-center' scope='row'>" +
                    laboratorio.idLaboratorio +
                    "</th>" +
                    "<td>" +
                    laboratorio.Nombre +
                    "</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-success btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";

                    html_select_laboratorio_options = html_select_laboratorio_options +
                    "<option value='"+laboratorio.idLaboratorio+"'>"+laboratorio.Nombre+"</option>";

            });
            html_select_laboratorio_options = html_select_laboratorio_options + "</select>";
            $("#selectEditHTMLLaboratorio").html(html_select_laboratorio_options);
            
            $("#tbl_row_laboratorios").html(html_tabla_laboratorios_activos);
            $("#tableLaboratorios").DataTable({
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

function registrarProducto(data) {
    $.ajax({
        type: "POST",
        url: "/save/producto",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Registrado!",
                    text: "El producto fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro el producto !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Upps!",
                text: "Algo paso, no se registro el producto !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function editarProducto(data) {
    $.ajax({
        type: "POST",
        url: "/edit/producto",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Actualizado!",
                    text: "El producto fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el producto !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
            Swal.fire({
                title: "Error!",
                text: "Algo paso, no se actualizo el producto !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function deleteProducto(data) {
    $.ajax({
        type: "POST",
        url: "/delete/producto",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            console.log("status > ", status);
            if (status) {
                Swal.fire({
                    title: "Desactivado!",
                    text: "El producto fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el producto !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$("#tablePresentaciones tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtProductoIdPresentacion").val(id);
    $("#txtProductoPresentacion").val(name);
    // Cerrar Modal
    $("#mdListPresentaciones").modal("hide");
});

$("#tableLaboratorios tbody").on("click", "tr", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    // Ver los detalles en consola
    console.log("id > " + id + " name > " + name);
    // Pintar en los inputs
    $("#txtProductoIdLaboratorio").val(id);
    $("#txtProductoLaboratorio").val(name);
    // Cerrar Modal
    $("#mdListLaboratorios").modal("hide");
});

$(document).on("click", ".btn-edit-producto", function () {
    var prodId = $(this).data("id");
    var prodName = $(this).data("name");
    var prodIdLab = $(this).data("idlaboratorio");
    var prodNameLab = $(this).data("laboratorio");
    var prodIdPres = $(this).data("idpresentacion");
    var prodNamePres = $(this).data("presentacion");
    var prodConcentracion = $(this).data("concentracion");
    var prodStock = $(this).data("stock");
    var prodCosto = $(this).data("costo");
    var prodVenta = $(this).data("venta");
    var prodSanitario = $(this).data("sanitario");
    var prodVencimiento = $(this).data("vencimiento");
    var prodEstado = $(this).data("state");

    $("#txtEditProdId").val(prodId);
    $("#txtEditProdName").val(prodName);
    $("#selectEditLaboratorio").val(prodIdLab);
    // $("#txtEditProdLaboratorio").val(prodNameLab);
    $("#selectEditPresentacion").val(prodIdPres);
    // $("#txtEditProdPresentacion").val(prodNamePres);
    $("#txtEditProdConcentracion").val(prodConcentracion);
    $("#txtEditProdStock").val(prodStock);
    $("#txtEditProdCosto").val(prodCosto);
    $("#txtEditProdVenta").val(prodVenta);
    $("#txtEditProdRegistroSanitario").val(prodSanitario);
    $("#txtEditProdVencimiento").val(prodVencimiento);
    $("#selectEditEstadoProducto").val(prodEstado);

    $("#txtDescripcionStock").html(prodStock);
    $("#txtDescripcionCosto").html(prodCosto);
    $("#txtDescripcionPrecio").html(prodVenta);

    $("#txtTitleEditarProducto").html(
        "<strong><i class='fas fa-fw fa-box-open '></i> " + prodName + "</strong>"
    );

    $("#mdEditProducto").modal("show");
});

$(document).on("click", ".btn-delete-producto", function () {
    var productoId = $(this).data("id");
    var productoName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el producto: <strong>" +
            productoName +
            " !</strong></p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, desactivar!",
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            var data = {
                _token: _globa_token_crf,
                _productoId: productoId,
            };

            deleteProducto(data);
        }
    });
});
