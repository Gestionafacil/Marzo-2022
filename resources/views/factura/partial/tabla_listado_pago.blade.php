<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="listado">
                <thead>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Detalle</th>
                    <th>Creación</th>
                    <th>Cuenta</th>
                    <th>Conciliación</th>
                    <th>Estado</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/inventario/listaAjuste.js') }}"></script>
@endsection