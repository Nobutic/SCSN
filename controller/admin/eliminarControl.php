<?php

$id = $_GET['id'];

require_once('../../model/servicio.php');


$control = new Servicio();


$control -> eliminarControl($id);


echo "<script type='text/javascript'>
        alert('Eliminacion exitosa');
        window.location = '../../view/admin/listaControles.php';
      </script>";

?>