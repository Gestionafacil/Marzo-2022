<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable  = [
        'empresas_id', 
        'nombre', 
        'descripcion'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
