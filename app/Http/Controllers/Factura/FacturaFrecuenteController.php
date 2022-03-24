<?php

namespace GestionaFacil\Http\Controllers\Factura;

use Illuminate\Http\Request;
use GestionaFacil\Http\Controllers\Controller;

class FacturaFrecuenteController extends Controller
{
    public function index()
    {
        return view('factura.facturaFrecuente.factura_frecuente');
    }

    public function facturaFrecuenteNueva()
    {
        return view('factura.facturaFrecuente.nueva_factura_frecuente');
    }
}
