<form method="POST" action="{{ url('inventario/producto/nuevo', []) }}" autocomplete="off">
    <style>
        #previ_img_producto {
            border: dashed 2px #b6b9bf;
            width: 100% !important;
            height: 200px;
        }

    </style>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" id="id">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre *</label>
                                <input type="text" name="nombre" id="nombre" class="form-control form-control-sm"
                                    required="true">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Referencia <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Agrega un código único para identificar tu producto. Ejemplo: CAS002"></i></label>
                                <input type="text" name="referencia" id="referencia"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Categoría <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Selecciona la categoría a la que pertenece tu producto y/o servicio."></i></label>
                                <select name="categoria_id" id="categoria_id"
                                    class="form-control form-control-sm select">
                                    @foreach ($categoria as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tipo de producto * <i class="fa fa-question-circle text-primary"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Indica el tipo de tu producto."></i></label>
                                <select name="tipo_producto_id" id="tipo_producto_id"
                                    class="form-control form-control-sm select" required="true">
                                    @foreach ($tipo_producto as $item)
                                        <optgroup label="{{ $item->valor_adicional }}:">
                                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Unidad de medida * <i class="fa fa-question-circle text-primary"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Selecciona una referencia de medición para tu producto. Ejemplo: Unidad, Kilogramo, Litro."></i></label>
                                <select name="unidad_medida_id" id="unidad_medida_id"
                                    class="form-control form-control-sm select" required="true">
                                    @foreach ($unidad_medida as $item)
                                        <option value="{{ $item->id }}">{{ $item->valor_adicional }} - {{ $item->valor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Clave de producto SAT *</label>
                                <select name="clave_producto_sat" id="clave_producto_sat"
                                    class="form-control form-control-sm" required="true"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Descripción <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Agrega detalles sobre tu producto o servicio."></i></label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="3"
                                    class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="checkbox" id="producto_inventariable" name="producto_inventariable" checked
                                    value="1">
                                <label for="producto_inventariable">Producto Inventariable <i
                                        class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Son productos a los que les llevas control de cantidades y costos unitarios, por lo general son productos tangibles"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="row depende_inventario">
                        <div class="col-lg-12">
                            <h6 class="text-success">Detalles de inventario</h6>
                            <small class="text-muted">Controla fácilmente tu inventario incluyendo esta información en
                                tus ítems de venta.</small>
                        </div>
                    </div>
                    <div class="row depende_inventario">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Almacén </label>
                                <select class="form-control form-control-sm" name="almacen_id" id="almacen_id">
                                    @foreach ($almacenes as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cantidad inicial * <i class="fa fa-question-circle text-primary"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Indica la cantidad con la que inicias el inventario de este producto."></i></label>
                                <input type="number" class="form-control form-control-sm" name="cantidad_inicial"
                                    id="cantidad_inicial" required="true">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cantidad mínima * <i class="fa fa-question-circle text-primary"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Activa una alerta y al vender este producto sabrás si has llegado al stock mínimo de inventario."></i></label>
                                <input type="number" class="form-control form-control-sm" name="cantidad_minima"
                                    id="cantidad_minima" required="true">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Cantidad máxima * <i class="fa fa-question-circle text-primary"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Activa una alerta y al comprar este producto sabrás si has llegado al stock máximo de inventario."></i></label>
                                <input type="number" class="form-control form-control-sm" name="cantidad_maxima"
                                    id="cantidad_maxima" required="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <label for="imagen">
                        <img src="{{ asset('img/seleccionarImagen.png') }}" id="previ_img_producto">
                    </label>
                    <input type="file" hidden name="imagen" id="imagen" accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Precio sin impuesto * <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                data-placement="top" title="Indica el precio de venta antes de impuesto"></i></label>
                        <input type="number" name="precio_sin_impuesto" id="precio_sin_impuesto" required
                            class="form-control form-control-sm" onkeyup="calcularPrecioTotal()">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Impuesto</label>
                        <select name="impuesto_id" id="impuesto_id" class="form-control form-control-sm"
                            onchange="calcularPrecioTotal()">
                            @foreach ($impuestos as $item)
                                <option data-valor="{{ $item->valor }}" value="{{ $item->id }}">
                                    {{ $item->valor_adicional }}({{ $item->valor }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Precio Total *</label>
                        <input type="number" name="precio_total" id="precio_total" required
                            class="form-control form-control-sm" readonly value="0">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="checkbox" id="aplica_lista_precio" name="aplica_lista_precio" value="1">
                        <label for="aplica_lista_precio">Utilizar lista de precios <i
                                class="fa fa-question-circle text-primary" data-toggle="tooltip" data-placement="top"
                                title="Asigna diferentes precios de venta a tu producto o servicio."></i></label>
                    </div>
                </div>
            </div>
            <div class="row lista_precio">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Lista de precios *</label>
                        <select name="lista_precio_id" id="lista_precio_id" class="form-control form-control-sm"
                            required="true">
                            @foreach ($lista_precios as $item)
                                <option value="{{ $item->id }}">{{ $item->valor }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row depende_inventario">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Costo inicial * <i class="fa fa-question-circle text-primary" data-toggle="tooltip"
                                data-placement="top"
                                title="Registra el valor de adquisición de este producto."></i></label>
                        <input type="number" name="costo_inicial" id="costo_inicial" required
                            class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <small class="text-muted">Todos los campos marcados con * son de caracter obligatorio.</small>
        </div>
        <div class="col-lg-6 text-right">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('producto', []) }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    <br>
</form>
