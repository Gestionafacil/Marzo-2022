<?php

namespace GestionaFacil\Http\Controllers;

use GestionaFacil\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('categoria.index');
    }

    public function listado()
    {
        return DataTables::of(Categoria::all())->toJson();
    }

    public function guardar( Request $request )
    {
        $categoria = $request->id ? Categoria::find( $request->id ) : $categoria = new Categoria();
        $action = $request->id ? 'editada': 'creada';

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresas_id = $request->user()->persona->empresa->id;
        $categoria->save();

        return response()->json(['data' => $categoria, 'message' => 'Categoría '.$action.' correctamente.']);
    }

    public function eliminar( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $banco = Categoria::find( $request->id );
                $banco->delete();
            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito la categoría'], 200);

    }

    public function cambiarEstado( Request $request )
    {
        $banco = Categoria::find($request->id);
        $banco->estado = $banco->estado == 1 ? $banco->estado = 0 : $banco->estado = 1;
        $banco->save();
        return response()->json( $banco );
    }
}
