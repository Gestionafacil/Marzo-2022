<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

}
