/* TR */
var fila = $("#lo-que-vamos-a-copiar").html();
$("#lo-que-vamos-a-copiar").html('');

$(document).ready(function() {

    /* Buscar productos */
    $("#btnBuscar").on('click', function() {
        /* Obtener los productos */
        $.get('/inventario/producto/listado/ajuste?q=' + $("#buscarProducto").val(), function(res) {
            if (res.length === 0) {
                alertaBonita('error', 'No hay ningún producto', 'OK');
            } else {
                /* Limpiar el Modal */
                $("#tbodyProductos").html('');

                /* Agregar los productos a la tabla */
                res.forEach(element => {
                    $("#tbodyProductos").append("<tr>" +
                        "<td>" + element.nombre + "</td>" +
                        "<td>" + element.referencia + "</td>" +
                        "<td>" + element.cantidad_inicial + "</td>" +
                        "<td><button type='button' class='btn btn-xs btn-primary' onclick='addFill(" + JSON.stringify(element) + ");'>Seleccionar</button></td>" +
                        "</tr>");
                });

                /* Mostrar el modal */
                $("#productos").modal('show');
            }
        });
    });

});

/* Función para agregar nueva Fila a la tabla */
function addFill(element) {
    console.log(element);
    if ($("#fila_id_" + element.id).length > 0) {
        alertaBonita("error", "Este producto ya se encuentra gregado", "OK");
        return;
    }

    /* Agregar una nuea fila */
    let html = '<tr id="fila_id_' + element.id + '">' +
        '<td>' +
        '    <input type="text" name="nombre[]" value="' + element.nombre + '" class="form-control form-control-sm text-center">' +
        '    <input type="hidden" name="producto_id[]" value="' + element.id + '">' +
        '</td>' +
        '<td><input type="text" name="cantidad_actual[]" value="' + element.cantidad_inicial + '" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>' +
        '<td>' +
        '    <select name="tipo_ajuste[]" onchange="cambiarAjuste(this)" class="form-control form-control-sm text-center">' +
        '        <option value="0">Incremento</option>' +
        '        <option value="1">Decremento</option>' +
        '    </select>' +
        '</td>' +
        '<td><input type="text" name="cantidad[]" value="0" onkeyup="cambiarAjuste(this)" class="form-control form-control-sm text-center"></td>' +
        '<td><input type="text" name="cantidad_final[]" value="' + element.cantidad_inicial + '" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>' +
        '<td><input type="text" name="costo_unitario[]" onkeyup="cambiarAjuste(this)" value="' + element.costo_inicial + '" class="form-control form-control-sm text-center"></td>' +
        '<td><input type="text" name="total_ajustado[]" value="' + element.costo_inicial * 0 + '" class="form-control form-control-sm text-center" style="border: none; background: none;" disabled></td>' +
        '<td><button type="button" onclick="eliminarFila(this)" class="btn btn-sm btn-danger">&times;</button></td>' +
        '</tr>';
    $("#lo-que-vamos-a-copiar").prepend(html);
    cambiarPrecioTotal();
}


$('#agregar_producto').on('click', function() {
    let element = "<tr>" +
        "<td><select name='producto_id[]' class='form-control form-control-sm select-producto'></select></td>" +
        "<td class='text-center'><input type='number' name='cantidad_actual[]' class='form-control form-control-sm' value='0' min='0'/></td>" +
        "<td><select class='form-control form-control-sm' name='tipo_ajuste[]'>" +
        " <option selected value='1'>Incremento</option>" +
        " <option value='2'>Decremento</option>" +
        "</select></td>" +
        "<td class='text-center'><input type='number' name='cantidad[]' class='form-control form-control-sm' value='0' min='0'/></td>" +
        "<td class='text-center'><input type='number' name='cantidad_final[]' class='form-control form-control-sm' value='0' min='0'/></td>" +
        "<td class='text-center'><input type='number' name='costo_unitario[]' class='form-control form-control-sm' value='0' min='0'/></td>" +
        /* "<td>  <input type='text' required class='currentMoney form-control form-control-sm' pattern='^\$\d{1,3}(,\d{3})*(\.\d+)?$0 value='' data-type='currency' placeholder='$0,00'></td>" + */
        "<td class='text-center'><input type='number' name='total_ajustado[]' class='form-control form-control-sm' value='0' min='0'/></td>" +
        "<td class='text-center'><a href='#' onclick='eliminarFila(this);'><span aria-hidden='true'>X</span></a></td></tr>";

    document.getElementById("idTable").insertRow(-1).innerHTML = element;
    evento();

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });
})

/* Función para eliminar la fila */
function eliminarFila(position) {
    var row = position.parentNode.parentNode;
    row.parentNode.removeChild(row);
    cambiarPrecioTotal();
}

/* Función para Cambiar las propiedades del Ajuste */
function cambiarAjuste(position) {
    var row = position.parentNode.parentNode;
    var cantidad_final = $("#" + row.id + " input[name='cantidad_final[]']");
    var total_ajustado = $("#" + row.id + " input[name='total_ajustado[]']");
    var cantidad_actual = $("#" + row.id + " input[name='cantidad_actual[]']").val();
    var cantidad = $("#" + row.id + " input[name='cantidad[]']").val();
    var costo_unitario = $("#" + row.id + " input[name='costo_unitario[]']").val();
    var tipo_ajuste = $("#" + row.id + " select[name='tipo_ajuste[]']").val();


    if (cantidad) {
        switch (tipo_ajuste) {
            case '0':
                cantidad_final.val(parseInt(cantidad_actual) + parseInt(cantidad));
                break;
            case '1':
                cantidad_final.val(parseInt(cantidad_actual) - parseInt(cantidad));
                break;
        }
    }

    switch (tipo_ajuste) {
        case '0':
            total_ajustado.val(parseInt(cantidad) * parseInt(costo_unitario));
            break;
        case '1':
            total_ajustado.val(parseInt(cantidad) * parseInt(-costo_unitario));
            break;
    }

    /* switch (tipo_ajuste) {
        case 'Incremento':
            total_ajustado.val(parseInt(position.value) * parseInt(costo_unitario));
            break;
        case 'Decremento':
            total_ajustado.val(parseInt(cantidad_final.val()) * parseInt(costo_unitario));
            break;
    } */

    cambiarPrecioTotal();
}

/* Función para ir incrementando o decrementando el precio_total */
function cambiarPrecioTotal() {
    var x = 0;
    document.querySelectorAll("input[name='total_ajustado[]']").forEach((e) => { x += parseInt(e.value); })
    $("#precio_total").val(x);
}

function evento() {
    $('.select-producto').select2({
        placeholder: 'Seleccione el producto',
        ajax: {
            url: '/atributo/SAT',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.valor,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
}

function between(min, max) {
    return Math.floor(
        Math.random() * (max - min) + min
    )
}