<?php

  $id_factura = $_POST['id_factura'];
  $fecha      = $_POST['fecha'];
  $valor      = $_POST['valor'];
  # validacion de campos vacios 
  if (empty($fecha)) {
    echo '<script type="text/javascript">
            alert("Por favor seleccione la fecha");
            window.location = "../../view/admin/cartera.php";
          </script>';
  } elseif (empty($valor)) {
    echo '<script type="text/javascript">
                  alert("Por favor, digite el valor");
                  window.location = "../../view/admin/cartera.php";
                </script>';
  } else {
    # Incluimos la clase cartera
    require_once('../../model/cartera.php');
    # Creamos un objeto de la clase cliente
    $cartera = new Cartera();

    # Llamamos al metodo para validar los datos en la base de datos
    $cartera->abonar($id_factura, $valor, $fecha);

    echo '<script type="text/javascript">
                alert("Registro exitoso!!!");
                window.location = "../../view/admin/cartera.php";
              </script>';
  }
