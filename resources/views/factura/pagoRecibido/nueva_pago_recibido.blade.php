@extends('layouts.master')
@section('title', 'Pagos Recibidos')
@section('content')
<div class="row">
    <div class="col-lg-7">
        <h3 class="text-secondary titleConfig">Nuevo ingreso</h3>
    </div>
</div>
<hr>
<pago-recibido-component></pago-recibido-component>  
@endsection