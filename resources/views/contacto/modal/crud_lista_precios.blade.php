<div class="modal fade" id="modalNuevaListaPrecios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Nueva lista de precios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formularioListaPrecios">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    Nombre <span class="text-success">*</span>
                                    <i class="fa fa-question-circle text-success" data-toggle="tooltip" data-placement="top"title="* Nombre que ayudará a identificar tu lista de precio"></i>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="valor" id="valor" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="PORCENTAJE" name="tipo_lista_precio" id="check_porcentaje_lista_precio" onclick="opcionesListaPrecio(this)">
                                        <label class="form-check-label" for="check_porcentaje_lista_precio">Porcentaje</label>
                                        <p>Se calcula con base en el precio indicado en la lista general</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="VALOR" name="tipo_lista_precio" id="check_valor_lista_precio" onclick="opcionesListaPrecio(this)">
                                        <label class="form-check-label" for="check_valor_lista_precio">Valor</label>
                                        <p>Indica un precio específico para cada producto</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" id="div_check_porcentaje_lista_precio" >
                            <div class="input-group input-group-sm mb-2 mr-sm-2">
                                <input type="number" class="form-control form-control-sm" id="valor_adicional" name="valor_adicional" value="0" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnListaPrecio">Guardar</button>
            </div>
        </div>
    </div>
</div>
