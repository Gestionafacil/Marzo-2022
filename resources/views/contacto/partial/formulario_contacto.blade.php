<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row breadcrumb p-2 rounded">
                    <div class="col-lg-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="check_cliente" name="check_cliente" {{ old('check_cliente') }}>
                            <label class="form-check-label" for="check_cliente">Cliente</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="check_proveedor" name="check_proveedor" {{ old('check_proveedor') }}>
                            <label class="form-check-label" for="check_proveedor">Proveedor</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="div_tipo_operacion">
                <div class="form-group">
                    <label>Tipo de operación <span class="text-success">*</span></label>
                    <select class="form-control form-control-sm select" name="tipo_operacion_id" id="tipo_operacion_id" {{ old('tipo_operacion_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($tipo_operacion as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Plazo de pago</label>
                    <select class="form-control form-control-sm select" name="plazo_pago_id" id="plazo_pago_id" {{ old('plazo_pago_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($plazo_pago as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>
                        @if( Auth::user()->tieneRol('admin') )
                            <button class="btn btn-xs btn-link" type="button" data-toggle="modal" data-target="#modalNuevoVendedor">
                                <i class="fa fa-plus-circle text-primary" data-toggle="tooltip" data-placement="top" title="Crear nuevo vendedor."></i>
                            </button>
                        @endif
                        Vendedor
                        <i class="fa fa-question-circle text-success" data-toggle="tooltip" data-placement="top" title="Selecciona el vendedor que deseas asociar a este contacto."></i>
                    </label>
                    <select class="form-control form-control-sm select" name="vendedor_id" id="vendedor_id" {{ old('vendedor_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($vendedores as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>
                        @if( Auth::user()->tieneRol('admin') )
                            <button class="btn btn-xs btn-link" type="button" data-toggle="modal" data-target="#modalNuevaListaPrecios">
                                <i class="fa fa-plus-circle text-primary" data-toggle="tooltip" data-placement="top" title="Crear nueva lista de precios."></i>
                            </button>
                        @endif
                        Lista de precios
                        <i class="fa fa-question-circle text-success" data-toggle="tooltip" data-placement="top" title="Selecciona la lista de precios que deseas asociar a este contacto."></i>
                    </label>
                    <select class="form-control form-control-sm select" name="lista_precios_id" id="lista_precios_id" {{ old('lista_precios_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($lista_precios as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Método de pago</label>
                    <select class="form-control form-control-sm select select" name="metodo_pago_id" id="metodo_pago_id" {{ old('metodo_pago_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($metodo_pago as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Forma de pago</label>
                    <select name="forma_pago_id" id="forma_pago_id" class="form-control form-control-sm select select" {{ old('forma_pago_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($forma_pago as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Uso CFDI</label>
                    <select name="uso_cfdi_id" id="uso_cfdi_id" class="select form-control form-control-sm select" {{ old('uso_cfdi_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($cfdi as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h6 class="text-success">Configuración contabilidad</h6>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Cuenta por cobrar</label>
                    <select name="cuenta_por_cobrar_id" id="cuenta_por_cobrar_id" class="form-control form-control-sm select" {{ old('cuenta_por_cobrar_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($tipo_cliente as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Cuenta por pagar</label>
                    <select name="cuenta_por_pagar_id" id="cuenta_por_pagar_id" class="form-control form-control-sm select" {{ old('cuenta_por_pagar_id') }}>
                        <option value selected disabled>Seleccionar</option>
                        @foreach ($tipo_proveedor as $item)
                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="breadcrumb rounded p-2 text-center font-weight-light">Personas asociadas</p>
            </div>
            <div class="col-lg-12">
                <div id="boxPersonasAsociadas"></div>
            </div>
            <div class="col-lg-12 text-right mt-3">
                <button type="button" class="btn btn-outline-success" id="btnModalAsociarPersonas">
                    <i class="fa fa-plus"></i> Asociar persona
                </button>
            </div>
        </div>
    </div>
</div>