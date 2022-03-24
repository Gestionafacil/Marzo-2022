$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Idioma para DataTables */
const language = {
    "decimal": "",
    "emptyTable": "No hay información",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ Entradas",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "Sin resultados encontrados",
    "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
    }
}

$(document).ready(function() {

    /* Activar Select2 */
    $(".select").select2();

    /* Activar Tooltip */
    $('[data-toggle="tooltip"]').tooltip();

    /* Activar Popover */
    activarPopovers();
});

function activarPopovers() {
    $('[data-toggle="popover"]').popover({
        container: 'body',
        trigger: 'hover',
        template: '<div style="width: 400px !important;" class="popover" role="tooltip"><div class="arrow"></div><div class="popover-body"></div></div>',
        html: true,
        placement: 'left',
        sanitize: false,
        content: function() {
            let estado = $(this).data('incluir_notificacion') == 1 ? 'activo' : 'inactivo';
            let checked = $(this).data('incluir_notificacion') == 1 ? 'checked' : '';
            let letra = $(this).data('nombre').charAt(0);
            let email = $(this).data('email') == null ? '-' : $(this).data('email');
            let telefono = $(this).data('telefono') == null ? '-' : $(this).data('telefono');

            return '<div class="row">' +
                '<div class="col-lg-2">' +
                '<span class="bg-' + $(this).data('class') + ' circle-letra">' + letra + '</span>' +
                '</div>' +
                '<div class="col-lg-10">' +
                '<h5><label class="mx-1" style="font-size: 15px !important; color: #707070;">' + $(this).data('nombre') + '</label></h5>' +
                '<label class="d-block">' + email + '</label>' +
                '<label class="d-block">' + telefono + '</label>' +
                '<div class="form-check">' +
                '<input type="checkbox" ' + checked + ' class="form-check-input" id="incluir_estado_cuenta" name="incluir_estado_cuenta" value="1">' +
                '<label class="form-check-label" for="incluir_estado_cuenta">' +
                'Envío de notificaciones ' + estado +
                '</label>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
    });
}

function alertaBonita(icon, title, confirmButtonText) {
    Swal.fire({
        icon: icon,
        title: title,
        showConfirmButton: true,
        timer: 9000,
        timerProgressBar: true,
        confirmButtonText: confirmButtonText,
        toast: true,
        position: "top-end",
        allowOutsideClick: true,
        allowEscapeKey: true,
        allowEnterKey: true,
        stopKeydownPropagation: true,
    });
}

$(function() {
    $('.chosen-select').chosen();
    $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
});

$("input[data-type='currency']").on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() {
        formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$" + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "$" + input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}