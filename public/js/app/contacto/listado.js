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
        "ajax": "/contacto/listado?inicio=1&fin=2",
        "columns": [
            { data: 'nombre', name: 'nombre' },
            { data: 'rfc', name: 'rfc' },
            { data: 'telefono', name: 'telefono' },
            { data: 'create_time', name: 'create_time' },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    if (data == 1) {
                        return '<a href="/contacto/vista/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-fw fa-eye text-info"></i></a>' +
                            '<a href="/contacto/editar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fa fa-fw fa-lightbulb text-warning"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarContacto(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>';
                    } else {
                        return '<a href="/contacto/vista/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-fw fa-eye text-info"></i></a>' +
                            '<a href="/contacto/editar/' + row.id + '" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-fw fa-lightbulb text-secondary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarContacto(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>'
                    }
                }
            }
        ]
    }).on('draw', function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
});

function cambiarEstado(contactoID) {

    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/contacto/cambiarEstado',
        type: 'POST',
        data: { id: contactoID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activado' : 'desactivado';
            alertaBonita('success', 'EL contacto ha sido  ' + estado + ' correctamente.', "Entendido");
            table.ajax.reload();
            $('[data-toggle="tooltip"]').tooltip('dispose');
        },
        error: (err) => {
            console.log(err);
        }
    });
}

function eliminarContacto(contactoID) {
    $('[data-toggle="tooltip"]').tooltip('dispose');
    /* Comprobar que si se quiere eliminar el Contacto */
    Swal
        .fire({
            title: "Confirmar eliminación",
            text: "Estás seguro que deseas eliminar este contacto?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        })
        .then(resultado => {
            if (resultado.value) {
                $("#spinLoad").show();
                $.ajax({
                    url: '/contacto/eliminar',
                    type: 'POST',
                    data: { id: contactoID },
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