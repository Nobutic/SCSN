<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Centro Soporte</title>

    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="resources/css/sweetalert.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="icon" href="resources/img/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="resources/img/favicon.png" sizes="180x180" />


  </head>
  <body>
  <div class="container">
      <div class="row">
        
        <div class="col-xs-12 col-md-4 col-md-offset-4">
          
          <!-- Margen superior (css personalizado )-->
          <div class="spacing-1"></div>

          <div class="center">
            <img  src="resources/img/logo.png" width="378" height="139">
          </div>
        </div>
      </div>
    </div>

    <script src="resources/js/jquery.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/sweetalert.min.js"></script>
    <script type="text/javascript">
      swal({ 
            title: "Tiempo de sesión expirada",
            text: "Se ha cerrado sesión por inactividad",
            type: "warning" 
          },
          function(){
            window.location.href = 'index.php';
        });
    </script>
  </body>
</html>
