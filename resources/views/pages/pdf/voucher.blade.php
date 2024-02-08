<!DOCTYPE html>
<html>
<title>Voucher</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    body {
        margin: 0 !important;
        padding: 0 !important;
        font-family: 'fantasy';
    }


    .title {
        font-size: 10px;
        font-weight: bold;
        font-family: 'fantasy';
    }

    .title-details {
        font-size: 10px;
        font-family: 'fantasy';
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
            <strong>GRINFAR E.I.R.L</strong>
        </center>
        <div style="margin-top: 10px;">
            <span class="title">RUC: </span><span class="title-details">20111111111</span>
            <span class="title"> TEL: </span> <span class="title-details">999 888 777 </span> <br>
            <span class="title-details">MZ B LT 4 GRUPO 2 A.A.H.H LA ENCANTADA - VILLA EL SALVADOR LIMA - PERÚ</span>
            <center style="margin-top: 5px;"> <span class="title">VOUCHER ELECTRÓNICO</span></center>
        </div>
    </main>
</body>

</html>