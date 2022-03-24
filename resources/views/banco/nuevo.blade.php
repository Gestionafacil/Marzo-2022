@extends('layouts.master')
@section('title', 'Nuevo banco')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig">Nuevo banco</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-5 offset-3">
            <form method="POST" action="{{ url('bancos/nuevo', []) }}">
                @include('banco.partial.formulario')
            </form>
        </div>
    </div>
@endsection