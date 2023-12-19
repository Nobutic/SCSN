<?php

    $id_control = $_POST['idControl'];
    include("../../model/servicio.php");
    $control = new Servicio();
    $control = $control->servicioId($id_control);
    foreach($control as $dato){
        $id_servicio = $dato['id_servicio'];
?>          
            <div class="modal-header">
                <h5 class="modal-title">Detalle Control</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-9">
                        <div class="border border-dark text-start">
                            <h5 class=""><u>Datos del Cliente</u></h5>
                            <div class="col">
                                <label>Nombre:</label>
                                <input style="width:75%" name="nombreCliente" value="<?php echo $dato['cliente'] ?>" class="sinborde" readonly/>
                            </div>
                            <div class="col">
                                <label>Nit:</label>
                                <input name="nit" value="<?php echo $dato['id_cliente'] ?>" class="sinborde" readonly/>
                            </div>
                            <div class="col">
                                <label>Direccion:</label>
                                <input style="width:75%" name="direccion" value="<?php echo $dato['direccion'] ?>" class="sinborde" readonly/>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Telefono:</label>
                                    <input name="telefono" value="<?php echo $dato['telefono'] ?>" class="sinborde" readonly/>
                                </div>
                                <div class="col">
                                    <label>Ciudad:</label>
                                    <input name="ciudad" value="<?php echo $dato['ciudad'] ?>" class="sinborde" readonly/>
                                </div>
                            </div>
                        </div>

                        <br/>

                        <h5>CONTROL DE SERVICIO <input class="sinborde" id="id" name="id" value="<?php echo $dato['id_servicio'] ?>" readonly/></h5>
                        
                        <br/>

                        <table class="border border-dark text-start">
                            <thead>
                                <tr>
                                <th scope="col">FECHA DEL SERVICIO</th>
                                <th scope="col">HORA INICIO:</th>
                                <th scope="col">HORA FINAL:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td><input name="fecha" value="<?php echo $dato['fecha'] ?>" class="sinborde" readonly/></td>
                                <td><input name="hInicio" value="<?php echo $dato['hora_inicio'] ?>" class="sinborde" readonly/></td>
                                <td><input name="hFinal" value="<?php echo $dato['hora_fin'] ?>" class="sinborde" readonly/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col"></div>
                </div>
                
                <br/>

                <div class="row">
                    <table class="table table-bordered text-start">
                        <thead>
                            <tr>
                                <th scope="col">DESCRIPCIÓN</th>
                                <th style="width: 25%;" scope="col">TIEMPO DE SERVICIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p><input class="sinborde" name="descripcion" value="<?php echo $dato['servicio'] ?>" readonly/></p>
                                    <p><b>ACTIVIDADES DESARROLLADAS</b></p>
                                    <p><textarea class="sinborde" name="actividades" rows="10" style="width: 100%;" readonly><?php echo $dato['actividades'] ?> </textarea></p>
                                    <p><b>PENDIENTES ASESOR</b></p>
                                    <p><textarea class="sinborde" name="actividades" rows="3" style="width: 100%;" readonly><?php echo $dato['descTarea'] ?> </textarea></p>
                                    <p><b>PENDIENTES CLIENTE</b></p>
                                    <p><textarea class="sinborde" name="actividades" rows="3" style="width: 100%;" readonly><?php echo $dato['tarea_cliente'] ?> </textarea></p>
                                </td>
                                <td><input class="sinborde" name="tiempo" value="<?php echo $dato['tiempo'] ?>" readonly/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col">
                        <h5><em>SERVICIO PRESTADO POR:</em></h5>
                        <?php echo $dato['asesor'] ?>
                    </div>
                    <div class="col">
                        <h5><em>SERVICIO RECIBIDO POR:</em></h5>
                        <strong>Nombre: </strong><input name="pRecibe" value="<?php echo $dato['persona_recibe'] ?>" class="sinborde" readonly/><br>
                        <strong>Cargo:  </strong><input name="cargo" value="<?php echo $dato['cargo'] ?>" class="sinborde" readonly/>
                        <input hidden name="email" value="<?php echo $dato['email'] ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="reenviar.php?id=<?php echo $id_servicio; ?>"><i class="fa fa-share"></i> Reenviar</a>
                <a class="btn btn-primary" href="download.php?id=<?php echo $id_servicio; ?>"><i class="fa fa-download"></i></a>
            </div>
                <?php } ?>