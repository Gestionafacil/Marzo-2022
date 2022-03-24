@extends('layouts.master')
@section('title', 'Nueva variante')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Nueva variante</h2>
            <p class="titleConfig text-muted">Agrega el nombre de la variante e indica las diferentes opciones que puede tener.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-sm" id="listado">
                        <thead>
                            <th>Nombre</th>
                            <th>Opciones</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <form action="{{ url('atributo/variante', []) }}" method="POST" autocomplete="off" id="guardar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Nombre <span class="text-success">*</span></label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required="true">
                                </div>
                            </div>
                            <div class="col-lg-4" id="Opciones">
                                <label>Opciones</label>
                            </div>
                            <div class="col-lg-12">
                                <button type="button" onclick="agregarOpcion();" class="btn btn-link float-right"><i class="fa fa-plus"></i> Nueva opción</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                                <button type="submit" name="guardar" value="guardar" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('js/app/atributo/variante.js') }}"></script>
@endsection