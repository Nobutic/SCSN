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
        $fechaInicio    = $_POST['fechaInicio'];
        $fechaFin       = $_POST['fechaFin'];
        $cliente        = $_POST['idCliente'];

                            

        include_once('../../model/servicio.php');
        $objeto = new Servicio();
        $servicio = $objeto-> mostrarServicio($fechaInicio, $fechaFin, $cliente);
    ?>


    <table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
        <thead>
            <tr style="background: #D0CDCD;">
                <th scope="col">FECHA CONTROL</th>
                <th scope="col"># CONTROL</th>
                <th scope="col">NOMBRE CLIENTE</th>
                <th scope="col">MODULO</th>
                <th scope="col">SERVICIO</th>
                <th scope="col">HORA INICIO</th>
                <th scope="col">HORA FINAL</th>
                <th scope="col">TIEMPO CONEXION</th>
                <th scope="col">TIEMPO SERVICIO</th>
                <th scope="col">ASESOR</th>
                <th scope="col">RECIBE SERVICIO</th>
                <th scope="col">TICKET GENERADO</th>
            </tr>
        </thead>
        
        <tbody>
            <?php while($dataRow = $servicio->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $dataRow['fecha'] ; ?></td>
                <td><?php echo $dataRow['id_servicio'] ; ?></td>
                <td><?php echo $dataRow['cliente'] ; ?></td>
                <td><?php echo $dataRow['modulo'] ; ?></td>
                <td><?php echo $dataRow['servicio'] ; ?></td>
                <td><?php echo $dataRow['hora_inicio'] ; ?></td>
                <td><?php echo $dataRow['hora_fin'] ; ?></td>
                <td><?php echo $dataRow['tiempo_conexion'] ; ?></td>
                <td><?php echo $dataRow['tiempo'] ; ?></td>
                <td><?php echo $dataRow['asesor'] ; ?></td>
                <td><?php echo $dataRow['persona_recibe'] ; ?></td>
                <?php if($dataRow['ticket'] > 0){ 
                        echo '<td>Si</td>';
                }else{ echo '<td>No</td>'; } ?>
            </tr>
            <?php } ?>
        </tbody>
</table>

</body>
</html>