<?php

namespace GestionaFacil\Http\Controllers;

use Illuminate\Http\Request;

use GestionaFacil\Descripcion;
use GestionaFacil\Helpers\ParametroHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class AtributoController extends Controller
{
    public function index()
    {
        return view('atributo.index');
    }

    public function variante()
    {
        return view('atributo.variante');
    }

    public function campo()
    {
        return view('atributo.campo');
    }

    public function postVariante(Request $request)
    {
        $descripcion = $request->id ? Descripcion::find($request->id) : new Descripcion();
        $action = $request->id ? 'editar' : 'crear';

        $descripcion->parametro_id = 23; /* ID ATRIBUTO_VARIANTE */
        $descripcion->valor = $request->nombre;
        $descripcion->valor_adicional = implode(",", $request->opcion);
        if ($descripcion->save()) {
            return response()->json(array('message' => 'Acción ' . $action . ' realizada exitosamente.'), 200);
        }

        return Redirect::route()->with('error', 'No se puedo realizar la acción de ' . $action);
    }

    public function postCampo(Request $request)
    {
        $descripcion = $request->id ? Descripcion::find($request->id) : new Descripcion();
        $action = $request->id ? 'editar' : 'crear';

        $descripcion->parametro_id = 24; /* ID ATRIBUTO_CAMPO */
        $descripcion->valor = $request->nombre;
        $descripcion->valor_adicional = $request->tipo_campo;
        $descripcion->valor_defecto = $request->default;
        $descripcion->descripcion = $request->descripcion;
        $descripcion->obligatorio = $request->obligatorio;
        $descripcion->imprimir_factura = $request->imprimir_factura;

        if ($request->opcion) {
            $descripcion->valor_adicional_2 = implode(",", $request->opcion);
        } else {
            $descripcion->valor_adicional_2 = "";
        }

        if ($descripcion->save()) {
            return response()->json(array('message' => 'Acción ' . $action . ' realizada exitosamente.'), 200);
        }

        return Redirect::route()->with('error', 'No se puedo realizar la acción de ' . $action);
    }

    public function varianteListado()
    {
        return DataTables::of(Descripcion::where('parametro_id', 23)->get())->toJson();
    }

    public function campoListado()
    {
        return DataTables::of(Descripcion::where('parametro_id', 24)->get())->toJson();
    }

    public function cambiarEstado(Request $request)
    {
        $banco = Descripcion::find($request->id);
        $banco->estado = $banco->estado == 1 ? $banco->estado = 0 : $banco->estado = 1;
        $banco->save();
        return response()->json($banco);
    }

    public function eliminar(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $banco = Descripcion::find($request->id);
                $banco->delete();
            });
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito al atributo variante'], 200);
    }

    public function obtenerSat(Request $request)
    {
        //die($request->search);
        return response()->json(Descripcion::whereRaw("CONCAT(valor,'-',valor_adicional ) LIKE ?", ["%" . $request->search . "%"])
            ->where("parametro_id", 26)
            ->get());
    }

    public function listadoSat( Request $request )
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Descripcion::select("id","valor", "valor_adicional")
                    ->where("parametro_id", 26)
            		->where('valor','LIKE',"%$search%")
                    ->orWhere('valor_adicional','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }
}
