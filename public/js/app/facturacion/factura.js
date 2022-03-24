$(document).ready(() => {

    $('#producto_id').select2({
        placeholder: 'Seleccione producto',
        ajax: {
            url: 'inventario/producto/list',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
})