var cantidad_personas_asociadas = 0;

$(document).ready(() => {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const type = urlParams.get('type');

    switch (type) {
        case 'Proveedor':
            $("#check_proveedor").attr('checked', true);
            opcionesProveedor();
            break;

        case 'Cliente':
            $("#check_cliente").attr('checked', true);
            opcionesCliente();
            break;

        default:
            opcionesCliente();
            break;
    }
});

document.getElementById("check_proveedor").addEventListener('click', opcionesProveedor, false);
document.getElementById("check_cliente").addEventListener('click', opcionesCliente, false);
document.getElementById("btnAsociarPersonas").addEventListener('click', asociarPersonaModal, false);
document.getElementById("btnModalAsociarPersonas").addEventListener('click', mostrarModalPersonasAsociadas, false);

$("#btnVendedor").on('click', function() { guardarVendedor(); });

$("#btnListaPrecio").on('click', function() { guardarListaPrecio(); });

/* Renderizar las personas asociadas */
function asociarPersona(id, nombre, email, telefono, celular, notificaciones) {

    if (id != undefined) {
        $("span[id='" + id + "']").remove();

    }

    let content = '<span class="border-bottom d-block py-2 show-popover" id="' + id + '">' +
        '<input type="hidden" name="persona_asociada_nombre[]" value="' + nombre + '">' +
        '<input type="hidden" name="persona_asociada_email[]" value="' + email + '">' +
        '<input type="hidden" name="persona_asociada_telefono[]" value="' + telefono + '">' +
        '<input type="hidden" name="persona_asociada_celular[]" value="' + celular + '">' +
        '<input type="hidden" name="persona_asociada_notificaciones[]" value="' + notificaciones + '">' +
        '<button ' +
        'type="button" ' +
        'class="btn btn-link" ' +
        'data-toggle="popover" ' +
        'id="lista_personas_asociadas_' + id + '"' +
        'data-nombre="' + nombre + '"' +
        'data-id="' + id + '"' +
        'data-email="' + email + '"' +
        'data-telefono="' + telefono + '"' +
        'data-celular="' + celular + '"' +
        'data-incluir_notificacion="' + notificaciones + '"' +
        'data-class="success">' +
        '<span class="circle-letra bg-success">' + nombre.charAt(0) + '</span>' +
        '</button>' +
        '<label class="mx-1" style="font-size: 15px !important; color: #707070;">' + nombre + '</label>' +
        '<div class="d-inline float-right" style="color: #707070;">' +
        '<button type="button" class="btn btn-link" onclick="editarPersonaAsociada(' + id + ')"><i class="fa fa-pencil-alt"></i></button>' +
        '<button type="button" class="btn btn-link" onclick="eliminarPersonaAsociada(' + id + ')"><i class="fa fa-times"></i></button>' +
        '</div>' +
        '</span>';

    $("#boxPersonasAsociadas").append(content);

    activarPopovers();
}


/* Renderizar los datos de la persona asociada en el formulario del modal */
function editarPersonaAsociada(id) {

    $("#asociar_persona_id").val(id);
    $("#asociar_persona_nombre").val($("#lista_personas_asociadas_" + id).data('nombre'));
    $("#asociar_persona_email").val($("#lista_personas_asociadas_" + id).data('email'));
    $("#asociar_persona_telefono").val($("#lista_personas_asociadas_" + id).data('telefono'));
    $("#asociar_persona_celular").val($("#lista_personas_asociadas_" + id).data('celular'));
    var chk = $("#lista_personas_asociadas_" + id).data('incluir_notificacion') == 1 ? true : false;
    $("#asociar_persona_incluir_enviar_notificaciones").prop('checked', chk);

    $("#modalAsociarPersona").modal('show');
}

/* Funciónes para controlar las opciones si el contacto es Cliente o Proveedor */
function opcionesProveedor() {
    if ($("#check_proveedor").prop('checked')) {
        $("#tipo_operacion").prop('required', true);
        $("#div_tipo_operacion").show();
    } else {
        opcionesCliente();
    }
}

function opcionesCliente() {
    if (!$("#check_proveedor").prop('checked')) {
        $("#tipo_operacion").prop('required', false);
        $("#div_tipo_operacion").hide();
    }
}

function asociarPersonaModal() {
    let id = $("#asociar_persona_id").val();
    let nombre = $("#asociar_persona_nombre").val();
    let email = $("#asociar_persona_email").val();
    let telefono = $("#asociar_persona_telefono").val();
    let celular = $("#asociar_persona_celular").val();
    let notificaciones = $("#asociar_persona_incluir_enviar_notificaciones").prop('checked');

    if (id == "") {
        id = cantidad_personas_asociadas++
    }
    asociarPersona(id, nombre, email, telefono, celular, notificaciones);

    document.getElementById("fap").reset();
    $("#modalAsociarPersona").modal('hide');

}

function eliminarPersonaAsociada(id) {
    $("span[id='" + id + "']").remove();
}

function mostrarModalPersonasAsociadas() {
    document.getElementById("fap").reset();
    $("#modalAsociarPersona").modal('show');
}

$("#div_check_porcentaje_lista_precio").hide();

function opcionesListaPrecio(_this) {

    if (_this.value == 'PORCENTAJE') {
        $("#div_check_porcentaje_lista_precio").show();
    } else {
        $("#div_check_porcentaje_lista_precio").hide();
    }
}

function guardarVendedor() {
    $.post("/contacto/vendedor", $("#formularioVendedor").serialize(), function(data) {
        $("#vendedor_id").append('<option value="' + data.id + '">' + data.nombre + '</option>');
        alert('Se ha creado con exito el vendedor ' + data.nombre);
        $(".modal").modal('hide');
        $("#formularioVendedor")[0].reset();
    });
}

function guardarListaPrecio() {
    $.post("/configuracion/parametro/" + 20, $("#formularioListaPrecios").serialize(), function(data) {
        $("#lista_precios_id").append('<option value="' + data.id + '">' + data.valor + '</option>');
        alert('Se ha creado con exito la lista de precios ' + data.valor);
        $(".modal").modal('hide');
    });
}