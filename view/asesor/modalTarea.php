<div class="modal fade" id="uni_modal<?php echo $task['id'] ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ver Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                               
                                    <h5><b class="border-bottom border-primary">Tarea</b></h5>
                                    <dd><?php echo $task['titulo'] ?></dd>
                               
                               
                                    <h5><b class="border-bottom border-primary">Asignar a</b></h5>
                                    <dd><?php echo $task['nombre'] ?></dd>
                               
                            </div>
                            <div class="col-md-6">
                               
                                    <h5><b class="border-bottom border-primary">Fecha del servicio</b></h5>
                                    <dd><?php echo $task['fecha'] ?></dd>
                               
                               
                                    <h5><b class="border-bottom border-primary">Estado</b></h5>
                                    <dd><?php echo $task['estado'] ?></dd>
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                               
                                    <h5><b class="border-bottom border-primary">Descripción</b></h5>
                                    <dd><?php echo $task['descripcion'] ?></span></dd>
                               
                            </div>

                            <div class="col-md-6">

                                    <?php if(!empty($task['solucion'])){ ?>
                                    <h5><b class="border-bottom border-primary">Solución</b></h5>
                                    <dd><?php echo $task['solucion'] ?></span></dd>
                                    <?php } ?>
                                    
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?php if($task['estado']!="RESUELTO"){ ?>
                <button class="btn btn-primary" data-bs-target="#solucionar<?php echo $task['id'] ?>" data-bs-toggle="modal">Dar solución</button>
                <?php }else{?>
                <button class="btn btn-primary" data-bs-target="#solucionar<?php echo $task['id'] ?>" data-bs-toggle="modal">Editar solución</button>          
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="solucionar<?php echo $task['id'] ?>" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Descripción Solucion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id='formulario_solucion' method="POST" action="../../controller/asesor/darSolucion.php">
        <div class="modal-body">
          <input name="id" type="text" value="<?php echo $task['id'] ?>" hidden>
          <textarea class="form-control" name="solucion" rows="15" ><?php echo $task['solucion'] ?></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="darSolucion">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>