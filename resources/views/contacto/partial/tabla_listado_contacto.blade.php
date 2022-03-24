<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-sm" id="listado">
            <thead>
                <th>Nombre</th>
                <th>Identificacion</th>
                <th>Teléfono</th>
                <th>Creado</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
{{-- Script --}}
@section('script')
    <script src="{{ asset('js/app/contacto/listado.js') }}"></script>
@endsection