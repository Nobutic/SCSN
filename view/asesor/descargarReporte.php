<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
    <style>
        .color{
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
    $filename = "REPORTE  " .$nombre. " - (" .$fecha. ").xls";
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename=" . $filename . "");


    /***RECIBIENDO LAS VARIABLE DE LA FECHA Y EL CLIENTE*/
    $mes     = $_POST['mes'];
    $anio    = $_POST['anio'];
    $cliente = $_POST['idCliente'];

                    

    include_once('../../model/tarea.php');
    $objeto = new Tarea();
    $ticket = $objeto-> ticketCliente($mes, $anio, $cliente);
?>


<table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
<thead>
    <tr style="background: #D0CDCD;">
        <th># CONTROL</th>
        <th scope="col">FECHA SERVICIO</th>
        <th scope="col">TICKET</th>
        <th scope="col">CLIENTE</th>
        <th scope="col">ASESOR</th>
        <th scope="col">MODULO</th>
        <th scope="col">SERVICIO</th>
        <th scope="col">ESTADO</th>
    </tr>
</thead>
<?php

            while($dataRow = $ticket->fetch_assoc()){ ?>
    <tbody>
        <tr>
            <td><?php echo $dataRow['id_servicio'] ; ?></td>
            <td><?php echo $dataRow['fecha'] ; ?></td>
            <td><?php echo $dataRow['ticket'] ; ?></td>
            <td><?php echo $dataRow['cliente'] ; ?></td>
            <td><?php echo $dataRow['asesor'] ; ?></td>
            <td><?php echo $dataRow['modulo'] ; ?></td>
            <td><?php echo $dataRow['tipo_servicio'] ; ?></td>
            <td><?php echo $dataRow['estado'] ; ?></td>
        </tr>
    </tbody>
    
<?php } ?>
</table>

</body>
</html>