<?php

$id      = $_POST['id'];
$time    = $_POST['tiempo'];
$data    = $_POST['fechaActual'];
$fecha_ven=$_POST['fecha_ven'];
$factura = $_POST['nFactura'];
$valor   = $_POST['valor'];
$abono   = $_POST['abono'];
if(empty($abono)){
  $abono = 0;
}
# validacion de campos vacios 
if(empty($fecha_ven)){
  echo '<script type="text/javascript">
          alert("Campo obligatorio, debe ingresar la fecha de vencimiento");
        </script>';
}elseif(empty($time)){
  echo '<script type="text/javascript">
          alert("Campo obligatorio, debe ingresar el tiempo");
        </script>';
}
elseif(empty($valor)){
  echo '<script type="text/javascript">
          alert("Campo obligatorio, debe ingresar el valor");
        </script>';
}elseif(empty($factura)){
  echo '<script type="text/javascript">
          alert("Campo obligatorio, debe ingresar el numero de la factura");
        </script>';
}elseif(empty($data)){
  echo '<script type="text/javascript">
          alert("Campo obligatorio, debe ingresar la fecha de la factura");
        </script>';
}else{
  # Incluimos la clase cliente
  require_once('../../model/cliente.php');
  # Creamos un objeto de la clase cliente
  $cliente = new Cliente();

  # Llamamos al metodo para validar los datos en la base de datos
  $cliente -> actualizarTiempo($id, $time, $factura, $valor, $abono, $data, $fecha_ven);

  echo "<script type='text/javascript'>
          alert('Registro exitoso!!');
          window.location='../../view/admin/cliente.php';
        </script>";
}
?>