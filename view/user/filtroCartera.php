<?php
  
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $cliente = $_POST['idCliente'];

  include_once('../../model/cliente.php');
  $objeto = new Cliente();
  $cartera = $objeto-> listarCartera($mes, $anio, $cliente);

?>

<br/>
<table id="tableCartera" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
    <thead>
        <tr>
            
            <th># FACTURA</th>
            <th>FECHA FACTURA</th>
            <th>FECHA VENCIMIENTO</th>
            <th>VALOR</th>
            <th>ABONOS</th>
            <th>SALDO FINAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!$cartera){
            echo '';
        }else{
            
        while($dato = $cartera->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $dato['id_factura'] ?></td>
            <td><?php echo $dato['fecha'] ?></td>
            <td><?php echo $dato['fecha_ven'] ?></td>
            <td><?php echo $dato['valor'] ?></td>
            <td>
                <?php echo $dato['sum_abono'] ?> <a type="button" data-bs-toggle="modal" data-bs-target="#abonos<?php echo $dato['id_compra'] ?>"><i class="fa fa-eye"></i></a>
                <?php  include 'modalAbono.php'; ?>
            </td>
            <?php
                if($dato['valor'] - $dato['sum_abono'] > 0){
                    echo'<td class="table-danger" align="center">'.$saldo=$dato['valor'] - $dato['sum_abono'].'</td>';
                }else{
                    echo'<td class="table-success" align="center">'.$saldo=$dato['valor'] - $dato['sum_abono'].'</td>';
                }?>
        </tr>
        <?php  }
             } ?>
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableCartera').DataTable({
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