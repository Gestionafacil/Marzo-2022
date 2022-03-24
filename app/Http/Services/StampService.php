<?php

    namespace GestionaFacil\Http\Services;

use SoapClient;

Class StampService{

        public function stamp( $cfdi )
        {
            $username = 'jhonat.rodri@gmail.com';
            $password = 'Jhonatan123*';
        
            $url = "https://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl";
            $client = new SoapClient($url);
            
            $params = array(
            "xml" => $cfdi,
            "username" => $username,
            "password" => $password
            );
            $response = $client->__soapCall("stamp", array($params));
            return $response;
        }

    }