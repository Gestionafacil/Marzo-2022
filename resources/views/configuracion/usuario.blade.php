@extends('layouts.master')
@section('title', 'Usuario')
@section('content')

    {{-- Alertas --}}
    @include('layouts.alerts')

    <!-- Formulario para crear Usuarios -->
    <form method="POST" id="formUsuario" autocomplete="off" action="{{ url('configuracion/usuario', []) }}">
        <div class="row" id="formCrearUsuario" hidden>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fa fa-users"></i> Crear nuevo usuario</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="form-group col-xs-12 col-xl-3">
                                <label>Correo electrónico <span class="text-success">*</span></label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-sm" 
                                    name="email" 
                                    id="email"
                                    placeholder="Correo electrónico" 
                                    value="{{ old('email') }}"
                                    require>
                            </div>
                            <div class="form-group col-xs-6 col-xl-2">
                                <label>Contraseña <span class="text-success">*</span></label>
                                <input  
                                    type="password" 
                                    class="form-control form-control-sm" 
                                    name="password" 
                                    id="password"
                                    placeholder="Contraseña" 
                                    value="{{ old('password') }}"
                                    required>
                            </div>
                            <div class="form-group col-xs-6 col-xl-2">
                                <label>Confirmar <span class="text-success">*</span></label>
                                <input 
                                    type="password" 
                                    class="form-control form-control-sm" 
                                    name="password_confirmation"
                                    id="password_confirmation" 
                                    placeholder="Confirmar contraseña" 
                                    value="{{ old('password_confirmation') }}"
                                    required>
                            </div>
                            <div class="form-group col-xs-6 col-xl-3">
                                <label>Rol/Cargo<span class="text-success">*</span></label>
                                <select class="form-control form-control-sm" id="rol" name="rol" required>
                                    <option selected value disabled>Selecciona</option>
                                    @foreach ($roles as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                        <button type="reset" onclick="displayFormulario(true)"
                            class="btn btn-sm btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- \Formulario para crear Usuarios -->

    <!-- Tabla de usuarios -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 pull-left">
                            <h5 class="card-title"><i class="fa fa-list"></i> Listado de usuario</h5>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <button type="button" onclick="displayFormulario(false);" class="btn btn-xs btn-success"
                                style="float: right;"><i class="fa fa-plus-circle"></i> Nuevo</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="table">
                            <thead>
                                <th>Rol/Cargo</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $item)
                                    <tr>
                                        <td>{{ $item->rol }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->create_time }}</td>
                                        <td>
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
                                <th>Rol/Cargo</th>
                                <th>Correo</th>
                                <th>Fecha</th>
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
@section('script')
    <script src="{{ asset('js/app/configuracionController.js') }}"></script>
@endsection
