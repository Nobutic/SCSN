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

  include_once '../../model/cliente.php';
  $objeto = new Cliente();
  $saldo = $objeto->saldo($_SESSION['id']);
  $ticket = $objeto->ticket($_SESSION['id']);
  $deuda = $objeto->deuda($_SESSION['id']);
  include_once('../../model/servicio.php');
  $objeto = new Servicio();
  $servicio = $objeto-> ultimosRegistros($_SESSION['id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="CRM INSU TI" />
        <meta name="author" content="Nobutic SAS" />
        <title>Centro Soporte :: INSU TI</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
        <link rel="icon" href="/scsn/resources/img/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="/scsn/resources/img/favicon.png" sizes="180x180" />
    </head>
    <body class="sb-nav-fixed"><?php include_once('modalClave.php'); ?>
        <nav class="sb-topnav navbar navbar-expand navbar-insu bg-insu">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Centro Servicios</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar solicitar servicio-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <a href="https://api.whatsapp.com/send?phone=573046063913&text=Solicitud%20de%20servicio" target="_blank" class="btn btn-primary" type="button">Solicitar servicio</a>
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
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                Mi Historial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="servicio.php">
                                        <div class="sb-nav-link-icon"><i class="fa fa-gears"></i></div>
                                        Servicios
                                    </a>
                                    <a class="nav-link" href="ticket.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bars-progress"></i></div>
                                        Tickets
                                    </a>
                                    <a class="nav-link" href="cartera.php">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div>
                                        Cartera
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link" href="ayuda.php">
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
                       <img width="315" height="116" src="/SCSN/resources/img/logo.png">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Centro de Soporte</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="svg-spinners:wifi" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                <h4><?php echo $saldo[0] ?> Minutos</h4>
                                                    <span>Saldo actual</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-black mb-4">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="uil:file-question-alt" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $ticket ?> Espera</h4>
                                                    <span>Ticket</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="ph:currency-circle-dollar-bold" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4>$<?php echo $deuda ?></h4>
                                                    <span>Deuda Cartera</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Ultimos Servicios
                                    </div>
                                    <div class="card-body">
                                        <table id="datatablesServices" class="table table-sm table-striped table-bordere">
                                            <thead>
                                                <tr>
                                                    <th># CONTROL</th>
                                                    <th><i class="fa-solid fa-calendar-days"></i> FECHA</th>
                                                    <th>MODULO</th>
                                                    <th>SERVICIO</th>
                                                    <th>HORA INCIO</th>
                                                    <th>HORA FINAL</th>
                                                    <th>TIEMPO SERVICIO</th>
                                                    <th>ASESOR</th>
                                                    <th>RECIBE SERVICIO</th>
                                                    <th><i class="fa-solid fa-gears"></i> Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                while($dato = $servicio->fetch_assoc()){ ?>
                                                <tr>
                                                    
                                                    <td><?php echo $dato['id_servicio'] ?></td>
                                                    <td><?php echo $dato['fecha'] ?></td>
                                                    <td><?php echo $dato['modulo'] ?></td>
                                                    <td><?php echo $dato['servicio'] ?></td>
                                                    <td><?php echo $dato['hora_inicio'] ?></td>
                                                    <td><?php echo $dato['hora_fin'] ?></td>
                                                    <td><?php echo $dato['tiempo'].' Minutos' ?></td>  
                                                    <td><?php echo $dato['asesor'] ?></td>         
                                                    <td><?php echo $dato['persona_recibe'] ?></td>

                                                    <td style="text-align:center">
                                                        <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detalle<?php echo $dato['id_servicio'] ?>"><i class="fa fa-eye"></i></a> 
                                                        <?php include('modalDetalleS.php') ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center  small">
                            <div class="text-muted">INSU TI SAS COPYRIGHTS &copy; ALL RIGHTS RESERVED BY NOBUTIC SAS </div>
                            <a class="nav-link" href="https://www.facebook.com/INsutic" target="_blank"><span class="iconify" data-icon="logos:facebook" style="font-size: 30px;"></span></a>
                            <a class="nav-link" href="https://www.instagram.com/insuti_s.a.s/" target="_blank"><span class="iconify" data-icon="logos:instagram-icon" style="font-size: 30px;"></span></a>
                        </div>
                        
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/SCSN/resources/js/jquery.js"></script>
        <script src="/SCSN/resources/js/scripts.js"></script>
        <script src="/SCSN/resources/js/sweetalert.min.js"></script> 
        <script src="/SCSN/resources/js/operaciones.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                $('#datatablesServices').DataTable({
                    searching:true,
                    ordering:true,
                    paging:true,
                    responsive:true,
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
            });
        </script>
    </body>
</html>