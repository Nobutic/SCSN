<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <link rel="stylesheet" href="../../resources/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="../../resources/css/styles.css" rel="stylesheet" />
  </head>
  <body>
    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/sweetalert.min.js"></script>
    <script src="../../resources/js/operaciones.js"></script>
  </body>
</html>

<?php

  $id_cliente = $_POST['id_cliente'];
  $id_factura = $_POST['id_factura'];
  $fecha = $_POST['fecha'];
  $fecha_factura = $_POST['fecha_factura'];
  $fecha_ven = $_POST['fecha_ven'];
  $fecha_abono = $_POST['fecha_abono'];
  $valor = $_POST['valor_factura'];
  $abono = $_POST['abono'];
  $tiempo = $_POST['tiempo'];
  if(empty($tiempo)){
    $tiempo = 0;
  }

  if(empty($id_cliente) || empty($id_factura) || empty($fecha) || empty($fecha_factura) || empty($fecha_ven) || empty($fecha_abono) || empty($valor) || empty($abono))
  {
    echo '<script type="text/javascript">
                alert("Por favor llenar los campos vacios");
                window.location = "../../view/admin/cartera.php";
              </script>'; // Un campo esta vacio y es obligatorio
  }else{
    require_once '../../model/cartera.php';
    $factura = new Cartera();
    $factura->editarFactura($id_cliente, $id_factura, $fecha, $fecha_ven, $fecha_factura, $fecha_abono, $valor, $abono, $tiempo);
    echo '<script type="text/javascript">
            alert("Actualizacion exitosa");
            window.location = "../../view/admin/cartera.php";
              </script>'; // Mensaje de confirmacion 
  }

?>