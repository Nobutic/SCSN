<?php

  $nombre         = $_POST['Nombre'];
  $nombreUsuario  = $_POST['nameUser'];
  $id             = $_POST['Id'];
  $email          = $_POST['email'];
  $direccion      = $_POST['direccion'];
  $telefono       = $_POST['telefono'];
  $ciudad         = $_POST['ciudad'];
  $nombreContacto = $_POST['nombreContacto'];
  $cargo          = $_POST['cargo'];
  $celular        = $_POST['celular'];
  $emailContacto  = $_POST['emailContacto'];
  $clave          = $_POST['clave'];
  $clave2         = $_POST['clave2'];

  if(empty($nombre) || empty($nombreUsuario) || empty($id) || empty($direccion) || empty($telefono) || empty($ciudad) || empty($nombreContacto) || empty($cargo) || empty($celular) || empty($emailContacto) || empty($clave) || empty($clave2))
  {

    echo 'error_1'; // Un campo esta vacio y es obligatorio

  }else{

    if($clave == $clave2){

      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        
        require_once('../../model/cliente.php');

      
        $cliente = new Cliente();

        
        $cliente->registroCliente($nombre, $nombreUsuario, $id, $email, $direccion, $telefono, $ciudad, $nombreContacto, $cargo, $celular, $emailContacto, $clave);
         
      }else{
        echo 'error_4';
      }
    }else{
      echo 'error_5';
    }

  }
?>