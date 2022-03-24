var table;

$(document).ready(function() {
    table = $('#listado').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
            {
                text: 'Refrescar',
                action: function(e, dt, node, config) {
                    table.ajax.reload();
                }
            }
        ],
        "language": language,
        "processing": true,
        "serverSide": true,
        "ajax": "/factura/listado",
        "columns": [
            { data: 'uuid', name: 'uuid' },
            { data: 'Cnombre', name: 'Cnombre' },
            { data: 'create_time', name: 'create_time' },
            { data: 'fecha_vencimiento', name: 'fecha_vencimiento' },
            { data: 'total_valor', name: 'total_valor' },
            { data: 'total_valor', name: 'total_valor' },
            { data: 'total_valor', name: 'total_valor' },
            { data: 'estadoFactura', name: 'estadoFactura' },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    return '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-eye"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-print"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-file"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-unlock"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-money-bill-wave"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="fa fa-pencil-alt"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="text-danger fa fa-minus"></i></button>' +
                        '<button type="button" class="btn btn-xs btn-link"><i class="text-danger fa fa-window-close"></i></button>'
                }
            }
        ],
    }).on('draw', function() {
        $('[data-toggle="tooltip"]').tooltip();
    });


    table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container()));

});

function cambiarEstado(bancoID) {
    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/bancos/cambiarEstado',
        type: 'POST',
        data: { id: bancoID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activado' : 'desactivado';
            alertaBonita('success', 'EL banco ha sido  ' + estado + ' correctamente.', "Entendido");
            table.ajax.reload();
            $('[data-toggle="tooltip"]').tooltip('dispose');
        },
        error: (err) => {
            console.log(err);
        }
    });
}

function eliminarBanco(bancoID) {
    $('[data-toggle="tooltip"]').tooltip('dispose');
    /* Comprobar que si se quiere eliminar el Banco */
    Swal
        .fire({
            title: "Confirmar eliminación",
            text: "Estás seguro que deseas eliminar este banco?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        })
        .then(resultado => {
            if (resultado.value) {
                $("#spinLoad").show();
                $.ajax({
                    url: '/bancos/eliminar',
                    type: 'POST',
                    data: { id: bancoID },
                    success: (res) => {
                        alertaBonita('success', res.message, 'Entendido');
                        $("#spinLoad").hide();
                        table.ajax.reload();
                        $('[data-toggle="tooltip"]').tooltip('dispose');
                    },
                    error: (err) => {
                        $("#spinLoad").hide();
                        alertaBonita('error', err.responseJSON.message, 'Entendido');
                    }
                });
            }
        });
}