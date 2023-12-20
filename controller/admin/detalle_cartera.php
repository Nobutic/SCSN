<?php

    $id_cartera = $_POST['idCompra'];
    include("../../model/cartera.php");
    $cartera = new Cartera();
    $cartera = $cartera->carteraId($id_cartera);
    foreach($cartera as $dato){
        $id_cartera = $dato['id_compra'];
?>

            <div class="modal-header">
                <h5 class="modal-title">Factura#<?php echo $dato['id_factura']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <form id="formulario_eFactura" method="POST" action="../../controller/admin/editarFactura.php">
                    <div class="modal-body">
                    <div class="row">

                        <div class="form-control">
                            <label><b>Cliente</b></label>
                            <input type="text" class="form-control" name="nombreCliente" value="<?php echo $dato['nombre'] ?>" readonly/>
                            
                            <input hidden type="date" id="fecha" name="fecha" value="<?php echo $dato['fecha'] ?>" />
                            <input hidden type="text" id="id_cliente" name="id_cliente" value="<?php echo $dato['id_cliente'] ?>" />
                            <input hidden type="text" id="id_factura" name="id_factura" value="<?php echo $dato['id_compra'] ?>" />
                            
                            <br />
                            
                            <label><b>Nuevo Valor Factura</b></label>
                            <input type="number" class="form-control" id="valor_factura" name="valor_factura" value="<?php echo $dato['valor']; ?>" required/>
                            
                            <br/>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label><b>Nueva Fecha Factura</b></label>
                                    <input type="date" class="form-control" id="fecha_factura" name="fecha_factura" value="<?php echo $dato['fecha']; ?>" required/>
                                </div>
                                <div class="col-md-6">
                                    <label><b>Nueva Fecha Vencimiento</b></label>
                                    <input type="date" class="form-control" id="fecha_ven" name="fecha_ven" value="<?php echo $dato['fecha_ven']; ?>" required/>
                                </div>
                            </div>
                            
                            <br/>
                            
                            <label><b>Nuevo Valor abono:</b></label>
                            <input type="number" class="form-control" id="abono" name="abono"/>
                            
                            <br/>
                            
                            <label><b>Nueva Fecha abono:</b></label>
                            <input type="date" class="form-control" id="fecha_abono" name="fecha_abono" value="<?php echo $dato['fecha']; ?>">
                            
                            <br/>
                            
                            <label><b>Nuevo Tiempo</b></label>
                            <input type="text" class="form-control solo-numero" id="tiempo" name="tiempo" placeholder="Tiempo a adicionar/restar, ej. 10 ó -10"/>
                            
                            <br/>
                            
                        </div>
                        <br>
                        <label><b>Nota:</b> Si no se va a actualizar el tiempo, digite cero (0)</label>
                        <br>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" name="button" id="editar_Factura">Aceptar</button>
            </div>
                </form>

<?php } ?>