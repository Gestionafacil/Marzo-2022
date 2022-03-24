@extends('layouts.master')
@section('title', 'Ajuste Inventario '.$ajuste->id)
@section('content')
    <h3 class="text-secondary titleConfig"><i class="fa fa-users"></i>Ajuste Inventario {{ $ajuste->id }}</h3>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <h4>Fecha de ajuste</h4>
                                <input type="text" disabled readonly class="form-control border-0" style="background: none; font-size: 20px !important;" value="{{ $ajuste->fecha_ajuste }}">
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <h4>Descripción</h4>
                                <textarea rows="2" disabled readonly class="form-control border-0" style="background: none; font-size: 20px !important;">{{ $ajuste->observacion }}</textarea>
                            </div>
                        </div>
                    </div>  
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table table-resposive">
                                <table class="table table" id="idTable">
                                    <thead>
                                        <th width="300">Producto</th>
                                        <th width="100">Cantidad actual</th>
                                        <th width="100">Tipo de ajuste</th>
                                        <th width="100">Cantidad</th>
                                        <th width="100">Cantidad final</th>
                                        <th width="100">Costo unitario</th>
                                        <th width="100">Total ajustado</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalle as $item)
                                            <tr>
                                                <td>{{ $item->producto }}</td>
                                                <td>{{ number_format($item->cantidad_inicial, 2) }}</td>
                                                <td>{{ $item->ajuste }}</td>
                                                <td>{{ number_format($item->cantidad, 2) }}</td>
                                                <td>{{ number_format($item->cantidad_final, 2) }}</td>
                                                <td>${{ number_format($item->costo_unitario, 2) }}</td>
                                                <td>${{ number_format($item->total_ajustado, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <h3>TOTAL ${{ number_format($ajuste->precio_total, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection