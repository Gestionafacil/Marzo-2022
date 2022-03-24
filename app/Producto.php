<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable  = [
        'empresa_id', 
        'nombre',
        'referencia',
        'categoria_id' , 
        'tipo_producto_id' ,
        'unidad_medida_id' ,
        'clave_producto_sat',
        'descripcion',
        'precio_total' ,
        'precio_sin_impuesto',
        'impuesto_id', 
        'producto_inventariable' ,
        'lista_precio_id',
        'estado'
    ];
    
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function guardarProducto( $request )
    {
        $precio = str_replace('$', '', $request["precio_total"] );
        $precio = str_replace(',', '', $precio );

        $precioSinImp = str_replace('$', '', $request["precio_sin_impuesto"] );
        $precioSinImp = str_replace(',', '', $precioSinImp );

        $this->nombre = $request["nombre"];
        $this->referencia = $request["referencia"];
        $this->categoria_id = $request["categoria_id"]; 
        $this->tipo_producto_id = $request["tipo_producto_id"];
        $this->unidad_medida_id = $request["unidad_medida_id"];
        $this->clave_producto_sat = $request["clave_producto_sat"];
        $this->descripcion = $request["descripcion"];
        $this->precio_total = $precio; 
        $this->precio_sin_impuesto = $precioSinImp; 
        $this->impuesto_id = $request["impuesto_id"]; 
        $this->producto_inventariable = (int)$request["producto_inventariable"];
        $this->lista_precio_id = $request["lista_precio_id"];
    
        if( $this->save() ){
            return array('Producto creada', 200);
        }
        else{
            return array('Producto no creada', 400);
        }
    }
}