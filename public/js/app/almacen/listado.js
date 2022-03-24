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
        "ajax": "/almacen/listado",
        "columns": [{
                data: 'nombre',
                name: 'nombre',
                render: function(data, type, row) {
                    return '<a href="/almacen/detalle/' + row.id + '">' + row.nombre + '</a>';
                }
            },
            { data: 'direccion', name: 'direccion' },
            { data: 'observacion', name: 'observacion' },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    if (data == 1) {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fa fa-fw fa-lightbulb text-warning"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarAlmacen(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>';
                    } else {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-fw fa-lightbulb text-secondary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarAlmacen(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>'
                    }
                }
            }
        ],
    }).on('draw', function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container()));

    $('#listado tbody').on('click', '.editar', function() {
        data = table.row($(this).parents('tr')).data();
        $("#id").val(data.id);
        $("#nombre").val(data.nombre);
        $("#direccion").val(data.direccion);
        $("#observacion").val(data.observacion);
    });

    $("#guardar").on('click', function(event) {
        $("#spinLoad").show();
        $.ajax({
            url: "/almacen/guardar",
            type: "POST",
            data: {
                id: $("#id").val(),
                nombre: $("#nombre").val(),
                direccion: $("#direccion").val(),
                observacion: $("#observacion").val()
            },
            success: function(res) {
                alertaBonita('success', res.message, "Entendido");
                table.ajax.reload();
                $("#spinLoad").hide();
            },
            error: function(err) {
                console.log(err);
                $("#spinLoad").hide();
            }
        });

        $("#id").val('');
        $("#nombre").val('');
        $("#direccion").val('');
        $("#observacion").val('');
    });

    $("#reset").on('click', function(event) {
        $("input, textarea").val('');
    });
});

function cambiarEstado(AlmacenID) {
    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/almacen/cambiarEstado',
        type: 'POST',
        data: { id: AlmacenID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activado' : 'desactivado';
            alertaBonita('success', 'EL almacen ha sido  ' + estado + ' correctamente.', "Entendido");
            table.ajax.reload();
            $('[data-toggle="tooltip"]').tooltip('dispose');
        },
        error: (err) => {
            console.log(err);
        }
    });
}

function eliminarAlmacen(AlmacenID) {
    $('[data-toggle="tooltip"]').tooltip('dispose');
    /* Comprobar que si se quiere eliminar el Almacen */
    Swal
        .fire({
            title: "Confirmar eliminación",
            text: "Estás seguro que deseas eliminar este almacen?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        })
        .then(resultado => {
            if (resultado.value) {
                $("#spinLoad").show();
                $.ajax({
                    url: '/almacen/eliminar',
                    type: 'POST',
                    data: { id: AlmacenID },
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

function editarAlmacen(AlmacenID) {
    console.log(AlmacenID);
}