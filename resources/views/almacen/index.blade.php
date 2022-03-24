@extends('layouts.master')
@section('title', 'Almacenes')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Almacenes</h2>
            <p class="titleConfig text-muted">Crea nuevos almacenes para para distribuir y gestionar tu inventario.</p>
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
                            <th>Dirección</th>
                            <th>Observaciones</th>
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
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label>Nombre <span class="text-success">*</span></label>
                        <input type="text" name="nombre" id="nombre" required class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea cols="10" rows="3" name="observacion" id="observacion" class="form-control form-control-sm"></textarea>
                    </div>
                    <button type="reset" class="btn btn-danger" id="reset">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/almacen/listado.js') }}"></script>
@endsection
