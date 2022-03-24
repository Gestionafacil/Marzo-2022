@extends('layouts.master')
@section('title', $banco->nombre)
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-3">
            <h2 class="text-secondary titleConfig">{{ $banco->nombre }}</h2>
        </div>
        <div class="col-lg-9 text-center mt-2">
            <button class="btn btn-xs btn-outline-primary px-3 mx-1"><i class="fa fa-plus"></i> Agregar dinero</button>
            <button class="btn btn-xs btn-outline-primary px-3 mx-1"><i class="fa fa-minus"></i> Retirar dinero</button>
            <button class="btn btn-xs btn-outline-primary px-3 mx-1"><i class="fa fa-minus"></i> Transferencia</button>
            <button class="btn btn-xs btn-outline-primary px-3 mx-1">Conciliar</button>
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-outline-primary dropdown-toggle px-3 mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más opciones</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" href="#">Desactivar</a>
                    <a class="dropdown-item" href="#">Ver conciliaciones</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 offset-8">
            <div class="card mt-2">
                <div class="card-body bg-secondary">
                  <span class="float-left" style="font-weight: bold">Saldo:</span> 
                  <span class="float-right"><i class="fa fa-dollar-sign"></i>{{ number_format($banco->saldo, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-sm" id="transaccion">
                <thead>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Conciliado</th>
                    <th>Cuenta contable</th>
                    <th>Estado</th>
                    <th>Salidas</th>
                    <th>Entradas</th>
                    <th>Acciones</th>    
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    {{-- Script --}}
    @section('script')
        <script src="{{ asset('js/app/banco/transaccion.js') }}"></script>
    @endsection
@endsection