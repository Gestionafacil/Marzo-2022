<?php

namespace GestionaFacil\Http\Controllers\Factura;

use Illuminate\Http\Request;
use GestionaFacil\Http\Controllers\Controller;

class PagoRecibidoController extends Controller
{
    public function index()
    {
        return view('factura.pagoRecibido.pago_recibido');
    }

    public function pagoRecibido()
    {
        return view('factura.pagoRecibido.nueva_pago_recibido');
    }
}
