<?php

    $idCliente = $_GET['idCliente'];
    $idServicio= $_GET['idServicio'];
    $tiempo    = $_GET['tiempo'];

    require_once '../model/servicio.php';
    $control = new Servicio();

    $control->aprobarControl($idCliente, $idServicio, $tiempo);


?>