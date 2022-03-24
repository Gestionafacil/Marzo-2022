<?php

namespace GestionaFacil\Http\Services\Factura\FacturaVenta;

use GestionaFacil\Http\Enterface\IFacturaVenta;
use GestionaFacil\Http\Repositories\FacturaRepository;
use Illuminate\Http\Request;

class GuardarSinTimbrarFacturaVenta implements IFacturaVenta
{
    private $repository;

    public function __construct()
    {
        $this->repository = new FacturaRepository();
    }

    public function guardar(Request $request)
    {
        list( $response, $status ) = $this->repository->createInvoice($request, 1);
        
        if( $status === 200 )
        {
            return array( "Factura guardada coreectamente y sin ser timbrada." , $status);
        }

        return array( $response , $status);
    }
}