<?php
    $nombre      = $_POST['nombre'];

    if(empty($nombre))
    {
        echo 'erro_1';
    }else{

        require_once '../../model/tipoServicio.php';

        $tipoServicio = new TipoServicio();

        $tipoServicio -> registroTipoServicio($nombre);

        echo 'registro';
    }

?>