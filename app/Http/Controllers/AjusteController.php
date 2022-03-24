<?php

namespace GestionaFacil\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use GestionaFacil\Ajuste;
use GestionaFacil\AjusteDetalle;
use GestionaFacil\Producto;
use GestionaFacil\ProductoAlmacen;

class AjusteController extends Controller
{
    public function ajuste()
    {
        return view("inventario.ajuste");
    }

    public function getAjusteInventario()
    {
        return view('inventario.nuevo_ajuste');
    }

    public function postAjusteInventario( Request $request )
    {
        /* dd( $almacen = ProductoAlmacen::where('producto_id', $request->producto_id[0])->get() ); */
        /* dd( $request ); */
        /* Validar los compos requeridos */
        $this->validate($request, [
            'fecha_ajuste' => 'required',
            'producto_id' => 'required',
        ]);

        $ajuste = new Ajuste();
        $ajuste->empresa_id = $request->user()->persona->empresa->id;
        $ajuste->observacion = $request->observacion;
        $ajuste->fecha_ajuste = $request->fecha_ajuste;
        $ajuste->precio_total = $request->precio_total;
        $ajuste->save();

        foreach ($request->producto_id as $key => $producto) {
            $ajusteDetalle = new AjusteDetalle();
            $ajusteDetalle->ajuste_id = $ajuste->id;
            $ajusteDetalle->producto_id = $producto;
            $ajusteDetalle->tipo_ajusste_id = $request->tipo_ajuste[$key];
            $ajusteDetalle->cantidad = $request->cantidad[$key];
            $ajusteDetalle->costo_unitario = $request->costo_unitario[$key];
            $ajusteDetalle->save();

            /* Cambio de cantidades */
            $almacen = ProductoAlmacen::where('producto_id', $producto)->first();

            switch ($request->tipo_ajuste[$key]) {
                case '0':
                    $almacen->cantidad_inicial = $almacen->cantidad_inicial +  $request->cantidad[$key];
                    break;
                case '0':
                    $almacen->cantidad_inicial = $almacen->cantidad_inicial -  $request->cantidad[$key];
                    break;
            }

            $almacen->save();
        }
        
        return redirect()->route('ajuste')->with(["success" => "Ajuste creado exitosamente"]);
    }

    public function listado()
    {
        return DataTables::of(Ajuste::all())->toJson();
    }

    public function listadoAjuste( Request $request )
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = ProductoAlmacen::join('productos as p', 'p.id', '=', 'almacen_producto.producto_id')
                ->select("p.id","p.nombre", "p.referencia", "almacen_producto.cantidad_inicial", "almacen_producto.costo_inicial")
                ->where('p.nombre','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function eliminar( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Ajuste a eliminar */
                $ajuste = Ajuste::find( $request->id );
                $ajuste->delete();

                /* Eliminar los detalles */
                AjusteDetalle::where('ajuste_id', $ajuste->id)->delete();

            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito al Ajuste'], 200);

    }

    public function cambiarEstado( Request $request )
    {
        $ajuste = Ajuste::find($request->id);
        $ajuste->estado = $ajuste->estado == 1 ? $ajuste->estado = 0 : $ajuste->estado = 1;
        $ajuste->save();
        return response()->json( $ajuste );
    }

    public function detalle($id)
    {
        $ajuste = Ajuste::find($id);
        $detalle = DB::table('ajuste_vista')->where('ajuste_id', $ajuste->id)->get();
        return view('inventario.ajuste_detalle', compact('ajuste', 'detalle'));
    }
}
