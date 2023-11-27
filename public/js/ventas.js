var _globa_token_crf = "";

$(document).ready(function () {
    _globa_token_crf = document.getElementById("_token").value;
    console.log("_globa_token_crf > ", _globa_token_crf);
});

$("#btnBuscarClientes").click(function () {
    $("#mdListClientes").modal("show");
    listClientes();
});

$("#btnBuscarComprobante").click(function () {
    $("#mdListComprobante").modal("show");
    listComprobantes();
});

$("#btnBuscarProducto").click(function () {
    $("#mdListProducto").modal("show");
    listProductos();
});

function listClientes() {
    var html_tabla_clientes = "";
    $.ajax({
        type: "GET",
        url: "/list/clientes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
            html_tabla_clientes = "";
        },
        success: function (response) {
            console.log("RDX> ", response);

            response.data.forEach(function (cliente) {
                console.log(cliente.Email);
                html_tabla_clientes =
                    html_tabla_clientes +
                    "<tr>" +
                    "<th scope='row'>"+cliente.idCliente+"</th>" +
                    "<td>"+cliente.Nombres+"</td>" +
                    "<td>"+cliente.Apellidos+"</td>" +
                    "<td>"+cliente.Dni+"</td>" +
                    "<td>"+cliente.Ruc+"</td>" +
                    "<td>"+cliente.Direccion+"</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-primary btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_clientes").html(html_tabla_clientes);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}

function listProductos() {
    var html_tabla_productos = "";
    $.ajax({
        type: "GET",
        url: "/list/productos",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
            html_tabla_productos = "";
        },
        success: function (response) {
            console.log("RDX> ", response);

            response.data.forEach(function (producto) {                
                html_tabla_productos =
                    html_tabla_productos +
                    "<tr>" +
                    "<th scope='row'>"+producto.idProducto+"</th>" +
                    "<td>"+producto.Descripcion+"</td>" +        
                    "<td>"+producto.laboratorio.Nombre+"</td>" +              
                    "<td>"+producto.presentacion.Descripcion+"</td>" +                                    
                    "<td>"+producto.Concentracion+"</td>" +
                    "<td>"+producto.Stock+"</td>" +
                    "<td>"+producto.Costo+"</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-primary btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_productos").html(html_tabla_productos);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}


function listComprobantes() {
    var html_tabla_comprobantes = "";
    $.ajax({
        type: "GET",
        url: "/list/comprobantes",
        data: {
            _token: _globa_token_crf,
        },
        dataType: "json",
        beforeSend: function (response) {
            html_tabla_comprobantes = "";
        },
        success: function (response) {
            console.log("RDX> ", response);

            response.data.forEach(function (comprobante) {                
                html_tabla_comprobantes =
                    html_tabla_comprobantes +
                    "<tr>" +
                    "<th scope='row'>"+comprobante.idTipoComprobante+"</th>" +
                    "<td>"+comprobante.Descripcion+"</td>" +        
                    "<td>"+comprobante.Estado+"</td>" +
                    "<td>" +
                    "   <center>" +
                    "      <button type='button' class='btn btn-primary btn-sm'><i class='fas fa-check'></i></button>" +
                    "    </center>" +
                    "</td>" +
                    "</tr>";
            });

            $("#tbl_row_comprobantes").html(html_tabla_comprobantes);
        },
        complete: function (response) {},
        error: function (response) {
            console.log("Error", response);
        },
    });
}
