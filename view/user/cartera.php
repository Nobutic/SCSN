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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
        <link href="../../resources/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Mi Historial de Cartera <i class="fa fa-wallet"></i></h3>
                                <hr/>
                            </div>
                        </div>
                        
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
                                        <input type="text" class="form-control" name="idCliente" id="idCliente" value="<?php echo ucfirst($_SESSION['id']); ?>" hidden>

                                        <div class="col" style="text-align: left;">
                                            <span class="btn btn-dark mb-2" id="filtro">Filtrar</span>
                                            <!-- <button type="submit" class="btn btn-danger mb-2">Descargar Reporte</button> -->
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
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
                            <div class="text-muted">INSU TI SAS COPYRIGHTS &copy; ALL RIGHTS RESERVED BY NOBUTIC SAS</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/resources/js/scripts.js"></script>
        <script src="/SCSN/resources/js/jquery.js"></script>
        <script src="/SCSN/resources/js/sweetalert.min.js"></script> 
        <script src="/SCSN/resources/js/operaciones.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/SCSN/assets/demo/chart-area-demo.js"></script>
        <script src="/SCSN/assets/demo/chart-bar-demo.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
        <script type="text/javascript">

            $("#filtro").on("click", function(e){
                e.preventDefault();
                $('#load').show();

                var mes = $('#mes').val();
                var anio = $('#anio').val();
                var idCliente =$('#idCliente').val();
                console.log(mes + '' + anio + '' + idCliente);

                if(mes !="" && anio !="" && idCliente !=""){
                    $.post("filtroCartera.php", {mes, anio, idCliente}, 
                    function (data) {
                        $("#tableCartera").hide();
                        $(".resultadoFiltro").html(data);
                        $('#load').hide();
                    });  
                }else if(mes ==""){
                    $(".resultadoFiltro").html('<p style="color:red;  font-weight:bold;">Debe elegir el mes</p>');
                }else{
                    $(".resultadoFiltro").html('<p style="color:red;  font-weight:bold;">Debe elegir el año</p>');
                }
            } );
        </script>
    </body>
</html>