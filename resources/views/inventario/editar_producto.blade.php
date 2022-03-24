@extends('layouts.master')
@section('title', 'Editar . . .')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-boxes"></i>Editar producto</h3>
            <p class="titleConfig text-muted">Edita tus productos inventariables y/o servicios que ofreces
                para registrar en tus ventas.</p>
        </div>
    </div>
    <hr>
    @include('layouts.alerts')
    @include('inventario.partial.formulario_producto')
@endsection
@section('script')
    <script src="{{ asset('js/app/inventario/producto/formulario.js') }}"></script>
    <script src="{{ asset('js/app/inventario/producto/editar.js') }}"></script>
@endsection
