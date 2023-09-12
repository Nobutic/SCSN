<?php

    $mes     = $_POST['mes_php'];
    $anio    = $_POST['anio_php'];
    $cliente = $_POST['cliente_php'];


    require_once('../../model/servicio.php');

    $servicio = new Servicio();
    $servicio -> mostrarServicio($mes, $anio, $cliente);

?>