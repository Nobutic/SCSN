<!-- Modal para agregar un nuevo tipo de servicio -->
<div class="modal fade" id="tSAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Tipo de Servicio </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            
                <div class="modal-body">

                    <form id="formulario_tipoServicio">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" >
                            </div>
                        </div>
                        <br/>


                        <!-- Animacion de load (solo sera visible cuando el cliente espere una respuesta del servidor )-->
                        <div class="row" id="load" hidden="hidden">
                            <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                            <img src="../../resources/img/load.gif" wih5h="100%" alt="">
                            </div>
                            <div class="col-xs-12 center text-accent">
                            <span>Validando información...</span>
                            </div>
                        </div>
                        <!-- Fin load -->

                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="registroTipoServicio()">Guardar</button>
                </div>
        </div>
    </div>
</div>

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
                        <div class="border border-dark text-start" style="width:70%">
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
                        <table class="border border-dark text-start" style="width:50%">
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
                </div>
                
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered text-start">
                            <thead>
                                <tr>
                                    <th scope="col">DESCRIPCIÓN</th>
                                    <th style="width: 21%;" scope="col">TIEMPO DE SERVICIO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p><input class="sinborde" name="descripcion" value="<?php echo $dato['servicio'] ?>" /></p>
                                        <p>ACTIVIDADES DESARROLLADAS</p>
                                        <p><textarea class="sinborde" name="actividades" rows="10" style="width: 100%;"><?php echo $dato['actividades'] ?> </textarea></p>
                                        
                                        <p>PENDIENTES ASESOR</p>
                                        <label><?php echo $dato['tarea'] ?>
                                        <p><?php echo $dato['descTarea'] ?></p>
                                        
                                        <p>PENDIENTES CLIENTE</p>
                                        <label><?php echo $dato['tarea_cliente'] ?></label>
                                    </td>
                                    <td><input class="sinborde" name="tiempo" value="<?php echo $dato['tiempo'] ?>" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input hidden name="modulo" value="<?php echo $dato['idModulo'] ?>" />
                <input hidden name="servicio" value="<?php echo $dato['idServicio'] ?>" />
                <input hidden name="tarea" value="<?php echo $dato['tarea'] ?>" />
                <input hidden name="descTarea" value="<?php echo $dato['descTarea'] ?>" />
                <input hidden name="tarea_cliente" value="<?php echo $dato['tarea_cliente'] ?>" />
                <input hidden name="id_ticket" value="<?php echo $dato['id_ticket'] ?>" />
                <input hidden name="id_asesor" value="<?php echo $dato['id_asesor'] ?>" />
                <div class="row">
                    <div class="col">
                        <h5><em>SERVICIO PRESTADO POR:</em></h5>
                        <input name="asesor"value="<?php echo $dato['asesor'] ?>" class="sinborde"/>
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
                <p align='right'><b>Nota: </b>Para la aprobacion primero Descargue y envie el archivo y luego dar click en el boton Aprobar</p>
                <input type="submit" class="btn btn-warning"  value="Editar"/>
                <a class="btn btn-primary" href="pdf.php?id=<?php echo $dato['id_servicio']; ?>"><i class="fa fa-download"></i> Descargar y enviar archivo PDF</a>
                <a type="button" class="btn btn-success" href="../../controller/aprobarControl.php?idServicio=<?php echo $dato['id_servicio'] ?>&idCliente=<?php echo $dato['id_cliente'] ?>&tiempo=<?php echo $dato['tiempo'] ?>" onclick="return aprobar()">Aprobar</a>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Detalle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"  id="detail">
            
        </div>
    </div>
</div>
