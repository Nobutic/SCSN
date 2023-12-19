<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
    <style>
        .color {
            background-color: #9BB;
        }
    </style>
</head>

<body>

    <?php
    $nombre  = $_POST['nombreCliente'];
    $fecha = date("d-m-Y");


    /**PARA FORZAR LA DESCARGA DEL EXCEL */
    header("Content-Type: text/html;charset=utf-8");
    header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
    $filename = "REPORTE  " . $nombre . " - (" . $fecha . ").xls";
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename=" . $filename . "");


    /***RECIBIENDO LAS VARIABLE DE LA FECHA Y EL CLIENTE*/
    $fechaInicio     = $_POST['fechaInicio'];
    $fechaFin    = $_POST['fechaFin'];
    $cliente = $_POST['idCliente'];



    include_once('../../model/cliente.php');
    $objeto = new Cliente();
    $mov = $objeto->listarMovimiento($fechaInicio, $fechaFin, $cliente);
    ?>


    <table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
        <thead>
            <tr style="background: #D0CDCD;">
                <th>#</th>
                <th>REF FACTURA</th>
                <th>CLIENTE</th>
                <th>IDENTIFICACION</th>
                <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
                <th><i class="fa fa-stopwatch"></i> TIEMPO</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $contador = 1;
            while ($dato = $mov->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $contador++; ?></td>
                    <td><?php echo $dato['id_factura']; ?></td>
                    <td><?php echo $dato['fecha']; ?></td>
                    <td><?php echo $dato['nombre_cliente']; ?></td>
                    <td><?php echo $dato['id_cliente']; ?></td>
                    <td><?php echo $dato['tiempo']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>