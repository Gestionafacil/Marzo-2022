@extends('layouts.master')
@section('title', 'Nueva factura')
@section('content')
<div class="row">
    <div class="col-lg-7">
        <h3 class="text-secondary titleConfig">Nueva factura</h3>
    </div>
</div>
<hr>

<factura-venta-component :dmetodopago="{{ $metodo_Pago }}" 
                         :forma_pago = "{{ $forma_pago }}" 
                         :almacen="{{ $almacen }}" 
                         :lista_precio="{{ $lista_precio }}" 
                         :vendedor="{{ $vendedor }}" 
                         :contacto="{{ $contacto }}" 
                         :plazo_pago="{{ $plazo_pago }}" 
                         :uso="{{ $uso }}"
                         :producto="{{ $producto }}"
                         :impuestos="{{ $impuestos }}"
                         >
  
</factura-venta-component>
@endsection
@section('script')
    <script src="{{ asset('js/app/facturacion/factura.js') }}"></script>
@endsection
