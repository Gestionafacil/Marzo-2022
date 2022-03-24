<?php

namespace GestionaFacil\Http\Controllers;

use GestionaFacil\Almacen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    public function index()
    {
        return view('almacen.index');
    }

    public function listado()
    {
        return DataTables::of(Almacen::all())->toJson();
    }

    public function guardar( Request $request )
    {
        $almacen = $request->id ? Almacen::find( $request->id ) : $almacen = new Almacen();
        $action = $request->id ? 'edtado' : 'creado';

        $almacen->nombre = $request->nombre;
        $almacen->direccion = $request->direccion;
        $almacen->observacion = $request->observacion;
        $almacen->empresas_id = $request->user()->persona->empresa->id;
        $almacen->save();

        return response()->json(['data' => $almacen, 'message' => 'Almacen '.$action.' exitosamente.']);
    }

    public function eliminar( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $banco = Almacen::find( $request->id );
                $banco->delete();
            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito al Alamcen'], 200);

    }

    public function cambiarEstado( Request $request )
    {
        $banco = Almacen::find($request->id);
        $banco->estado = $banco->estado == 1 ? $banco->estado = 0 : $banco->estado = 1;
        $banco->save();
        return response()->json( $banco );
    }
}
