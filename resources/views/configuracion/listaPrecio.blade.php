@extends('layouts.master')
@section('title', 'Lista de precios')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Lista de precios</h2>
            <p class="titleConfig text-muted">Define precios especiales para tus productos de venta.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-sm" id="listado">
                        <thead>
                            <th>Nombre</th>
                            <th>Principal</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <form action="" id="guardar" autocomplete="off">
                        <input type="hidden" name="id" id="id">
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
                                            <input class="form-check-input" type="radio" value="PORCENTAJE" id="tipo_lista_precio_porcentaje" name="tipo_lista_precio" id="check_porcentaje_lista_precio" onclick="opcionesListaPrecio(this)">
                                            <label class="form-check-label" for="check_porcentaje_lista_precio">Porcentaje</label>
                                            <p>Se calcula con base en el precio indicado en la lista general</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="VALOR" id="tipo_lista_precio_valor" name="tipo_lista_precio" id="check_valor_lista_precio" onclick="opcionesListaPrecio(this)">
                                            <label class="form-check-label" for="check_valor_lista_precio">Valor</label>
                                            <p>Indica un precio específico para cada producto</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="div_check_porcentaje_lista_precio" style="display: none;">
                                <div class="input-group input-group-sm mb-2 mr-sm-2">
                                    <input type="number" class="form-control form-control-sm" id="valor_adicional" name="valor_adicional" value="0" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="reset" class="btn btn-sm btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/configuracion/listaPrecio.js') }}"></script>
@endsection
