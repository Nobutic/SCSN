<?php
    date_default_timezone_set('America/Bogota');
    $fechaActual = date('ym');
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

    include_once '../../model/modulo.php';
    $objeto1 = new Modulo();
    $modulo = $objeto1->listarModulo();

    include_once '../../model/tipoServicio.php';
    $objeto2 = new TipoServicio();
    $tipoServicio = $objeto2->listarTipoS();

    include_once '../../model/cliente.php';
    $objeto4 = new Cliente();
    $clientes = $objeto4->listarClientes();

    include_once '../../model/tarea.php';
    $objeto6 = new Tarea();
    $tarea = $objeto6->listarTickets();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <title>Editar Control :: INSU TI</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link href="../../resources/css/styles.css" rel="stylesheet" />
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
                    <h3>Control de Servicio</h3>
                    <hr/>
                </div>
            </div>

            <!-- Formulario diligenciar el control de servicio -->
            <form id="formulario_eControl">
                <div class="card">
                    <div class="card-header">
                        <h5>Datos del cliente</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-6">
                                <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $_POST['nombreCliente'] ?>" readonly>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#busqueda">Buscar Cliente</button>
                            </div>
                            
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-6">
                                <label>Identificacion</label>
                                <input type="text" class="form-control" name="id" id="id" value="<?php echo $_POST['nit'] ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label>Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $_POST['telefono'] ?>" readonly>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="col-6">
                                <label>Direccion</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $_POST['direccion'] ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label>Ciudad</label>
                                <input type="text" class="form-control"  name="ciudad" id="ciudad" value="<?php echo $_POST['ciudad'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <div class="card">
                    <div class="card-header">
                        <h5>Fecha - Tiempo</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="<?php echo $_POST['fecha'] ?>" required>
                            </div>
                            <div class="col-6">
                                <label>Consecutivo</label>
                                <input type="text" class="form-control" name="consecutivo" value="<?php echo $_POST['consecutivo'] ?>" readonly>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <label>Hora Inicio</label>
                                <input type="time" class="form-control" name="hInicio" value="<?php echo $_POST['hInicio'] ?>" required>
                            </div>
                            <div class="col-6">
                                <label>Hora Final</label>
                                <input type="time" class="form-control" name="hFinal" value="<?php echo $_POST['hFinal'] ?>" required>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-6">
                                <label>Tiempo de asesoria</label>
                                <input type="number" class="form-control" name="tiempoAsesoria" placeholder="Tiempo en minutos" value="<?php echo $_POST['tiempo'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <?php $id_modulo = $_POST['modulo']; 
                      $id_servicio = $_POST['servicio'];
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Módulo</laber>
                                <select class="form-select" name="modulo">
                                    <option value="">Seleccione modulo</option>
                                    <?php while($mod = $modulo->fetch_assoc()){ ?>
                                    <option value="<?php echo $mod['id'] ?>" <?php if ($mod['id']==$id_modulo) {echo ' selected="selected"';}?>><?php echo $mod['nombre'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Servicio</laber>
                                <select class="form-select" name="servicio">
                                    <option value="">Seleccione servicio</option>
                                    <?php while($tipoS = $tipoServicio->fetch_assoc()){ ?>
                                        <option value="<?php echo $tipoS['id']; ?>" <?php if ($tipoS['id']==$id_servicio) {echo ' selected="selected"';}?>><?php echo $tipoS['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="card">
                    <div class="card-header">
                        <h5>Descripción</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label>Actividades desarrolladas</label>
                                <textarea class="form-control" name="actividades" rows="5"><?php echo $_POST['actividades'] ?></textarea>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-12">
                                <label>Pendientes Asesor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select class="form-select col-6" name="idTicket" required>
                                    <option value="">Seleccione ticket</option>
                                    <?php while($ticket = $tarea->fetch_assoc()){ ?>
                                        <option value="<?php echo $ticket['id']; ?>" <?php if ($ticket['id']==$_POST['id_ticket']) {echo ' selected="selected"';}?>><?php echo $ticket['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                                <br/>
                        <div class="row">
                            <div class="col-12">
                                <textarea class="form-control" name="pAsesor" rows="5" placeholder="Detallar las actividades pendientes "><?php echo $_POST['descTarea'] ?></textarea>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-12">
                                <label>Pendientes Cliente</label>
                                <textarea class="form-control" name="pCliente" rows="5"><?php echo $_POST['tarea_cliente'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                
                <input type="text" name="idAsesor" value="<?php echo $_SESSION['id']?>" hidden>
                <div class="card">
                    <h5 class="card-header">Servicio recibido por</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $_POST['pRecibe'] ?>">
                            </div>
                            <div class="col-6">
                                <label>Cargo</label>
                                <input type="text" class="form-control" name="cargo" value="<?php echo $_POST['cargo'] ?>">
                            </div>
                            <div class="col-6">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $_POST['email'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <!-- Animacion de load (solo sera visible cuando el cliente espere una respuesta del servidor )-->
                <div class="row" id="load" hidden="hidden">
                    <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                    <img src="../../resources/img/load.gif" width="100%" alt="">
                    </div>
                    <div class="col-xs-12 center text-accent">
                    <span>Validando información...</span>
                    </div>
                </div>
                <!-- Fin load -->
                                        
            
                <!-- boton enviar  los datos mediante ajax -->
                <div class="col-12">
                    <a href="listaControles.php" class="btn btn-danger">Cancelar</a>
                    <button type="button" class="btn btn-primary" id="editarControl">Actualizar</button>
                </div>
            </form>
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

   <!-- Modal -->
   <div class="modal fade" id="busqueda">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clientes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tableCliente" class="table table-sm table-striped table-bordere">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Identificacion</th>
                                <th>Saldo </th>
                                <th>Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($client = $clientes->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $client['n'] ?></td>
                                <td><?php echo $client['nombre'] ?></td>
                                <td><?php echo $client['id'] ?></td>
                                <td><?php echo $client['saldo']?></td>
                                <td style="text-align:center">
                                    <a class="btn btn-info" onclick="seleccionar(<?php echo $client['id'] ?>,'<?php echo $client['nombre'] ?>', <?php echo $client['telefono'] ?>, '<?php echo $client['direccion'] ?>', '<?php echo $client['ciudad'] ?>')"><i class='fa fa-plus-circle' aria-hidden='true'></i></a>    
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
    <!-- Fin del modal -->

    
    <script src="../../resources/js/jquery.js"></script>
    <script src="../../resources/js/scripts.js"></script>
    <script src="../../resources/js/sweetalert.min.js"></script>
    <script src="../../resources/js/operaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tableCliente').DataTable({
                scrollY: '200px',
                scrollCollapse: true,
                paging: false,
                searching:true,
                ordering:true,
                paging:true,
                responsive:true,
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });

          
        });

        function seleccionar(id, nombre, telefono, direccion, ciudad){
            $('#id').val(id);
            $('#cliente').val(nombre);
            $('#telefono').val(telefono);
            $('#direccion').val(direccion);
            $('#ciudad').val(ciudad);
            $('#busqueda').modal('hide');
        }
        
    </script>
  </body>
</html>