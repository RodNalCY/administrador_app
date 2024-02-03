var datos_seleccionados = [];
var global_role_id = "";

$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListRoles").html(
        "<tr><td colspan='5' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listRolesAll();
});

function listRolesAll() {
    $.ajax({
        type: "GET",
        url: "/list/roles",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_roles = "";

            response.data.forEach(function (role) {
                html_tabla_roles =
                    html_tabla_roles +
                    "<tr>" +
                    "<td class='text-center' scope='row'>" +
                    role.id +
                    "</td>" +
                    "<th>" +
                    role.name +
                    "</th>" +
                    "<td>" +
                    role.guard_name +
                    "</td>" +
                    "<td>" +
                    role.fecha +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-role'" +
                    " data-id='" +
                    role.id +
                    "' data-name='" +
                    role.name +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-role'" +
                    " data-id='" +
                    role.id +
                    "' data-name='" +
                    role.name +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListRoles").html(html_tabla_roles);
            $("#tableRoles").DataTable({
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

$("#btnRegistrarRole").click(function () {
    console.log("btnRegistrarRole()");
    var roleName = $("#txtRoleNombre").val();
    var roleTipo = $("#txtRoleTipo").val();

    if (roleName != "") {
        console.log("roleName > " + roleName + " roleTipo > " + roleTipo);
        var data = {
            _token: _globa_token_crf,
            _roleName: roleName,
            _roleType: roleTipo,
        };
        registrarRole(data);
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

$("#btnActualizarRolePermisos").click(function () {
    console.log("btnActualizarRolePermisos()");
    var data = {
        _token: _globa_token_crf,
        _roleId: global_role_id,
        _permisos: datos_seleccionados,
    };
    editRolePermisos(data);
});

$(document).on("click", ".btn-delete-role", function () {
    var roleId = $(this).data("id");
    var roleName = $(this).data("name");

    console.log("roleId > " + roleId + " roleName > " + roleName);
    Swal.fire({
        title: "Eliminar",
        text: "Desea eliminar al role " + roleName + " del sistema!",
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
                _roleId: roleId,
                _roleName: roleName,
            };
            deleteRole(data);
        }
    });
});

$(document).on("click", ".btn-edit-role", function () {
    var roleId = $(this).data("id");
    var roleName = $(this).data("name");
    $("#txtTitleEditarPermisos").html("<strong><i class='fas fa-fw fa-user-cog'></i> " +roleName+"</strong>");

    console.log("roleId > " + roleId + " roleName > " + roleName);
    var data = {
        _token: _globa_token_crf,
        _roleId: roleId,
        _roleName: roleName,
    };
    listaPermisosRole(data);
    $("#mdEditPermisoRole").modal("show");
});

function registrarRole(data) {
    $.ajax({
        type: "POST",
        url: "/save/role",
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
                    text: "Se creo correctamente el role !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se creo correctamente el role !",
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

function deleteRole(data) {
    $.ajax({
        type: "POST",
        url: "/delete/role",
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

function listaPermisosRole(data) {
    $.ajax({
        type: "POST",
        url: "/list/permisos/role",
        data: data,
        dataType: "json",
        beforeSend: function () {
            datos_seleccionados = [];
            global_role_id = "";
        },
        success: function (response) {
            console.log("success()");
            console.log(response);
            var html_tabla_roles_permisos = "";
            global_role_id = response.roleId;

            response.data.forEach(function (rp) {
                var _checked = "";

                if (rp.permission_id != null) {
                    _checked = "checked";
                    datos_seleccionados.push({ id: rp.id });
                }

                html_tabla_roles_permisos +=
                    "<tr>" +
                    "<td scope='row'><center>" +
                    rp.id +
                    "</center></td>" +
                    "<td>" +
                    rp.name +
                    "</td>" +
                    "<td>" +
                    "<center><input type='checkbox' class='select_checkbox' " +
                    _checked +
                    " data-id='" +
                    rp.id +
                    "' data-name='" +
                    rp.name +
                    "' /></center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#table_permisos_roles").html(html_tabla_roles_permisos);
        },
        complete: function () {
            console.log("complete()");
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$(document).on("click", ".select_checkbox", function () {
    var permisoId = $(this).data("id");
    // console.log("permisoId > " + permisoId);
    if ($(this).prop("checked")) {
        datos_seleccionados.push({ id: permisoId });
    } else {
        var index = datos_seleccionados.findIndex(function (permiso) {
            return permiso.id === permisoId;
        });
        datos_seleccionados.splice(index, 1);
    }

    console.log("Permisos :", datos_seleccionados);
});

function editRolePermisos(data) {
    $.ajax({
        type: "POST",
        url: "/edit/role/permisos",
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
                    text: "Se actualizo correctamente los permisos !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo los permisos !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        },
        complete: function () {
            console.log("complete()");
            // setTimeout(() => {
            //     location.reload();
            // }, 1500);
        },
        error: function (response) {
            console.log("Error", response);
        },
    });
}
