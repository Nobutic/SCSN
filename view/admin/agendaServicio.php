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


// listado de eventos de google calendar
$m = ''; //for error messages
$id_calendar = ''; //id event created 
$link_calendar = '';

if (isset($_POST['addCalendar'])) {

    $titulo = $_POST['titulo'];

    date_default_timezone_set('America/Bogota');
    include_once '../../resources/lib/google-api-php-client/vendor/autoload.php';

    //configurar variable de entorno / set enviroment variable
    putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->setScopes(['https://www.googleapis.com/auth/calendar']);


    try {

        $service = new Google_Service_Calendar($client);
        $calendar = new Google_Service_Calendar_Calendar();
        $calendar->setSummary($titulo);
        $calendar->setTimeZone('America/Bogota');

        $createdCalendar = $service->calendars->insert($calendar);

        $id_calendar = $createdCalendar->getId();
        $link_calendar = $createdCalendar->gethtmlLink();
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
    <title>Servicio :: INSU TI</title>
    <link href="../../resources/css/styles.css" rel="stylesheet" />
    <script src="../../resources/js/jquery.js"></script>
    <link rel="stylesheet" href="../../resources/css/sweetalert.css">
    <script src="https://use.fontawesome.com/releases/v6.2.1/js/all.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://fullcalendar.io/releases/core/4.0.2/main.min.css'>
    <link rel='stylesheet' href='https://fullcalendar.io/releases/daygrid/4.0.1/main.min.css'>
    <link rel='stylesheet' href='https://fullcalendar.io/releases/list/4.0.1/main.min.css'>
    <link rel="icon" href="../../resources/img/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="../../resources/img/favicon.png" sizes="180x180" />
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        }

        #calendar {
            max-width: 1000px;
            margin: 40px auto;
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
                        <?php
                        if (isset($_POST['addCalendar'])) {
                            if ($m != '') {
                        ?>
                                <script type="text/javascript">
                                    alert("Error :<?php echo $m;   ?>");
                                </script>
                            <?php
                            } elseif ($id_calendar != '') {
                            ?>
                                <script type="text/javascript">
                                    alert("CALENDARIO CREADO CON EXITO <?php echo $id_calendar ?> link: <?php $link_calendar ?>");
                                </script>
                                <!-- $html_body2.='<label class="control-form">EVENTO CREADO CON EXITO</label><br>';
                            $html_body2.='<label class="control-form">ID EVENTO :'.$id_event.'</label><br>';
                            $html_body2.='<a href="'.$link_event.'">LINK</a>'; -->

                            <?php
                            } else { ?>
                                <script type="text/javascript">
                                    alert("OPERACION FALLIDA");
                                </script>
                        <?php }
                        } ?>

                        <div id="calendar"></div>
                        <div id="dialog" title="My dialog" style="display:none">
                            <form>
                                <fieldset>
                                    <label for="Id">Titulo</label>
                                    <input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all">
                                    <label for="Id">Descripcion</label>
                                    <input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all">
                                </fieldset>
                            </form>
                        </div>
                        <!-- <iframe src="https://calendar.google.com/calendar/embed?src=7d24de5bad89ed26c5b1a6b0d8c5d4be969d17892a3eadb33481397ade92bda3%40group.calendar.google.com&ctz=America%2FBogota" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe> -->

                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var calendarEl = document.getElementById('calendar');

                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                locale: 'es',
                                initialView: 'dayGridMonth',
                                plugins: ['dayGrid', 'list', 'googleCalendar'],
                                header: {
                                    left: 'prev,next today nEvento nCalendario',
                                    center: 'title',
                                    right: 'dayGridMonth, listMonth'
                                },

                                customButtons: {
                                    nEvento: {
                                        text: 'Añadir Evento',
                                        click: function() {
                                            window.location = "agregarEvento.php";
                                        }
                                    }

                                },

                                eventLimit: true, // para todas las vistas que no sean TimeGrid
                                views: {
                                    timeGrid: {
                                        eventLimit: 6 // ajustar a 6 solo para timeGridWeek/timeGridDay
                                    }
                                },


                                displayEventTime: false, // no mostrar la columna de tiempo en la vista de lista

                                // ¡ESTA CLAVE NO FUNCIONARÁ EN PRODUCCIÓN!
                                // Para crear su propia clave API de Google, siga las instrucciones aquí:
                                // http://fullcalendar.io/docs/google-calendar/
                                // googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
                                googleCalendarApiKey: 'AIzaSyDKO6FTCD8AsRE7819j_MJ3CHOkibl8c2g',

                                eventSources: [{
                                        googleCalendarId: 'jopsanrodriguezgonzalez@gmail.com',
                                        className: 'Jopsan',
                                        color: 'maroon'
                                    },
                                    {
                                        googleCalendarId: 'renteriaandy8@gmail.com'
                                    }
                                ],
                                //calendario de prueba

                                eventClick: function(arg) {

                                    // abre eventos en una ventana emergente
                                    window.open(arg.event.url, '_blank', 'width=700,height=600');

                                    // evita que la pestaña actual navegue
                                    arg.jsEvent.preventDefault();
                                }
                            });

                            calendar.render();
                        });
                    </script>
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
    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/operaciones.js"></script>
    <script src="../../resources/js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src='https://fullcalendar.io/releases/core/4.0.2/main.min.js'></script>
    <script src='https://fullcalendar.io/releases/daygrid/4.0.1/main.min.js'></script>
    <script src='https://fullcalendar.io/releases/list/4.0.1/main.min.js'></script>
    <script src='https://fullcalendar.io/releases/google-calendar/4.0.1/main.min.js'></script>
    <script src="../../assets/demo/chart-area-demo.js"></script>
    <script src="../../assets/demo/chart-bar-demo.js"></script>
</body>

</html>