<?php

namespace GestionaFacil\Http\Controllers;

use Illuminate\Http\Request;
use GestionaFacil\Helpers\MailHelper;

class contactoRegController extends Controller
{
   public function getContactoReg()
   {
    return view('autenticar.contacto');
   }

   public function envioMailContacto(Request $request)
   {
      $mail = new MailHelper();
      $mail->sendMail( $request, $request['email'], $usuario, 'email-contacto');
   }
}
