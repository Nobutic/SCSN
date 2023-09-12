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
                            <h5 class=""><u>Datos del Cliente</u></h5>
                            <div class="col">
                            <label>Nombre:</label>
                            <label><?php echo $dato['cliente'] ?></label>
                            </div>
                            <div class="col">
                            <label>Nit:</label>
                            <label><?php echo $dato['id_cliente'] ?></label>
                            </div>
                            <div class="col">
                            <label>Direccion:</label>
                            <label><?php echo $dato['direccion'] ?></label>
                            </div>
                            <div class="row">
                            <div class="col">
                            <label>Telefono:</label>
                            <label><?php echo $dato['telefono'] ?></label>
                            </div>
                            <div class="col">
                            <label>Ciudad:</label>
                            <label><?php echo $dato['ciudad'] ?></label>
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
                                <td><?php echo $dato['fecha'] ?></td>
                                <td><?php echo $dato['hora_inicio'] ?></td>
                                <td><?php echo $dato['hora_fin'] ?></td>
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
                                <th style="width: auto;" scope="col">TIEMPO DE SERVICIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p><?php echo $dato['servicio'] ?></p>
                                    <p>ACTIVIDADES DESARROLLADAS</p>
                                    <p><?php echo $dato['actividades'] ?></p>

                                    <p>PENDIENTES ASESOR</p>
                                    <label><?php echo $dato['tarea'] ?>
                                    <p><?php echo $dato['descripcion'] ?></p>
                                    
                                    <p>PENDIENTES CLIENTE</p>
                                    <label><?php echo $dato['tarea_cliente'] ?></label>
                                </td>
                                <td><?php echo $dato['tiempo_conexion'].' Minutos' ?></td>
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
                        <strong>Nombre: </strong><?php echo $dato['persona_recibe'] ?><br>
                        <strong>Cargo:  </strong><?php echo $dato['cargo'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <a class="btn btn-primary" href="pdf.php?id=<?php echo $dato['id_servicio']; ?>"><i class="fa fa-download"></i> Descargar archivo PDF</a> -->
            </div>
        </div>
    </div>
</div>