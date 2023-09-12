<?php
  
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 3){
    header('location: ../../index.php');
  }else{
    if((time() - $_SESSION['tiempo']) > 3600){
      header('location: ../../cerrarSesionInactividad.php');
    }
  }

  $_SESSION['tiempo'] = time();

  include_once '../../model/servicio.php';
  $objeto = new Servicio();
  $servicio = $objeto->controlAsesor($_SESSION['id']);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="CRM INSU TI" />
        <meta name="author" content="Nobutic SAS" />
        <title>Centro de Soporte</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css">
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../../resources/css/sweetalert.css">
        <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../../resources/img/favicon.png"/>
        <link rel="apple-touch-icon" href="../../resources/img/favicon.png" sizes="180x180" />
    </head>
    <body class="sb-nav-fixed"><?php include_once('modalClave.php'); ?>
        <nav class="sb-topnav navbar navbar-expand navbar-insu bg-insu">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Centro Soporte</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
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
                            <a class="nav-link" href="agenda.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-calendar"></i></div>
                                Agenda
                            </a>
                            <a class="nav-link" href="tareas.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-clipboard-list"></i></div>
                                Tareas
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-file-lines"></i></div>
                                Control de servicio
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="listaControles.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-rectangle-list"></i></div>
                                        Lista de Controles
                                    </a>
                                    <a class="nav-link" href="controlServicio.php">
                                        <div class="sb-nav-link-icon"><i class="fa fa-file-pen"></i></div>
                                        Diligenciar Control
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Informes</div>
                            <a class="nav-link" href="informes.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-clipboard-list"></i></div>
                                Generar informes
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <br/>
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Lista de Controles 
                                </div>
                                <div class="card-body">
                                    <table id="tableServicio" class="cell-border table table-sm table-bordere dataTable no-footer">
                                        <thead>
                                            <tr>
                                                
                                                <th># Servicio</th>
                                                <th>Cliente</th>
                                                <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
                                                <th>Servicio</th>
                                                <th><i class="fa fa-stopwatch"></i> Tiempo</th>
                                                <th>Estado</th>
                                                <th><i class="fa-solid fa-gears"></i> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while($dato = $servicio->fetch_assoc()){ ?>
                                            <tr>
                                                <td><?php echo $dato['id_servicio'] ?></td>
                                                <td><?php echo $dato['cliente'] ?></td>
                                                <td><?php echo $dato['fecha'] ?></td>
                                                <td><?php echo $dato['servicio'] ?></td>
                                                <td><?php echo $dato['tiempo'].' Minutos' ?></td>
                                                <?php if($dato['estado_control'] == 'APROBADO'){ ?>
                                                <td class="text-center"><span class="badge badge-pill badge-success"><?php echo $dato['estado_control'] ?></span></td>
                                                <?php }else{ ?>
                                                <td class="text-center"><span class="badge badge-pill badge-danger"><?php echo $dato['estado_control'] ?></span></td>
                                                <?php } ?>
                                                <td style="text-align:center">
                                                    <a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detalle<?php echo $dato['id_servicio'] ?>"><i class="fa fa-eye"></i></a>
                                                    <?php include 'modalServicio.php'; ?>
                                                </td>
                                            </tr>                                            
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">INSU TI SAS COPYRIGHTS &copy; ALL RIGHTS RESERVED</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/resources/js/scripts.js"></script>
        <script src="/SCSN/resources/js/jquery.js"></script>
        <script src="/SCSN/resources/js/operaciones.js"></script>
        <script src="/SCSN/resources/js/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tableServicio').DataTable({
                    "order": [5, 'desc'],
                    scrollY: '50vh',
                    scrollCollapse: true,
                    paging: false,
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
            });
        </script>
    </body>
</html>