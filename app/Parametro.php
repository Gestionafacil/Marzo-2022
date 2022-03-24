<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';

    public static function descripcion( $parametro )
    {
        return Parametro::join('descripcion as d', 'd.parametro_id', 'parametros.id')->where('parametros.nombre', $parametro)->get();
    }
}
