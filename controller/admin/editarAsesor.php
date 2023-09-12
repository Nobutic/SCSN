<?php

  $id       = $_POST['id'];
  $nombre   = $_POST['nombre'];
  $email    = $_POST['email'];
  $telefono = $_POST['telefono'];
  $cargo    = $_POST['cargo'];

  if(empty($nombre) || empty($email) || empty($telefono) || empty($cargo))
  {

    echo 'error_1'; // Un campo esta vacio y es obligatorio

  }else{

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        # Incluimos la clase asesor
        require_once('../../model/asesor.php');

        # Creamos un objeto de la clase asesor
        $asesor= new Asesor();

        # Llamamos al metodo para validar los datos en la base de datos
        $asesor -> actualizarAsesor($nombre, $id, $email, $telefono, $cargo);
        echo 'actualizar';
        
        }else{
            echo 'error_4';
          }

    }

?>