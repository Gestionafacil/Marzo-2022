<div class="card">
    <div class="card-body">
        <form action="{{ url('bancos/nuevo', []) }}" method="POST">
            <input type="hidden" name="id" @isset($banco) value="{{ $banco->id }}" @endisset>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Tipo de cuenta <span class="text-success">*</span></label>
                <div class="col-sm-8">
                    <select name="tipo_cuenta_id" id="tipo_cuenta_id" class="form-control form-control-sm" required>
                        <option value disabled selected>Seleccione</option>
                        @foreach ($tipo_cuenta as $item)
                            @if(isset($banco)) 
                                @if ( $banco->tipo_cuenta_id === $item->id )
                                    <option value="{{ $item->id }}" selected>{{ $item->valor }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->valor }}</option>
                                @endif
                            @else
                                <option value="{{ $item->id }}">{{ $item->valor }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Nombre de la cuenta <span class="text-success">*</span></label>
                <div class="col-sm-8">
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" required @isset($banco) value="{{ $banco->nombre }}" @endisset>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Número de la cuenta</label>
                <div class="col-sm-8">
                    <input type="number" name="numero_cuenta" id="numero_cuenta" class="form-control form-control-sm" @isset($banco) value="{{ $banco->numero_cuenta }}" @endisset>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Saldo inicial <span class="text-success">*</span></label>
                <div class="col-sm-8">
                    <input type="number" name="saldo" id="saldo" class="form-control form-control-sm" required @isset($banco) value="{{ $banco->saldo }}" @endisset>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Fecha <span class="text-success">*</span></label>
                <div class="col-sm-8">
                    <input type="date" name="fecha" id="fecha" class="form-control form-control-sm" required @isset($banco) value="{{ $banco->fecha }}" @endisset>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label float-right">Descripción</label>
                <div class="col-sm-8">
                    <textarea name="descripcion" id="descripcion" class="form-control form-control-sm" cols="30" rows="2">@isset($banco) {{ $banco->descripcion }} @endisset</textarea>
                </div>
            </div>
            <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('Banco', []) }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" name="guardarContacto"  class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>