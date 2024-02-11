<!DOCTYPE html>
<html>
<title>Voucher</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    @page {
        margin: 0.5cm;
    }

    @font-face {
        font-family: "CourierPrime-Regular";
        src: url("{{ public_path('fonts/CourierPrime-Regular.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: "CourierPrime-Bold";
        src: url("{{ public_path('fonts/CourierPrime-Bold.ttf') }}") format('truetype');
    }


    body {
        margin: 0 !important;
        padding: 0 !important;
        font-family: 'CourierPrime-Regular';
    }

    .farma-title {
        font-size: 16px;
        font-family: 'CourierPrime-Bold';
    }

    .title {
        font-size: 12px;
        font-family: 'CourierPrime-Bold';
    }

    .title-details {
        font-size: 12px;
        font-family: 'CourierPrime-Regular';
    }
</style>

<body>
    <?php

    $firma = file_get_contents("img/icons/icono-farma.png");
    $firma = '<img src="data:image/jpg;base64,' . base64_encode($firma) . '" style="width:120px" alt="Logo Farma">';

    $imgqr = file_get_contents("img/icons/qrcode-boleta.png");
    $imgqr = '<img src="data:image/jpg;base64,' . base64_encode($imgqr) . '" style="width:120px" alt="Logo QR">';

    ?>

    <main>
        <center>
            <div><?php echo $firma; ?></div>
            <span class="farma-title">GRINFAR E.I.R.L</span>
        </center>
        <div style="margin-top: 10px;">
            <table style="width: 100%;">
                <tr>
                    <td colspan="2"><span class="title">RUC:</span><span class="title-details">20105566229</span></td>                   
                    <td colspan="2" ><span class="title">TELEF:</span><span class="title-details">987654321</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="title-details">A.A.H.H LA ENCANTADA MZ B LT 4 GRUPO 2 VILLA EL SALVADOR LIMA - PERÚ </span></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center style="margin-top: 5px;"> <span class="farma-title">{{ $detalle['comprobanteName'] }} DE VENTA ELECTRÓNICA</span></center>
                    </td>
                </tr>
                <tr style="background-color: grey; color: white;">
                    <td colspan="4">
                        <center style="margin-bottom: 5px !important;"> <span class="farma-title">{{ $detalle['comprobanteNumero'] }}</span></center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><span class="title">FECHA DE VENTA: </span></td>
                    <td colspan="2"><span class="title-details">{{ $fecha_hora }}</span></td>
                </tr>
                <tr>
                    <td><span class="title">CAJA: </span></td>
                    <td><span class="title-details">0000001</span></td>
                    <td><span class="title"> VENDEDOR(A): </span></td>
                    <td><span class="title-details">{{ $detalle['empleadoId'] }} </span></td>
                </tr>
                <tr>
                    <td colspan="1"><span class="title">RUC/DNI: </span></td>
                    <td colspan="3"><span class="title-details">{{ $detalle['clienteRUC'] }} </span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="title">CLIENTE:  </span></td>
                </tr>
                <tr>
                    <td colspan="4"><span class="title-details">{{ $detalle['clienteName'] }}</span></td>
                </tr>
                <tr style="background-color: grey; color: white;">
                    <td colspan="4">
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="3"><span class="farma-title">Producto&nbsp;&nbsp;</span></td>
                                <td colspan="1"><span class="farma-title">(Cant. x P.V)&nbsp;Total</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table style="width: 100%;">
                        @foreach($productos as $value)
                            <tr>
                                <td colspan="2"><span class="title-details">{{ $value['producto'] }} {{ $value['descripcion'] }} </span></td>
                                <td colspan="1"><span class="title-details">{{ $value['cantidad'] }} x {{ $value['precio'] }}</span></td>
                                <td colspan="1"><span class="title-details">{{ $value['total'] }}</span></td>
                            </tr>
                        @endforeach
                        </table>
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <hr>
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="2"><span class="title">OP. GRAVADA</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">{{ $detalle['subtotal'] }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="title">IGV (18%)</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">{{ $detalle['valorIGV'] }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="title">T. PRECIO VENTAS</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">{{ $detalle['valorTotal'] }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="title">T. DESCUENTO</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">0.00</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="title">OP. EXONERADO</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">0.00</span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="title">OP. INAFECTO</span></td>
                                <td colspan="1"><span class="title-details">S/.</span></td>
                                <td colspan="1"><span class="title-details">0.00</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>              
                <tr style="background-color: grey; color: white;">
                    <td colspan="4">
                        <table style="width: 100%;">
                            <tr>
                                <td colspan="2"><span class="farma-title">IMPORTE TOTAL</span></td>
                                <td colspan="1"><span class="title">S/.</span></td>
                                <td colspan="1"><span class="title">{{ $detalle['ventaTotal'] }}</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><span class="title-details">SON {{ $total_pagar_texto }}</span></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <hr>
                    </td>
                </tr>
            </table>


        </div>
        <center>
            <div><?php echo $imgqr; ?></div>
        </center>
        <center>
            <div><span class="title-details">Reprensentación impresa del COMPROBANTE DE VENTA ELECTRONICA</span></div>
        </center>

    </main>
</body>

</html>