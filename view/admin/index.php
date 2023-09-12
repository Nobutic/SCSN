<?php

session_start();

// Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: ../../index.php');
} else {
    if ((time() - $_SESSION['tiempo']) > 3600) {
        header('location: ../../cerrarSesionInactividad.php');
    }
}

$_SESSION['tiempo'] = time();

include_once '../../model/asesor.php';
$objeto = new Asesor();
$asesor = $objeto->numAsesores();

include_once '../../model/cliente.php';
$objeto2 = new Cliente();
$cliente = $objeto2->numClientes();

include_once '../../model/servicio.php';
$objeto3 = new Servicio();
$servicio = $objeto3->numServicios();
$his_servicio = $objeto3->numControl();

include_once '../../model/usuario.php';
$objeto4 = new Usuario();
$usuario = $objeto4->numUsuarios();

include_once '../../model/tarea.php';
$objeto5 = new Tarea();
$tickets = $objeto5->numTareas();

include_once '../../model/tipoServicio.php';
$objeto6 = new TipoServicio();
$tipoServicio = $objeto6->numTipoServicios();

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
    <link rel="stylesheet" href="../../resources/css/sweetalert.css">
    <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/scsn/resources/img/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="/scsn/resources/img/favicon.png" sizes="180x180" />
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
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="listUser.php">
                                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                    Usuarios
                                </a>
                                <a class="nav-link" href="cliente.php">
                                    <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                                    Clientes
                                </a>
                                <a class="nav-link" href="asesor.php">
                                    <div class="sb-nav-link-icon"><i class="fa fa-users-gear"></i></div>
                                    Asesores
                                </a>
                                <a class="nav-link" href="ticket.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bars-progress"></i></div>
                                    Tickets
                                </a>
                                <a class="nav-link" href="modulo.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                                    Modulos
                                </a>
                                <a class="nav-link" href="tipoServicio.php">
                                    <div class="sb-nav-link-icon"><i class="fa fa-gear"></i></div>
                                    Tipos de servicios
                                </a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">Más</div>
                        <a class="nav-link" href="agendaServicio.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-calendar"></i></div>
                            Agendar Servicio
                        </a>
                        <a class="nav-link" href="tareas.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-list-check"></i></div>
                            Tareas pendiente
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
                                    Pendientes por aprobar
                                </a>
                                <a class="nav-link" href="controlServicio.php">
                                    <div class="sb-nav-link-icon"><i class="fa fa-file-pen"></i></div>
                                    Diligenciar Control
                                </a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Informes</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa fa-clipboard-list"></i></div>
                            Generar informes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="todosServicio.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                                    Servicios
                                </a>
                                <a class="nav-link" href="servicio.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                                    Servicios por empresa
                                </a>
                                <a class="nav-link" href="his_movimiento.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                                    Movimientos
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link" href="cartera.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-wallet"></i></div>
                            Cartera
                        </a>
                        <a class="nav-link" href="historial_control.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-check-to-slot"></i></div>
                            Historial Controles
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <img width="315" height="116" src="/SCSN/resources/img/logo.png">
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Centro de Soporte</li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="listUser.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:account-group" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $usuario ?></h4>
                                                    <span>Usuarios</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="cliente.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:account-cash" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $cliente ?></h4>
                                                    <span>Clientes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="asesor.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:account-cog" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $asesor ?></h4>
                                                    <span>Asesores</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="listaControles.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:file-cog" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $servicio ?></h4>
                                                    <span>Controles Pendientes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-dark text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="tareas.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:file-question" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $tickets ?></h4>
                                                    <span>Tareas pendientes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link text-white" href="historial_control.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="mdi:note-check" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $his_servicio ?></h4>
                                                    <span>Servicios</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-black text-white mb-4">
                                <div class="card-content">
                                    <a type="button" class="nav-link btn btn-primary text-white" href="tipoServicio.php">
                                        <div class="card-body">
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="align-self-center">
                                                    <span class="iconify" data-icon="eos-icons:rotating-gear" data-width="50"></span>
                                                </div>
                                                <div class="media-body text-right">
                                                    <h4><?php echo $tipoServicio ?></h4>
                                                    <span>Tipos de servicios</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <canvas id="grafico"></canvas> -->
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
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/SCSN/resources/js/scripts.js"></script>
    <script src="/SCSN/resources/js/jquery.js"></script>
    <script src="/SCSN/resources/js/sweetalert.min.js"></script>
    <script src="/SCSN/resources/js/operaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Realizar la llamada AJAX para obtener los datos del backend
        $.ajax({
            url: '../../controller/admin/grafico.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Obtener los datos de la respuesta del backend
                var datos = response;

                // Crear un array para almacenar las etiquetas del eje x (meses) y los valores del eje y (totales)
                var labels = [];
                var values = [];

                // Recorrer los datos y extraer las etiquetas y los valores
                for (var i = 0; i < datos.length; i++) {
                    labels.push(datos[i].mes);
                    values.push(datos[i].total);
                }

                // Obtener el elemento del gráfico en el HTML
                var ctx = document.getElementById('grafico').getContext('2d');

                // Crear el gráfico de barras utilizando Chart.js
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos del backend:', error);
            }
        });
    </script>
</body>

</html>