$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    dataIngresosMensuales();
    dataIngresosSemanales();
    dataTotalPresentaciones();
    dataTotalLaboratorios();
});

function dataIngresosMensuales() {
    $.ajax({
        type: "GET",
        url: "/dashboard/ingreso/mensuales",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);

            var labels = response.labels;
            var data = response.data;

            // Configuración del gráfico
            var ctx1 = document.getElementById("barChart1").getContext("2d");
            var barChart1 = new Chart(ctx1, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Total",
                            data: data,
                            backgroundColor: "rgba(0, 191, 255, 0.3)", // Azul claro
                            borderColor: "rgba(0, 191, 255, 1)", // Azul claro
                            pointStyle: "circle",
                            pointRadius: 10,
                            pointHoverRadius: 15,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function dataIngresosSemanales() {
    $.ajax({
        type: "GET",
        url: "/dashboard/ingreso/semanales",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);

            var labels2 = response.labels;
            var data2 = response.data;

            var ctx2 = document.getElementById("barChart2").getContext("2d");
            var barChart2 = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: labels2,
                    datasets: [
                        {
                            label: "Total",
                            data: data2,
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            pointStyle: "circle",
                            pointRadius: 10,
                            pointHoverRadius: 15,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function dataTotalPresentaciones() {
    $.ajax({
        type: "GET",
        url: "/dashboard/total/presentaciones",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);

            var labels3 = response.labels;
            var data3 = response.data;

            var ctx3 = document.getElementById("pieChart1").getContext("2d");
            var barChart3 = new Chart(ctx3, {
                type: "pie",
                data: {
                    labels: labels3,
                    datasets: [
                        {
                            data: data3,
                            backgroundColor: [
                                "rgba(0, 123, 255, 0.7)", // Azul
                                "rgba(40, 167, 69, 0.7)", // Verde
                                "rgba(255, 193, 7, 0.7)", // Amarillo
                                "rgba(255, 150, 50, 0.7)", // Amarillo
                            ],
                        },
                    ],
                },
            });
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function dataTotalLaboratorios() {
    $.ajax({
        type: "GET",
        url: "/dashboard/total/laboratorios",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);

            var labels4 = response.labels;
            var data4 = response.data;

            var ctx4 = document
                .getElementById("barColumnChart1")
                .getContext("2d");
            var barChart4 = new Chart(ctx4, {
                type: "bar",
                data: {
                    labels: labels4,
                    datasets: [
                        {
                            label: "",
                            data: data4,
                            backgroundColor: [
                                "rgba(40, 167, 69, 0.7)", // Verde
                                "rgba(255, 193, 7, 0.7)", // Amarillo
                                "rgba(0, 123, 255, 0.7)", // Azul
                            ],

                            borderSkipped: true,
                            stack: "combined",
                        },
                    ],
                },
            });
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}
