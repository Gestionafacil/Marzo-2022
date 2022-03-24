<?php
    namespace GestionaFacil\Helpers;
    
    use GestionaFacil\Descripcion;
    
    class ParametroHelper{

        public function __construct()
        {
            
        }

        public static function obtenerParametros( $nombre )
        {
             return Descripcion::join('parametros', 'descripcion.parametro_id', 'parametros.id')
            ->where('parametros.nombre', $nombre)
            ->select('descripcion.*')
            //->take(100)
            ->get();
        }

    }