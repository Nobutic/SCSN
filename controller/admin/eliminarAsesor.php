<?php

$id = $_GET['id'];

require_once('../../model/asesor.php');


$asesor = new Asesor();


$asesor -> eliminarAsesor($id);


echo "<script type='text/javascript'>
        window.location = '../../view/admin/asesor.php';
      </script>";

?>