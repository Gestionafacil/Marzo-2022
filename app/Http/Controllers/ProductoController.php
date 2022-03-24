<?php

namespace GestionaFacil\Http\Controllers;

use Exception;
use GestionaFacil\Helpers\ParametroHelper;
use Illuminate\Http\Request;
use GestionaFacil\Producto;
use GestionaFacil\Categoria;
use GestionaFacil\Almacen;
use GestionaFacil\ProductoAlmacen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductoController extends Controller
{
    public function producto()
    {
        return view("inventario.producto");
    }

    public function getProducto()
    {
        $tipo_producto = ParametroHelper::obtenerParametros('TIPO_PRODUCTO');
        $unidad_medida = ParametroHelper::obtenerParametros('UNIDAD_MEDIDA');
        $impuestos = ParametroHelper::obtenerParametros('IMPUESTO');
        $clave_producto = ParametroHelper::obtenerParametros('CLAVE_PRODUCTO');
        $categoria = Categoria::all();
        $almacenes = Almacen::all();
        $lista_precios = ParametroHelper::obtenerParametros('LISTA_PRECIO');

        return view("inventario.nuevo_producto", compact(
            'tipo_producto',
            'unidad_medida',
            'impuestos',
            'clave_producto',
            'categoria',
            'almacenes',
            'lista_precios'
        ));
    }

    public function vistaProducto($id)
    {
        $producto = DB::table('view_producto')->where('id', $id)->first();
        return view("inventario.vista_producto", compact('producto'));
    }

    public function loadProducto($id)
    {
        $producto = DB::table('productos')->where('id', $id)->first();
        /* Validar si el Producto existe */
        if( !$producto ){
            return redirect()->route('producto')->with('error', 'El producto no existe.');
        }

        $tipo_producto = ParametroHelper::obtenerParametros('TIPO_PRODUCTO');
        $unidad_medida = ParametroHelper::obtenerParametros('UNIDAD_MEDIDA');
        $impuestos = ParametroHelper::obtenerParametros('IMPUESTO');
        $clave_producto = ParametroHelper::obtenerParametros('CLAVE_PRODUCTO');
        $categoria = Categoria::all();
        $almacenes = Almacen::all();
        $lista_precios = ParametroHelper::obtenerParametros('LISTA_PRECIO');
        $productoAlmacen = DB::table('almacen_producto')->where('producto_id', $id)->first();

        return view("inventario.editar_producto", compact(
            'tipo_producto',
            'unidad_medida',
            'impuestos',
            'clave_producto',
            'categoria',
            'almacenes',
            'lista_precios',
            /* 'producto', */
            'productoAlmacen'
        ));
    }


    public function postProducto(Request $request)
    {        
        if( $request->id ){
            try
            {
                /* dd($request->request); */
                $precio = str_replace('$', '', $request["precio_total"] );
                $precio = str_replace(',', '', $precio );
                $precioSinImp = str_replace('$', '', $request["precio_sin_impuesto"] );
                $precioSinImp = str_replace(',', '', $precioSinImp );

                $producto = Producto::find($request->id);
                $producto->nombre = $request["nombre"];
                $producto->referencia = $request["referencia"];
                $producto->categoria_id = $request["categoria_id"]; 
                /* $producto->tipo_producto_id = $request["tipo_producto_id"]; */
                $producto->unidad_medida_id = $request["unidad_medida_id"];
                $producto->clave_producto_sat = $request["clave_producto_sat"];
                $producto->descripcion = $request["descripcion"];
                $producto->precio_total = $precio; 
                $producto->precio_sin_impuesto = $precioSinImp;
                $producto->impuesto_id = $request["impuesto_id"]; 
                /* $producto->producto_inventariable = (int)$request["producto_inventariable"]; */
                $producto->lista_precio_id = $request["lista_precio_id"];
                if( $producto->save() )
                {
                    if ($producto->producto_inventariable == 1) {
                        $precio = str_replace('$', '', $request['costo_inicial']);
                        $precio = str_replace(',', '', $precio);
        
                        /* $producto = Producto::latest('id')->first(); */
                        
                        $productoAlmacen = ProductoAlmacen::where('producto_id', $producto->id)->first();
                        $productoAlmacen->producto_id = $producto->id;
                        $productoAlmacen->almacen_id = $request->almacen_id;
                        $productoAlmacen->cantidad_inicial = $request->cantidad_inicial;
                        $productoAlmacen->cantidad_minima = $request->cantidad_minima;
                        $productoAlmacen->cantidad_maxima = $request->cantidad_maxima;
                        $productoAlmacen->costo_inicial = $precio;
                        $productoAlmacen->save();
                    }
                }
                
                return Redirect::route('producto')->with('success', 'Producto ' . $producto->nombre . ' editado exitosamente');

            }catch (\Exception $e) {
                return Redirect::back()->with('error', $e->getMessage());
            }
        }

        try {
            //instanciamos una clase llamada 'producto'
            $producto = new Producto();
            list($response, $status) = $producto->guardarProducto($request);
            $producto->empresa_id = current_plan()->pivot->empresa_id;
            $producto->save();

            if ($request->producto_inventariable == "1") {

                $precio = str_replace('$', '', $request['costo_inicial']);
                $precio = str_replace(',', '', $precio);

                $producto = Producto::latest('id')->first();

                $productoAlmacen = new ProductoAlmacen();
                $productoAlmacen->producto_id = $producto->id;
                $productoAlmacen->almacen_id = $request->almacen_id;
                $productoAlmacen->cantidad_inicial = $request->cantidad_inicial;
                $productoAlmacen->cantidad_minima = $request->cantidad_minima;
                $productoAlmacen->cantidad_maxima = $request->cantidad_maxima;
                $productoAlmacen->costo_inicial = $precio;
                $productoAlmacen->save();
            }
        } catch (\Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
        return Redirect::route('producto')->with('success', 'Producto ' . $producto->nombre . ' creado exitosamente');
    }

    public function listado()
    {
        return DataTables::of(Producto::orderBy('id', 'DESC')->get())->toJson();
    }

    public function cambiarEstado(Request $request)
    {
        $producto = Producto::find($request->id);
        $producto->estado = $producto->estado == 1 ? $producto->estado = 0 : $producto->estado = 1;
        $producto->save();
        return response()->json($producto);
    }

    public function eliminar(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                /* Obtener los datos del producto a eliminar */
                $producto = Producto::find($request->id);
                $producto->delete();
            });
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito el producto'], 200);
    }

    public function valor()
    {
        $total = Producto::join('almacen_producto as ap', 'ap.producto_id', '=', 'productos.id')
            ->selectRaw("SUM(ap.cantidad_inicial * ap.costo_inicial) AS valor")
            ->first();
        return view('inventario.valor', compact('total'));
    }

    public function ListadoValor()
    {
        return DataTables::of(
            Producto::join('almacen_producto as ap', 'ap.producto_id', '=', 'productos.id')
                ->selectRaw("productos.nombre as nombre, productos.referencia, productos.descripcion, productos.estado, productos.id,
                    ap.cantidad_inicial, ap.costo_inicial,
                    ap.costo_inicial * ap.cantidad_inicial AS total, 
                    descripcion.valor_adicional as unidad_medida_id, descripcion.valor as unidad")
                ->join('descripcion', 'descripcion.id', '=', 'productos.unidad_medida_id')
                ->get()
        )->toJson();
    }

    /* Función para obtener todos los datos de un Producto */
    public function datosProducto($id)
    {
        return response()->json(DB::table('view_producto')->where('id', $id)->first());
    }
    public function datosProductoSinId()
    {
        return DB::select('select * from view_producto');
    }
    
    public function listProducto(Request $request )
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Producto::select("id","nombre")
            ->where('nombre','LIKE',"%$search%")
            ->get();
        }
    }
}