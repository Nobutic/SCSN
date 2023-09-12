<?php
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2){
    header('location: ../../index.php');
  }else{
    if((time() - $_SESSION['tiempo']) > 3600){
    header('location: ../../cerrarSesionInactividad.php');
    }
  }
  $_SESSION['tiempo'] = time();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="CRM INSU TI" />
        <meta name="author" content="Nobutic SAS" />
        <title>Centro de Soporte</title>
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
        <link rel="icon" href="../resources/img/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="../resources/img/favicon.png" sizes="180x180" />
    </head>
    <body class="sb-nav-fixed"><?php include_once('modalClave.php'); ?>
        <nav class="sb-topnav navbar navbar-expand navbar-insu bg-insu">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Inicio</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar solicitar servicio-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo ucfirst($_SESSION['nombre']); ?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cambiarContraseña">Cambiar contraseña</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../../controller/cerrarSesion.php">Cerrar sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menú</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home-lg-alt"></i></div>
                                Inicio
                            </a>
                            
                            <a class="nav-link" href="historial.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Mi historial
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                                Servicios
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-question"></i></div>
                                Ayuda en línea
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Solicitar Servicio</h3>
                                <hr/>
                            </div>
                        </div>
                    
                        <iframe src="https://api.whatsapp.com/send?phone=573046063913&text=Solicitud%20de%20servicio" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                    
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">INSU TI SAS COPYRIGHTS &copy; ALL RIGHTS RESERVED BY NOBUTIC SAS</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/resources/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/assets/demo/chart-area-demo.js"></script>
        <script src="/SCSN/assets/demo/chart-bar-demo.js"></script>
    </body>
</html>