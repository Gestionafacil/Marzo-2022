@extends('layouts.master')
@section('title', 'Centro de costos')
@section('content')
    @include('layouts.alerts')
    <!-- Formulario para crear centros de costos -->
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" autocomplete="off" action="{{ route('configuracion/centroCostos', []) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fa fa-dollar-sign"></i> Crear nuevo centro de costos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xs-6 col-xl-7">
                                <label>Código <span class="text-success">*</span></label>
                                <input type="number" class="form-control form-control-sm" name="codigo" id="codigo"
                                    placeholder="Código" require>
                            </div>
                            <div class="form-group col-xs-2 col-xl-4">
                                <label>Nombre <span class="text-success">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"
                                    placeholder="Nombre" require>
                            </div>
                            <div class="form-group col-xs-2 col-xl-4">
                                <label>Descripción <span class="text-success">*</span></label>
                                <textarea class="form-control form-control-sm" name="descripcion" id="descripcion"
                                    placeholder="Descripción" require></textarea>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de
                        caracter obligatorio.</p>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- \Formulario para crear centros de costos -->

        <!-- Tabla de centro de costos -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-list"></i> Listado de centro de costos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="table">
                            <thead>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                               
                            </tbody>
                            <tfoot>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th>Opciones</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- \Tabla de usuarios -->
@endsection
