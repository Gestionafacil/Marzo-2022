<?php

namespace GestionaFacil\Http\Controllers\Factura;

use Illuminate\Http\Request;
use GestionaFacil\Http\Controllers\Controller;
use GestionaFacil\Helpers\ParametroHelper;
use GestionaFacil\Contacto;
use GestionaFacil\Vendedor;
use GestionaFacil\Almacen;
use GestionaFacil\DetalleFactura;
use GestionaFacil\FacturaVenta;
use GestionaFacil\FacturaVista;
use GestionaFacil\Http\Factory\FacturaVentaFactory;
use GestionaFacil\Producto;
use GestionaFacil\Http\Requests\FacturaVentaRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FacturaVentaController extends Controller
{    
    public function __construct(){}

    public function index()
    {
        $facturas = FacturaVenta::all();
        // var_dump($this->listarFactura());
        // exit;
        return view('factura.facturaVenta.factura_venta', compact('facturas'));
    }

    public function facturaNueva(){
        
        $metodo_Pago = ParametroHelper::obtenerParametros('METODO_DE_PAGO');
        $forma_pago = ParametroHelper::obtenerParametros('FORMA_DE_PAGO');
        $almacen = Almacen::all();
        $lista_precio = ParametroHelper::obtenerParametros('LISTA_PRECIO');
        $vendedor = Vendedor::all();
        $contacto = Contacto::join('personas as p', 'p.id', '=', 'contactos.persona_id')->select('p.nombre', 'contactos.id')->get();
        $plazo_pago = ParametroHelper::obtenerParametros('PLAZO_PAGO');
        $uso = ParametroHelper::obtenerParametros('CFDI');
        $producto = Producto::all();
        $impuestos = ParametroHelper::obtenerParametros('IMPUESTO');

        return view('factura.facturaVenta.nueva_factura_venta', compact('metodo_Pago', 'forma_pago', 'almacen', 'lista_precio', 'vendedor', 'contacto', 'plazo_pago', 'uso',  'producto',  'impuestos'));
    }

    public function guardarFactura( FacturaVentaRequest $request, FacturaVentaFactory $facturaVentaFactory )
    {   
        $factura = $facturaVentaFactory->initialize( $request->InvoiceType );
        list($res, $status) = $factura->guardar($request);
        return response()->json( [ 'message' => $res, 'status' => $status ] );
    }

    public function cancelarFactura( Request $request ){
        
    }

    public function imprimirFactura( $id, $action )
    {   
        $factura = FacturaVista::where('codigoFactura', $id)->first()->toArray();
        $detalle = DetalleFactura::join('productos as p', 'p.id', '=', 'factura_detalle.producto_id')
        ->join('descripcion as d', 'd.id', '=', 'p.unidad_medida_id')
        ->where('factura_detalle.factura_id', $id)
        ->select('p.nombre', 'factura_detalle.cantidad', 'factura_detalle.precio', 'd.valor', 'd.valor_adicional')
        ->get()
        ->toArray();
        /* dd(array('factura' => $factura, 'detalle' => $detalle)); */
        $pdf = \PDF::loadView('print.invoice_basic', array('factura' => $factura, 'detalle' => $detalle));
        return $pdf->stream('archivo.pdf');
    }

    public function listarFactura()
    {

        return DataTables::of(FacturaVenta::all())->toJson();
    }
}