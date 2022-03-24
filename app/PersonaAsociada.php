<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class PersonaAsociada extends Model
{
    protected $table = 'personas_asociadas';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
