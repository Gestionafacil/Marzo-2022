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
        "ajax": "/bancos/listado",
        "columns": [{
                data: 'nombre',
                name: 'nombre',
                render: function(data, type, row) {
                    return '<a href="/bancos/detalle/' + row.id + '">' + row.nombre + '</a>';
                }
            },
            { data: 'numero_cuenta', name: 'numero_cuenta' },
            { data: 'descripcion', name: 'descripcion' },
            { data: 'saldo', name: 'saldo', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    if (data == 1) {
                        return '<a href="/bancos/detalle/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-fw fa-eye text-info"></i></a>' +
                            '<a href="/bancos/editar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fa fa-fw fa-lightbulb text-warning"></i></a>' +
                            '<a href="/bancos/conciliar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Conciliar"><i class="fa fa-fw fa-share text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarBanco(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>';
                    } else {
                        return '<a href="/bancos/detalle/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-fw fa-eye text-info"></i></a>' +
                            '<a href="/bancos/editar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-fw fa-lightbulb text-secondary"></i></a>' +
                            '<a href="/bancos/conciliar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Conciliar"><i class="fa fa-fw fa-share text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarBanco(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>'
                    }
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