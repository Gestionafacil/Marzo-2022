@extends('layouts.master')
@section('title', 'Clientes')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Clientes</h3>
            <p class="titleConfig text-muted">Crea los contactos que asociarás en tus documentos y transacciones de ingresos.</p>
        </div>
        <div class="col-lg-5">
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-upload"></i> Importar desde Excel</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i> Exportar</button>
            <a href="{{ route('ContactoNuevo', []) }}?type=Cliente" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Nuevo cliente</a>
        </div>
    </div>
    <hr>
    @include('contacto.partial.tabla_listado_contacto')
@endsection