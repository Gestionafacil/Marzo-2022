<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

}
