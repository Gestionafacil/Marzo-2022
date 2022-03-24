const appInv = $("#producto_inventariable");
const appPrecio = $("#aplica_lista_precio");

var qrCode = new QRCode(document.getElementById("qrCode"));

const $seleccionArchivos = document.querySelector("#selec_img_producto"),
      $imagenPrevisualizacion = document.querySelector("#previ_img_producto");

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
});

function aplicaInventario() {
    if (appInv.prop("checked")) {
        $("#container-invetario").removeAttr('hidden');
        $("#container-invetario-2").removeAttr('hidden');
    } else {
        $("#container-invetario").attr("hidden", true);
        $("#container-invetario-2").attr("hidden", true);
    }
}

function aplicaListaPrecio() {
    if (appPrecio.prop("checked")) {
        $("#container-precio").removeAttr('hidden');
        $("#lista_precio_id").attr("required", true)
    } else {
        $("#container-precio").attr("hidden", true);
        $("#lista_precio_id").removeAttr("required")
    }
}


function crearCodigoQr() {
    let text = "Producto o servicio : " + $("#nombre").val() + $("#categoria_id").val();
    if (text != "") {
        $("#modalCodigo").modal('show');
        qrCode.makeCode(text);
    }
}

/*$("#descargarCode").on("click", function () {
    var base64 = $("#codigoQR img").attr('src');
    $("#descargarCode").attr('href', base64);
    $("#descargarCode").attr('download', "codigoQR");
    $("#descargarCode").trigger("click");

});*/

/* Clave producto SAT */
$(document).ready(function () {
    $('#clave_producto_sat').select2({
        placeholder: 'Seleccione Clave SAT',
        ajax: {
            url: '/atributo/SAT',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
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
});