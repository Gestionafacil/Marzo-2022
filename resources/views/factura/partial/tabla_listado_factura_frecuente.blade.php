<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="listado">
                <thead>
                    <th>Cliente</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de finalización</th>
                    <th>Total</th>
                    <th>Frecuencia(meses)</th>
                    <th>Frecuencia(dias)</th>
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