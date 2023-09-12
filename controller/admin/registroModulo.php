<?php
    $nombre      = $_POST['nombre'];

    if(empty($nombre))
    {
        echo 'error_1';
    }else{

        require_once '../../model/modulo.php';

        $modulo = new Modulo();

        $modulo -> registroModulo($nombre);

    }

?>