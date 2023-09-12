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
    <title>Centro de Soporte :: INSU TI</title>

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

            <legend class="center"></legend>
            <font color="#fffff"><font face="verdana"><font size="3"><br>
            <b> <font color="#003399">Se ha desconectado de forma correcta</font></b></font><br>
            <font color="#ffffff"><font face="verdana"><font color="#003399" size="2">Para
            volver a la página principal pulse el botón de &nbsp;
            <i>"Aceptar"</i>. </font></font></font></font></font>
            <legend class="center"></legend>
          
            

            <!-- boton #login para activar la funcion click y enviar el los datos mediante ajax -->
            <div class="row">
              <div class="col-xs-8 col-xs-offset-2">
                <div class="spacing-2"></div>
                <a href="index.php" class="btn btn-primary btn-block">Aceptar</a>
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
