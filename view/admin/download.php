<?php 
include_once('../../model/servicio.php');
$objeto = new Servicio();
$servicio = $objeto-> servicioId($_GET['id']);
$nombreImagen = "../../resources/lib/dompdf/img/logo_formato.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
ob_start(); 
foreach($servicio as $services){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="CRM INSU TI" />
    <meta name="author" content="Nobutic SAS" />
    <link rel="stylesheet" href="../../resources/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="../../resources/css/styles.css" rel="stylesheet" />
  </head>
  <body>
    <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-9"><img src="<?php echo $imagenBase64 ?>" alt="" title="" align="right" width="30%"/>
                        <table border="" rules="rows" width="70%" style="border: 1px solid black;">
                            <tbody>
                                <td>
                                <h3><u> Datos del Cliente</u></h3>
                                <div class="col">
                                <label> Nombre:</label>
                                <label><?php echo $services['cliente']; ?></label>
                                </div>
                                <div class="col">
                                <label> Nit:</label>
                                <label><?php echo $services['id_cliente']; ?></label>
                                </div>
                                <div class="col">
                                <label> Direccion:</label>
                                <label><?php echo $services['direccion'] ?></label>
                                </div>
                                <div class="row">
                                <div class="col">
                                <label> Telefono:</label>
                                <label><?php echo $services['telefono'] ?></label>
                                </div>
                                <div class="col">
                                <label align="right"> Ciudad:</label>
                                <label><?php echo $services['ciudad'] ?></label>
                                </div>
                                </div>
                                </td>
                            </tbody>
                        </table>
                        <label style="width: 50%;"><h3>CONTROL DE SERVICIO &emsp; <?php echo $_GET['id']?></h3></label>
                        <table border="" rules="all" width="70%" style="border: 1px solid black;">
                            <thead>
                                <tr>
                                <th scope="col">FECHA DEL SERVICIO</th>
                                <th scope="col">HORA INICIO:</th>
                                <th scope="col">HORA FINAL:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td ALIGN="center" VALIGN="TOP"><?php echo $services['fecha'] ?></td>
                                <td ALIGN="center" VALIGN="TOP"><?php echo $services['hora_inicio'] ?></td>
                                <td ALIGN="center" VALIGN="TOP"><?php echo $services['hora_fin'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <table border="" rules="all" width="100%" style="border: 1px solid black;">
                        <thead>
                            <tr style="background: #D0CDCD;">
                                <th scope="col">DESCRIPCIÓN</th>
                                <th style="width: 21%;" scope="col">TIEMPO SERVICIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p><?php echo $services['servicio'] ?></p>
                                    <p>ACTIVIDADES DESARROLLADAS</p>
                                    <p><?php echo nl2br($services['actividades']) ?></p>
                                    <p>PENDIENTES ASESOR</p>
                                    <label><?php echo $services['tarea'] ?><br>
                                    <label><?php echo $services['descTarea'] ?></label>
                                    
                                    <p>PENDIENTES CLIENTE</p>
                                    <label><?php echo $services['tarea_cliente'] ?></label>
                                </td>
                                <td ALIGN="center" VALIGN="TOP"><?php echo $services['tiempo'].' Minutos' ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <label><b><u>OBSERVACIONES: En caso de presentar alguna inconformidad con el detalle descrito, es necesario comunicarlo
                    respondiendo al correo que entrega el presente. Luego de 3 días hábiles de enviado este soporte, si no existe
                    notificación alguna se dará la aceptación y se procederá a descontar el tiempo de servicio prestado.</u></b></label>
                    <h4><u>OTRAS CLARIDADES DE NUESTRO SERVICIO</u></h4>
                    <h6>1. El servicio no reemplaza ni disminuye la respondabilidad propia de la organización y/o su Responsabilidad Legal con
                        relación a sus decisiones y actuaciones en materia de gestión Organizacional, legal, Laboral, Financiera, Tributaria y Contable<br>
                        2. Cualquier servicio adicional que la compañía pudiera solicitar y que sea aceptada proveer, será objeto de acuerdos escritos por separado<br>
                        3. Los servicios aquí propuestos complementan y apoyan el servicio de Soporte Técnico relacionado con el Software Helisa, No pretenden reemplazar
                        ni disminuir la responsabilidad de quienes tienen a cargo de preparar y presentar la información de la entidad.<br>
                        4. Las actividades de instalación o acompañamiento que indiquen desplazamientos y que estos sean intermunicipales, interregionales o en 
                        condiciones especiales, INsuempresa SAS, tiene la potestad de facturar los gastos de transporte, alimentación y hospedaje en que se incurran.
                    </h6>
                </div>
                <div class="row">
                    <table width="100%">
                        <thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <h5><em>SERVICIO PRESTADO POR:</em></h5>
                                    <?php echo $services['asesor'] ?>
                                </td>
                                <td>
                                    <h5><em>SERVICIO RECIBIDO POR:</em></h5>
                                    <strong>Nombre: </strong><?php echo $services['persona_recibe'] ?><br>
                                    <strong>Cargo:  </strong><?php echo $services['cargo'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>

  </body>
<html>
<?php
$cliente = $services['cliente'];
$email   = $services['email'];
}


// Creacion del pdf. El fichero se genera perfectamente con este codigo.
require_once '../../resources/lib/dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=factura.pdf");
$pdf = $dompdf->output();
$filename = "Control Num_".$_GET['id'].".pdf";
file_put_contents("apps/veci/tmp/".$filename, $pdf);
$dompdf->stream($filename);
?>