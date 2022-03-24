@extends('layouts.master')
@section('title', 'Categorías')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Categorías</h2>
            <p class="titleConfig text-muted">Utiliza las categorías para clasificar tus productos.</p>
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
                            <th>Descripcion</th>
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
                <div class="card-header">
                    <span class="h6 text-white font-weight-light">Nueva Categoría</span>
                </div>
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
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/categoria/listado.js') }}"></script>
@endsection
