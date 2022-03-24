$(".lista_precio").hide();

$(document).ready(function() {

    /* Calve producto SAT */
    $('#clave_producto_sat').select2({
        placeholder: 'Seleccione Clave SAT',
        ajax: {
            url: '/atributo/SAT',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.valor_adicional + " - " + item.valor,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    /* Ocultar los dependientes del inventario */
    $('#producto_inventariable').on('change', function(event) {

        if ($("#producto_inventariable").prop("checked")) {
            $(".depende_inventario").show();
            controlarRequired('.depende_inventario', true);
        } else {
            $(".depende_inventario").hide();
            controlarRequired('.depende_inventario', false);
        }

    });

    $('#aplica_lista_precio').on('change', function(event) {

        if ($("#aplica_lista_precio").prop("checked")) {
            $(".lista_precio").show();
            controlarRequired('.lista_precio', true);
        } else {
            $(".lista_precio").hide();
            controlarRequired('.lista_precio', false);
        }

    });

});

function controlarRequired(clase, boleano) {
    $(clase + ' input, ' + clase + ' select').attr("required", boleano);
}

function calcularPrecioTotal() {
    let impuesto = parseFloat($("#impuesto_id option:selected").data('valor')) * parseFloat($("#precio_sin_impuesto").val());

    $("#precio_total").val(impuesto + parseFloat($("#precio_sin_impuesto").val()));
}