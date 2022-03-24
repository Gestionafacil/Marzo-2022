@extends('layouts.master')
@section('title', 'Editar contacto . . . ')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Editar contacto</h3>
        </div>
    </div>
    <hr>

    {{-- Inluir las alertas --}}
    @include('layouts.alerts')

    <form method="POST" action="{{ url('contacto/editar') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" id="id">
        <div class="row">
            {{-- Datos para crear la Persona --}}
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tipo de tercero <span class="text-success">*</span></label>
                                    <select class="form-control form-control-sm select" name="tipo_tercero_id" id="tipo_tercero_id" required value="{{ old('tipo_tercero_id') }}">
                                        @foreach ($tipo_terceros as $item)
                                            <option value="{{ $item->id }}">{{ $item->valor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Inputs para la tabla de Persona --}}
                            @include('contacto.partial.formulario_persona')

                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="form-check">
                                    <input type="checkbox" checked class="form-check-input" id="incluir_estado_cuenta" name="incluir_estado_cuenta" value="1" value="{{ old('incluir_estado_cuenta') }}">
                                    <label class="form-check-label" for="incluir_estado_cuenta">
                                        Incluir estado de cuenta
                                        <i class="fa fa-question-circle text-success" data-toggle="tooltip" data-placement="top" title="En cada factura enviada por correo, tu cliente recibirá su estado de cuenta."></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Datos para crear el Contacto --}}
            <div class="col-lg-5">
                @include('contacto.partial.formulario_contacto')
            </div>
        </div>

        {{-- Comentario --}}
        @include('partial.comentario')
        <br>
        
        {{-- Botones de guardado --}}
        <div class="row">
            <div class="col-lg-6 pull-left">
                <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter
                    obligatorio.</p>
            </div>
            <div class="col-lg-6 text-right">
                <button type="button" class="btn btn-outline-secondary">Cancelar</button>
                <button type="submit" name="guardarContacto"  class="btn btn-primary">Editar contacto</button>
            </div>
        </div>
        <br>

    </form>

    <!-- Modal Asociar Persona -->
    @include('contacto.modal.crud_asociar_persona')
    
    {{-- Modal Nueva lista de precios --}}
    @include('contacto.modal.crud_lista_precios')

    {{-- Modal Nuevo Vendedor --}}
    @include('contacto.modal.crud_nuevo_vendedor')

@endsection
@section('script')
    <script src="{{ asset('js/app/contacto/editar.js') }}"></script>
@endsection
