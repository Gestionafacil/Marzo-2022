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
        "ajax": "/categoria/listado",
        "columns": [
            { data: 'nombre', name: 'nombre' },
            { data: 'descripcion', name: 'descripcion' },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    if (data == 1) {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fa fa-fw fa-lightbulb text-warning"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarCategoria(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>';
                    } else {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-fw fa-lightbulb text-secondary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarCategoria(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>'
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
        $("#descripcion").val(data.descripcion);
    });

    $("#guardar").on('click', function(event) {
        $("#spinLoad").show();
        $.ajax({
            url: "/categoria/guardar",
            type: "POST",
            data: {
                id: $("#id").val(),
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val()
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
        $("#descripcion").val('');
    });

    $("#reset").on('click', function(event) {
        $("#id").val('');
        $("#nombre").val('');
        $("#descripcion").val('');
    });
});

function cambiarEstado(CategoriaID) {
    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/categoria/cambiarEstado',
        type: 'POST',
        data: { id: CategoriaID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activado' : 'desactivado';
            alertaBonita('success', 'La categoría ha sido  ' + estado + ' correctamente.', "Entendido");
            table.ajax.reload();
            $('[data-toggle="tooltip"]').tooltip('dispose');
        },
        error: (err) => {
            console.log(err);
        }
    });
}

function eliminarCategoria(CategoriaID) {
    $('[data-toggle="tooltip"]').tooltip('dispose');
    /* Comprobar que si se quiere eliminar el Categoría */
    Swal
        .fire({
            title: "Confirmar eliminación",
            text: "Estás seguro que deseas eliminar esta categoría?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        })
        .then(resultado => {
            if (resultado.value) {
                $("#spinLoad").show();
                $.ajax({
                    url: '/categoria/eliminar',
                    type: 'POST',
                    data: { id: CategoriaID },
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