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
        
        $fecha = date("d-m-Y");


        /**PARA FORZAR LA DESCARGA DEL EXCEL */
        header("Content-Type: text/html;charset=utf-8");
        header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
        $filename = "LISTA CLIENTES - (" .$fecha. ").xls";
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Disposition: attachment; filename=" . $filename . "");
                            

        include_once('../../model/cliente.php');
        $objeto = new Cliente();
        $clientes = $objeto-> listarClientes();
    ?>


    <table style="text-align: center;" border='1' cellpadding=1 cellspacing=1>
        <thead>
            <tr style="background: #D0CDCD;">
                <th>#</th>
                <th>Nombre</th>
                <th>Identificacion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Ciudad</th>
            </tr>
        </thead>
        
        <tbody>
            <?php while($client = $clientes->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $client['n'] ?></td>
                <td><?php echo $client['nombre'] ?></td>
                <td><?php echo $client['id'] ?></td>
                <td><?php echo $client['telefono'] ?></td>
                <td><?php echo $client['email'] ?></td>
                <td><?php echo $client['direccion'] ?></td>
                <td><?php echo $client['ciudad'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>

</body>
</html>