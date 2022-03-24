@extends('layouts.master')
@section('title', 'Ajuste Inventario')
@section('content')

<!-- alerta que se muestra cuando la info sea enviada -->

@include('layouts.alerts')

    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-boxes"></i>Ajustes de inventario</h3>
            <p class="titleConfig text-muted">Controla las cantidades de tu inventario registrando Aumentos o Disminuciones</p>
        </div>
        <div class="col-lg-5">
            <a href="{{ route('ajusteNuevo', []) }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Nuevo ajuste de inventario</a>
        </div>
    </div>
    <hr>
    @include('inventario.partial.tabla_lista_ajuste')
@endsection