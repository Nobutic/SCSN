<?php

require_once ('../../model/cliente.php');
$cliente    = new Cliente();
$data       = $_POST['fechaActual'];
$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;
if($tipo == 'text/csv'){

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(";", $linea);
       
        $identificacion        = !empty($datos[0])  ? ($datos[0]) : '';
        $nombre                = utf8_encode($datos[1]);
		$correo                = !empty($datos[2])  ? ($datos[2]) : '';
        $direccion             = utf8_encode($datos[3]);
        $telefono              = !empty($datos[4])  ? ($datos[4]) : '';
        $ciudad                = utf8_encode($datos[5]);
        $nombre_contacto       = utf8_encode($datos[6]);
        $cargo                 = !empty($datos[7])  ? ($datos[7]) : '';
        $celular               = !empty($datos[8])  ? ($datos[8]) : '';
        $email_contacto        = !empty($datos[9])  ? ($datos[9]) : '';
        $nombreUsuario         = utf8_encode($datos[10]);
        $clave                 = !empty($datos[11])  ? ($datos[11]) : '';
       
        if( !empty($identificacion) ){

            $cant_duplicidad = $cliente -> verificarCliente($identificacion);
        }   

        //No existe Registros Duplicados
        if ( $cant_duplicidad == 0 ) { 

            $cliente -> registroCliente($nombre,$nombreUsuario, $identificacion, $correo, $direccion, $telefono, $ciudad, $nombre_contacto, $cargo, $celular, $email_contacto, $clave);
        } 
        /**Caso Contrario actualizo el o los Registros ya existentes*/
        else{
            
            $cliente -> actualizarCliente($identificacion, $nombreUsuario, $nombre, $direccion, $telefono, $ciudad, $nombre_contacto, $cargo, $celular, $email_contacto, $data, $clave);
        }
    }

    $i++;

 
    echo "<script type='text/javascript'>
            alert('Carga Exitosa!!');
            window.location='../../view/admin/cliente.php';
        </script>";
    }
}else{
    echo '<script type="text/javascript">alert("Formato incorrecto"); window.location ="../../view/admin/cliente.php";</script>';
}
?>