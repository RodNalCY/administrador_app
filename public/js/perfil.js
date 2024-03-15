$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    if ($("#particlebackground").length != 0) {
        var config = $("#particlebackground").data("config");
        particlesJS.load("particlebackground", config);
    }
    console.log("_global_token_crf > ", _global_token_crf);
    getUserDetails();
});
function getUserDetails() {
    $.ajax({
        type: "GET",
        url: "/dashboard/user/details",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
            $("#http_loading").show();
            $("#http_content").hide();
        },
        success: function (response) {
            console.log("RDX> ", response);
            let status = response.status;
            if (status) {
                var dominioBase = window.location.origin;
                var filePath = "";
                var sexo = "";
                if (response.data.empleado.Sexo == "M") {
                    filePath = dominioBase + "/img/icons/doctor.png";
                    sexo = "Masculino";
                } else {
                    filePath = dominioBase + "/img/icons/doctora.png";
                    sexo = "Femenino";
                }

                $("#icon-logo").attr("src", filePath);
                $("#txtDNI").val(response.data.empleado.Dni);
                $("#txtNombres").val(
                    response.data.empleado.Nombres +
                        " " +
                        response.data.empleado.Apellidos
                );
                $("#txtEspecialidad").val(response.data.empleado.Especialidad);
                $("#txtEmail").val(response.data.empleado.Email);
                $("#txtSexo").val(sexo);
                $("#txtTelefono").val(response.data.empleado.Telefono);
                $("#txtDireccion").val(response.data.empleado.Direccion);
            }
            setInterval(() => {
                $("#http_loading").hide();
                $("#http_content").show();
            }, 1000);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}
