<?php

namespace GestionaFacil\Http\Services;

use Barryvdh\DomPDF\Facade as PDF;
use GestionaFacil\Contacto;
use GestionaFacil\FacturaVenta;
use Illuminate\Support\Facades\Mail;

class EmailService{
    
    public function __construct()
    {
        
    }

    public function enviarFacturaTimbrada( $id, $request )
    {
        $factura = FacturaVenta::find( $id );
        $contacto = Contacto::join('personas as p', 'p.id', '=', 'contactos.persona_id')->get();

        $pdf = PDF::loadView('print.invoice_basic', $factura);

        Mail::send('print.invoice_basic',$factura->toArray(), function($msj) use($pdf){
            $msj->from("danielalbor22@gmail.com","Gestiona Fácil");
            $msj->subject('Timbre de factura');
            $msj->to('danielalbor22@gmail.com');
            $msj->attachData($pdf->output(), 'test.pdf');
        });

        return true;
    }

}