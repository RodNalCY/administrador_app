$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListPermisos").html(
        "<tr><td colspan='5' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listPermisosAll();
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

            response.data.forEach(function (role) {
                html_tabla_permisos =
                    html_tabla_permisos +
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
                    "   <center>" +
                    "      <button type='button' class='btn btn-primary btn-sm'><i class='fas fa-eye'></i></button>" +
                    "      <button type='button' class='btn btn-warning btn-sm'><i class='fas fa-pen'></i></button>" +
                    "      <button type='button' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>" +
                    "    </center>" +
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
