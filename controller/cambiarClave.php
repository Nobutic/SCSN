<?php 

    $idUsuario   = $_POST['idUsuario_php'];
    $claveActual = $_POST['cActual_php'];
    $claveNueva1 = $_POST['cNueva1_php'];
    $claveNueva2 = $_POST['cNueva2_php'];

    if(empty($claveActual) || empty($claveNueva1) || empty($claveNueva2))
    {
        echo 'error_1';
    }else{
        if($claveNueva1 == $claveNueva2)
        {
            require_once '../model/usuario.php';
            $usuario = new Usuario();

            $usuario -> cambiarClave($idUsuario, $claveActual, $claveNueva1);

        }else{
            echo 'error_3';
        }
    }
?>