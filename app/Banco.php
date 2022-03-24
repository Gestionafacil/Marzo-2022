<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    
    protected $fillable  = [
        'empresa_id', 
        'tipo_cuenta_id',
        'nombre', 
        'numero_cuenta',
        'fecha', 
        'descripcion',
        'saldo'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
