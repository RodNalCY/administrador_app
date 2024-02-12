$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListComprobantes").html(
        "<tr><td colspan='4' class='text-center'>No hay comprobantes disponibles.</td></tr>"
    );
    listaComprobantes();
});

$("#btnActualizarComprobante").click(function () {
    var comprobanteId = $("#txtEditIdComprobante").val().trim();
    var comprobanteState = $("#selectEstadoComprobante").val().trim()

    console.log("comprobanteId > " + comprobanteId + " comprobanteState > " + comprobanteState);
    Swal.fire({
        title: "Actualizar",
        text: "Desea actualizar el estado del comprobante!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {

            var data = {
                _token: _globa_token_crf,
                _comprobanteId: comprobanteId,
                _comprobanteState: comprobanteState,
            };

            editarComprobante(data);
        }
    });

});

function listaComprobantes() {
    $.ajax({
        type: "GET",
        url: "/list/comprobantes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
        },
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_comprobantes = "";
            var html_select_options = 
            "<select class='form-control' id='selectEstadoComprobante'>" + 
            "<option value='Activo'>Activo</option>"+ 
            "<option value='Inactivo'>Inactivo</option>"+
            "</select>";

            response.data.forEach(function (comprobante) {
                html_tabla_comprobantes =
                    html_tabla_comprobantes +
                    "<tr>" +
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
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-comprobante'" +
                    " data-id='" +
                    comprobante.idTipoComprobante +
                    "' data-state='" +
                    comprobante.Estado +
                    "' data-name='" +
                    comprobante.Descripcion +
                    "'><i class='fas fa-pen'></i></button>" +     
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-comprobante'" +
                    " data-id='" +
                    comprobante.idTipoComprobante +
                    "' data-name='" +
                    comprobante.Descripcion +
                    "'><i class='fas fa-trash'></i></button>" +              
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListComprobantes").html(html_tabla_comprobantes);
            $("#selectHTMLComprobante").html(html_select_options);
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

function editarComprobante(data) {
    $.ajax({
        type: "POST",
        url: "/edit/comprobante",
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
                    text: "El comprobante fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el comprobante !",
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

function deleteComprobante(data) {
    $.ajax({
        type: "POST",
        url: "/delete/comprobante",
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
                    text: "El comprobante fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo la comprobante !",
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

$(document).on("click", ".btn-edit-comprobante", function () {
    var comprobanteId = $(this).data("id");
    var comprobanteName = $(this).data("name");
    var comprobanteEstado = $(this).data("state");
    $("#txtTitleEditarComprobante").html(
        "<strong><i class='fas fa-fw fa-file'></i> " + comprobanteName + "</strong>"
    );

    $("#txtEditIdComprobante").val(comprobanteId);
    $("#txtEditNombreComprobante").val(comprobanteName);
    $("#selectEstadoComprobante").val(comprobanteEstado);

    console.log("comprobanteId > " + comprobanteId + " comprobanteName > " + comprobanteName+ " comprobanteEstado > " + comprobanteEstado);

    $("#mdEditComprobante").modal("show");
});



$(document).on("click", ".btn-delete-comprobante", function () {
    var dataId = $(this).data("id");
    var dataName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el comprobante : <strong>" +
            dataName +
            "</strong></p>",
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
                _dataId: dataId,
            };

            deleteComprobante(data);
        }
    });
});
