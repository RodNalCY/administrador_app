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

    .farma-name {
        font-size: 14px;
        font-family: 'CourierPrime-Bold';
    }

    .title {
        font-size: 10px;
        font-family: 'CourierPrime-Bold';
    }

    .title-details {
        font-size: 10px;
        font-family: 'CourierPrime-Regular';
    }
</style>

<body>
    <?php

    $firma = file_get_contents("img/icons/icono-farma.png");
    $firma = '<img src="data:image/jpg;base64,' . base64_encode($firma) . '" style="width:120px" alt="Logo Farma">';

    ?>

    <main>
        <center>
            <div><?php echo $firma; ?></div>
            <span class="farma-name">GRINFAR E.I.R.L</span>
        </center>
        <div style="margin-top: 10px;">
            <span class="title">RUC: </span><span class="title-details">20111111111</span>
            <span class="title"> TEL: </span> <span class="title-details">999888777 </span> <br>
            <span class="title-details">MZ B LT 4 GRUPO 2 A.A.H.H LA ENCANTADA - VILLA EL SALVADOR LIMA - PERÚ</span>
            <center style="margin-top: 5px;"> <span class="title">VOUCHER ELECTRÓNICO</span></center>
            <center style="margin-top: 5px;"> <span class="title">{{ $titulo }}</span></center>
        </div>
    </main>
</body>

</html>