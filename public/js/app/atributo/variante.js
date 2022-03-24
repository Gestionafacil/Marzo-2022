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
        "ajax": "/atributo/variante/listado",
        "columns": [
            { data: 'valor', name: 'valor' },
            { data: 'valor_adicional', name: 'valor_adicional' },
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
        $(".input-group.mb-3").remove();
        data = table.row($(this).parents('tr')).data();
        data.valor_adicional.split(",").forEach((element) => {
            agregarOpcion(element);
        });

        $("#id").val(data.id);
        $("#nombre").val(data.valor);
    });

    $("#guardar").on('submit', function(event) {
        event.preventDefault();
        $("#spinLoad").show();
        $.ajax({
            url: "/atributo/variante",
            type: "POST",
            data: $("#guardar").serialize(),
            success: function(res) {
                alertaBonita('success', res.message, "Entendido");
                table.ajax.reload();
                $("#spinLoad").hide();
                $("#id").val('');
                $("#nombre").val('');
                $(".input-group.mb-3").remove();
            },
            error: function(err) {
                console.log(err);
                $("#spinLoad").hide();
            }
        });
    });

    $("button[type='reset']").on('click', (e) => {
        $(".input-group.mb-3").remove();
    });
});

function cambiarEstado(VarianteID) {
    $("#spinLoad").show();
    $('[data-toggle="tooltip"]').tooltip('dispose');
    $.ajax({
        url: '/atributo/variante/cambiarEstado',
        type: 'POST',
        data: { id: VarianteID },
        success: (res) => {
            $("#spinLoad").hide();
            let estado = res.estado == true ? 'activado' : 'desactivado';
            alertaBonita('success', 'El atributo variante ha sido  ' + estado + ' correctamente.', "Entendido");
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
            text: "Estás seguro que deseas eliminar este atributo variante?",
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

/* Agregar opciones */
function agregarOpcion(valor_adicional = "") {
    contador_opciones++;
    $("#Opciones").append('<div class="input-group mb-3" id="divOpcion_' + contador_opciones + '">' +
        '<input type="text" required="true" class="form-control form-control-sm" value="' + valor_adicional + '" placeholder="Opción" name="opcion[]">' +
        '<div class="input-group-append">' +
        '<button type="button" onclick="quitarOpcion( ' + contador_opciones + ' )" class="input-group-text"><i class="fa fa-times"></i></button>' +
        '</div>' +
        '</div>');
}

/* Eliminar Opción */
function quitarOpcion(ID) {
    $("#divOpcion_" + ID).remove();

}