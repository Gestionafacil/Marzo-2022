<?php

namespace GestionaFacil\Http\Services\Factura\FacturaVenta;

use GestionaFacil\Http\Enterface\IFacturaVenta;
use GestionaFacil\Http\Repositories\FacturaRepository;
use GestionaFacil\Http\Services\cargarInformacion;
use GestionaFacil\Http\Services\StampService;
use GestionaFacil\Http\Services\XmlGenerator;

class GuardarTimbrarFacturaVenta implements IFacturaVenta
{
    private $repository;
    private $xmlGenerator;
    private $stampService;

    public function __construct( )
    {
        $this->repository = new FacturaRepository();
        $this->xmlGenerator = new XmlGenerator();
        $this->stampService = new StampService();    
    }

    public function guardar( $request )
    {
        list($response, $status) = $this->repository->createInvoice($request, 1);
        
        if( $status === 400 )
        {
            return array( $response, $status );
        }

        $cargar = new cargarInformacion($request);
        $request = $cargar->cargar();

        /* Crear CFDI */
        $cfdi = $this->xmlGenerator->certificar( $this->xmlGenerator->sellar( $this->xmlGenerator->cfdi($request) ) );
        
        /* Timbrar */
        $cfdi_timbrado = $this->stampService->stamp($cfdi);

        if( empty($cfdi_timbrado->stampResult->Incidencias) )
        {
            return array( $cfdi_timbrado, 400 );
        }

        $this->repository->facturaTimbrada($response->id, $cfdi_timbrado);

        return array($response, 200);

    }
}