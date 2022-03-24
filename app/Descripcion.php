<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Descripcion extends Model
{
    protected $table = 'descripcion';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    

}
