@extends('layouts.master')
@section('title', 'Impuestos')
@section('content')
    @include('layouts.alerts')
    <!-- Formulario para crear impuestos -->
    <div class="row">
        <div class="col-lg-6">
            <form method="POST" id="formEmpresa" autocomplete="off" action="{{ route('ImpuestoCrear', []) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fa fa-dollar-sign"></i> Crear nuevo impuesto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xs-6 col-xl-7">
                                <label>Nombre <span class="text-success">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"
                                    placeholder="Nombre" require>
                            </div>
                            <div class="form-group col-xs-2 col-xl-4">
                                <label>Valor <span class="text-success">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="valor" id="valor"
                                    placeholder="Valor" require>
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

        <!-- \Formulario para crear Usuarios -->

        <!-- Tabla de usuarios -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-list"></i> Listado de impuestos</h5>
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
                                @foreach ($parametros as $item)
                                    <tr>
                                        <td>{{ $item->valor_adicional }}</td>
                                        <td>{{ $item->valor }}</td>
                                        <td>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Ver"
                                                class="text-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Editar"
                                                class="text-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Desactivar"
                                                class="text-danger">
                                                <i class="fa fa-minus-circle"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Activar"
                                                class="text-success">
                                                <i class="fa fa-plus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
