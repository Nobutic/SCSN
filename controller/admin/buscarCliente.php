<?php

    $txtCliente = $_POST['txtCliente'];

   
    require_once('../../model/cliente.php');
    $cliente = new Cliente();
    $verificar = $cliente->verificarCliente($txtCliente);
    if($verificar > 0){
        $cliente ->consultarClientePorId($txtCliente);
        return $cliente;
    }else{
        echo'noExiste';
    }


?>