@extends('layouts.master')
@section('title', 'Contacto Todos')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Contactos</h3>
            <p class="titleConfig text-muted">Crea tus clientes, proveedores y demás contactos para asociarlos en tus documentos.</p>
        </div>
        <div class="col-lg-5">
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-upload"></i> Importar desde Excel</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i> Exportar</button>
            <a href="{{ route('ContactoNuevo', []) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Nuevo contacto</a>
        </div>
    </div>
    <hr>
    @include('contacto.partial.tabla_listado_contacto')
@endsection