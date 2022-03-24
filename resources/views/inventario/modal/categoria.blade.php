<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">Crear nueva categoráa</div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nombre <span class="text-success">*</span></label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" name="nombre" id="nombre" required class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea cols="10" rows="3" name="descripcion" id="descripcion" class="form-control form-control-sm"></textarea>
                                </div>
                                <button type="button" class="btn btn-danger" id="reset">Cancelar</button>
                                <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>