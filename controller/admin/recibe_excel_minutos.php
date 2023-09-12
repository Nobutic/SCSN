<?php

require_once ('../../model/cliente.php');
$cliente    = new Cliente();
$tipo       = $_FILES['dataMinuto']['type'];
$tamanio    = $_FILES['dataMinuto']['size'];
$archivotmp = $_FILES['dataMinuto']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;
if($tipo == 'text/csv'){

    foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        $cantidad_regist_agregados =  ($cantidad_registros - 1);

        if ($i != 0) {

            $datos = explode(";", $linea);
        
            $idCliente             = !empty($datos[0])  ? ($datos[0]) : '';
            // $nombre                = utf8_encode($datos[1]);
            $idFactura             = !empty($datos[2])  ? ($datos[2]) : '';
            $fecha                 = date('Y/m/d', strtotime($datos[3]));
            $fecha_ven             = date('Y/m/d', strtotime($datos[4]));
            $valor                 = !empty($datos[5])  ? ($datos[5]) : '';
            $abono                 = !empty($datos[6])  ? ($datos[6]) : '';
            $tiempo                = !empty($datos[7])  ? ($datos[7]) : '';

            $cliente -> actualizarTiempo($idCliente, $tiempo, $idFactura, $valor, $abono, $fecha, $fecha_ven);    
            }
            $i++;

    
            echo "<script type='text/javascript'>
                    alert('Carga Exitosa!!');
                    
                </script>";
    }
}else{
    echo '<script type="text/javascript">alert("Formato incorrecto"); window.location ="../../view/admin/cliente.php";</script>';
}
?>