<?php
$idcliente = $_POST['ad_id'];

?>
          <input type="hidden" name="id" value="<?php echo $idcliente ?>">
          <div class="row">
            <div class="col-md-6">
              <label for="cliente">ID Cliente: <?php echo $idcliente ?></label>
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <label>Fecha Factura</label>
                  <input class="form-control" type="date" name="fechaActual" value="<?php echo date('Y-m-d') ?>">
              </div>
              <div class="col-md-6">
                  <label>Fecha Vencimiento</label>
                  <input class="form-control" type="date" name="fecha_ven" >
              </div>
          </div>
          <br/>

          <div class="row">
              <div class="col-md-6">
                  <label>N° Factura</label>
                  <input class="form-control" type="text" name="nFactura" >
              </div>
              <div class="col-md-6">
                  <label>Tiempo</label>
                  <input class="form-control" name="tiempo" type="number" required>
              </div>
          </div>
          <br />

          <div class="row">
              <div class="col-md-6">
                  <label>Valor</label>
                  <input class="form-control" name="valor" type="number" required>
              </div>
              <div class="col-md-6">
                  <label>Abono</label>
                  <input class="form-control" name="abono" type="number" required>
              </div>
          </div>