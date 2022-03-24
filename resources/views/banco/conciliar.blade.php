@extends('layouts.master')
@section('title', 'Conciliar banco')
@section('content')
    @include('layouts.alerts')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="text-secondary titleConfig">Conciliar banco</h2>
            <p class="titleConfig text-muted">Compara los movimientos de dinero registrados en tus bancos de Alegra con los reportados por tu entidad bancaria</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Cuenta bancaria</label>
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value selected disabled>Seleccionar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Desde (Ultima conciliación)</label>
                                <input type="date" name="" id="" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Hasta</label>
                                <input type="date" name="" id="" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p class="text-muted text-center" style="color: red !important;">El campo de fecha "Hasta" es requerido</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <p></p>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Script --}}
@section('script')
    {{-- <script src="{{ asset('js/app/banco/editar.js') }}"></script> --}}
@endsection
