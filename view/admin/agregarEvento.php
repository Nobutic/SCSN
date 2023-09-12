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
$asesor = $objeto->listarAsesores();


// listado de eventos de google calendar
$m = ''; //for error messages
$id_event = ''; //id event created 
$link_event;

// agregar un nuevo evento
if (isset($_POST['agendar'])) {


    date_default_timezone_set('America/Bogota');
    include_once '../../resources/lib/google-api-php-client/vendor/autoload.php';

    //configurar variable de entorno / set enviroment variable
    putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->setScopes(['https://www.googleapis.com/auth/calendar']);

    //define id calendario
    //$id_calendar='7d24de5bad89ed26c5b1a6b0d8c5d4be969d17892a3eadb33481397ade92bda3@group.calendar.google.com';
    $id_calendar = $_POST['calendario'];



    $datetime_start = $_POST['date_start'];
    $time_start     = $_POST['time_start'];
    $time_end       = $_POST['timefinally_start'];


    $time_start     = date("c", strtotime($datetime_start . $time_start));
    $time_end       = date("c", strtotime($datetime_start . $time_end));


    $nombre         = (isset($_POST['titulo'])) ? $_POST['titulo'] : ' xyz ';
    $descripcion    = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : ' xyz ';
    // $asesor=$_POST['asesor'];
    try {

        //instanciamos el servicio
        $calendarService = new Google_Service_Calendar($client);



        //parámetros para buscar eventos en el rango de las fechas del nuevo evento
        $optParams = array(
            'orderBy' => 'startTime',
            'maxResults' => 20,
            'singleEvents' => TRUE,
            'timeMin' => $time_start,
            'timeMax' => $time_end,
        );

        //obtener eventos 
        $events = $calendarService->events->listEvents($id_calendar, $optParams);

        //obtener número de eventos 
        $cont_events = count($events->getItems());

        //crear evento si no hay eventos
        if ($cont_events == 0) {

            $event = new Google_Service_Calendar_Event();
            $event->setSummary($nombre);
            $event->setDescription($descripcion);

            //fecha inicio
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($time_start);
            $event->setStart($start);

            //fecha fin
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($time_end);
            $event->setEnd($end);

            // $attendees = array();

            // // Agregar los Participantes
            // $attendee = new Google_Service_Calendar_EventAttendee();
            // $attendee->setEmail($asesor);
            // $attendees[] = $attendee;

            // $event->attendees = $attendees;


            $createdEvent = $calendarService->events->insert($id_calendar, $event);
            $id_event = $createdEvent->getId();
            $link_event = $createdEvent->gethtmlLink();
        } else {
            $m = "<script type='text/javascript'>
                        alert('Hay " . $cont_events . " eventos en ese rango de fechas');
                        window.location='agendaServicio.php';
                    </script>";
        }
    } catch (Google_Service_Exception $gs) {

        $m = json_decode($gs->getMessage());
        $m = $m->error->message;
    } catch (Exception $e) {
        $m = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <title>Agenda de Servicios :: INSU TI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <link href="../../resources/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/esm/index.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
    <link rel="icon" href="../../resources/img/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="../../resources/img/favicon.png" sizes="180x180" />
    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/sweetalert.min.js"></script>
    <style type="text/css">
        #form_event {
            background-color: #fff;
            margin: 0% 5%;
            width: 75%;
            border: 2px solid;
            padding: 15px;
        }

        #form_nEvent {
            background-color: #fff;
            margin: 0% 5%;
            width: 70%;
            border: 2px solid;
            padding: 15px;
        }

        @media screen AND (max-width: 480px) {
            form {
                margin: 0px 3%;
                width: 94%;
            }
        }
    </style>
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
                                <a class="nav-link" href="#">
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
                        <div class="col-md-12">
                            <h3>Nuevo Evento</h3>
                            <hr />
                        </div>
                    </div>
                    <br />

                    <div class="row">

                        <?php
                        if (isset($_POST['agendar'])) {
                            if ($m != '') {
                        ?>
                                <label class="control-form">Error :<?php echo $m;   ?></label>
                            <?php
                            } elseif ($id_event != '') {
                            ?>
                                <script type="text/javascript">
                                    swal({
                                            title: "EVENTO CREADO CON EXITO",
                                            type: "success"
                                        },
                                        function() {
                                            window.location = 'agendaServicio.php';
                                        });
                                </script>
                                <!-- $html_body2.='<label class="control-form">EVENTO CREADO CON EXITO</label><br>';
                        $html_body2.='<label class="control-form">ID EVENTO :'.$id_event.'</label><br>';
                        $html_body2.='<a href="'.$link_event.'">LINK</a>'; -->

                            <?php
                            }
                            ?><br>
                            <!-- <button type="button" class="btn btn-primary btn-block" onclick="reload();">Atrás</button> -->

                        <?php
                        } else {
                        ?>
                            <form id="form_nEvent" action="" method="POST">
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label>Titulo</label>
                                            <input type="text" class="form-control " name="titulo" placeholder="Ingrese el titulo" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label>Descripcion</label>
                                            <textarea type="text" class="form-control " rows="7" name="descripcion" placeholder="Ingrese la descripcion" autocomplete="off"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Fecha</label>
                                            <input type='date' class='form-control' name='date_start' autocomplete='off' required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Hora Inicio</label>
                                            <input type="time" class="form-control" name="time_start" autocomplete="off" required />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Hora Final</label>
                                            <input type="time" class="form-control" name="timefinally_start" autocomplete="off" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label>Asesor</label>
                                            <select class="form-select" name="calendario">
                                                <option value="">Seleccione asesor</option>
                                                <?php while ($idA = $asesor->fetch_assoc()) { ?>
                                                    <option value="<?php echo $idA['calendario']; ?>"><?php echo $idA['nombre']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-danger" onclick="reload();">Atrás</button>
                                        <button type="submit" class="btn btn-primary btn-block" name="agendar">Enviar</button>
                                    </div>
                                </div>
                            </form>

                        <?php
                        } ?>
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
    <!-- / Final Formulario registro -->

    <!-- Jquery -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="../../resources/js/operaciones.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="../../assets/demo/chart-area-demo.js"></script>
    <script src="../../assets/demo/chart-bar-demo.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_events2').DataTable({
                searching: true,
                ordering: true,
                paging: true,
                responsive: true,
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });

        });

        function reload() {
            location.href = "agendaServicio.php";
        }
    </script>
</body>

</html>