<?php
  
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $cliente = $_POST['idCliente'];

  include_once('../../model/servicio.php');
  $objeto = new Servicio();
  $servicio = $objeto-> mostrarServicio($mes, $anio, $cliente);

  
?>


<table id="tableServicio" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
    <thead>
        <tr>
            
            <th># Servicio</th>
            <th>Cliente</th>
            <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
            <th>Servicio</th>
            <th>Asesor</th>
            <th><i class="fa fa-stopwatch"></i> Tiempo</th>
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
            <td><?php echo $dato['cliente'] ?></td>
            <td><?php echo $dato['fecha'] ?></td>
            <td><?php echo $dato['servicio'] ?></td>
            <td><?php echo $dato['asesor'] ?></td>
            <td style="text-align:center"><?php echo $dato['tiempo'] ?></td>
            
        </tr>
        
        
        <?php }
             } ?>
    </tbody>
</table>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableServicio').DataTable({
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