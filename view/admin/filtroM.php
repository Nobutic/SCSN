<?php
  
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $cliente = $_POST['idCliente'];

  include_once('../../model/cliente.php');
  $objeto2 = new Cliente();
  $cliente = $objeto2->listarMovimiento($fechaInicio, $fechaFin, $cliente);

?>

<table id="tableMov" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
    <thead>
        <tr>
            
            <th>REF FACTURA</th>
            <th><i class="fa-solid fa-calendar-days"></i> Fecha</th>
            <th><i class="fa fa-stopwatch"></i> TIEMPO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!$cliente){
            echo '';
        }else{
        while($dato = $cliente->fetch_assoc()){ ?>
        <tr>
            
            <td><?php echo $dato['id_factura']; ?></td>
            <td><?php echo $dato['fecha']; ?></td>
            <td><?php echo $dato['tiempo']; ?></td>
        </tr>
        
        
        <?php }
             } ?>
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableMov').DataTable({
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