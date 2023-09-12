<?php
  
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $cliente = $_POST['idCliente'];

  include_once('../../model/tarea.php');
  $objeto = new Tarea();
  $ticket = $objeto-> ticketCliente($mes, $anio, $cliente);

?>


<table id="tableTicket" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
    <thead>
        <tr>
            
            <th># CONTROL</th>
            <th>FECHA SERVICIO</th>
            <th>SERVICIO</th>
            <th>ASESOR</th>
            <th>ESTADO</th>
            <th><i class="fa-solid fa-gears"></i> Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!$ticket){
            echo '';
        }else{
        while($dato = $ticket->fetch_assoc()){ ?>
        <tr>
            
            <td><?php echo $dato['id_servicio'] ?></td>
            <td><?php echo $dato['fecha'] ?></td>
            <td><?php echo $dato['ticket'] ?></td>
            <td><?php echo $dato['asesor'] ?></td>
            <?php if($dato['estado']!='RESUELTO'){?>
            <td class="text-center"><span class="badge badge-pill badge-warning"><?php echo $dato['estado'] ?></td>
            <td></td>
            <?php }else{ ?>
            <td class="text-center"><span class="badge badge-pill badge-success"><?php echo $dato['estado'] ?></td>
            <td style="text-align:center;">
                <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detalle<?php echo $dato['id_servicio']; ?>"><i class="fa fa-eye"></i></a>
            </td>
            <?php } ?>
        </tr>
        <div class="modal fade" id="detalle<?php echo $dato['id_servicio'] ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Control #<?php echo $dato['id_servicio'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h5>Solucion del asesor</h5>
                                <textarea class="form-control" readonly><?php echo $dato['solucion'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>    
                    </div>
                </div>
            </div>
        </div>
        
        <?php }
             } ?>
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableTicket').DataTable({
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

