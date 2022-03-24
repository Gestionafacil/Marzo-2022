<div class="modal fade" id="modalNuevoVendedor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Nuevo vendedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formularioVendedor">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nombre <span class="text-success">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">RFC</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="rfc" name="rfc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Descripción</label>
                        <div class="col-sm-10">
                            <textarea cols="30" rows="3" class="form-control form-control-sm" id="descripcion" name="descripcion"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnVendedor">Guardar</button>
            </div>
        </div>
    </div>
</div>