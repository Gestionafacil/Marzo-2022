<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class ProductoAlmacen extends Model
{
   protected $table = "almacen_producto";

   protected $fillable = ['producto_id',
                          'almacen_id',
                          'cantidad_inicial',
                          'cantidad_minima',
                          'cantidad_maxima', 
                          'costo_inicial'];

   public $timestamps = false;    
}
