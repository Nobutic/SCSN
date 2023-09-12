<?php

  $id     = $_POST['id'];
  $name   = $_POST['name'];
  $email  = $_POST['email'];
  $clave  = $_POST['clave'];
  $clave2 = $_POST['clave2'];
  $cargo  = $_POST['cargo'];

  if(empty($id) || empty($name) || empty($email) || empty($clave) || empty($clave2))
  {
    echo 'error_1'; // Un campo esta vacio y es obligatorio
  }else{

    if($clave == $clave2){

      if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        # Incluimos la clase usuario
        require_once('../../model/usuario.php');
        # Creamos un objeto de la clase usuario
        $usuario = new Usuario();
        # Llamamos al metodo login para validar los datos en la base de datos
        $usuario -> registroUsuario($id, $name, $email, $clave, $cargo);

      }else{
        echo 'error_4';
      }
    }else{
      echo 'error_2';
    }
  }
?>