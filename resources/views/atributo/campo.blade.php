@extends('layouts.master')
@section('title', 'Nueva campo adicional')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Nuevo campo adicional</h2>
            <p class="titleConfig text-muted">Configura características particulares a tus productos creando nuevos campos adicionales.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-sm" id="listado">
                        <thead>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tipo de campo</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <form action="" method="POST" autocomplete="off" id="guardar">
                <input type="hidden" name="id" id="id">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nombre <span class="text-success">*</span></label>
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Tipo de campo <span class="text-success">*</span></label>
                                    <select name="tipo_campo" id="tipo_campo" required class="form-control form-control-sm">
                                        <option value="text">Texto</option>
                                        <option value="number">Número</option>
                                        <option value="decimal">Número decimal</option>
                                        <option value="date">Fecha</option>
                                        <option value="boolean">Si / No</option>
                                        <option value="select">Lista de opciones</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-gropup">
                                    <label>Valor por defecto</label>
                                    <input type="text" name="default" id="default" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="obligatorio" id="obligatorio" value="1">
                                        <label class="form-check-label" for="obligatorio">Obligatorio</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="imprimir_factura" id="imprimir_factura" value="1">
                                        <label class="form-check-label" for="imprimir_factura">Imprimir en facturas</label>
                                    </div>
                                </div>
                            </div>
                            <div id="listadoOpciones" style="display: none;">
                                <div class="col-lg-12" id="Opciones">
                                    <div class="form-group">
                                        <label>Opciones</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="button" onclick="agregarOpcion();" class="btn btn-link float-right"><i class="fa fa-plus"></i> Nueva opción</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="reset" class="btn btn-sm btn-danger">Cancelar</button>
                                <button type="submit" name="guardar" value="guardar" class="btn btn-sm btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('js/app/atributo/campo.js') }}"></script>
@endsection