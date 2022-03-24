@extends('layouts.master')
@section('title', $producto->nombre)
@section('content')
    <style>
        .new-item-image {
            margin: 0 auto;
            width: 100%;
            height: 250px;
            background-color: #f9fafd;
            border: 2px dashed #bcc9d8;
            background-position: center 35%;
            background-repeat: no-repeat;
            position: relative;
            cursor: pointer
        }

        .currentMoney {
            border: 1px solid #ced4da;
            border-radius: 5px;
            color: #333;
            font-size: 32px;
            padding: .5rem 1rem;
            width: 100%;
            height: calc(1.8125rem + 2px);
        }

        #codigoQR {
            width: 100px;
            height: 100px;
            margin-top: 15px;
        }

    </style>
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-boxes"></i> {{ $producto->nombre }}</h3>
        </div>
        <div class="col-lg-5">
            <a href="{{ url('inventario/producto/editar/' . $producto->id, []) }}"
                class="float-right btn btn-xs btn-outline-primary"><i class="fa fa-fw fa-edit"></i> Editar</a>
        </div>
    </div>
    <hr>
    @include('layouts.alerts')
    <form method="POST" action="{{ url('inventario/producto/nuevo', []) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">´
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Nombre <span class="text-primary">*</span></label>
                                <input type="text" class="form-control border-0" id="nombre"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->nombre }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Referencia</label>
                                <input type="text" class="form-control border-0"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->referencia }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Categorias</label>
                                <input type="text" class="form-control border-0" id='categoria_id'
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->categoria }}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Tipo de Producto <span class="text-primary">*</span></label>
                                <input type="text" class="form-control border-0"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->tipo_producto }}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Unidad de Medida <span class="text-primary">*</span></label>
                                <input type="text" class="form-control border-0"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->medida }}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Clave del producto SAT <span class="text-primary">*</span></label>
                                <input type="text" class="form-control border-0"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    value="{{ $producto->clave_producto }}">
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Descripción</label>
                                <textarea class="form-control border-0" rows="2"
                                    style="background: none; font-size: 15px !important;" readonly
                                    disabled>{{ $producto->descripcion }}</textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="switch">
                                    @if ($producto->producto_inventariable == true)
                                        <input type="checkbox" name="producto_inventariable" id="producto_inventariable"
                                            onchange="aplicaInventario()" checked readonly disabled
                                            value="{{ $producto->producto_inventariable }}" />
                                    @else
                                        <input type="checkbox" name="producto_inventariable" id="producto_inventariable"
                                            onchange="aplicaInventario()" readonly disabled
                                            value="{{ $producto->producto_inventariable }}" />
                                    @endif
                                    <span class="slider round"></span>
                                </label> <span class="text_switch">Producto Inventariable</span>
                            </div>
                        </div>
                        <!-- form de inventario  -->
                        @if ($producto->producto_inventariable == true)
                            <div id="container-invetario" class="m-2">
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="valor">Almacén</label>
                                        <input type="text" class="form-control border-0"
                                            style="background: none; font-size: 15px !important;" readonly disabled
                                            value="{{ $producto->almacen }}">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="valor">Cantidad Inicial <span class="text-primary">*</span> </label>
                                        <input type="number" class="form-control form-control-sm border-0"
                                            style="background: none; font-size: 15px !important;" readonly disabled
                                            id="cantidad_inicial" value="{{ $producto->cantidad_inicial }}">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="valor">Cantidad Minima <span class="text-primary">*</span> </label>
                                        <input type="number" class="form-control border-0"
                                            style="background: none; font-size: 15px !important;" readonly disabled
                                            id="cantidad_minima" value="{{ $producto->cantidad_minima }}">
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="valor">Cantidad Maxima <span class="text-primary">*</span> </label>
                                        <input type="number" class="form-control border-0"
                                            style="background: none; font-size: 15px !important;" readonly disabled
                                            id="cantidad_maxima" value="{{ $producto->cantidad_maxima }}">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="button" class="btn btn-secondary btn-sm" value="Generar Codigo Qr"
                                            name="generar_qr" onclick="crearCodigoQr();">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="new-item-image">
                                <label for="selec_img_producto" style="cursor: pointer;">
                                    <input type="file" name="selec_img_producto" id="selec_img_producto" accept="image/*"
                                        hidden>
                                    <figure>
                                        <img src="{{ asset('img/seleccionarImagen.png') }}" id="previ_img_producto">
                                        <figcaption class="text-muted">
                                            {{-- Logo de empresa --}}
                                        </figcaption>
                                    </figure>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="valor">Precio Total <span class="text-primary">*</span></label>
                                <input type="text" required name="precio_total" class="currentMoney border-0"
                                    style="background: none; font-size: 15px !important;" id="precio_total"
                                    pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="$0,00" readonly
                                    disabled value="{{ $producto->precio_total }}">
                            </div>
                            <div class=" form-group col-lg-6">
                                <label for="valor">Precio sin impuesto<span class="text-primary">*</span></label>
                                <input type="text" name="precio_sin_impuesto" class="currentMoney border-0"
                                    style="background: none; font-size: 15px !important;" id="precio_total"
                                    id="precio_sin_impuesto" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"
                                    placeholder="$0,00" required readonly disabled
                                    value="{{ $producto->precio_sin_impuesto }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="valor">Impuesto <span class="text-primary">*</span></label>
                                <input type="text" class="form-control border-0"
                                    style="background: none; font-size: 15px !important;" readonly disabled
                                    id="impuesto" value="{{ $producto->impuesto }}">
                            </div>
                            <div class="col-lg-12">
                                <label class="switch">
                                    @if ($producto->lista_precio != null)
                                        <input type="checkbox" checked name="aplica_lista_precio" id="aplica_lista_precio"
                                            readonly disabled onchange="aplicaListaPrecio()" />
                                    @else
                                        <input type="checkbox" name="aplica_lista_precio" id="aplica_lista_precio" readonly
                                            disabled onchange="aplicaListaPrecio()" />
                                    @endif
                                    <span class="slider round"></span>
                                </label> <span class="text_switch">Utilizar lista de precios </span>
                            </div>
                        </div>
                        @if ($producto->lista_precio != null)
                            <div id="container-precio" class="m-2">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="valor">Lista de precio <span class="text-primary">*</span></label>
                                        <input type="text" class="form-control border-0"
                                            style="background: none; font-size: 15px !important;" readonly disabled
                                            id="cantidad_maxima" value="{{ $producto->lista_precio }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($producto->producto_inventariable == true)
                            <div id="container-invetario-2" class="m-2">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="valor">Costo Inicial<span class="text-primary">*</span> </label>
                                        <input type="text" name="costo_inicial" class="currentMoney border-0"
                                            id="costo_inicial" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"
                                            data-type="currency border-0"
                                            style="background: none; font-size: 15px !important;" placeholder="$0,00"
                                            readonly disabled value="{{ $producto->costo_inicial }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <small class="text-muted">Todos los campos marcados con * son de caracter obligatorio.</small>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('producto', []) }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        <br>
    </form>

    {{-- Modal codigo de barra --}}
    @include('inventario.modal.codigo_barra')

@endsection
@section('script')
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script src="{{ asset('js/app/inventario/productoController.js') }}"></script>
@endsection
