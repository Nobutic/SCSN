<?php
  $id         = $_POST['id'];
  $nombre     = $_POST['nombre'];
  $calendario = $_POST['idCalendario'];
  $email      = $_POST['email'];
  $telefono   = $_POST['telefono'];
  $cargo      = $_POST['cargo'];
  $clave1     = $_POST['clave'];
  $clave2     = $_POST['clave2'];
  

  if(empty($id) || empty($calendario) || empty($nombre) || empty($email) || empty($telefono) || empty($cargo))
  {

      echo 'error_1'; // Un campo esta vacio y es obligatorio
  
    }else{
      if($clave1 == $clave2){
  
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
          
          require_once('../../model/asesor.php');
          
          $asesor = new Asesor();
    
          
          $asesor -> registroAsesor($nombre, $calendario, $id, $email, $telefono, $cargo, $clave1);
          
    
        }else{
          echo 'error_4';
        }
      }else{
        echo 'error_5';
      }
  
    }
?>