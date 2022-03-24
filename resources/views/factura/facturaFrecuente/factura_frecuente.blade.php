@extends('layouts.master')
@section('title', 'Nueva factura')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig"><i class="fa fa-shield-alt"></i>Facturas de venta frecuentes</h3>
        </div>
        <div class="col-lg-5">
            <a href="{{ route('nuevaFacturaFrecuente', []) }}" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i>
                Nueva factura de recurrente</a>
        </div>
    </div>
    <hr>
    @include('factura.partial.tabla_listado_factura_frecuente')
@endsection