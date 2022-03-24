@extends('layouts.master')
@section('title', 'Nuevo ajuste')
@section('content')

    <style>
        .subTtile {
            font-size: 19px !important;
            color: #00aaea;
            position: relative;
            top: 20px;
        }

        .linea {
            margin-left: 160px !important;
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

    </style>

    <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Nuevo ajuste de inventario</h3>
    <p class="titleConfig text-muted">Ajusta las cantidades de tus productos
        inventariables registrando Incrementos o Disminuciones como aumentos o pérdidas de mercancía.</p>
    <hr>
    @include('layouts.alerts')
    <form method="POST" action="#" id="formularioAjuste">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="fecha_ajuste">Fecha del Ajuste<span class="text-primary">*</span></label>
                        <input class="form-control form-control-sm" type="datetime-local" name="fecha_ajuste" id="fecha_ajuste" required>
                    </div>
                    <div class="form-group col-lg-9">
                        <label for="observacion">Observación</label>
                        <textarea class="form-control form-control-sm" name="observacion" id="observacion" cols="30"
                            rows="5"></textarea>
                    </div>
                </div>
                <p class="subTtile">Producto de venta
                    <hr class="linea">
                </p>
                <div class="row">
                    <div class="col-lg-6 pull-right">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Buscar producto..." id="buscarProducto">
                            <div class="input-group-append">
                                <button type="button" id="btnBuscar" class="input-group-button btn btn-primary" id="basic-addon2"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-lg-12">
                        <div class="table table-resposive">
                            <table class="table table-sm" id="idTable">
                                <thead>
                                    <td width="300">Producto</td>
                                    <td width="100">Cantidad actual</td>
                                    <td width="100">Tipo de ajuste</td>
                                    <td width="100">Cantidad</td>
                                    <td width="100">Cantidad final</td>
                                    <td width="100">Costo unitario</td>
                                    <td width="100">Total ajustado</td>
                                    <td width="100">Acciones</td>
                                </thead>
                                <tbody id="lo-que-vamos-a-copiar">
                                    {{-- <tr>
                                        <td>
                                            <input type="text" name="nombre[]" class="form-control form-control-sm text-center">
                                            <input type="hidden" name="producto_id[]">
                                        </td>
                                        <td><input type="text" name="cantidad_actual[]" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>
                                        <td>
                                            <select name="tipo_ajuste" class="form-control form-control-sm text-center">
                                                <option value="Incremento">Incremento</option>
                                                <option value="Decremento">Decremento</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="cantidad[]" value="0" onclick="cambiarAjuste(this)" class="form-control form-control-sm text-center"></td>
                                        <td><input type="text" name="cantidad_final[]" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>
                                        <td><input type="text" name="costo_unitario[]" class="form-control form-control-sm text-center"></td>
                                        <td><input type="text" name="total_ajustado[]" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>
                                        <td><button type="button" onclick="eliminarFila(this)" class="btn btn-sm btn-danger">&times;</button></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 d-flex justify-content-between align-items-center">
                        {{-- <input type="button" class="btn btn-outline-primary btn-sm" value="Agregar producto" id="agregar_producto"> --}}
                        <label>
                            <h4>
                                <strong id="total">
                                    Total: $
                                    <input type="number" id="precio_total" name="precio_total" readonly value="0" style="font-size: 20px;font-size: 30px !important;border: none;background: none;font-weight: bold !important;width: 150px;">
                                </strong>
                        </label>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6 pull-left">
                        <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button" class="btn btn-outline-secondary">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal --}}
    <div class="modal fade" id="productos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-sm" id="tablaProductos">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Referencia</th>
                                        <th>Cantidad actual</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyProductos"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('js/app/inventario/ajusteController.js') }}"></script>
@endsection
