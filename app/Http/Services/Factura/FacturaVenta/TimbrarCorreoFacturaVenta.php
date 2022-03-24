<?php

namespace GestionaFacil\Http\Services\Factura\FacturaVenta;

use GestionaFacil\Http\Enterface\IFacturaVenta;
use Illuminate\Http\Request;
use GestionaFacil\Http\Services\EmailService;

class TimbrarCorreoFacturaVenta implements IFacturaVenta
{
    private $guardarTimbrar;
    private $emailSerice;

    public function __construct()
    {
        $this->emailSerice = new EmailService();
        $this->guardarTimbrar = new GuardarTimbrarFacturaVenta();    
    }
    public function guardar(Request $request)
    {   
        list($response, $status) = $this->guardarTimbrar->guardar($request);

        $this->emailSerice->enviarFacturaTimbrada( $response->id, $request );


    }
}