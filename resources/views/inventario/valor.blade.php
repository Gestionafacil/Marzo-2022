@extends('layouts.master')
@section('title', 'Valor de inventario')
@section('content')
    <div class="row">
        <div class="col-lg-7">
            <h3 class="text-secondary titleConfig">Valor de inventario</h3>
            <p class="titleConfig text-muted">Consulta el valor del inventario actual, la cantidad de ítems inventariables que tienes y su costo promedio.</p>
        </div>
        <div class="col-lg-5">
            <button class="btn btn-sm btn-outline-secondary float-right"><i class="fa fa-download"></i> Exportar a Excel</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Hasta <span class="text-primary">*</span></label>
                <input type="date" name="hasta" id="hasta" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group mt-1">
                <button type="button" class="btn btn-sm btn-primary mt-4">Generar reporte</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-response">
                <table class="table table-sm" id="listado">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Referencia</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Estado</th>
                            <th>Costo promedio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 offset-8">
            <div class="card mt-2">
                <div class="card-body bg-secondary">
                  <span class="float-left" style="font-weight: bold">Saldo:</span> 
                  <span class="float-right"><i class="fa fa-dollar-sign"></i>{{ number_format($total->valor, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var table;

        $(document).ready(function() {
            table = $('#listado').DataTable({
                "language": language,
                "processing": true,
                "serverSide": true,
                "ajax": "/inventario/valor/listado",
                "columns": [
                    { data: 'nombre', name: 'nombre', 
                        render: function(data, type, row) {
                            return '<a href="/inventario/producto/detalle/' + row.id + '">' + row.nombre + '</a>';
                        }
                    },
                    { data: 'referencia', name: 'referencia' },
                    { data: 'descripcion', name: 'descripcion' },
                    { data: 'cantidad_inicial', name: 'cantidad_inicial' },
                    { data: 'unidad_medida_id', name: 'unidad_medida_id', render: function(data, type, row){
                        return '<span data-toggle="tooltip" data-placement="top" title="'+row.unidad+'" class="btn btn-link">'+row.unidad_medida_id+'</span>';
                    } },
                    { data: 'estado', name: 'estado' },
                    { data: 'costo_inicial', name: 'costo_inicial', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                    { data: 'total', name: 'total', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                    /* { data: 'saldo', name: 'saldo', render: $.fn.dataTable.render.number(',', '.', 2, '$') }, */
                ],
            }).on('draw', function(){
                /* Activar Tooltip */
                $('[data-toggle="tooltip"]').tooltip();
            });
        });
    </script>
@endsection