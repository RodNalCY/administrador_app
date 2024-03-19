$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    $("#http_loading_change").hide();
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

function setVerifyPassword(password) {
    $.ajax({
        type: "POST",
        url: "/dashboard/verificar/password",
        data: {
            _token: _global_token_crf,
            _password: password,
        },
        dataType: "json",
        beforeSend: function (response) {
            $("#http_loading_change").show();
        },
        success: function (response) {
            console.log("RDX> ", response);
            let status = response.status;
            if (status) {
                Swal.fire({
                    title: "Correcto!",
                    text: "Las contraseña fue validada, ingrese su nueva contraseña!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500,
                });

                $("#txtContraseniaActual").prop("disabled", true);
                $("#btnVerificarPassword").prop("disabled", true);

                $("#txtNuevaContrasenia").removeAttr("disabled");
                $("#txtRepNuevaContrasenia").removeAttr("disabled");
                $("#btnActualizarPassword").removeAttr("disabled");
                $("#txtNuevaContrasenia").css("background", "palegreen");
                $("#txtRepNuevaContrasenia").css("background", "palegreen");
            } else {
                Swal.fire({
                    title: "Incorrecta!",
                    text: "La contraseña es incorrecta intente nuevamente !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
            $("#http_loading_change").hide();
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function setUpdatePassword(neo_password) {
    $.ajax({
        type: "POST",
        url: "/dashboard/update/password",
        data: {
            _token: _global_token_crf,
            _neo_password: neo_password,
        },
        dataType: "json",
        beforeSend: function (response) {
            $("#http_loading_change").show();
        },
        success: function (response) {
            console.log("RDX> ", response);
            let status = response.status;
            if (status) {
                Swal.fire({
                    icon: "success",
                    title: "Correcto!",
                    text: "Su contraseña fue actualizada con exito, Gracias!",
                    confirmButtonText: "Entendido",
                    confirmButtonColor: "#3085d6",
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }else{
                Swal.fire({
                    title: "Upps!",
                    text: "No se pudo procesar su solicitud, intente nuevamente !",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
            $("#http_loading_change").hide();
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

$("#btnActualizarContraseña").click(function () {
    $("#mdActualizarContrasenia").modal("show");
});

$("#btnVerificarPassword").click(function () {
    var passActual = $("#txtContraseniaActual").val().trim();
    console.log("passActual > ", passActual);
    setVerifyPassword(passActual);   
});

$("#btnActualizarPassword").click(function () {
    var passOne = $("#txtNuevaContrasenia").val().trim();
    var passTwo = $("#txtRepNuevaContrasenia").val().trim();

    if (passOne === passTwo) {
        setUpdatePassword(passOne);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Las contraseñas no conciden intenta nuevamente !",
            icon: "error",
            showConfirmButton: false,
            timer: 1500,
        });
        
    }
});
