<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class FacturaVenta extends Model
{
    protected $table = 'factura';

    protected $fillable  = [
        'tipo_documento_id',
        'empresa_id',
        'contacto_id',
        'fecha_vencimiento',
        'almacen_id',
        'lista_precio_id',
        'vendedor_id',
        'terminos_condiciones',
        'notas',
        'pie_factura',
        'firma',
        'total_valor',
        'estado'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
