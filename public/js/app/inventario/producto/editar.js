$("#spinLoad").show();

$(document).ready(function() {

    /* Cargar la información del Producto */
    $.get('/inventario/producto/' + parseInt(location.href.split('/')[6]), function(res) {
        console.log(res);
        /* Editar información */
        $('title, .titleConfig:first').text(res.nombre);

        /* Bloquear inputs que no se pueden editar */
        //$("#tipo_producto_id").attr("disabled", true);
        $("#producto_inventariable").attr("disabled", true);

        /* Asignar valores */
        $("#id").val(res.id);
        $("#nombre").val(res.nombre);
        $("#referencia").val(res.referencia);
        $("#categoria_id").val(res.categporia_id);
        $("#tipo_producto_id").val(res.tipo_producto_id);
        $("#unidad_medida_id").val(res.unidad_medida_id);
        $("#descripcion").val(res.descripcion);
        $("#precio_total").val(res.precio_total);
        $("#precio_sin_impuesto").val(res.precio_sin_impuesto);

        /* Validar si es inventariable el producto */
        if (res.producto_inventariable == 0) {
            $("#producto_inventariable").attr("checked", false);
            $(".depende_inventario").hide();
            controlarRequired('.depende_inventario', false);
        } else {
            $("#almacen_id").val(res.almacen_id);
            $("#cantidad_inicial").val(res.cantidad_inicial);
            $("#cantidad_minima").val(res.cantidad_minima);
            $("#cantidad_maxima").val(res.cantidad_maxima);
            $("#costo_inicial").val(res.costo_inicial);
        }

        /* Validar si tiene LIsta Precio */
        if (res.lista_precio_id != null) {
            $("#lista_precio_id").val(res.lista_precio_id);
            $("#aplica_lista_precio").prop("checked", true);
            $(".lista_precio").show();
        }

        /* Agregar Clave Producto */
        $("#clave_producto_sat").append('<option selected value="' + res.clave_producto_sat + '">' + res.clave_producto + '</option>');

        $("#spinLoad").hide();
        $(".select").select2();
    });

});