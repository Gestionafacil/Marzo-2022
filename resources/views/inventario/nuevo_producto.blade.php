@extends('layouts.master')
@section('title', 'Nuevo producto')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Nuevo producto</h3>
            <p class="titleConfig text-muted">Crea tus productos inventariables y/o servicios que ofreces
                para registrar en tus ventas.</p>
        </div>
    </div>
    <hr>
    @include('layouts.alerts')
   @include('inventario.partial.formulario_producto')

@endsection
@section('script')
    <script src="{{ asset('js/app/inventario/producto/formulario.js') }}"></script>
@endsection

