<?php

namespace GestionaFacil\Http\Services\Factura\FacturaVenta;

use GestionaFacil\Http\Enterface\IFacturaVenta;
use GestionaFacil\Http\Repositories\FacturaRepository;
use Illuminate\Http\Request;

class GuardarComoBorradorFacturaVenta implements IFacturaVenta
{
    private $repository;

    public function __construct()
    {
        $this->repository = new FacturaRepository();
    }

    public function guardar(Request $request)
    {
        list($response, $status) = $this->repository->createInvoice($request);
        
        if( $status === 200 )
        {
            return array( "Factura guardada coreectamente como borrador." , $status);
        }

        return array( $response , $status);
    }
}