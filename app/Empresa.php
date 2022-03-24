<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre', 
        'rfc', 
        'calle', 
        'exterior', 
        'interior',
        'colonia',
        'telefono',
        'website',
        'email',
        'num_empleados',
        'regimen',
        'precision_decimal',
        'separador_decimal_export',
        'plan_id'
    ];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function guardarEmpresa( $request, $id = NULL )
    {
        /* $this->nombre = $request->input('nombre');
        $this->telefono = $request->input('telefono'); */

        if( $this->save() )
        {
            return array('Empresa creada exitosamente!', 200);
        }
        
        return array('Empresa no creada!', 400);
    }

    public function usuarios()
    {
        return $this->hasMany(Persona::class, 'empresa_id');
    }

    public function plan()
    {
        return $this->belongsToMany(Plan::class, 'empresas_planes', 'empresa_id', 'plan_id')->withTimestamps();
    }

}
