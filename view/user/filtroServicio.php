<?php
  
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $cliente = $_POST['idCliente'];

  include_once('../../model/servicio.php');
  $objeto = new Servicio();
  $servicio = $objeto-> mostrarServicio($mes, $anio, $cliente);

?>


<table id="tableControl" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
    <thead>
        <tr>
            
            <th># CONTROL</th>
            <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
            <th>MODULO</th>
            <th>SERVICIO</th>
            <th>HORA INCIO</th>
            <th>HORA FINAL</th>
            <th>TIEMPO SERVICIO</th>
            <th>ASESOR</th>
            <th>RECIBE SERVICIO</th>
            <th><i class="fa-solid fa-gears"></i> Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!$servicio){
            echo '';
        }else{
        while($dato = $servicio->fetch_assoc()){ ?>
        <tr>
            
            <td><?php echo $dato['id_servicio'] ?></td>
            <td><?php echo $dato['fecha'] ?></td>
            <td><?php echo $dato['modulo'] ?></td>
            <td><?php echo $dato['servicio'] ?></td>
            <td><?php echo $dato['hora_inicio'] ?></td>
            <td><?php echo $dato['hora_fin'] ?></td>
            <td><?php echo $dato['tiempo'].' Minutos' ?></td>  
            <td><?php echo $dato['asesor'] ?></td>         
            <td><?php echo $dato['persona_recibe'] ?></td>

            <td style="text-align:center">
                <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detalle<?php echo $dato['id_servicio'] ?>"><i class="fa fa-eye"></i></a> 
                <?php include('modalDetalleS.php') ?>
            </td>
        </tr>
        <?php }
             } ?>
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableControl').DataTable({
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