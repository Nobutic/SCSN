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
    include_once '../../model/cartera.php';
    $objeto = new Cartera();
    $cartera = $objeto->saldo();
    $fecha = date("d-m-Y");


    /**PARA FORZAR LA DESCARGA DEL EXCEL */
    header("Content-Type: text/html;charset=utf-8");
    header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
    $filename = "REPORTE CLIENTE CON SALDO - (" . $fecha . ").xls";
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename=" . $filename . "");

    ?>


    <table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
        <thead>
            <tr>
                <th>#FACTURA</th>
                <th>CLIENTE</th>
                <th>FECHA FACTURA</th>
                <th>FECHA VENCIMIENTO</th>
                <th>VALOR FACTURA</th>
                <th>ABONOS</th>
                <th>SALDO</th>
                <th>TIEMPO</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($dato = $cartera->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $dato['id_factura'] ?></td>
                    <td><?php echo $dato['nombre'] ?></td>
                    <td><?php echo $dato['fecha'] ?></td>
                    <td><?php echo $dato['fecha_ven'] ?></td>
                    <td><?php echo $dato['valor'] ?></td>
                    <td><?php echo $dato['sum_abono'] ?></td>
                    <td><?php echo $dato['valor'] - $dato['sum_abono'] ?></td>
                    <td><?php echo $dato['tiempo'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>