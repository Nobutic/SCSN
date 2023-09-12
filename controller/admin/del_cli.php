<?php

    $clienteId = $_POST['del_id'];
    include '../../model/cliente.php';
    $cliente = new Cliente();
    $cliente_ID = $cliente->loadCliente($clienteId);
    while($row = mysqli_fetch_array($cliente_ID)){
        $id_cliente=$row['id'];
        $nombre=$row['nombre'];
    }
?>

          <div class="row">
            
            <div class="col-6">
              <p>Esta seguro de eliminar el cliente <b><u><?php echo $nombre ?></u>?</b></p>
            
            </div>
            <input hidden type="number" class="form-control" name="id" value="<?php echo $id_cliente ?>">
          </div>