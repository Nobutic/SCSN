<!-- Modal para editar los datos completos del asesor -->
<div class="modal fade" id="aEditar<?php echo $datos['id'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Asesor </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id='formulario_edicionA'>
                    <div class="row">
                        <input type="number" name="id" value="<?php echo $datos['id'] ?>" hidden>
                        <div class="col-md-12">
                            <label>Nombre</label>
                            <input class="form-control" name="nombre" type="text" value="<?php echo $datos['nombre'] ?>" autocomplete="off" required>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <label>Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $datos['email'] ?>" autocomplete="off" required>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <div class="col-md-6">
                            <label>Telefono</label>
                            <input class="form-control" name="telefono" type="number" value="<?php echo $datos['telefono'] ?>" autocomplete="off" required>
                        </div>

                        <div class="col-md-6">
                            <label>Cargo</label>
                            <input class="form-control" name="cargo" type="text" value="<?php echo $datos['cargo'] ?>" autocomplete="off" required>
                        </div>
                    </div>
                    <br />

                    
                    <!-- Animacion de load (solo sera visible cuando el Asesor espere una respuesta del servidor )-->
                    <div class="row" id="load" hidden="hidden">
                        <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                            <img src="/scsn/resources/img/load.gif" width="100%" alt="">
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
                    <button type="button" class="btn btn-primary" id="editarAsesor">Actualizar</button>
                </div>
            </div>
        </div>
</div>
<!-- fin modal edicion -->