@extends('layouts.master')
@section('title', 'Atributos')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"> Atributos</h2>
            <p class="titleConfig text-muted">Agrega información adicional y personaliza las características de tus productos de venta.</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('AtributoVariante', []) }}" class="h6 text-center text-white">Variantes</a>
                </div>
                <div class="card-body">
                    <p>Configura atributos variables que definen las características de tus productos, como color y talla.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('AtributoCampo', []) }}" class="h6 text-center text-white">Campos adicionales</a>
                </div>
                <div class="card-body">
                    <p>Crea campos adicionales para agregar información extra en tus items, como el código de barras.</p>
                </div>
            </div>
        </div>
    </div>
@endsection