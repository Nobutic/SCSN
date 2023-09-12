<?php

$id = $_GET['id'];

require_once('../../model/cliente.php');


$cliente = new Cliente();


$cliente -> eliminarCliente($id);


echo "<script type='text/javascript'>
        window.location = '../../view/admin/cliente.php';
      </script>";

?>