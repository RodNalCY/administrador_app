$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListClientes").html(
        "<tr><td colspan='11' class='text-center'>No hay empleados disponibles.</td></tr>"
    );

    listaClientes();
});

$("#btnRegistrarCliente").click(function () {
    var cliDNI = $("#txtClienteDNI").val();
    var cliNombres = $("#txtClienteNombres").val();
    var cliApellidos = $("#txtClienteApellidos").val();
    var cliSexo = $("#selectSexoCliente").val();
    var cliEmail = $("#txtClienteEmail").val();
    var cliTelef = $("#txtClienteTelefono").val();
    var cliDirec = $("#txtClienteDireccion").val();
    var cliRUC = $("#txtClienteRUC").val();

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
            _token: _globa_token_crf,
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

$("#btnActualizarCliente").click(function () {
    var cliId = $("#txtEditCliId").val();
    var cliDNI = $("#txtEditCliDNI").val();
    var cliNombre = $("#txtEditCliName").val();
    var cliApellidos = $("#txtEditCliApellidos").val();
    var cliEmail = $("#txtEditCliEmail").val();
    var cliTelef = $("#txtEditCliTelef").val();
    var cliSexo = $("#selectEditSexoCliente").val();
    var cliDirec = $("#txtEditCliDireccion").val();
    var cliRUC = $("#txtEditCliRUC").val();
    var cliEstado = $("#selectEditEstadoCliente").val();

    if (cliNombre != "" && cliApellidos != "" && cliDNI != "") {
        console.log(
            "cliId > " +
                cliId +
                "cliDNI > " +
                cliDNI +
                "cliNombre > " +
                cliNombre +
                " cliApellidos > " +
                cliApellidos +
                " cliEmail > " +
                cliEmail +
                " cliTelef > " +
                cliTelef +
                " cliSexo > " +
                cliSexo +
                " cliDirec > " +
                cliDirec +
                " cliRUC > " +
                cliRUC +
                " cliEstado > " +
                cliEstado
        );

        var data = {
            _token: _globa_token_crf,
            _cliId: cliId,
            _cliDNI: cliDNI,
            _cliNombre: cliNombre,
            _cliApellidos: cliApellidos,         
            _cliEmail: cliEmail,
            _cliTelef: cliTelef,
            _cliSexo: cliSexo,
            _cliDirec: cliDirec,
            _cliRUC: cliRUC,
            _cliEstado: cliEstado,
        };

        editarCliente(data);
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

function listaClientes() {
    $.ajax({
        type: "GET",
        url: "/list/clientes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_clientes = "";

            var html_select_sexo_options =
                "<select class='form-control' id='selectSexoCliente'>" +
                "<option value='M'>Masculino</option>" +
                "<option value='F'>Femenino</option>" +
                "</select>";

            var html_select_edit_sexo_options =
                "<select class='form-control' id='selectEditSexoCliente'>" +
                "<option value='M'>Masculino</option>" +
                "<option value='F'>Femenino</option>" +
                "</select>";

            var html_select_edit_options =
                "<select class='form-control' id='selectEditEstadoCliente'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (cli) {
                html_tabla_clientes =
                    html_tabla_clientes +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    cli.idCliente +
                    "</th>" +
                    "<td>" +
                    cli.Nombres +
                    "</td>" +
                    "<td>" +
                    cli.Apellidos +
                    "</td>" +
                    "<td>" +
                    cli.Sexo +
                    "</td>" +
                    "<td>" +
                    cli.Dni +
                    "</td>" +
                    "<td>" +
                    cli.Telefono +
                    "</td>" +
                    "<td>" +
                    cli.Ruc +
                    "</td>" +
                    "<td>" +
                    cli.Email +
                    "</td>" +
                    "<td>" +
                    cli.Direccion +
                    "</td>" +
                    "<td>" +
                    cli.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-cliente'" +
                    " data-id='" +
                    cli.idCliente +
                    "' data-name='" +
                    cli.Nombres +
                    "' data-apellidos='" +
                    cli.Apellidos +
                    "' data-sexo='" +
                    cli.Sexo +
                    "' data-dni='" +
                    cli.Dni +
                    "' data-telefono='" +
                    cli.Telefono +
                    "' data-ruc='" +
                    cli.Ruc +
                    "' data-email='" +
                    cli.Email +
                    "' data-direccion='" +
                    cli.Direccion +
                    "' data-state='" +
                    cli.Estado +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-cliente'" +
                    " data-id='" +
                    cli.idCliente +
                    "' data-name='" +
                    cli.Nombres +
                    " " +
                    cli.Apellidos +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListClientes").html(html_tabla_clientes);

            $("#selectHTMLSexo").html(html_select_sexo_options);
            $("#selectEditHTMLSexo").html(html_select_edit_sexo_options);
            $("#selectEditHTMLEstado").html(html_select_edit_options);

            // Reinicializar DataTables
            $("#tableClientes").DataTable({
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

function registrarCliente(data) {
    $.ajax({
        type: "POST",
        url: "/save/cliente",
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
                location.reload();
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

function editarCliente(data) {
    $.ajax({
        type: "POST",
        url: "/edit/cliente",
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
                    text: "El cliente fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el cliente !",
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
                text: "Algo paso, no se actualizo el cliente !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function deleteCliente(data) {
    $.ajax({
        type: "POST",
        url: "/delete/cliente",
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
                    text: "El cliente fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el cliente !",
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

$(document).on("click", ".btn-edit-cliente", function () {
    var cliId = $(this).data("id");
    var cliName = $(this).data("name");
    var cliApellidos = $(this).data("apellidos");
    var cliSexo = $(this).data("sexo");
    var cliDNI = $(this).data("dni");
    var cliTelef = $(this).data("telefono");
    var cliRUC = $(this).data("ruc");
    var cliEmail = $(this).data("email");
    var cliDireccion = $(this).data("direccion");
    var cliEstado = $(this).data("state");

    $("#txtEditCliId").val(cliId);
    $("#txtEditCliDNI").val(cliDNI);
    $("#txtEditCliName").val(cliName);
    $("#txtEditCliApellidos").val(cliApellidos);
    $("#selectEditSexoCliente").val(cliSexo);
    $("#txtEditCliTelef").val(cliTelef);
    $("#txtEditCliRUC").val(cliRUC);
    $("#txtEditCliEmail").val(cliEmail);
    $("#txtEditCliDireccion").val(cliDireccion);
    $("#selectEditEstadoCliente").val(cliEstado);

    $("#txtTitleEditarCliente").html(
        "<strong><i class='fas fa-fw fa-users'></i> " + cliName + "</strong>"
    );

    $("#mdEditCliente").modal("show");
});

$(document).on("click", ".btn-delete-cliente", function () {
    var clienteId = $(this).data("id");
    var clienteName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el Cliente: <strong>" +
            clienteName +
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
                _clienteId: clienteId,
            };

            deleteCliente(data);
        }
    });
});
