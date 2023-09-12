<?php

date_default_timezone_set('America/Bogota');
include_once '../../model/asesor.php';
$objeto = new Asesor();
$asesor = $objeto->listarAsesores();

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


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <title>Asesor :: INSU TI</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="../../resources/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../resources/css/sweetalert.css">
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">
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
                    <br />

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aAdicionar">Nuevo Asesor</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-sm table-striped table-bordere">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Cargo</th>
                                        <th>Tareas pendientes</th>
                                        <th><i class="fa-solid fa-gears"></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($datos = $asesor->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $datos['n'] ?></td>
                                            <td><?php echo $datos['nombre'] ?></td>
                                            <td><?php echo $datos['email'] ?></td>
                                            <td><?php echo $datos['cargo'] ?></td>
                                            <td style="text-align:center">
                                                <a type="button" class="btn btn-info" aria-label="Tareas Pendientes" data-balloon-pos="up" href="tareasAsesor.php?id=<?php echo $datos['id'] ?>&nombre=<?php echo $datos['nombre'] ?>"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td style="text-align:center">
                                                <a type="button" class="btn btn-success" aria-label="Editar" data-balloon-pos="up" data-bs-toggle="modal" data-bs-target="#aEditar<?php echo $datos['id'] ?>"><i class="fa fa-edit"></i></a>
                                                <a type="button" class="btn btn-danger" aria-label="Eliminar" data-balloon-pos="up" href="../../controller/admin/eliminarAsesor.php?id=<?php echo $datos['id'] ?>" onclick="return Confirmation()"><i class="fa fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        include('modalAsesor.php');
                                    }
                                    ?>
                                </tbody>
                            </table>
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

    <div class="modal fade" id="aAdicionar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Asesor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario_asesor">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nombre</label>
                                <input class="form-control" name="nombre" type="text" placeholder="Nombre Completo" autocomplete="off" required>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <label>ID del Calendario</label>
                                <input class="form-control" name="idCalendario" type="text" autocomplete="off" placeholder="idcalendario@group.calendario.google.com" required>
                                <label>Obtenerlo en calendario google</label>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <label>Identificacion</label>
                                <input class="form-control" name="id" type="number" maxlength="10" placeholder="1234567890" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" placeholder="email@dominio.com" autocomplete="off" required>
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-md-6">
                                <label>Telefono</label>
                                <input class="form-control" name="telefono" minlength="7" maxlength="10" type="number" placeholder="1234567890" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label>Cargo</label>
                                <input class="form-control" name="cargo" type="text" placeholder="Asesor" autocomplete="off" required>
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-md-6">
                                <label>Contraseña</label>
                                <input class="form-control" autocomplete="off" name="clave" type="password" required>
                            </div>
                            <div class="col-md-6">
                                <label>Verificar contraseña</label>
                                <input class="form-control" autocomplete="off" name="clave2" type="password" required>
                            </div>
                        </div>
                        <br />

                        <!-- Animacion de load (solo sera visible cuando el cliente espere una respuesta del servidor )-->
                        <div class="row" id="load" hidden="hidden">
                            <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                                <img src="/scsn/resources/img/load.gif" width="100%" alt="">
                            </div>
                            <div class="col-xs-12 center text-accent">
                                <span>Validando información...</span>
                            </div>
                        </div>
                        <!-- Fin load -->

                    </form>
                </div>
                <div class="modal-footer">
                    <label>El usuario queda creado</label>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="agregarAsesor" onclick="agregarAsesor()">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- fin modal agregar -->




    <script src="../../resources/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/operaciones.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                searching: true,
                ordering: true,
                paging: true,
                responsive: true,
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>

</html>