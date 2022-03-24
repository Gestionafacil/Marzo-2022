@extends('layouts.master')
@section('title', 'Facturas')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-shield-alt"></i>Facturas y tickets</h3>
        </div>
        <div class="col-lg-5">
            <a href="{{ route('nuevaFacturaVenta', []) }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i>
                Nueva factura de venta</a>
        </div>
    </div>
    <hr>
    {{-- <factura-venta-listado-component :facturas = "{{ $facturas }}"></factura-venta-listado-component> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <table class="table table-hover table-sm" id="listado">
                    <thead>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Creacion</th>
                        <th>Vencimiento</th>
                        <th>Total</th>
                        <th>Cobrado</th>
                        <th>Por cobrar</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/facturaVenta/listado.js') }}"></script>
@endsection