<?php

$id_cartera = $_POST['idCompra'];
include("../../model/cartera.php");
$objeto = new Cartera();
$cartera = $objeto->carteraId($id_cartera);
foreach ($cartera as $dato) {
    $id_cartera = $dato['id_compra'];
?>
    <div class="modal-header">
        <h5 class="modal-title">Abonar a la factura#<?php echo $dato['id_factura']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form id="formulario_abono" method="POST" action="../../controller/admin/abonar.php">
        <div class="modal-body">
            <div class="form-control">

                <input hidden type="text" id="id_factura" name="id_factura" value="<?php echo $dato['id_compra']; ?>" />
                <div class="form-group">
                    <label>Valor abono:</label>
                    <input type="number" class="form-control" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label>Fecha abono:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" name="button" id="Abonar">Aceptar</button>
        </div>
    </form>

<?php } ?>