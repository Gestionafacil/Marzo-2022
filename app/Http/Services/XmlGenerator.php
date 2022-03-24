<?php

namespace GestionaFacil\Http\Services;

use Carbon\Carbon;
use GestionaFacil\FacturaVenta;
use Illuminate\Http\Request;
use MrGenis\Sat\CadenaOriginal33;

Class XmlGenerator{

        protected $template;

        public function cfdi($request){
            $concepto = $this->concepto($request->arrayFact);

            $this->template = file_get_contents( storage_path() . "/WSDL/cfdi.xml" );
            $this->template = str_replace('{{concepto}}', $concepto, $this->template);
            $this->template = str_replace('{{LugarExpedicion}}', $request->empresa->codPostal, $this->template);
            $this->template = str_replace('{{CondicionesDePago}}', $request->empresa->CondicionesDePago, $this->template);
            $this->template = str_replace('{{EmisorNombre}}', $request->empresa->nombre, $this->template);
            $this->template = str_replace('{{EmisorRegimenFiscal}}', $request->empresa->regimen, $this->template);
            $this->template = str_replace('{{EmisorRfc}}', $request->empresa->rfc, $this->template);
            $this->template = str_replace('{{NoCertificado}}', $request->empresa->NoCertificado, $this->template);
            /* 2021-09-15T16:58:47 */
            $this->template = str_replace('{{Fecha}}', substr( date('c'), 0, 19), $this->template);
            return $this->template;
        }

        public function sellar( $cfdi )
        {
            $sello = $this->sello( $this->cadenaOriginal( $cfdi ) );
            $this->template = str_replace('{{Sello}}', $sello, $this->template);
        }

        public function certificar( $cfdi )
        {
            $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents( storage_path() . "/CSD_Escuela_Kemper_Urgate_EKU9003173C9_20190617_131753s.cer" )));
            $this->template = str_replace('{{Certificado}}', $certificado, $this->template);
            return $this->template;
        }

        private function concepto( $conceptos ){
            $xml = '';
            for( $i=0; $i<count($conceptos); $i++){
                $xml.='<cfdi:Concepto Cantidad="'.$conceptos[$i]["cantidad"].'" ClaveProdServ="81112100" ClaveUnidad="E20" Descripcion="Servicio" Importe="1000.00" ValorUnitario="1000.00">'.
                        '<cfdi:Impuestos>'.
                            '<cfdi:Traslados>'.
                                '<cfdi:Traslado Base="1000.00" Importe="160.00" Impuesto="002" TasaOCuota="0.160000" TipoFactor="Tasa"/>'.
                            '</cfdi:Traslados>'.
                        '</cfdi:Impuestos>'.
                    '</cfdi:Concepto>';
            }
            return $xml;
        }

        public function sello($cadenaOriginal)
        {
            $fileKey = storage_path() . "/CSD_Escuela_Kemper_Urgate_EKU9003173C9_20190617_131753_key.pem"; // Ruta al archivo key
            $private = openssl_pkey_get_private(file_get_contents($fileKey));
            $sig = "";
            openssl_sign($cadenaOriginal, $sig, $private, OPENSSL_ALGO_SHA256);
            return base64_encode($sig);
        }

        public function cadenaOriginal($cfdi)
        {
            return CadenaOriginal33::cadenaOriginal($cfdi);
        }
    }