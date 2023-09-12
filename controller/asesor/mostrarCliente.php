<?php

    $nombre = $_POST['jsData'];


    require_once('../../model/Cliente.php');

    $cliente = new Cliente();
    $cliente -> consultarClientePorId($nombre);

?>