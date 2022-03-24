var contador_opciones = 0;

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
        "ajax": "/configuracion/listadoDescripcion/20",
        "columns": [
            { data: 'valor', name: 'valor' },
            { data: 'descripcion', name: 'descripcion' },
            { data: 'valor_defecto', name: 'valor_defecto' },
            {
                data: 'estado',
                name: 'estado',
                "render": function(data, type, row) {
                    columna = row;
                    if (data == 1) {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fa fa-fw fa-lightbulb text-warning"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarVariante(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>';
                    } else {
                        return '<a class="editar" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-fw fa-pencil-alt text-primary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="cambiarEstado(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-fw fa-lightbulb text-secondary"></i></a>' +
                            '<a style="cursor: pointer;" onclick="eliminarVariante(' + parseInt(row.id) + ')" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-fw fa-times text-danger"></i></a>'
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
        $("#valor").val(data.valor);
        $("#valor_adicional").val(data.valor_adicional);
        if (data.valor_defecto == "VALOR") {
            $("#tipo_lista_precio_valor").prop("checked", true);
            $("#div_check_porcentaje_lista_precio").hide();
        } else {
            $("#tipo_lista_precio_porcentaje").prop("checked", true);
            $("#div_check_porcentaje_lista_precio").show();
        }
    });

    $("#guardar").on('submit', function(event) {
        event.preventDefault();
        $.post("/configuracion/parametro/" + 20, $("#guardar").serialize(), function(data) {
            $("#lista_precios_id").append('<option value="' + data.id + '">' + data.valor + '</option>');
            alert('Se ha creado con exito la lista de precios ' + data.valor);
            $(".modal").modal('hide');
            table.ajax.reload();
            $("#guardar")[0].reset()
        });
    });

    $("button[type='reset']").on('click', (e) => {
        $("#id").val('');
        $("#div_check_porcentaje_lista_precio").hide();
    });
});

function cambiarEstado(VarianteID) {
    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/configuracion/descripcion/cambiarEstado',
        type: 'POST',
        data: { id: VarianteID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activada' : 'desactivada';
            alertaBonita('success', 'La lista de precios ha sido  ' + estado + ' correctamente.', "Entendido");
            table.ajax.reload();
            $('[data-toggle="tooltip"]').tooltip('dispose');
        },
        error: (err) => {
            console.log(err);
        }
    });
}

function eliminarVariante(VarianteID) {
    $('[data-toggle="tooltip"]').tooltip('dispose');
    /* Comprobar que si se quiere eliminar el Categoría */
    Swal
        .fire({
            title: "Confirmar eliminación",
            text: "Estás seguro que deseas eliminar esta lista de precios?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        })
        .then(resultado => {
            if (resultado.value) {
                $("#spinLoad").show();
                $.ajax({
                    url: '/atributo/variante/eliminar',
                    type: 'POST',
                    data: { id: VarianteID },
                    success: (res) => {
                        alertaBonita('success', 'Lista de precios eliminada correctamente.', 'Entendido');
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

function opcionesListaPrecio(_this) {

    if (_this.value == 'PORCENTAJE') {
        $("#div_check_porcentaje_lista_precio").show();
    } else {
        $("#div_check_porcentaje_lista_precio").hide();
    }
}