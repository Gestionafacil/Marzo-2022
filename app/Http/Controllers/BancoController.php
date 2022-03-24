<?php

namespace GestionaFacil\Http\Controllers;

use Illuminate\Http\Request;

use GestionaFacil\Banco;
use GestionaFacil\Helpers\ParametroHelper;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class BancoController extends Controller
{

    public function bancoId($id)
    {
        return response()->json( Banco::find($id) );
    }

    public function index()
    {
        $saldo = Banco::selectRaw("SUM(saldo) as saldo")->first()->saldo;
        return view('banco.index', compact('saldo'));
    }

    public function getNuevo()
    {
        $tipo_cuenta = ParametroHelper::obtenerParametros('TIPO_CUENTA');
        return view('banco.nuevo', compact('tipo_cuenta'));
    }

    public function postNuevo( Request $request )
    {
        if( isset( $request->id ) )
        {
            $banco = Banco::where('id', $request->id)
                ->update([
                    'tipo_cuenta_id' => $request->tipo_cuenta_id,
                    'nombre' => $request->nombre,
                    'numero_cuenta' => $request->numero_cuenta,
                    'fecha' => $request->fecha,
                    'descripcion' => $request->descripcion,
                    'saldo' => $request->tipo_cuenta_id,
                ]);
            return redirect()->route('Banco')->with(["success" => "Banco ".$request->nombre." actualizado exitosamente"]);
        }

        $request['empresa_id'] = $request->user()->persona->empresa->id;
        (new Banco($request->input()))->saveOrFail();
        return redirect()->route('Banco')->with(["success" => "Banco creado exitosamente"]);
    }

    public function getEditar( $id )
    {
        $banco = Banco::find($id);
        $tipo_cuenta = ParametroHelper::obtenerParametros('TIPO_CUENTA');
        return view('banco.editar', compact('banco', 'tipo_cuenta'));
    }

    public function detalle( $id )
    {
        $banco = Banco::find($id);
        return view('banco.detalle', compact('banco'));
    }

    public function listado()
    {
        return DataTables::of(Banco::all())->toJson();
    }

    public function cambiarEstado( Request $request )
    {
        $banco = Banco::find($request->id);
        $banco->estado = $banco->estado == 1 ? $banco->estado = 0 : $banco->estado = 1;
        $banco->save();
        return response()->json( $banco );
    }

    public function eliminar( Request $request )
    {
        try {
            
            DB::transaction(function() use ($request) {

                /* Obtener los datos del Contacto a eliminar */
                $banco = Banco::find( $request->id );
                $banco->delete();
            });
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        return response()->json(['message' => 'Se ha eliminado con exito al Banco'], 200);

    }

    public function getConciliar( $id )
    {
        return view('banco.conciliar');
    }
}
