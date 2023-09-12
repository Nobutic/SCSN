<?php

  session_start();

  // isset verifica si existe una variable o eso creo xd
  if(isset($_SESSION['id'])){
    header('location: controller/redirec.php');
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <title>Inicio de sesion :: INSU TI</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/sweetalert.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="icon" href="resources/img/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="resources/img/favicon.png" sizes="180x180" />


  </head>
  <body>

    <!-- Formulario Login -->
    <div class="container">
      <div class="row">
        
        <div class="col-xs-12 col-md-4 col-md-offset-4">
          
          <!-- Margen superior (css personalizado )-->
          <div class="spacing-1"></div>
          <div class="center">
            <img  src="resources/img/logo.png" width="378" height="139">
          </div>
          <!-- Estructura del formulario -->
          <fieldset>

            <legend class="center">Inicio de sesión</legend>
          
            <!-- Caja de texto para usuario -->
            <label class="sr-only" for="user">Email</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
              <input type="text" class="form-control" id="user" placeholder="Ingrese su email">
            </div>

            <!-- Div espaciador -->
            <div class="spacing-2"></div>

            <!-- Caja de texto para la clave-->
            <label class="sr-only" for="clave">Contraseña</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-lock"></i></div>
              <input type="password" autocomplete="off" class="form-control" id="clave" placeholder="Ingresa su contraseña">
            </div>

            <!-- Animacion de load (solo sera visible cuando el cliente espere una respuesta del servidor )-->
            <div class="row" id="load" hidden="hidden">
              <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                <img src="resources/img/load.gif" width="100%" alt="">
              </div>
              <div class="col-xs-12 center text-accent">
                <span>Validando información...</span>
              </div>
            </div>
            <!-- Fin load -->

            <!-- boton #login para activar la funcion click y enviar el los datos mediante ajax -->
            <div class="row">
              <div class="col-xs-8 col-xs-offset-2">
                <div class="spacing-2"></div>
                <button type="button" class="btn btn-primary btn-block" name="button" id="login">Iniciar sesion</button>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>

    <!-- / Final Formulario login -->

    <!-- Jquery -->
    <script src="resources/js/jquery.js"></script>
    <!-- Bootstrap js -->
    <script src="resources/js/bootstrap.min.js"></script>
    <!-- SweetAlert js -->
    <script src="resources/js/sweetalert.min.js"></script>
    <!-- Js personalizado -->
    <script src="resources/js/operaciones.js"></script>
  </body>
</html>
