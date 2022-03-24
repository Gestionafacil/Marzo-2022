/* Modal de empresa */
function estadoFacturacion(param) {

    if (param) {
        $("#card-activo").attr('hidden', false);
        $("#btnActivaFact").attr('hidden', true);
        $("#btnDesactFact").attr('hidden', false);
    } else {
        $("#card-activo").attr('hidden', true)
        $("#btnDesactFact").attr('hidden', true);
        $("#btnActivaFact").attr('hidden', false);

    }

}

/* Mostra el formulario para crear un nuevo usuario */
function displayFormulario(param) {
    if (param) {
        $("#formCrearUsuario").attr('hidden', true);
    } else {
        $("#formCrearUsuario").attr('hidden', false)
    }
}

$("#tipo_persona_id").on('change', function(target) {

    if (target.target.selectedOptions[0].text == 'OTRO') {
        $("#a_que_te_dedicas").attr('hidden', false);
        $("#te_dedicas").show();
        $("#te_dedicas").attr('required');
    } else {
        $("#a_que_te_dedicas").attr('hidden', true);
        $("#te_dedicas").hide();
        $("#te_dedicas").removeAttr('required');
    }

});


/* Obtener referencia al input y a la imagen */
const $seleccionArchivos = document.querySelector("#seleccionarLogo"),
    $imagenPrevisualizacion = document.querySelector("#previsualizarLogo");

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