<?php

  $id             = $_POST['id'];
  $nombre         = $_POST['nombre'];
  $email          = $_POST['email'];
  $direccion      = $_POST['direccion'];
  $telefono       = $_POST['telefono'];
  $ciudad         = $_POST['ciudad'];
  $nombreContacto = $_POST['nombreContacto'];
  $cargo          = $_POST['cargo'];
  $celular        = $_POST['celular'];
  $emailContacto  = $_POST['emailContacto'];
  $data           = $_POST['fechaActual'];

  if(empty($nombre) || empty($email) || empty($direccion) || empty($telefono) || empty($ciudad) || empty($nombreContacto) || empty($cargo) || empty($celular) || empty($emailContacto))
  {

    // Un campo esta vacio y es obligatorio
    echo "<script type='text/javascript'>
            alert('Campos obligatorios, llene los campos vacíos');
            window.location='../../view/admin/cliente.php';
          </script>"; 

  }else{

    
    # Incluimos la clase cliente
    require_once('../../model/cliente.php');

    # Creamos un objeto de la clase cliente
    $cliente = new Cliente();

    # Llamamos al metodo para validar los datos en la base de datos
    $cliente -> editar($id, $nombre, $email, $direccion, $telefono, $ciudad, $nombreContacto, $cargo, $celular, $emailContacto, $data);

    echo "<script type='text/javascript'>
            alert('Registro actualizado con exito');
            window.location='../../view/admin/cliente.php';
          </script>";
  }




?>
