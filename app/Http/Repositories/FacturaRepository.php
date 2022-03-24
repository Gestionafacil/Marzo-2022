<?php

namespace GestionaFacil\Http\Repositories;

use GestionaFacil\FacturaVenta;
use Exception;
use GestionaFacil\DetalleFactura;
use Illuminate\Support\Facades\DB;

class FacturaRepository{
        
        public function createInvoice($facturaVentaData, $estado = 0){
            try {
                $factura = new FacturaVenta();

                DB::transaction(function () use ($factura, $facturaVentaData, $estado) {
                    
                    $factura->tipo_documento_id = "1";//$facturaVentaData->tipo_documento_id; 
                    $factura->empresa_id = $facturaVentaData->user()->persona->empresa->id;
                    $factura->contacto_id = $facturaVentaData->contacto_id;
                    $factura->fecha_vencimiento = $facturaVentaData->vencimiento;
                    $factura->almacen_id = $facturaVentaData->almacen_id;
                    $factura->lista_precio_id = $facturaVentaData->lista_precio_id;
                    $factura->vendedor_id = $facturaVentaData->vendedor_id;
                    $factura->terminos_condiciones = $facturaVentaData->terminos_condiciones;
                    $factura->notas = $facturaVentaData->notas;
                    $factura->pie_factura = $facturaVentaData->pie_factura;
                    $factura->firma = $facturaVentaData->firma;
                    $factura->estado = $estado;
                    $factura->total_valor = 0; //$facturaVentaData->total_valor;
                    $factura->save();

                    foreach( $facturaVentaData->arrayFact as $arr ){
                        $detalle = new DetalleFactura();
                        $detalle->factura_id = $factura->id;
                        $detalle->producto_id = $arr["producto_id"];
                        $detalle->precio = $arr["precio"];
                        $detalle->descuento = explode('% ', $arr["desc"])[1];
                        $detalle->cantidad = $arr["cantidad"];
                        $detalle->save();
                    }
                });

                return array($factura, 200);

            } catch (Exception $e) {
                return array($e->getMessage(), 400);
            }
        }

        public function facturaTimbrada( $id, $cfdi_timbrado )
        {
            $factura = FacturaVenta::find( $id );
            $factura->uuid = $cfdi_timbrado->stampResult->UUID;
            $factura->estado = 2;
            $factura->save();
            return $factura;
        }
    }