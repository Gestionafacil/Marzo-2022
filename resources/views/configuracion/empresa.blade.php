@extends('layouts.master')
@section('title', 'Empresa')
@section('content')
    @include('layouts.alerts')
    <form method="POST" id="formEmpresa" autocomplete="off" method="{{ url('configuracion/empresa', []) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id" name="id" value="{{ isset($empresa->id) ? $empresa->id : ''  }}">
        <div class="card mt-2">
            <div class="card-header">
                <h5 class="card-title"><i class="fa fa-users"></i> Datos de la empresa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-xs-3 col-xl-3">
                        <label>Nombre <span class="text-success">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            name="nombre" 
                            id="nombre" 
                            required 
                            value="{{ isset($empresa->nombre) ? $empresa->nombre : '' }}">
                    </div>
                    <div class="form-group col-xs-2 col-xl-2">
                        <label>RFC</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            name="rfc" id="rfc"
                            placeholder="RFC"
                            value="{{ isset($empresa->rfc) ? $empresa->rfc : '' }}">
                    </div>
                    <div class="form-group col-xs-2 col-xl-2">
                        <label>Calle</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="calle" 
                            name="calle" 
                            placeholder="Calle"
                            value="{{ isset($empresa->calle) ? $empresa->calle : '' }}">
                    </div>
                    <div class="form-group col-xs-1 col-xl-1">
                        <label>Exterior</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="exterior" 
                            name="exterior" 
                            placeholder="Exterior"
                            value="{{ isset($empresa->exterior) ? $empresa->exterior : '' }}">
                    </div>
                    <div class="form-group col-xs-1 col-xl-1">
                        <label>Interior</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="interior" 
                            name="interior" 
                            placeholder="Interior"
                            value="{{ isset($empresa->interior) ? $empresa->interior : '' }}">
                    </div>
                    <div class="form-group col-xs-2 col-xl-2">
                        <label>Colonia</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="colonia" 
                            name="colonia" 
                            placeholder="Colonia"
                            value="{{ isset($empresa->colonia) ? $empresa->colonia : '' }}">
                    </div>
                    <div class="form-group col-xs-3 col-xl-2">
                        <label>Teléfono</label>
                        <input 
                            type="number" 
                            class="form-control form-control-sm" 
                            id="telefono" 
                            name="telefono" 
                            placeholder="Teléfono"
                            value="{{ isset($empresa->telefono) ? $empresa->telefono : '' }}">
                    </div>
                    <div class="form-group col-xs-3 col-xl-2">
                        <label>Web site</label>
                        <input 
                            type="url" 
                            class="form-control form-control-sm" 
                            id="website" 
                            name="website"
                            placeholder="Sitio WEB"
                            value="{{ isset($empresa->website) ? $empresa->website : '' }}">
                    </div>
                    <div class="form-group col-xs-3 col-xl-3">
                        <label>Correo electrónico</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm" 
                            id="email" 
                            name="email" 
                            placeholder="Correp electrónico"
                            value="{{ isset($empresa->email) ? $empresa->email : '' }}">
                    </div>
                    <div class="form-group col-xs-2 col-xl-2">
                        <label>Número de empleados</label>
                        <select class="form-control form-control-sm" id="num_empleados" name="num_empleados">
                            <option selected value disabled>Selecciona</option>
                            @foreach ($num_empleados as $item)
                            @if ($item->id == $empresa->num_empleados)
                                <option selected value="{{ $item->id }}">{{ $item->valor }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->valor }}</option>
                            @endif    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-2 col-xl-2">
                        <label>Precisión decimal <span class="text-success">*</span></label>
                        <select class="form-control form-control-sm" id="precision_decimal" name="precision_decimal" required>
                            <option selected value disabled>Selecciona</option>
                            @foreach ($precision_decimal as $item)
                                @if ($item->id == $empresa->precision_decimal)
                                    <option selected value="{{ $item->id }}">{{ $item->valor_adicional }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->valor_adicional }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-3 col-xl-3">
                        <label><small><b>Separador decimal para exportables</b></small></label>
                        <select class="form-control form-control-sm" id="separador_decimal_export" name="separador_decimal_export">
                            <option selected value="0">Selecciona</option>
                            @foreach ($separador_decimal as $item)
                                @if ( $item->id == $empresa->separador_decimal_export )
                                    <option selected value="{{ $item->id }}">{{ $item->valor_adicional }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->valor_adicional }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-xs-3 col-xl-3">
                        <label>Sector socioeconómico</label>
                        <select class="form-control form-control-sm" id="sector_socioeconomico_id" name="sector_socioeconomico_id">
                            <option selected value="0">Selecciona</option>
                            @foreach ($sectores as $item)
                                @if ( $item->id == $empresa->sector_socioeconomico_id )
                                    <option selected value="{{ $item->id }}">{{ $item->valor }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->valor }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-xs-3 col-xl-3">
                        <label for="seleccionarLogo" style="cursor: pointer;">
                            <input type="file" name="seleccionarLogo" id="seleccionarLogo" accept="image/*" hidden>
                            <figure class="select-image">
                                <img src="{{ asset('img/seleccionarImagen.png') }}" id="previsualizarLogo">
                                <figcaption class="text-muted">
                                    {{-- Logo de empresa --}}
                                </figcaption>
                            </figure>
                        </label>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Activar Factura Electronica</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <small>La factura electrónica es un documento para soportar la venta de productos o servicios, y
                                se reporta al <strong>SAT</strong> en el momento que se genera.</small>
                        </p>
                        <div class="row d-block">
                            <div class="float-md-right">
                                <button type="button" id="btnDesactFact" class="btn btn-danger btn-sm required"
                                    onclick="estadoFacturacion(false)" hidden>Desactivar</button>
                                <button type="button" id="btnActivaFact" class="btn btn-secondary btn-sm required"
                                    onclick="estadoFacturacion(true)">Activar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='card hidden' id="card-activo" hidden>
                    <div class="card-header">
                        <h5 class="card-title">Certificado para timbrar CFDI</h5>
                    </div>
                    <div class='card-body'>
                        <p><small>Carga tu certificado de sello digital, llave y contraseña asociada para timbrar tus comprobantes. <a href="#">Ver más</a>.</small></p>
                        <div class="row">
                            <div class="form-group col-12">
                                <div class="input-file input-file--reverse">
                                    <label for="" class="input-file__field"></label>
                                    <input type="file" id="file2" class="input-file__input">
                                    <label for="file2" class="input-file__btn"><small>Certificado CSD(.cer)</small>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="input-file input-file--reverse">
                                    <label for="" class="input-file__field"></label>
                                    <input type="file" id="file" class="input-file__input">
                                    <label for="file" class="input-file__btn"><small>LLave privada(.key)</small></label>
                                </div>
                            </div>
                            <div class="form-inline col-12">
                                <label>Contraseña</label>
                                <input type="password" class="form-control form-control-sm" name="passwordFact"
                                    id="passwordFact">
                            </div>
                        </div>
                        <p>
                            <small>Nuestro PAC autorizado para generar CFDI es Quadrum, si deseas conocer cómo firmar el manifiesto de autorización,<a href="#"> haz clic aquí.</a></small>
                        </p>
                        <p><small>Si necesitas ayuda paso a paso haz clic en <a href="#">ver más.</a></small></p>
                    </div>
                </div>
            </div>
            <p class="text-muted text-center">Todos los campos con <span class="text-success">*</span> son de caracter obligatorio.</p>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{ asset('js/app/configuracionController.js') }}"></script>
@endsection