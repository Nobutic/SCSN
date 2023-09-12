<?php

require_once('../../model/servicio.php');

$total = new Servicio();

// Llamar al método en el modelo para obtener los datos del gráfico
$datos = $total->totalServicios();


// Convertir los datos en formato JSON para pasarlos al frontend
$datosJSON = json_encode($datos);

// Pasar los datos al frontend utilizando la variable JavaScript
echo $datosJSON;
 
?>