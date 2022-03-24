<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
