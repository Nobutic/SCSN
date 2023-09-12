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

include_once '../../model/cartera.php';
$objeto = new Cartera();
$cartera = $objeto->listarCartera();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <title>Cartera :: INSU TI</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
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

                    <div class="row">

                        <div class="col-md-9">

                            <h3>Cartera</h3>
                            <hr />

                        </div>
                        <div class="col-md-1">
                            <a type="button" href="filtroSaldo.php" class="btn btn-danger mb-2">Descargar Reporte</a>
                        </div>

                    </div>
                    <br />

                    <div class="row">
                        <table id="tablaDatos" class="table table-sm table-striped table-bordere">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#FACTURA</th>
                                    <th>CLIENTE</th>
                                    <th>TIEMPO</th>
                                    <th>FECHA FACTURA</th>
                                    <th>FECHA VENCIMIENTO</th>
                                    <th>VALOR FACTURA</th>
                                    <th>ABONOS</th>
                                    <th>SALDO</th>
                                    <th><i class="fa-solid fa-gears"></i> ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($dato = $cartera->fetch_assoc()) { ?>
                                    <!-- Si el saldo es igual a cero no mostrar esa factura -->
                                    <tr>
                                        <td><?php echo $dato['id_compra'] ?></td>
                                        <td><?php echo $dato['id_factura'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['tiempo'] ?></td>
                                        <td><?php echo $dato['fecha'] ?></td>
                                        <td><?php echo $dato['fecha_ven'] ?></td>
                                        <td>$<?php echo number_format($dato['valor']) ?></td>
                                        <td>$
                                            <?php echo number_format($dato['sum_abono']) ?> <a type="button" data-bs-toggle="modal" data-bs-target="#abonos<?php echo $dato['id_compra'] ?>"><i class="fa fa-eye"></i></a>

                                        </td>
                                        <?php
                                        if ($dato['valor'] - $dato['sum_abono'] > 0) {
                                            echo '<td class="table-danger" align="center">$' . number_format($saldo = $dato['valor'] - $dato['sum_abono']) . '</td>';
                                        } else {
                                            echo '<td class="table-success" align="center">$' . number_format($saldo = $dato['valor'] - $dato['sum_abono']) . '</td>';
                                        } ?>
                                        <td>
                                            <?php
                                            if ($dato['valor'] - $dato['sum_abono'] > 0) { ?>
                                                <button class="btn btn-success"><i class="fa-solid fa-hand-holding-medical" data-bs-toggle="modal" data-bs-target="#abonar<?php echo $dato['id_compra'] ?>"></i></button>
                                            <?php } ?>
                                            <button class="btn btn-info"><i class="fa fa-edit" data-bs-toggle="modal" data-bs-target="#editarFactura<?php echo $dato['id_compra'] ?>"></i></button>
                                            <?php include('modalCartera.php') ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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

    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/sweetalert.min.js"></script>
    <script src="../../resources/js/operaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#tablaDatos').DataTable({
                searching: true,
                ordering: true,
                paging: true,
                responsive: true,
                "lenguage": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });


            $('.solo-numero').keyup(function() {
                this.value = (this.value + '').replace(/[^0-9\.-]/g, '');
            });

            
            //$('#editar_Factura').click(function() {

                //alert('funcion click');
                // var datosFactura = $('#formulario_eFactura').serialize();

                // $.ajax({
                // method: 'POST',
                // url: '../../controller/admin/editarFactura.php',
                // data: datosFactura,
                // beforeSend: function(){
                //     $('#load').show();
                // },
                // success: function(res){
                //     $('#load').hide();

                //     if(res == 'error_1'){
                //     swal({
                //         title: 'Por favor llenar los campos vacios', 
                //         type: 'error'
                //     });
                //     }else if(res == 'editar'){
                //     swal({ 
                //         title: "Actualización exitosa",
                //         type: "success" 
                //         },
                //         function(){
                //         window.location = 'cartera.php';
                //     });
                //     }else{
                //     window.location.href = res ;
                //     }

                // }
                // });
            //});

        });
    </script>

</body>

</html>