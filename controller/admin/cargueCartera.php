<?php

    $numFactura = "";
    $fecha = "";
    $fechaVen = "";
    $valor = "";
    $abono = "";
    $saldo = $valor - $abono;
    $cliente = "";

    if(empty($fecha) || empty($valor) || empty($abono) || empty($cliente)){
        echo 'error_1'; // campos vacios
    }else{
        if($saldo < 0){
            echo 'error_2'; // el abono no puede ser mayor al valor de la factura - revisar si es posible en la practica
        }else{
            // realzar la insercion a la base de datos
        }
    }


?>