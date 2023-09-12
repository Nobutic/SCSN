<?php
 
    $clienteId = $_POST['edit_id'];
    include '../../model/cliente.php';
    $cliente = new Cliente();
    $cliente = $cliente->loadCliente($clienteId);
    while($row = mysqli_fetch_array($cliente)){
        $id_cliente=$row['id'];
        $nombre=$row['nombre'];
        $email=$row['email'];
        $direccion=$row['direccion'];
        $telefono=$row['telefono'];
        $ciudad=$row['ciudad'];
        $nombre_contacto=$row['nombre_contacto'];
        $cargo=$row['cargo'];
        $celular=$row['celular'];
        $email_contacto=$row['email_contacto'];
    }
?>


                <input name="fechaActual" type="hidden" value="<?php echo date('Y-m-d') ?>" />
                <div class="row">
                    <div class="col-md-12">
                        <h5>Datos de la empresa</h5>
                        <hr/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <label>Nombre</label>
                        <input class="form-control" autocomplete="off" name="Nombre" type="text" value="<?php echo $nombre ?>" />
                    </div>
                </div>
                <br />

                <div class="row">
                    
                    <input hidden class="form-control" autocomplete="off" name="Id" type="number" value="<?php echo $id_cliente ?>"/>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input class="form-control" autocomplete="off" name="email" type="email" value="<?php echo $email ?>"/>
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="col-md-6">
                        <label>Direccion</label>
                        <input class="form-control" autocomplete="off" name="direccion" type="text" value="<?php echo $direccion ?>"/>
                    </div>
                    <div class="col-md-6">
                        <label>Telefono</label>
                        <input class="form-control" autocomplete="off" name="telefono" type="number" value="<?php echo $telefono ?>"/>
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="col-md-12">
                        <label>Ciudad</label>
                        <input class="form-control" autocomplete="off" name="ciudad" type="text" value="<?php echo $ciudad ?>"/>
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="col-md-12">
                        <h5>Datos contacto</h5>
                        <hr/>
                    </div>
                </div>
                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label>Nombre contacto</label>
                        <input class="form-control" autocomplete="off" name="nombreContacto" type="text" value="<?php echo $nombre_contacto ?>"/>
                    </div>

                    <div class="col-md-6">
                        <label>Cargo</label>
                        <input class="form-control" autocomplete="off" name="cargo" type="text" value="<?php echo $cargo ?>"/>
                    </div>
                </div>
                <br/>

                <div class="row">
                    <div class="col-md-6">
                        <label>Celular</label>
                        <input class="form-control" autocomplete="off" name="celular" type="text" value="<?php echo $celular ?>"/>
                    </div>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input class="form-control" autocomplete="off" name="emailContacto" type="text" value="<?php echo $email_contacto ?>"/>
                    </div>
                </div>
