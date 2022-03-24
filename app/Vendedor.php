<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
