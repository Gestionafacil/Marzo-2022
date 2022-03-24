<?php

namespace GestionaFacil\Http\Controllers;

use GestionaFacil\Contacto;
use GestionaFacil\Helpers\MailHelper;
use GestionaFacil\Helpers\ParametroHelper;
use GestionaFacil\Persona;
use GestionaFacil\PersonaAsociada;
use Illuminate\Http\Request;

use GestionaFacil\User as Usuario;
use GestionaFacil\Vendedor;
use Illuminate\Support\Facades\Redirect;
use DB;

use DataTables;

class ContactoController extends Controller
{
    public function todos()
    {
        $contactos = Contacto::join('personas as p', 'p.id', 'contactos.persona_id')
        ->select('contactos.id', 'p.nombre', 'p.rfc', 'p.telefono', 'contactos.estado', 'contactos.create_time')
        ->orderBy('contactos.create_time', 'ASC')
        ->get();
        return view('contacto.todos', compact('contactos'));
    }

    public function getCliente()
    {
        $contactos = Contacto::join('personas as p', 'p.id', 'contactos.persona_id')
        ->select('p.nombre', 'p.rfc', 'p.telefono', 'contactos.estado', 'contactos.id', 'contactos.create_time')
        ->where('es_cliente', true)
        ->get();

        return view('contacto.cliente', compact('contactos'));
    }

    public function getProveedor()
    {
        $contactos = Contacto::join('personas as p', 'p.id', 'contactos.persona_id')
        ->select('p.nombre', 'p.rfc', 'p.telefono', 'contactos.estado', 'contactos.id', 'contactos.create_time')
        ->where('es_proveedor', true)
        ->get();

        return view('contacto.proveedor', compact('contactos'));
    }

    public function getContacto()
    {
        $tipo_terceros = ParametroHelper::obtenerParametros('TIPO_TERCERO');
        $cfdi = ParametroHelper::obtenerParametros('CFDI');
        $plazo_pago = ParametroHelper::obtenerParametros('PLAZO_PAGO');
        $tipo_operacion = ParametroHelper::obtenerParametros('TIPO_OPERACION');
        $cfdi = ParametroHelper::obtenerParametros('CFDI');
        $metodo_pago = ParametroHelper::obtenerParametros('METODO_DE_PAGO');
        $forma_pago = ParametroHelper::obtenerParametros('FORMA_DE_PAGO');
        $lista_precios = ParametroHelper::obtenerParametros('LISTA_PRECIO');
        $tipo_cliente = ParametroHelper::obtenerParametros('TIPO_CLIENTE');
        $tipo_proveedor = ParametroHelper::obtenerParametros('TIPO_PROVEEDOR');
        $vendedores = Vendedor::all();

        return view('contacto.nuevo', compact(
                'tipo_terceros', 
                'cfdi', 
                'plazo_pago', 
                'tipo_operacion', 
                'metodo_pago', 
                'forma_pago', 
                'lista_precios',
                'tipo_cliente',
                'tipo_proveedor',
                'vendedores'
            ));
    }

    public function postContacto( Request $request )
    {
        /* Valido los datos que me llegan del Request */
        $this->validate($request, [
            "tipo_tercero_id" => "required",
            "rfc" => "unique:personas",
            "nombre" => "required",
            "email" => "required|unique:usuarios"
        ]);

        if( $request->check_proveedor )
        {
            $this->validate($request, [
                "tipo_operacion_id" => "required"
            ]);
        }

        /* Creao el Usuario */
        $usuario = new Usuario();
        $request['password'] = 'GestionaFacil';
        list($response, $status) = $usuario->guardarUsuario( $request );
        
        if( $status == 200 )
        {   
            /* Crear la Persona */
            $persona = new Persona();
            list($response, $status) = $persona->guardarPersona($request);

            if( $status == 200 )
            {
                /* Asignarle el Rol al usuario */
                if( $request->check_cliente )
                {
                    $usuario->roles()->attach(3);
                }

                if( $request->check_proveedor )
                {
                    $usuario->roles()->attach(4);
                }

                /* Asignarle una empresa a la Persona */
                $persona->empresa_id = current_plan()->pivot->empresa_id;
                /* Asignarle el ID persona al usuario */
                $usuario->persona_id = $persona->id;
                $usuario->save();

                /* Crear el Contacto */
                $contacto = new Contacto();
                $contacto->persona_id = $persona->id;
                $contacto->incluir_estado_cuenta = $request->incluir_estado_cuenta;
                $contacto->es_cliente = $request->check_cliente;
                $contacto->es_proveedor = $request->check_proveedor;
                $contacto->tipo_tercero_id = $request->tipo_tercero_id;
                $contacto->tipo_operacion_id = $request->tipo_operacion_id;
                $contacto->plazo_pago_id = $request->plazo_pago_id;
                $contacto->vendedor_id = $request->vendedor_id;
                $contacto->lista_precios_id = $request->lista_precios_id;
                $contacto->metodo_pago_id = $request->metodo_pago_id;
                $contacto->forma_pago_id = $request->forma_pago_id;
                $contacto->uso_cfdi_id = $request->uso_cfdi_id;
                $contacto->cuenta_por_cobrar_id = $request->cuenta_por_cobrar_id;
                $contacto->cuenta_por_pagar_id = $request->cuenta_por_pagar_id;
                
                if( $contacto->save() )
                {
                    /* Crear perdona(s) asociada(s) */
                    if(isset($request->persona_asociada_nombre)){
                        foreach ($request->persona_asociada_nombre as $key => $value) {
                            $personaAsociada = new PersonaAsociada();
                            $personaAsociada->contacto_id = $contacto->id;
                            $personaAsociada->nombre = $value;
                            $personaAsociada->email = $request->persona_asociada_email[$key];
                            $personaAsociada->telefono = $request->persona_asociada_telefono[$key];
                            $personaAsociada->celular = $request->persona_asociada_celular[$key];
                            if( $request->persona_asociada_notificaciones[$key] != null ){
                                $personaAsociada->notificaciones = 1;
                            }
                            $personaAsociada->save();
                        }
                    }

                    /* Enviar Correo */
                    /* $mail = new MailHelper();
                    $mail->sendMail( $request, 'Confirmación de cuenta', $usuario, 'email-confirmation'); */

                    if( isset($request->guardarYCrearOtro) ){
                        return Redirect::route('ContactoNuevo')->with('success', 'Contacto '.$persona->nombre.' creado exitosamente');
                    }
                    
                    if( $request->check_cliente && !$request->check_proveedor )
                    {
                        return redirect()
                            ->route('ContactoCliente')
                            ->with('success', 'Contacto de tipo cliente'.$persona->nombre.' creado exitosamente');
                    }

                    if( !$request->check_cliente && $request->check_proveedor )
                    {
                        return redirect()
                            ->route('ContactoProveedor')
                            ->with('success', 'Contacto de tipo proveedor'.$persona->nombre.' creado exitosamente');
                    }

                    return Redirect::route('ContactoTodos')->with('success', 'Contacto '.$persona->nombre.' creado exitosamente');
                }
            }

        }
    }

    public function getVista( $id )
    {
        $contacto = DB::table('contactoview')->where('id', $id)->first();

        $tipo_terceros = ParametroHelper::obtenerParametros('contacto');

        return view('contacto.vista', compact('contacto', 'tipo_terceros'));
    }

    public function postVendedor( Request $request )
    {
        $vendedor = new Vendedor();
        $vendedor->nombre = $request->nombre;
        $vendedor->rfc = $request->rfc;
        $vendedor->descripcion = $request->descripcion;
        $vendedor->save();
        return response()->json($vendedor);
    }

    public function getEditar( $id )
    {
        $tipo_terceros = ParametroHelper::obtenerParametros('TIPO_TERCERO');
        $cfdi = ParametroHelper::obtenerParametros('CFDI');
        $plazo_pago = ParametroHelper::obtenerParametros('PLAZO_PAGO');
        $tipo_operacion = ParametroHelper::obtenerParametros('TIPO_OPERACION');
        $cfdi = ParametroHelper::obtenerParametros('CFDI');
        $metodo_pago = ParametroHelper::obtenerParametros('METODO_DE_PAGO');
        $forma_pago = ParametroHelper::obtenerParametros('FORMA_DE_PAGO');
        $lista_precios = ParametroHelper::obtenerParametros('LISTA_PRECIO');
        $tipo_cliente = ParametroHelper::obtenerParametros('TIPO_CLIENTE');
        $tipo_proveedor = ParametroHelper::obtenerParametros('TIPO_PROVEEDOR');
        $vendedores = Vendedor::all();

        $contacto = DB::table('contactoview')->where('id', $id)->first();

        $personasAsociadas = Contacto::join('personas_asociadas as pa', 'pa.contacto_id', 'contactos.id')->where('contactos.id', $contacto->id)->get();

        return view('contacto.editar', compact(
                'tipo_terceros', 
                'cfdi', 
                'plazo_pago', 
                'tipo_operacion', 
                'metodo_pago', 
                'forma_pago', 
                'lista_precios',
                'tipo_cliente',
                'tipo_proveedor',
                'vendedores',
                'contacto',
                'personasAsociadas'
            ));
    }

    public function postEditar( Request $request )
    {
        /* dd( $request->all() ); */

        /* Valido los datos que me llegan del Request */
        $this->validate($request, [
            "tipo_tercero_id" => "required",
            "rfc" => "required",
            "nombre" => "required",
            "email" => "required"
        ]);

        /* Obtener Contacto */
        $contacto = Contacto::find($request->id);
        
        /* Validar que el Contacto exista */
        if( $contacto )
        {

            /* Validar que si es un Proveedor, tenga el campo Tipo de Operación */
            if( $request->check_proveedor )
            {
                $this->validate($request, [
                    "tipo_operacion_id" => "required"
                ]);
            }

            /* Editar datos del Contacto */
            $contacto->incluir_estado_cuenta = $request->incluir_estado_cuenta;
            $contacto->es_cliente = $request->check_cliente;
            $contacto->es_proveedor = $request->check_proveedor;
            $contacto->tipo_tercero_id = $request->tipo_tercero_id;
            $contacto->tipo_operacion_id = $request->tipo_operacion_id;
            $contacto->plazo_pago_id = $request->plazo_pago_id;
            $contacto->vendedor_id = $request->vendedor_id;
            $contacto->lista_precios_id = $request->lista_precios_id;
            $contacto->metodo_pago_id = $request->metodo_pago_id;
            $contacto->forma_pago_id = $request->forma_pago_id;
            $contacto->uso_cfdi_id = $request->uso_cfdi_id;
            $contacto->cuenta_por_cobrar_id = $request->cuenta_por_cobrar_id;
            $contacto->cuenta_por_pagar_id = $request->cuenta_por_pagar_id;
            $contacto->save();

            /* Editar el Usuario */
            $usuario = Usuario::where('persona_id', $contacto->persona_id)->first();
            $usuario->email = $request->email;
            $usuario->save();

            /* Editar la Persona */
            $persona =Persona::find( $contacto->persona_id );
            $persona->rfc = $request->rfc;
            $persona->nombre = $request->nombre;
            $persona->calle = $request->calle;
            $persona->exterior = $request->exterior;
            $persona->interior = $request->interior;
            $persona->colonia = $request->colonia;
            $persona->localidad = $request->localidad;
            $persona->estado = $request->estado;
            $persona->celular = $request->celular;
            $persona->telefono = $request->telefono;
            $persona->telefono2 = $request->telefono2;
            $persona->save();

            /* Elimino los roles */
            $usuario->roles()->detach();

            /* Asignarle el Rol al usuario */
            if( $request->check_cliente )
            {
                $usuario->roles()->attach(3);
            }

            if( $request->check_proveedor )
            {
                $usuario->roles()->attach(4);
            }

            /* Eliminar Personas Asociadas */

            /* Agregar Personas Asociadas */
            $personasAsociadasDelete = PersonaAsociada::where('contacto_id', $contacto->id)->delete();

            /* Crear perdona(s) asociada(s) */
            if( isset($request->persona_asociada_nombre) ) {
                foreach ($request->persona_asociada_nombre as $key => $value) {
                    $personaAsociada = new PersonaAsociada();
                    $personaAsociada->contacto_id = $contacto->id;
                    $personaAsociada->nombre = $value;
                    $personaAsociada->email = $request->persona_asociada_email[$key];
                    $personaAsociada->telefono = $request->persona_asociada_telefono[$key];
                    $personaAsociada->celular = $request->persona_asociada_celular[$key];
                    echo $request->persona_asociada_notificaciones[$key];
                    if( $request->persona_asociada_notificaciones[$key] == 'true' ){
                        $personaAsociada->notificaciones = 1;
                    }
                    
                    $personaAsociada->save();
                }
            }

            return Redirect::back()->with('success', 'Contacto '.$persona->nombre.' editado');

        }
        else
        {
            return Redirect::route('ContactoTodos')->with('error', 'El contacto que desea editar no existe');
        }
    }

    public function cambiarEstado( Request $request )
    {
        $contacto = Contacto::find($request->id);
        $contacto->estado = $contacto->estado == 1 ? $contacto->estado = 0 : $contacto->estado = 1;
        $contacto->save();
        return response()->json( $contacto );
    }

    /* Método para obtener los datos de un Contacto mediante su ID */
    public function obtenerContactoID( Request $request )
    {
        /* Obtener los datos mediante la View creada */
        try {
            $contacto = DB::statement('contactoview')->where('id', $request->id)->first();
        } catch (\Throwable $th) {
            $contacto = DB::table('contactoview')->where('id', $request->id)->first();
        }

        /* Comprobar que exista un Contacto con el ID */
        if( $contacto )
        {
            return response()->json( $contacto, 200 );
        }

        return response()->json( "No hay ningún contacto con el ID enviado", 400 );

    }

    /* Método para obtener las personas asociadas de un Contacto */
    public function obtenerContactoPersonasAsociadas( Request $request )
    {
        $personasAsociadas = Contacto::join('personas_asociadas as pa', 'pa.contacto_id', 'contactos.id')
        ->where('contactos.id', $request->id)
        ->get();

        return response()->json($personasAsociadas, 200);
    }

    public function listado()
    {
        return \DataTables::of(\DB::table('contactoview'))->make(true);
    }

    public function eliminar( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $contacto = Contacto::find( $request->id );
                
                /* Obtener la Persona */
                $persona =Persona::find( $contacto->persona_id );

                /* Obtener el Usuario */
                $usuario = Usuario::where('persona_id', $contacto->persona_id)->first();

                /* Eliminar las Personas Asociadas */
                PersonaAsociada::where('contacto_id', $contacto->id)->delete();

                /* Eliminar los Roles del Usuario */
                $usuario->roles()->detach();

                /* Eliminar el Contacto */
                $contacto->delete();

                /* Elimino el Usuario */
                $usuario->delete();

                /* Elimino la Persona */
                $persona->delete();

            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito al Contacto'], 200);

    }
}
