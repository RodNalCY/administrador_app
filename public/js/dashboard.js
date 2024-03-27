$(document).ready(function () {
    _global_token_crf = document.getElementById("_token").value;
    console.log("_global_token_crf > ", _global_token_crf);
    dataResumenDashboard();
    dataTotalVentasMensuales();
    dataSumaVentasMensuales();
    // dataTotalPresentaciones();
    // dataTotalLaboratorios();
    dataSumaVentasSemana();
    dataTotalVentasSemana();
});

function dataTotalVentasMensuales() {
    $.ajax({
        type: "GET",
        url: "/dashboard/total/ventas/mensuales",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#fechaInfoAnioOne").text("Año: "+"2024");
            var label_response = response.labels;
            var data_response = response.data;

            // Configuración del gráfico
            var ctx1 = document.getElementById("barChartTotalVentaMensual").getContext("2d");
            var barChartTotalVentaMensual = new Chart(ctx1, {
                type: "line",
                data: {
                    labels: label_response,
                    datasets: [
                        {
                            label: "Total",
                            data: data_response,
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

function dataSumaVentasMensuales() {
    $.ajax({
        type: "GET",
        url: "/dashboard/suma/ventas/mensuales",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#fechaInfoAnioTwo").text("Año: "+"2024");
            var label_response = response.labels;
            var data_response = response.data;

            var ctx2 = document.getElementById("barChartSumVentaMensual").getContext("2d");
            var barChartSumVentaMensual = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: label_response,
                    datasets: [
                        {
                            label: "Total (S/.) ",
                            data: data_response,
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

function dataResumenDashboard() {
    $.ajax({
        type: "GET",
        url: "/dashboard/resumen",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#HTMLVentaRealizadas").text(response.total_ventas);
            $("#HTMLComprasRealizadas").text(response.total_compras);
            $("#HTMLTotalCliente").text(response.total_clientes);
            $("#HTMLTotalProductos").text(response.total_productos);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function dataSumaVentasSemana() {
    $.ajax({
        type: "GET",
        url: "/dashboard/suma/ventas/semana",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#fechaInfoOne").text("Semana: "+response.info);
            // console.log("RDX> ", response.semana[1]);
            var label_response = response.labels;
            var data_response = response.data;

            var ctx2 = document.getElementById("barChartSumVentaSemana").getContext("2d");
            var barChartSumVentaSemana = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: label_response,
                    datasets: [
                        {
                            label: "Total (S/.) ",
                            data: data_response,
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

function dataTotalVentasSemana() {
    $.ajax({
        type: "GET",
        url: "/dashboard/total/ventas/semana",
        data: {
            _token: _global_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {},
        success: function (response) {
            console.log("RDX> ", response);
            $("#fechaInfoTwo").text("Semana: "+response.info);
            var label_response = response.labels;
            var data_response = response.data;

            var ctx2 = document.getElementById("barChartTotalVentaSemana").getContext("2d");
            var barChartTotalVentaSemana = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: label_response,
                    datasets: [
                        {
                            label: "Total",
                            data: data_response,
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