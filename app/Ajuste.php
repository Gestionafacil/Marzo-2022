<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = "ajuste_inventario";

    protected $fillable = [
        'id', 
        'fecha_ajuste',
        'precio_total',
        'observacion', 
        'estado',
        'empresa_id'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
