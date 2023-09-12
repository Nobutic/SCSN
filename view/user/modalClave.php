<div class="modal" id="cambiarContraseña">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar Contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input hidden type="number" value="<?php echo ucfirst($_SESSION['id']); ?>" id="idUsuario" />
        <div class="row">
            <div class="col">
                <label>Contraseña Actual</label>
                <input type="password" class="form-control" id="claveActual"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Contraseña Nueva</label>
                <input type="password" class="form-control" id="claveNueva1"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Confirmar Contraseña</label>
                <input type="password" class="form-control" id="claveNueva2"/>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="cambiar">Cambiar</button>
      </div>
    </div>
  </div>
</div>



