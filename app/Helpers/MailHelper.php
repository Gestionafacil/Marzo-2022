<?php

    namespace GestionaFacil\Helpers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class MailHelper{

        public function __construct()
        {

        }

        public function sendMail( Request $request, $subject, $usuario, $plantilla )
        {
            return Mail::send('mail.'.$plantilla,$usuario->toArray(), function($msj) use($subject,$usuario){
                $msj->from("registro@gestionafacil.com","Gestiona Fácil");
                $msj->subject($subject);
                $msj->to($usuario->email);
            });
        }

        public function sendMailContact( Request $request, $plantilla )
        {
            return Mail::send('mail.'.$plantilla,$request->toArray(), function($msj) use($subject,$request){
                $msj->from("registro@gestionafacil.com","Gestiona Fácil");
                $msj->subject($subject);
                $msj->to("contacto@gestionafacil.com");
            });
        }

    }