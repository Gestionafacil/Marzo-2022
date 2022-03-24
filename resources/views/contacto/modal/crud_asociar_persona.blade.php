<div class="modal fade" id="modalAsociarPersona" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Asociar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fap">
                    <input type="hidden" name="asociar_persona_id" id="asociar_persona_id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nombre <span class="text-success">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="asociar_persona_nombre" name="asociar_persona_nombre">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Correo electrónico</label>
                                <input type="text" class="form-control form-control-sm" id="asociar_persona_email" name="asociar_persona_email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control form-control-sm" id="asociar_persona_telefono" name="asociar_persona_telefono">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Celular</label>
                                <input type="text" class="form-control form-control-sm" id="asociar_persona_celular" name="asociar_persona_celular">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="asociar_persona_incluir_enviar_notificaciones" name="asociar_persona_incluir_enviar_notificaciones" value="1">
                                <label class="form-check-label" for="asociar_persona_incluir_enviar_notificaciones">Enviar
                                    notificaciones</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnAsociarPersonas">Asociar persona</button>
            </div>
        </div>
    </div>
</div>