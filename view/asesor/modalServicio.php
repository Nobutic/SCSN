<div class="modal fade" id="detalle<?php echo $dato['id_servicio'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Control #<?php echo $dato['id_servicio'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-9">
                        <div class="border border-dark text-start">
                            <form action="editarControl.php" method="POST">
                            <input hidden name="consecutivo" value="<?php echo $dato['id_servicio'] ?>" />
                            <h5 class=""><u>Datos del Cliente</u></h5>
                            <div class="col">
                            <label>Nombre:</label>
                            <input style="width:75%" name="nombreCliente" value="<?php echo $dato['cliente'] ?>" class="sinborde" />
                            </div>
                            <div class="col">
                            <label>Nit:</label>
                            <input name="nit" value="<?php echo $dato['id_cliente'] ?>" class="sinborde" />
                            </div>
                            <div class="col">
                            <label>Direccion:</label>
                            <input style="width:75%" name="direccion" value="<?php echo $dato['direccion'] ?>" class="sinborde" />
                            </div>
                            <div class="row">
                            <div class="col">
                            <label>Telefono:</label>
                            <input name="telefono" value="<?php echo $dato['telefono'] ?>" class="sinborde" />
                            </div>
                            <div class="col">
                            <label>Ciudad:</label>
                            <input name="ciudad" value="<?php echo $dato['ciudad'] ?>" class="sinborde" />
                            </div>
                            </div>
                        </div>
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
                                <td><input name="fecha" value="<?php echo $dato['fecha'] ?>" class="sinborde" /></td>
                                <td><input name="hInicio" value="<?php echo $dato['hora_inicio'] ?>" class="sinborde" /></td>
                                <td><input name="hFinal" value="<?php echo $dato['hora_fin'] ?>" class="sinborde" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col"></div>
                </div>
                <input hidden name="modulo" value="<?php echo $dato['idModulo'] ?>" />
                <input hidden name="servicio" value="<?php echo $dato['idServicio'] ?>" />
                <input hidden name="tarea" value="<?php echo $dato['tarea'] ?>" />
                <input hidden name="descTarea" value="<?php echo $dato['descTarea'] ?>" />
                <input hidden name="tarea_cliente" value="<?php echo $dato['tarea_cliente'] ?>" />
                <input hidden name="id_ticket" value="<?php echo $dato['id_ticket'] ?>" />
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
                                    <p><input class="sinborde" name="descripcion" value="<?php echo $dato['servicio'] ?>" /></p>
                                    <p>ACTIVIDADES DESARROLLADAS</p>
                                    <p><textarea class="sinborde" name="actividades" rows="10" style="width: 100%;"><?php echo $dato['actividades'] ?> </textarea></p>
                                </td>
                                <td><input class="sinborde" name="tiempo" value="<?php echo $dato['tiempo'] ?>" /></td>
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
                        <strong>Nombre: </strong><input name="pRecibe" value="<?php echo $dato['persona_recibe'] ?>" class="sinborde"/><br>
                        <strong>Cargo:  </strong><input name="cargo" value="<?php echo $dato['cargo'] ?>" class="sinborde"/>
                        <input hidden name="email" value="<?php echo $dato['email'] ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php if($dato['estado_control'] != 'APROBADO'){ ?>
                <input type="submit" class="btn btn-success"  value="Editar"/>
                <?php } ?>
            </div>
        </form>
        </div>
    </div>
</div>
