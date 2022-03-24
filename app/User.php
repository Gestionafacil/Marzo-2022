<?php

namespace GestionaFacil;

use Faker\Provider\ar_JO\Person;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use GestionaFacil\Persona;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    /* protected $hidden = [
        'password', 'remember_token',
    ]; */

    protected $fillable = ['persona_id', 'plan_id', 'email', 'password', 'confirmado', 'token'];

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /* Método para guardar usuarios */
    public function guardarUsuario($request)
    {
        $this->email = $request['email'];
        $this->password = bcrypt($request['password']);
        $this->confirmado = false;
        $this->token = str_random(20);
        
        if( $this->save() )
        {
            return array('¡Usuario creado exitosamente!', 200);
        }
        
        return array('¡Usuario no creado!', 400);
    }

    /* Método para obtener los datos de la tabla persona, relacionado con el usuario logueado */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    /* Método para obtener los roles del usuario logueado */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'usuarios_roles', 'usuario_id', 'rol_id');
    }

    /* Método para validar si el usuario tiene un rol en especifico */
    public function tieneRol( $arrayRoles )
    {
        // $arrayRoles son los roles a validar
		// $rolesUsuario son los roles que tiene el usuario asignados previamente

        $rolesUsuario = $this->roles;

        //Se verificarán varios roles
		if(is_array($arrayRoles)){
			foreach($rolesUsuario as $rol){
				if(in_array($rol->alias, $arrayRoles)){
					return true;
				}
			}
		}else{
			foreach($rolesUsuario as $rol){
				if($rol->alias == $arrayRoles){
					return true;
				}
			}
		}

        return false;
    }

    /* Método para obtener los planes del usuario */
    public function planes()
    {
        return $this->belongsToMany(Plan::class, 'usuarios_planes', 'usuarios_id', 'planes_id')->withTimestamps();
    }
}
