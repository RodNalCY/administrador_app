$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListUsuarios").html(
        "<tr><td colspan='6' class='text-center'>No hay productos disponibles.</td></tr>"
    );
    listUsuariosAll();
});

function listUsuariosAll() {
    $.ajax({
        type: "GET",
        url: "/list/usuarios",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function () {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_usuarios = "";

            response.data.forEach(function (user) {
                html_tabla_usuarios =
                    html_tabla_usuarios +
                    "<tr>" +
                    "<td class='text-center' scope='row'>" +
                    user.id +
                    "</td>" +
                    "<th>" +
                    user.name +
                    "</th>" +
                    "<td>" +
                    user.email +
                    "</td>" +
                    "<td>" +
                    user.role +
                    "</td>" +     
                    "<td>" +
                    user.fecha +
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

            $("#tableListUsuarios").html(html_tabla_usuarios);
            $("#tableUsuarios").DataTable({
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
