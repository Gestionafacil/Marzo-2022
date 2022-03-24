@extends('layouts.master')
@section('title', $banco->nombre)
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig">{{ $banco->nombre }}</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-5 offset-3">
            @include('banco.partial.formulario')
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/banco/editar.js') }}"></script>
@endsection
