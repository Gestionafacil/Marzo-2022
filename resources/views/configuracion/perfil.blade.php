@extends('layouts.master')
@section('title', 'Perfil')
@section('content')
@include('layouts.alerts')
    <form method="POST" id="formPerfil" autocomplete="off" action="{{ url('configuracion/perfil', []) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id" name="id" value="<?= isset($perfil->id) ? $perfil->id : null; ?>">
        <div class="card mt-2">
        <div class="card-header">
				<h5 class="card-title"><i class="fa fa-user"></i> Modificar perfil</h5>
			</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-xs-6 col-xl-2">
                        <label>
                            Tipo de usuario
                            <span class="text-success">*</span>
                        </label>
                        <select class="form-control form-control-sm" id="tipo_persona_id" name="tipo_persona_id" required>
                            <option selected value disabled>Selecciona</option>
                            @foreach ($tipos as $tipo)
                                @if (isset($perfil->tipo_persona_id))
                                    @if ($perfil->tipo_persona_id == $tipo->id)
                                        <option selected value="{{ $tipo->id }}">{{ $tipo->valor }}</option>    
                                    @else
                                        <option value="{{ $tipo->id }}">{{ $tipo->valor }}</option>        
                                    @endif
                                @else
                                    <option value="{{ $tipo->id }}">{{ $tipo->valor }}</option>    
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-6 col-xl-4">
                        <label>Nombre <span class="text-success">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="nombre" 
                            name="nombre"
                            placeholder="Ingrese su nombre" 
                            required 
                            value="<?= isset($perfil->nombre) ? $perfil->nombre : ''; ?>">
                    </div>
                    <div class="form-group col-xs-6 col-xl-6">
                        <label>Dirección</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="direccion" 
                            name="direccion"
                            placeholder="Ingrese su dirección" 
                            required 
                            value="<?= isset($perfil->direccion) ? $perfil->direccion : ''; ?>">
                    </div>
                    <div class="form-group col-xs-6 col-xl-3">
                        <label>Teléfono <span class="text-success">*</span></label>
                        <input 
                            type="number" 
                            class="form-control form-control-sm" 
                            id="telefono"
                            name="telefono" 
                            placeholder="Ingrese su teléfono" 
                            required 
                            value="<?= isset($perfil->telefono) ? $perfil->telefono : ''; ?>">
                    </div>
                    <div 
                        class="form-group col-xs-6 col-xl-3" 
                        id="a_que_te_dedicas"
                        @if (isset($perfil->tipo_persona_id))
                            @if ($perfil->tipo_persona_id != 24){{-- 24 es el ID de la Descripción del Parametro TIPO_PERSONA --}}
                                hidden
                            @endif
                        @else
                            hidden
                        @endif>
                        <label>A que te dedicas<span class="text-success">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="te_dedicas" 
                            name="te_dedicas"
                            placeholder="¿A qué te dedicas?" 
                            required 
                            value="<?= isset($perfil->te_dedicas) ? $perfil->te_dedicas : '';; ?>">
                    </div>
                    <div class="form-group col-xs-6 col-xl-3">
                        <label>RFC</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="rfc"
                            name="rfc" 
                            placeholder="Número de documento" 
                            required 
                            value="<?= isset($perfil->rfc) ? $perfil->rfc : ''; ?>">
                    </div>
                    <div class="form-group col-xs-6 col-xl-3">
                        <label>Genero</label>
                        <select class="form-control form-control-sm" id="genero_id" name="genero_id" required>
                            <option selected value disabled>Selecciona</option>
                            @foreach ($generos as $genero)
                                @if ( isset($perfil->genero_id) )
                                    @if ( $genero->id == $perfil->genero_id )
                                        <option value="{{ $genero->id }}" selected>{{ $genero->valor }}</option>    
                                    @else
                                        <option value="{{ $genero->id }}">{{ $genero->valor }}</option>
                                    @endif
                                @else
                                    {{-- No esta Setiada la variable, así que todo pasa y no valida nada --}}
                                    <option value="{{ $genero->id }}">{{ $genero->valor }}</option>    
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                </div>
            </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('js/app/configuracionController.js') }}"></script>
@endsection