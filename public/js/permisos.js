$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListPermisos").html(
        "<tr><td colspan='5' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listPermisosAll();
});

$("#btnRegistrarPermiso").click(function () {
    console.log("btnRegistrarPermiso()");
    var permisoName = $("#txtNombrePermiso").val();
    var permisoTipo = $("#txtTipoPermiso").val();

    if (permisoName != "") {
        console.log(
            "permisoName > " + permisoName + " permisoTipo > " + permisoTipo
        );
        var data = {
            _token: _globa_token_crf,
            _permisoName: permisoName,
            _permisoType: permisoTipo,
        };
        registrarPermiso(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Algo paso, debe completar todos los campos !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnActualizarPermiso").click(function () {
    console.log("btnActualizarPermiso()");
    var permisoEditId = $("#txtEditIdPermiso").val();
    var permisoEditName = $("#txtEditNombrePermiso").val();

    if (permisoEditName != "") {
        console.log(
            "permisoEditId > " +
                permisoEditId +
                " permisoEditName > " +
                permisoEditName
        );
        var data = {
            _token: _globa_token_crf,
            _permisoEditId: permisoEditId,
            _permisoEditName: permisoEditName,
        };
        editarPermiso(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Algo paso, debe completar todos los campos !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

function listPermisosAll() {
    $.ajax({
        type: "GET",
        url: "/list/permisos",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_permisos = "";

            response.data.forEach(function (permiso) {
                html_tabla_permisos =
                    html_tabla_permisos +
                    "<tr>" +
                    "<td class='text-center' scope='row'>" +
                    permiso.id +
                    "</td>" +
                    "<th>" +
                    permiso.name +
                    "</th>" +
                    "<td>" +
                    permiso.guard_name +
                    "</td>" +
                    "<td>" +
                    permiso.fecha +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-permiso'" +
                    " data-id='" +
                    permiso.id +
                    "' data-name='" +
                    permiso.name +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-permiso'" +
                    " data-id='" +
                    permiso.id +
                    "' data-name='" +
                    permiso.name +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListPermisos").html(html_tabla_permisos);
            $("#tablePermisos").DataTable({
                order: [[0, "asc"]],
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

function registrarPermiso(data) {
    $.ajax({
        type: "POST",
        url: "/save/permiso",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            if (status) {
                Swal.fire({
                    title: "Correcto!",
                    text: "Se creo correctamente el permiso !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se creo correctamente el permiso !",
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

function editarPermiso(data) {
    $.ajax({
        type: "POST",
        url: "/edit/permiso",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            if (status) {
                Swal.fire({
                    title: "Correcto!",
                    text: "Se edito correctamente el permiso !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se edito correctamente el permiso !",
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

$(document).on("click", ".btn-edit-permiso", function () {
    var permisoId = $(this).data("id");
    var permisoName = $(this).data("name");
    $("#txtTitleEditarPermiso").html(
        "<strong><i class='fas fa-fw fa-user-shield'></i> " +
            permisoName +
            "</strong>"
    );

    $("#txtEditIdPermiso").val(permisoId);
    $("#txtEditNombrePermiso").val(permisoName);

    console.log("permisoId > " + permisoId + " permisoName > " + permisoName);

    $("#mdEditPermiso").modal("show");
});

$(document).on("click", ".btn-delete-permiso", function () {
    var permisoId = $(this).data("id");
    var permisoName = $(this).data("name");

    Swal.fire({
        title: "Eliminar",
        html:
            "<p>Desea eliminar al permiso <strong>" +
            permisoName +
            "</strong> del sistema!</p>",
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
                _permisoId: permisoId,
                _permisoName: permisoName,
            };
            deletePermiso(data);
        }
    });
});

function deletePermiso(data) {
    $.ajax({
        type: "POST",
        url: "/delete/permiso",
        data: data,
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("success()");
            console.log(response);
            let status = response.status;
            let message = response.message;
            if (status) {
                Swal.fire({
                    title: "Correcto!",
                    text: message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: message,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            setTimeout(() => {
                location.reload();
            }, 2000);
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}
