<!-- Modal para editar los datos completos del cliente -->
<div class="modal fade" id="cEditar" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Editar cliente </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../controller/admin/editarCliente.php">
                <div class="modal-body" id="info_update">
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="editarCliente">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal edicion -->

<!-- Modal para eliminar un cliente -->
<!-- No se esta utilizando -->
<div class="modal fade" id="cEliminar" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5">¿Realmente desea eliminar a ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_eliminar">
                <div class="modal-body" id="info_del">
                    
                </div>

                <div class="model-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="eliminar">Borrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para adicionar tiempo cliente -->
<div class="modal fade" id="cAdicionarTiempo" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Adicionar Tiempo al cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="POST" action="../../controller/admin/tiempoCliente.php">
                <div class="modal-body" id="form_add">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="adicionar">Guardar</button>
                </div>
            
            </form>
        </div>
    </div>
</div>

                                