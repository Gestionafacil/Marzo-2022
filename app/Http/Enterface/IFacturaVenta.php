<?php
    namespace GestionaFacil\Http\Enterface;

use Illuminate\Http\Request;

interface IFacturaVenta
    {
        public function guardar( Request $request );
    }
    