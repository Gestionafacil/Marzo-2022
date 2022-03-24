<?php

namespace GestionaFacil\Http\Controllers;

use Illuminate\Http\Request;

use GestionaFacil\User as Usuario;
use GestionaFacil\Empresa;
use GestionaFacil\Persona;

use GestionaFacil\Helpers\MailHelper;
use GestionaFacil\Helpers\ParametroHelper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use GestionaFacil\Descripcion;
use GestionaFacil\Parametro;
use GestionaFacil\Plan;
use GestionaFacil\Role;
use Illuminate\Support\Facades\DB as FacadesDB;
use Yajra\DataTables\Facades\DataTables;

class ConfiguracionController extends Controller
{
    public function index(Request $request)
    {
        return view('configuracion.index');
    }

    public function getEmpresa()
    {
        /* Validar que el usuario tenga una persona creada para poder crear una empresa */
        $usuario = Usuario::find( Auth::user()->id );
        
        if ( $usuario->persona != NULL )
        {
            /* El usuario logueado si tiene una  */
            $empresa = $usuario->persona->empresa;
            $num_empleados = ParametroHelper::obtenerParametros('NUM_EMPLEADO');
            $precision_decimal = ParametroHelper::obtenerParametros('PRECICION_DECIMAL');
            $separador_decimal = ParametroHelper::obtenerParametros('SEPARADOR_DECIMAL');
            $sectores = ParametroHelper::obtenerParametros('ACTIVIDAD_SOCIOECONOMICA');

            return view('configuracion.empresa', compact('empresa', 'num_empleados', 'precision_decimal', 'separador_decimal', 'sectores'))
            ->with('error', 'Error');
        }else
        {
            Session::flash('warning', 'Usted no tiene una persona creada, asi que no puede crear una empresa');
            return view('configuracion.empresa');
        }
    }

    public function postEmpresa( Request $request )
    {
        $data = $this->validate($request, [
            'nombre'    => 'required', 
            'precision_decimal' => 'required'
        ]);

        $empresa = Empresa::find($request->input('id'));
        $empresa->nombre = $request->input('nombre');
        $empresa->rfc = $request->input('rfc');
        $empresa->calle = $request->input('calle');
        $empresa->exterior = $request->input('exterior');
        $empresa->interior = $request->input('interior');
        $empresa->colonia = $request->input('colonia');
        $empresa->telefono = $request->input('telefono');
        $empresa->website = $request->input('website');
        $empresa->email = $request->input('email');
        $empresa->sector_socioeconomico_id = $request->input('sector_socioeconomico_id');
        $empresa->num_empleados = $request->input('num_empleados');
        $empresa->precision_decimal = $request->input('precision_decimal');
        $empresa->separador_decimal_export = $request->input('separador_decimal_export');
        
        if( $empresa->save() )
        {
            return Redirect::back()->with('success', 'Datos de empresa actualizados');
        }
        
    }

    public function getPerfil()
    {
        /* Tabla personas */
        $perfil = Usuario::find( Auth::user()->id )->persona;
        
        /* Parametros */
        $documentos = ParametroHelper::obtenerParametros('TIPO_IDENTIFICACION');
        $generos = ParametroHelper::obtenerParametros('GENERO');
        $tipos = ParametroHelper::obtenerParametros('TIPO_PERSONA');

        return view('configuracion.perfil', compact('perfil', 'documentos', 'generos', 'tipos'));
    }

    public function postPerfil( Request $request )
    {
        /* Actualizar Perfil del Usuario */
        $persona = $request->user()->persona;
        $persona->nombre = $request->input('nombre');
        $persona->rfc = $request->input('rfc');
        $persona->direccion = $request->input('direccion');
        $persona->telefono = $request->input('telefono');
        $persona->genero_id = $request->input('genero_id');
        $persona->tipo_persona_id = $request->input('tipo_persona_id');
        $persona->te_dedicas = $request->input('te_dedicas');
        if( $persona->save() )
        {
            return Redirect::route('Perfil')->with('success', '¡Ha actualizado la información de su perfil correctamente!.');            
        }
    }

    public function getCentroCostos()
    {
        return view('configuracion.centroCostos');
    }

    public function postCentroCostos( Request $request )
    {
        
    }

    public function getUsuario()
    {
        $empresa_id = Empresa::find( Auth::user()->persona->empresa->id );
       
        $usuarios = DB::table('usuarios_roles as ur')
        ->select('u.*', 'r.nombre as rol')
        ->join('usuarios as u', 'u.id', 'ur.usuario_id')
        ->join('roles as r', 'r.id', 'ur.rol_id')
        ->join('personas as p', 'p.id', 'u.persona_id')
        ->where('p.empresa_id', $empresa_id->id)
        ->get();

        $roles = Role::all();

        return view('configuracion.usuario', compact('usuarios', 'roles'));
    }

    public function postUsuario( Request $request )
    {
        /* Instancia el Usuario */
        $usuario = new Usuario();

        /* Validar Request */
        $this->validate($request, [
            'email' => 'required|unique:usuarios|max:45',/* unique:usuarios| */
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'rol' => 'required'
        ]);

        /* Guardar el usuario */
        list($response, $status) = $usuario->guardarUsuario($request);

        if( $status === 200 )
        {
            /* Asiganrle un Rol */
            $usuario->roles()->attach($request->input('rol'));

            /* Crear Persona */
            $persona = new Persona();
            $persona->guardarPersona($request);

            /* Asignarle una Persona al usuario */
            $usuario->persona_id = $persona->id;
            $usuario->save();

            /* Asignarle una empresa a la persona */
            $persona->empresa_id = $request->user()->persona->empresa->id;
            $persona->save();

            /* Enviar Correo */
            $mail = new MailHelper();
            #$mail->sendMail( $request, 'Confirmación de cuenta', $usuario, 'email-confirmation');

            return Redirect::back()->with('success', 'Usuario creado exitosamente');
        }
        else{
            return Redirect::back()->with('error', 'No se pudo crear el usuario');
        }
    }

    public function getSuscripcion()
    {
        $planes = Plan::all();
        return view('configuracion.suscripcion', compact('planes'));
    }

    public function getImpuesto()
    {
        $parametros = ParametroHelper::obtenerParametros('IMPUESTO');
        return view('configuracion.impuesto', compact('parametros'));
    }

    public function postImpuesto( Request $request )
    {
        $impuesto = new Descripcion();
        $impuesto->valor = $request->input('valor');
        $impuesto->valor_adicional = $request->input('nombre');
        $impuesto->parametro_id = 9;/* ID del Parametro IMPUESTO */
        $impuesto->save();
        return redirect()->back()->with('success', '¡Se ha creado con exito el impuesto!.');
    }

    public function postParametro( Request $request, $id )
    {
        $descripcion = $request->id ? Descripcion::find( $request->id ) : new Descripcion();
        $descripcion->parametro_id = $id;
        $descripcion->valor = $request->valor;
        $descripcion->valor_adicional = $request->valor_adicional;
        $descripcion->valor_defecto = $request->tipo_lista_precio;
        $descripcion->save();
        return response()->json( $descripcion, 200 );
    }

    public function listaPrecio()
    {
        return view('configuracion.listaPrecio');
    }

    public function listadoDescripcion($parametro_id)
    {
        return DataTables::of(Descripcion::where('parametro_id', $parametro_id)->get())->toJson();
    }

    public function cambiarEstado( Request $request )
    {
        $banco = Descripcion::find($request->id);
        $banco->estado = $banco->estado == 1 ? $banco->estado = 0 : $banco->estado = 1;
        $banco->save();
        return response()->json( $banco );
    }

    public function eliminarDescripcion( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $banco = Descripcion::find( $request->id );
                $banco->delete();
            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito la lista de precios'], 200);

    }
}
