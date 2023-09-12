<?php
  
    session_start();

    // Validamos que exista una session y ademas que el cargo que exista sea igual a 3 (Asesor)
    if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 3){
    header('location: ../../index.php');
    }else{
    if((time() - $_SESSION['tiempo']) > 3600){
        header('location: ../../cerrarSesionInactividad.php');
    }
    }

    $_SESSION['tiempo'] = time();

    include_once '../../model/cliente.php';
    $objeto = new Cliente();
    $clientes = $objeto->listarClientes();
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

                    <div class="row">

                        <div class="col-md-12">

                            <h3>Informe de Pendientes</h3>
                            <hr />

                        </div>

                    </div>
                    <br />

                    <div class="row">
                        <div class="col-md-12 text-center mt-5">
                            <form action="descargarReporte.php" method="post">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="mes" id="mes" class="form-select" required>
                                            <option value="">Seleccione mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>


                                    <div class="col-md-2">
                                        <select name="anio" id="anio" class="form-select" required>
                                            <option value="">Seleccione año</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <div class="input-group">
                                            <!-- <input type="text" class="form-control" id="idCliente" name="idCliente" placeholder="Nombre cliente" required/> -->
                                            <input id="idCliente" id="idCliente" name="idCliente" value="" hidden type="text" />
                                            <input ReadOnly="true" class="form-control text-box single-line" id="nombreCliente" name="nombreCliente" type="text" value="" placeholder="Seleccione cliente" required/>
                                            <span class="field-validation-valid" data-valmsg-for="sCliente" data-valmsg-replace="true"></span>
                                            <a class="btnOption BotonBuscar input-group-text" href="#" data-bs-toggle="modal" data-bs-target="#mClientes"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </div>
                                    </div>


                                    <div class="col" style="text-align: left;">
                                        <span class="btn btn-dark mb-2" id="filtro">Filtrar</span>
                                        <button type="submit" class="btn btn-danger mb-2">Descargar Reporte</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <br/>
                    <div class="table-responsive resultadoFiltro"></div>

                    <div class="row" id="load" hidden="hidden">
                        <div class="col-md-6"></div>
                        <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                            <img src="/scsn/resources/img/load.gif" width="100%" alt="">
                            
                            <span>Validando información...</span>
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
        <div class="modal fade" id="mClientes">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Clientes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="tableControl" class="table table-sm table-striped table-bordere">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Identificacion</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($client = $clientes->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $client['n'] ?></td>
                                    <td><?php echo $client['nombre'] ?></td>
                                    <td><?php echo $client['id'] ?></td>
                                    <td style="text-align:center">
                                        <a class="btn btn-info" data-bs-dismiss="modal" onclick="seleccionar(<?php echo $client['id'] ?>,'<?php echo $client['nombre'] ?>')"><i class='fa fa-plus-circle' aria-hidden='true'></i></a>    
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/resources/js/scripts.js"></script>
        <script src="/SCSN/resources/js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('#tableControl').DataTable({
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
            
                $('#tableTicket').DataTable({
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
            });
            
            let input = document.getElementById("nombreCliente");
            input.onclick = mostrarClientes;


            $("#filtro").on("click", function(e){
                e.preventDefault();
                $('#load').show();

                var mes = $('#mes').val();
                var anio = $('#anio').val();
                var idCliente =$('#idCliente').val();
                console.log(mes + '' + anio + '' + idCliente);

                if(mes =="" ){
                    $(".resultadoFiltro").html('<p style="color:red;  font-weight:bold;">Debe elegir el mes</p>');
                }else if(anio =="" ){
                    $(".resultadoFiltro").html('<p style="color:red;  font-weight:bold;">Debe elegir el año</p>');
                }else if(idCliente ==""){
                    $(".resultadoFiltro").html('<p style="color:red;  font-weight:bold;">Debe seleccionar un cliente</p>');
                }else{
                    $.post("filtro.php", {mes, anio, idCliente}, 
                    function (data) {
                        $("#tableControl").hide();
                        $(".resultadoFiltro").html(data);
                        $('#load').hide();
                    });  
                }
            } );

            function mostrarClientes(){
                $('#mCliente').modal('show');
            }

            function seleccionar(id, nombre){
                $('#idCliente').val(id);
                $('#nombreCliente').val(nombre);
            }
        </script>
    </body>
</html>