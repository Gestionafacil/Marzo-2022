@extends('layouts.master')
@section('title', 'Bancos')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig"><i class="fa fa-piggy-bank"></i> Bancos</h2>
        </div>
        <div class="col-lg-2">
            <a href="{{ route('NuevoBanco', []) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Nuevo banco</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-sm" id="listado">
                <thead>
                    <th>Nombre</th>
                    <th>Número de la cuenta</th>
                    <th>Descripción</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 offset-8">
            <div class="card mt-4">
                <div class="card-body">
                  <span class="float-left" style="font-weight: bold">Total:</span> 
                  <span class="float-right"><i class="fa fa-dollar-sign"></i> {{ number_format($saldo, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/banco/listado.js') }}"></script>
@endsection