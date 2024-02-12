$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
    $("#tableListEmpleados").html(
        "<tr><td colspan='14' class='text-center'>No hay empleados disponibles.</td></tr>"
    );

    listaEmpleados();
});

$("#btnRegistrarEmpleado").click(function () {
    var empNombre = $("#txtEmpleadoNombre").val().trim().toUpperCase();
    var empApellidos = $("#txtEmpleadoApellidos").val().trim().toUpperCase();
    var empDNI = $("#txtEmpleadoDNI").val().trim();
    var empSexo = $("#selectSexoEmpleado").val().trim();
    var empEspecial = $("#selectEspecialidadEmpleado").val().trim();
    var empEmail = $("#txtEmpleadoEmail").val().trim();
    var empTelef = $("#txtEmpleadoTelefono").val().trim();
    var empDirec = $("#txtEmpleadoDireccion").val().trim().toUpperCase();
    var empHIngreso = $("#txtEmpleadoHIngreso").val().trim();
    var empHSalida = $("#txtEmpleadoHSalida").val().trim();
    var empSueldo = $("#txtEmpleadoSueldo").val().trim();

    if (empNombre != "" && empApellidos != "" && empDNI != "") {
        console.log(
            "empNombre > " +
                empNombre +
                "empApellidos > " +
                empApellidos +
                " empDNI > " +
                empDNI +
                " empSexo > " +
                empSexo +
                " empEspecial > " +
                empEspecial +
                " empEmail > " +
                empEmail +
                " empTelef > " +
                empTelef +
                " empDirec > " +
                empDirec +
                " empHIngreso > " +
                empHIngreso +
                " empHSalida > " +
                empHSalida +
                " empSueldo > " +
                empSueldo
        );
        var data = {
            _token: _globa_token_crf,
            _empNombre: empNombre,
            _empApellidos: empApellidos,
            _empDNI: empDNI,
            _empSexo: empSexo,
            _empEspecial: empEspecial,
            _empEmail: empEmail,
            _empTelef: empTelef,
            _empDirec: empDirec,
            _empHIngreso: empHIngreso,
            _empHSalida: empHSalida,
            _empSueldo: empSueldo,
        };

        registrarEmpleado(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar el nombre de la presentación !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});

$("#btnActualizarEmpleado").click(function () {
    var empId = $("#txtEditEmpId").val().trim();
    var empNombre = $("#txtEditEmpName").val().trim().toUpperCase();
    var empApellidos = $("#txtEditEmpApellidos").val().trim().toUpperCase();;
    var empDNI = $("#txtEditEmpDNI").val().trim();
    var empSexo = $("#selectEditSexoEmpleado").val().trim();
    var empEspecial = $("#selectEditEspecialidadEmpleado").val().trim();
    var empEmail = $("#txtEditEmpEmail").val().trim();
    var empTelef = $("#txtEditEmpTelef").val().trim();
    var empDirec = $("#txtEditEmpDireccion").val().trim().toUpperCase();
    var empHIngreso = $("#txtEditEmpHIngreso").val().trim();
    var empHSalida = $("#txtEditEmpHSalida").val().trim();
    var empSueldo = $("#txtEditEmpSueldo").val().trim();
    var empEstado = $("#selectEditEstadoEmpleado").val().trim();


    if (empNombre != "" && empApellidos != "" && empDNI != "") {
        console.log(
            "empId > " +
            empId +
            "empNombre > " +
                empNombre +
                "empApellidos > " +
                empApellidos +
                " empDNI > " +
                empDNI +
                " empSexo > " +
                empSexo +
                " empEspecial > " +
                empEspecial +
                " empEmail > " +
                empEmail +
                " empTelef > " +
                empTelef +
                " empDirec > " +
                empDirec +
                " empHIngreso > " +
                empHIngreso +
                " empHSalida > " +
                empHSalida +
                " empSueldo > " +
                empSueldo +
                " empEstado > " +
                empEstado
        );

        var data = {
            _token: _globa_token_crf,
            _empId: empId,
            _empNombre: empNombre,
            _empApellidos: empApellidos,
            _empDNI: empDNI,
            _empSexo: empSexo,
            _empEspecial: empEspecial,
            _empEmail: empEmail,
            _empTelef: empTelef,
            _empDirec: empDirec,
            _empHIngreso: empHIngreso,
            _empHSalida: empHSalida,
            _empSueldo: empSueldo,
            _empEstado: empEstado,
        };

        editarEmpleado(data);
    } else {
        Swal.fire({
            title: "Upps!",
            text: "Debe completar los datos del empleado !",
            icon: "warning",
            showConfirmButton: false,
            timer: 1500,
        });
    }
});


function listaEmpleados() {
    $.ajax({
        type: "GET",
        url: "/list/empleados",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            var html_tabla_empleados = "";
            var html_select_sexo_options =
                "<select class='form-control' id='selectSexoEmpleado'>" +
                "<option value='M'>Masculino</option>" +
                "<option value='F'>Femenino</option>" +
                "</select>";

            var html_select_edit_sexo_options =
                "<select class='form-control' id='selectEditSexoEmpleado'>" +
                "<option value='M'>Masculino</option>" +
                "<option value='F'>Femenino</option>" +
                "</select>";

            var html_select_especialidad_options =
                "<select class='form-control' id='selectEspecialidadEmpleado'>" +
                "<option value='Practicante'>Practicante</option>" +
                "<option value='Enfermera'>Enfermera</option>" +
                "<option value='Técnica Enfermera'>Técnica Enfermera</option>" +
                "<option value='Otros'>Otros</option>" +
                "</select>";

            var html_select_edit_especialidad_options =
                "<select class='form-control' id='selectEditEspecialidadEmpleado'>" +
                "<option value='Practicante'>Practicante</option>" +
                "<option value='Enfermera'>Enfermera</option>" +
                "<option value='Técnica Enfermera'>Técnica Enfermera</option>" +
                "<option value='Otros'>Otros</option>" +
                "</select>";

            var html_select_edit_options =
                "<select class='form-control' id='selectEditEstadoEmpleado'>" +
                "<option value='Activo'>Activo</option>" +
                "<option value='Inactivo'>Inactivo</option>" +
                "</select>";

            response.data.forEach(function (emp) {
                html_tabla_empleados =
                    html_tabla_empleados +
                    "<tr>" +
                    "<th class='text-center' scope='row'>" +
                    emp.idEmpleado +
                    "</th>" +
                    "<td>" +
                    emp.Nombres +
                    "</td>" +
                    "<td>" +
                    emp.Apellidos +
                    "</td>" +
                    "<td>" +
                    emp.Especialidad +
                    "</td>" +
                    "<td>" +
                    emp.Sexo +
                    "</td>" +
                    "<td>" +
                    emp.Dni +
                    "</td>" +
                    "<td>" +
                    emp.Email +
                    "</td>" +
                    "<td>" +
                    emp.Telefono +
                    "</td>" +
                    "<td>" +
                    emp.Direccion +
                    "</td>" +
                    "<td>" +
                    emp.HoraIngreso +
                    "</td>" +
                    "<td>" +
                    emp.HoraSalida +
                    "</td>" +
                    "<td>" +
                    emp.Sueldo +
                    "</td>" +
                    "<td>" +
                    emp.Estado +
                    "</td>" +
                    "<td>" +
                    "<center>" +
                    " <button type='button' class='btn btn-warning btn-sm btn-edit-empleado'" +
                    " data-id='" +
                    emp.idEmpleado +
                    "' data-name='" +
                    emp.Nombres +
                    "' data-apellidos='" +
                    emp.Apellidos +
                    "' data-especialidad='" +
                    emp.Especialidad +
                    "' data-sexo='" +
                    emp.Sexo +
                    "' data-dni='" +
                    emp.Dni +
                    "' data-email='" +
                    emp.Email +
                    "' data-telefono='" +
                    emp.Telefono +
                    "' data-direccion='" +
                    emp.Direccion +
                    "' data-hingreso='" +
                    emp.HoraIngreso +
                    "' data-hsalida='" +
                    emp.HoraSalida +
                    "' data-sueldo='" +
                    emp.Sueldo +
                    "' data-state='" +
                    emp.Estado +
                    "'><i class='fas fa-pen'></i></button>" +
                    " <button type='button' class='btn btn-danger btn-sm btn-delete-empleado'" +
                    " data-id='" +
                    emp.idEmpleado +
                    "' data-name='" +
                    emp.Nombres +
                    "'><i class='fas fa-trash'></i></button>" +
                    "</center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tableListEmpleados").html(html_tabla_empleados);
            $("#selectHTMLSexo").html(html_select_sexo_options);
            $("#selectHTMLEspecialidad").html(html_select_especialidad_options);

            $("#selectEditHTMLSexo").html(html_select_edit_sexo_options);
            $("#selectEditHTMLEspecialidad").html(html_select_edit_especialidad_options); 
            $("#selectEditHTMLEstado").html(html_select_edit_options);
            // Reinicializar DataTables
            $("#tableEmpleados").DataTable({
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

function registrarEmpleado(data) {
    $.ajax({
        type: "POST",
        url: "/save/empleado",
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
                    text: "El empleado fue registrado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se registro el empleado !",
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
                text: "Algo paso, no se registro el empleado !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function editarEmpleado(data) {
    $.ajax({
        type: "POST",
        url: "/edit/empleado",
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
                    text: "El empleado fue actualizado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se actualizo el empleado !",
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
                text: "Algo paso, no se actualizo el empleado !",
                icon: "error",
                showConfirmButton: false,
                timer: 1500,
            });
        },
    });
}

function deleteEmpleado(data) {
    $.ajax({
        type: "POST",
        url: "/delete/empleado",
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
                    text: "El empleado fue desactivado con exito !",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                Swal.fire({
                    title: "Upps!",
                    text: "Algo paso, no se desactivo el empleado !",
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


$(document).on("click", ".btn-edit-empleado", function () {
    var empId = $(this).data("id");
    var empName = $(this).data("name");
    var empApellidos = $(this).data("apellidos");
    var empEspecialidad = $(this).data("especialidad");
    var empSexo = $(this).data("sexo");
    var empDNI = $(this).data("dni");
    var empEmail = $(this).data("email");
    var empTelef = $(this).data("telefono");
    var empDireccion = $(this).data("direccion");
    var empHIngreso = $(this).data("hingreso");
    var empHSalida = $(this).data("hsalida");
    var empSueldo = $(this).data("sueldo");
    var empEstado = $(this).data("state");

    $("#txtEditEmpId").val(empId);
    $("#txtEditEmpName").val(empName);
    $("#txtEditEmpApellidos").val(empApellidos);
    $("#selectEditEspecialidadEmpleado").val(empEspecialidad);
    $("#selectEditSexoEmpleado").val(empSexo);
    $("#txtEditEmpDNI").val(empDNI);
    $("#txtEditEmpEmail").val(empEmail);
    $("#txtEditEmpTelef").val(empTelef);
    $("#txtEditEmpDireccion").val(empDireccion);
    $("#txtEditEmpHIngreso").val(empHIngreso);
    $("#txtEditEmpHSalida").val(empHSalida);
    $("#txtEditEmpSueldo").val(empSueldo);
    $("#selectEditEstadoEmpleado").val(empEstado);

    $("#txtTitleEditarEmpleado").html(
        "<strong><i class='fas fa-fw fa-address-card'></i> " +
            empName +
            "</strong>"
    );

    $("#mdEditEmpleado").modal("show");
});

$(document).on("click", ".btn-delete-empleado", function () {
    var empleadoId = $(this).data("id");
    var empleadoName = $(this).data("name");

    Swal.fire({
        title: "Desactivar",
        html:
            "<p>Desea desactivar el Empleado: <strong>" +
            empleadoName +
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
                _empleadoId: empleadoId,
            };

            deleteEmpleado(data);
        }
    });
});
