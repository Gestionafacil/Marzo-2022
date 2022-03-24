<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'factura_detalle';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
