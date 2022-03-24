<?php

namespace GestionaFacil\Http\Factory;

use GestionaFacil\Http\Services\Factura\FacturaVenta\GuardarComoBorradorFacturaVenta;
use GestionaFacil\Http\Services\Factura\FacturaVenta\GuardarSinTimbrarFacturaVenta;
use GestionaFacil\Http\Services\Factura\FacturaVenta\GuardarTimbrarFacturaVenta;
use GestionaFacil\Http\Services\Factura\FacturaVenta\TimbrarCorreoFacturaVenta;

class FacturaVentaFactory
{

    public function initialize( $type )
    {
        /* 0. Borrador 1. Factura guardada pero no timbrada 2.Factura guardada y timbrada 3. Factura cancelada */
        switch( $type )
        {   case 'GuardarTimbrar':
                return new GuardarTimbrarFacturaVenta();
                break;

            case 'GuardarComoBorrador': 
                return new GuardarComoBorradorFacturaVenta();
                break;

            case 'GuardarSinTimbrar': 
                    return new GuardarSinTimbrarFacturaVenta();
                break;
            
            case 'TimbrarCorreo': 
                return new TimbrarCorreoFacturaVenta();
                break;
            
            default: 
                return array("Método no soportado", 400);
                break;
        }
    }

}