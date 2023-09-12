<div class="modal fade" id="abonos<?php echo $dato['id_compra']; ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Abonos de la factura#<?php echo $dato['id_factura']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php $abonos = $objeto->abonos($dato['id_compra']); ?>
                    <table id="tableCartera" class="cell-border table table-sm table-striped table-bordere dataTable no-footer">
                        <thead>
                            <tr>
                                
                                <th># FACTURA</th>
                                <th>FECHA ABONO</th>
                                <th>VALOR ABONO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($datos = $abonos->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $datos['id_factura']; ?></td>
                                <td><?php echo $datos['fecha']; ?></td>
                                <td><?php echo $datos['abono'];  ?></td>
                                
                            </tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>