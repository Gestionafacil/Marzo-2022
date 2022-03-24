@extends('layouts.master')
@section('title', 'Productos')
@section('content')

<!-- alerta que se muestra cuando la info sea enviada -->

@include('layouts.alerts')

    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-boxes"></i>Productos</h3>
            <p class="titleConfig text-muted">Crea, edita y administra cada detalle de tus ítems de venta.</p>
        </div>
        <div class="col-lg-5">
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-upload"></i> Importar desde Excel</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-download"></i> Exportar</button>
            <a href="{{ route('productoNuevo', []) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Nuevo producto</a>
        </div>
    </div>
    <hr>
    @include('inventario.partial.tabla_listado_producto')
@endsection