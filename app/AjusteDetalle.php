<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class AjusteDetalle extends Model
{
    protected $table = 'ajuste_inventario_producto';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
