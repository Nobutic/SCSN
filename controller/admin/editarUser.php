<?php

  $id     = $_POST['id'];
  $name   = $_POST['name'];
  $email  = $_POST['email'];
  $clave  = $_POST['clave'];
  $clave2 = $_POST['clave2'];
  $cargo  = $_POST['cargo'];
  $nuevoid= $_POST['nuevoid'];

  if(empty($id) || empty($name) || empty($email) || empty($clave) || empty($clave2))
  {

    echo 'error_1'; // Un campo esta vacio y es obligatorio

  }else{

    if($clave == $clave2){

      
      # Incluimos la clase usuario
      require_once('../../model/usuario.php');

      # Creamos un objeto de la clase usuario
      $usuario = new Usuario();

      # Llamamos al metodo para validar los datos en la base de datos
      $usuario -> actualizarUsuario($id, $name, $email, $clave, $cargo, $nuevoid);
    
     
            

    }else{
      echo 'error_2';// Clave y clave2 son diferentes
    }

  }




?>
