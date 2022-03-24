<?php

namespace GestionaFacil;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['nombre', 'rfc', 'direccion', 'telefono', 'empresa_id', 'genero_id', 'tipo_persona_id'];
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function guardarPersona( $request )
    {
        $this->nombre = $request['nombre'];
        $this->rfc = $request['rfc'];
        $this->direccion = $request['direccion'];
        $this->calle = $request['calle'];
        $this->interior = $request['interior'];
        $this->exterior = $request['exterior'];
        $this->colonia = $request['colonia'];
        $this->localidad = $request['localidad'];
        $this->estado = $request['estado'];
        $this->pais = $request['pais'];
        $this->telefono = $request['telefono'];
        $this->telefono2 = $request['telefono2'];
        $this->celular = $request['celular'];
        $this->genero_id = $request['genero_id'];
        $this->tipo_persona_id = $request['tipo_persona_id'];

        if( $this->save() ){
            return array('Persona creada', 200);
        }
        else{
            return array('Persona no creada', 400);
        }
    }
}
