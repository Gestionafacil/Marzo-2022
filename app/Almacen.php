<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';

    protected $fillable  = [
        'empresa_id', 
        'nombre', 
        'direccion',
        'observacion'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
