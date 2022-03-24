<?php

namespace GestionaFacil\Http\Controllers;

use GestionaFacil\Empresa;
use Illuminate\Http\Request;

use GestionaFacil\User as Usuario;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

use GestionaFacil\Helpers\MailHelper;
use GestionaFacil\Persona;

class AuthController extends Controller
{
    public function getAutenticar()
    {
        return view('autenticar.autenticar');
    }

    public function postAutenticar(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
        {
            if( !Auth::user()->confirmado )
            {
                Auth::logout();
                return redirect()->back()
                ->with('error', 'Aun no has confirmado tu cuenta con el correo electónico que te ha sido enviado.')
                ->withInput();    
            }

            return Redirect::route('Dashboard')->with('logoStatus', 'true');

        }
        else
        {
            return redirect()->back()->with('error', 'Credenciales incorrectas, si no tienes una cuenta, puedes crearla. Es totalmente gratis.')->withInput();
        }
    }

    public function getRegistrar()
    {
        return Redirect::route('login')->with('success', 'Lo sentimos, pero en estos momentos, no se pueden crear cuentas de usuarios.');
        return view('autenticar.registrar');
    }

    /* Método para crear nuevos usuarios */
    public function postRegistrar( Request $request )
    {
        /* Validar Request */
        $data = $this->validate($request, [
            'email' => 'required|unique:usuarios|max:45',
            'password' => 'required'
        ]);

        /* Instancia el Usuario */
        $usuario = new Usuario();
        
        /* Guardar el usuario */
        list($response, $status) = $usuario->guardarUsuario($request);

        if( $status === 200 )
        {
            /* Asignarle el Rol al usuario */
            $usuario->roles()->attach( 1 );

            /* Crear la Persona */
            $persona = new Persona();
            $persona->guardarPersona( $request );

            /* Asignarle el ID persona al usuario */
            $usuario->persona_id = $persona->id;
            $usuario->save();

            /* Crear la empresa */
            $empresa = new Empresa();
            $empresa->guardarEmpresa($request);
            $empresa->save();

            /* Asignarle una Empresa a la Persona */
            $persona->empresa_id = $empresa->id;
            $persona->save();

            /* Agregarle el Plan Gratis a la empresa */
            $empresa->plan()->attach(1);

            /* Enviar Correo */
            $mail = new MailHelper();
            $mail->sendMail( $request, 'Confirmación de cuenta', $usuario, 'email-confirmation');

            return Redirect::route('login')->with('success', 'Hemos enviado un enlace de confirmación a su correo electrónico.');
        }
    }

    public function verificar($token)
    {
        $usuario = Usuario::where('token', $token)->first();
        
        if( $usuario )
        {
            $usuario->confirmado = true;
            $usuario->token = null;
            $usuario->save();
            
            $request = new Request();

            /* Enviar Correo */
            $mail = new MailHelper();
            $mail->sendMail( $request, 'Bienvenido', $usuario, 'welcome');

            return Redirect::route('login')->with('success', 'Su cuenta ha sido activada con exito, ahora puedes autenticarte!');
        }
        else
        {
            return Redirect::route('login')->with('error', 'El código de confirmación es incorrecto o ha expirado!');
        }

    }

    public function salir()
    {
        Auth::logout();
        return Redirect::route('Bienvenido');
    }
}
